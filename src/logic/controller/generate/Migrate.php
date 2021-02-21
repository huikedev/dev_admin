<?php


namespace huikedev\dev_admin\logic\controller\generate;


use huikedev\huike_base\app_const\NoticeType;
use huikedev\huike_base\base\BaseLogic;
use huikedev\huike_base\exceptions\AppLogicException;
use huikedev\huike_base\exceptions\AppServiceException;
use huikedev\dev_admin\service\generate\facade\MigrateService;

class Migrate extends BaseLogic
{
    public function create()
    {
        try{
            MigrateService::create();
            $this->msg = '数据库迁移文件生成成功！';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

    public function run()
    {
        try{
            MigrateService::run();
            $this->msg = '数据库迁移执行成功！';
            $this->noticeType = NoticeType::DIALOG_SUCCESS;
        }catch (AppServiceException $appServiceException){
            throw new AppLogicException($appServiceException);
        }
        return $this;
    }

	 /**
	 * @desc 表字段生成迁移文件
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function tableToMigration():self
	{
		try{
			MigrateService::tableToMigration();
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
			$this->msg = '从表字段生成迁移文件成功';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}


	 /**
	 * @desc 表数据生成种子文件
	 * @huike logic
	 * @return self
	 * @throws AppLogicException
	 */
	public function tableToSeeds():self
	{
		try{
			MigrateService::tableToSeeds();
			$this->noticeType = NoticeType::NOTIFICATION_SUCCESS;
			$this->msg = '表数据生成种子文件成功！';
		}catch (AppServiceException $serviceException){
			throw new AppLogicException($serviceException);
		}
		return $this;
	}

}