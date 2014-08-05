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

        /**
         * @apiGroup Report
         * @apiName get_user_reports
         * @api {get} /report
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *           "success": true,
         *           "message": "Record(s) Found",
         *           "data": {
         *              "totalCount": 2,
         *              "report": [
         *                  {
         *                      "id": "1",
         *                      "user_id": "1",
         *                      "project_id": "15",
         *                      "created_at": null,
         *                      "updated_at": null,
         *                      "updated_by_id": null,
         *                      "reported_for_date": null,
         *                      "time_started_at": null,
         *                      "time_ended_at": null,
         *                      "comment": null
         *                   }
         *               ]
         *           }
         *       }
         * */
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


        /**
         * @apiGroup Report
         * @apiName create_user_report
         * @api {post} /report
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *           "success": true,
         *           "message": "Record(s) Found",
         *           "data": {
         *              "totalCount": 2,
         *              "report": {
         *                      "id": "1",
         *                      "user_id": "1",
         *                      "project_id": "15",
         *                      "created_at": "2014-08-05 17:41:44",
         *                      "updated_at": null,
         *                      "updated_by_id": null,
         *                      "reported_for_date": null,
         *                      "time_started_at": null,
         *                      "time_ended_at": null,
         *                      "comment": null
         *               }
         *           }
         *       }
         * */
        $this->onRest('model.apply.post.data', function($model, $data, $restricted_properties) {
            /**
             * @var Report $model
             */

            if(!isset($data['project_id'])){
                throw new CHttpException(400, 'Missing project id.');
            }

            unset($data['user_id']);

            if(!isset($data['time_started_at'])){
                $model->time_started_at = date('H:i:s', time());
            }

            if(!isset($data['reported_at'])){
                $model->time_started_at = date('Y-m:d H:i:s', time());
            }

            $model->user_id = Yii::app()->user->id;

            if(!Project::isUserBounded($data['project_id'], $model->user_id)){
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

    protected function isFullCOSRSupportEnabled()
    {
        return true;
    }
}