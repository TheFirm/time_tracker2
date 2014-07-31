<?php

/**
 * @method ERestResourceHelper getResourceHelper()
 */
class ReportController extends APIController
{
    public function restEvents()
    {
        $this->onRest(ERestEvent::MODEL_WITH_RELATIONS, function() {
            return [];
        });

        $this->onRest('model.count', function($model) {
            /**
             * @var Report $model
             */

            self::applyAllCondition($model);

            return $model->count();
        });

        $this->onRest('model.find.all', function($model) {
            /**
             * @var Report $model
             */

            self::applyAllCondition($model);

            return $model->findAll();
        });

        $this->onRest('model.restricted.properties', function() {
            return [
                'created_at',
                'updated_at',
                'id',
                'updated_by_id',
            ];
        });

        $this->onRest('model.apply.post.data', function($model, $data, $restricted_properties) {
            /**
             * @var Report $model
             */

            if(!isset($data['project_id'])){
                throw new CHttpException(400, 'Missing project id.');
            }

            if(!isset($data['user_id'])){
                throw new CHttpException(400, 'Missing user id.');
            }

            if(!Project::isUserBounded($data['project_id'], $data['user_id'])){
                throw new CHttpException(400, 'Not bounded to project.');
            }

            return $this->getResourceHelper()->setModelAttributes($model, $data, $restricted_properties);
        });

        $this->onRest('post.filter.req.auth.ajax.user', function($validation) {
            return !Yii::app()->user->isGuest;
        });
    }

    /**
     * @param Report $model
     * @return \Report
     */
    protected static function applyAllCondition(&$model){
        $criteria = $model->getDbCriteria(true);
        if(!Yii::app()->user->checkAccess('admin')){
            $criteria->addCondition('user_id = :user_id');
            $criteria->params[':user_id'] = Yii::app()->user->id;
        }

        return $model;
    }

	public function actionIndex()
	{
		echo 'V1';
	}
}