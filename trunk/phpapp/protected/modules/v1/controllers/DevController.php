<?php


class DevController extends APIController
{
    public function restEvents()
    {
        /**
         * @apiGroup Dev
         * @apiName checkAccess
         * @api {get} /dev/checkAccess Check's
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "google": "http://some link here",
         *     }
         * */
        $this->onRest('req.get.checkAccess.render', function($r) {
            echo json_encode([
                Yii::app()->user->checkAccess($r)
            ]);
        });


        $this->onRest('post.filter.req.auth.ajax.user', function($validation) {
            switch ($this->getAction()->getId()) {
                case 'REST.GET':
                case 'REST.POST':
                    return true;
                case 'REST.PUT':
                case 'REST.DELETE':
                    throw new CHttpException(400, 'Not implemented');
                    break;
                default:
                    return false;
                    break;
            }
        });


        $this->onRest('req.get.fake.render', function ($secret, $id) {
            if(!$secret or !$id or $secret != 2234){
                throw new CHttpException(400);
            }

            $uident = new UserIdentity('t', 't');
            $user = User::model()->findByPk($id);
            if(!$user){
                throw new CHttpException(400, 'No user found with id = ' . $id);
            }
            $uident->setId($user->id);
            Yii::app()->user->login($uident, 0);
            echo json_encode(['logined' => !Yii::app()->user->isGuest]);
        });

        /**
         * @apiGroup Dev
         * @apiName auth_status
         * @api {get} /auth/status Auth status
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "isLoggedIn": true,
         *       "user": [
         *          "name": "Some username",
         *          "type": 1,
         *          "id": 12
         *      ]
         *     }
         * */
        $this->onRest('req.get.status.render', function () {
            $arr = [
                'isLoggedIn' => !Yii::app()->user->isGuest
            ];

            if(!Yii::app()->user->isGuest){
                $usr = User::model()->findByPk(Yii::app()->user->id);

                if(!$usr){
                    Yii::app()->user->logout();
                    throw new CHttpException(500, 'Missing user in database');
                }

                $arr['user'] = [
                    'name' => $usr->name,
//                    'type' => $usr->type,
                    'id' => $usr->id
                ];
            }

            echo json_encode($arr);
        });

        /**
         * @apiGroup Auth
         * @apiName auth_status
         * @api {post} /auth/logout Auth status
         * @apiVersion 1.0.0
         *
         *
         * @apiSuccessExample Success-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": true,
         *     }
         *
         * @apiSErrorExample Error-Response:
         *     HTTP/1.1 200 OK
         *     {
         *       "success": false,
         *     }
         * */
        $this->onRest('req.post.logout.render', function () {
            $arr = [];

            if(Yii::app()->user->isGuest){
                $arr['success'] = false;
            } else {
                Yii::app()->user->logout();
                $arr['success'] = Yii::app()->user->isGuest;
            }

            echo json_encode($arr);
        });

        $this->onRest(ERestEvent::MODEL_INSTANCE, function() {
            throw new CHttpException(400, 'Not implemented');
        });
    }

    protected function isFullCOSRSupportEnabled()
    {
        return true;
    }
}