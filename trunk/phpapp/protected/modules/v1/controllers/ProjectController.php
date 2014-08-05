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
         *           "totalCount": 1,
         *          "project": {
         *              {
         *                  "id": "1",
         *                  "name": "testProject",
         *                  "active": "0",
         *                  "lft": "0",
         *                  "rgt": "0",
         *                  "level": "1",
         *                  "root": "1",
         *               }
         *          }
         *      }
         * */

        $this->onRest(ERestEvent::MODEL_WITH_RELATIONS, function() {
            return [];
        });

        /**
         * @apiGroup Project
         * @apiName bind_user_to_project
         * @api {get} /project/:id Get project by id
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": true
         *      }
         *
         * @apiErrorExample Error-Response:
         *     HTTP/1.1 400 Error
         *      {
         *          "success": false,
         *          "message": "Missing user id",
         *          "data": {
         *              "errorCode": 400,
         *              "message": "Missing user id"
         *          }
         *      }
         * @apiErrorExample Error-Response:
         *     HTTP/1.1 400 Error
         *      {
         *          "success": false,
         *          "message": "Missing project id",
         *          "data": {
         *              "errorCode": 400,
         *              "message": "Missing project id"
         *          }
         *      }
         *
         * * */
        $this->onRest('req.post.bindUser.render', function($data) {
            if(!isset($data['user_id'])){
                throw new CHttpException(400, 'Missing user id.');
            }
            if(!isset($data['project_id'])){
                throw new CHttpException(400, 'Missing project id.');
            }

            $project_id = $data['project_id'];
            $user_id = $data['user_id'];

            $response = [];

            if(Project::isUserBounded($project_id, $user_id)){
                throw new CHttpException(400, 'Already bounded.');
            }

            Project::bindUser($project_id, $user_id);

            $response['success'] = true;

            echo json_encode($response);
        });


        $this->onRest(ERestEvent::POST_FILTER_REQ_AUTH_AJAX_USER, function($validation) {
            switch ($this->getAction()->getId()) {
                case 'REST.GET':
                    return !Yii::app()->user->isGuest;
                case 'REST.POST':
                    return Yii::app()->user->checkAccess('admin');
                    break;
                case 'REST.PUT':
                    return Yii::app()->user->checkAccess('admin');
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
}