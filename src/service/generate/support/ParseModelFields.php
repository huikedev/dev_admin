<?php


namespace huikedev\dev_admin\service\generate\support;


use huikedev\huike_generator\migration\support\HuikeModelFields;
use Phinx\Db\Adapter\AdapterInterface;
use think\Collection;
use think\Exception;

class ParseModelFields
{
    /**
     * @var array
     */
    protected $modelFields;
    /**
     * @var array
     */
    protected $timestampFields;
    /**
     * @var string
     */
    protected $primary;
    /**
     * @var array
     */
    protected $jsonFields=[];
    /**
     * @var Collection
     */
    protected $modelFieldsCollection;
    protected $timestampRemark = ['delete_time'=>'软删除时间','update_time'=>'最后更新时间','create_time'=>'创建时间'];
    public function __construct(array $modelFields,array $timestampFields,string $primary='id')
    {
        $this->modelFields = $modelFields;
        $this->timestampFields = $timestampFields;
        $this->primary = $primary;
    }

    public function handle():self
    {
        $this->modelFieldsCollection = new Collection();
        $this->modelFieldsCollection->push($this->getPrimary());
        foreach ($this->modelFields as $key => $modelField){
            $this->modelFieldsCollection->push($this->parseField($key,$modelField));
        }
        foreach ($this->timestampFields as $timestampField){
            $this->modelFieldsCollection->push($this->parseTimestampField($timestampField));
        }
        return $this;
    }

    public function getCollection():Collection
    {
        return $this->modelFieldsCollection;
    }

    public function getJsonFields():array
    {
        return $this->jsonFields;
    }

    // 获取主键字段配置
    protected function getPrimary()
    {
        $primary = new HuikeModelFields();
        $primary->field_name = $this->primary;
        $primary->field_type = AdapterInterface::PHINX_TYPE_INTEGER;
        $primary->field_length = 11;
        $primary->field_scale = 0;
        $primary->field_index = 'primary';
        $primary->default_value = ['type'=>'undefined','value'=>'undefined'];
        $primary->field_options = ['primary','unsigned'];
        $primary->field_remark = '主键ID';
        return $primary;
    }

    // 获取数据表字段配置
    protected function parseField(int $key,array $modelField)
    {
        $fieldModel = new HuikeModelFields();
        if(isset($modelField['name']) === false || empty($modelField['name'])){
            throw new Exception('请输入第'.($key+1).'个自定义字段的字段名');
        }
        if(isset($modelField['type']) === false || empty($modelField['type'])){
            throw new Exception('请选择第'.($key+1).'个自定义字段的字段类型');
        }
        $fieldModel->field_name = $modelField['name'];
        $fieldModel->field_type = strtolower($modelField['type']);
        if($fieldModel->field_type === 'json'){
            $this->jsonFields[] = $fieldModel->field_name;
        }
        $fieldModel->field_length = $this->getFieldLength($modelField);
        $fieldModel->field_index = $modelField['index_type'] ?? 'none';
        $fieldModel->field_scale = $this->getFieldScale($modelField);
        $fieldModel->default_value = $this->getFieldDefaultValue($modelField);
        $fieldModel->field_options = $modelField['options'] ?? [];
        $fieldModel->field_remark = $modelField['field_remark'] ?? null;
        return $fieldModel;
    }

    protected function parseTimestampField(string $fieldName)
    {
        $fieldModel = new HuikeModelFields();
        $fieldModel->field_name = $fieldName;
        $fieldModel->field_type = AdapterInterface::PHINX_TYPE_INTEGER;
        $fieldModel->field_length = 11;
        $fieldModel->field_scale = 0;
        $fieldModel->field_index = 'none';
        $fieldModel->default_value = ['type'=>'integer','value'=>0];
        $fieldModel->field_options = ['unsigned'];
        $fieldModel->field_remark = $this->timestampRemark[$fieldName] ?? '未知时间戳';
        return $fieldModel;
    }

    protected function getFieldLength(array $fieldConfig):int
    {
        $fieldType = isset($fieldConfig['type']) ?  strtolower($fieldConfig['type']) : 'unknown';
        switch (true){
            case $fieldType === 'tinyinteger':
                return 4;
            case $fieldType === 'integer':
                return 11;
            case $fieldType === 'biginteger':
                return 20;
            case $fieldType ==='string' || $fieldType === 'char':
                $length = isset($fieldConfig['length']) ? intval($fieldConfig['length']) : 255;
                return  $length < 0 ? 255 : $length;
            case $fieldType === 'decimal':
                $length = isset($fieldConfig['length']) ? intval($fieldConfig['length']) : 8;
                $length = $length > 11 ? 11 : $length;
                return $length === 0 ? 8 :$length;
            default:
                return 0;
        }
    }

    protected function getFieldScale(array $fieldConfig):int
    {
        $fieldType = isset($fieldConfig['type']) ?  strtolower($fieldConfig['type']) : 'unknown';
        if($fieldType === 'decimal'){
            $decimal = isset($fieldConfig['length']) ? intval($fieldConfig['length']) : 8;
            return $decimal <= 0 ? 2 : $decimal;
        }else{
            return 0;
        }
    }

    protected function getFieldDefaultValue(array $fieldConfig)
    {
        if(isset($fieldConfig['default_value'])){
            if($fieldConfig['default_value']===''){
                $data['type'] = 'undefined';
                $data['value'] = 'undefined';
                return $data;
            }
            if(is_numeric($fieldConfig['default_value'])){
                if(strpos($fieldConfig['default_value'],'.')===false){
                    $data['type']='integer';
                    $data['value'] = intval($fieldConfig['default_value']);
                }else{
                    $data['type']='double';
                    $data['value'] = floatval($fieldConfig['default_value']);
                }
            }else{
                $data['type']=gettype($fieldConfig['default_value']);
                $data['value'] = $fieldConfig['default_value'];
            }
        }else{
            $data['type'] = 'undefined';
            $data['value'] = 'undefined';
        }
        return $data;
    }


}