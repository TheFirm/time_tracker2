<?php


class UserController extends APIController
{
    public function restEvents()
    {
        /**
         * @apiGroup User
         * @apiName get_user_list
         * @api {get} /user Get user list
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": true,
         *       "data": {
         *           "totalCount": 2,
         *           "user": [
         *               {
         *                   "id": "1",
         *                  "first_name": "testUser1",
         *                   "last_name": "testUser11"
         *               },
         *               {
         *                   "id": "2",
         *                   "first_name": "testUser2",
         *                   "last_name": "testUser22"
         *               }
         *          ]
         *      }
         * */

        /**
         * @apiGroup User
         * @apiName get_user_by_id
         * @api {get} /user/:id Get user by id
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *           "success": true,
         *           "message": "Record Found",
         *           "data": {
         *               "totalCount": 1,
         *               "user": {
         *                   "id": "1",
         *                   "first_name": "testUser1",
         *                   "last_name": "testUser11"
         *               }
         *           }
         *      }
         * */

        $this->onRest(ERestEvent::MODEL_WITH_RELATIONS, function() {
            return [];
        });

        $this->onRest(ERestEvent::MODEL_VISIBLE_PROPERTIES, function() {
            return [
                'id',
                'first_name',
                'last_name',
            ];
        });


        $this->onRest('post.filter.req.auth.ajax.user', function($validation) {
            switch ($this->getAction()->getId()) {
                case 'REST.GET':
                    return !Yii::app()->user->isGuest;
                case 'REST.POST':
                    throw new CHttpException(400, 'Not implemented');
                    break;
                case 'REST.PUT':
                case 'REST.DELETE':
                    throw new CHttpException(400, 'Not implemented');
                    break;
                default:
                    return false;
                    break;
            }
        });
    }

    protected function isFullCOSRSupportEnabled()
    {
        return true;
    }
}