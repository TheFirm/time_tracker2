<?php


class ProjectController extends APIController
{
    public function restEvents()
    {
        /**
         * @apiGroup Project
         * @apiName get_project_list
         * @api {get} /project Get project list
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": true,
         *       "data": {
                    "totalCount": 2,
                    "project": [
                        {
                            "id": "1",
                            "name": "testProject",
                            "active": "0",
                            "lft": "0",
                            "rgt": "0",
                            "level": "1",
                            "root": "1",
                        },
                        {
                            "id": "2",
                            "name": "testProject2",
                            "active": "0",
                            "lft": "0",
                            "rgt": "0",
                            "level": "1",
                            "root": "1",
                        }
         *          ]
         *      }
         * */

        /**
         * @apiGroup Project
         * @apiName get_project_by_id
         * @api {get} /project/:id Get project by id
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": true,
         *       "data": {
                    "totalCount": 1,
                    "project": {
                        {
                            "id": "1",
                            "name": "testProject",
                            "active": "0",
                            "lft": "0",
                            "rgt": "0",
                            "level": "1",
                            "root": "1",
                        }
         *          }
         *      }
         * */

        $this->onRest(ERestEvent::MODEL_WITH_RELATIONS, function() {
            return [];
        });

//        $this->onRest(ERestEvent::MODEL_VISIBLE_PROPERTIES, function() {
//            return [
//                'id',
//                'first_name',
//                'last_name',
//            ];
//        });

        $this->onRest('post.filter.req.auth.ajax.user', function($validation) {
            switch ($this->getAction()->getId()) {
                case 'REST.GET':
                    return !Yii::app()->user->isGuest;
                case 'REST.POST':
                    throw new CHttpException(400, 'Not implemented');
                    break;
                case 'REST.PUT':
                    return Yii::app()->user->checkAccess('edit-project');
                    break;
                case 'REST.DELETE':
                    throw new CHttpException(400, 'Not implemented');
                    break;
                default:
                    return false;
                    break;
            }
        });
    }

	public function actionIndex()
	{
		echo 'V1';
	}
}