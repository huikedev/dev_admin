<?php


namespace huikedev\dev_admin\common\model_trait;


use huikedev\dev_admin\common\caching\facade\DeveloperCache;

trait CreatorTrait
{
    public function getCreatorAttr($value,$data): array
    {
        $default = [
          'id'=>-1,
          'username'=>'无记录',
            'position_id'=>-1,
          'position_text'=>'无记录'
        ];
        if(isset($data['creator_id']) === false){
            return $default;
        }
        if(is_numeric($data['creator_id']) && $data['creator_id'] > 0){
            return DeveloperCache::setId($data['creator_id'])->getModel()->append(['position_text'])->toArray();
        }
        $default['id'] = 0;
        $default['username'] = '未知';
        return $default;
    }
}