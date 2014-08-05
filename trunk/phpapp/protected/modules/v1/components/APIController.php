<?php
/**
 * Created by PhpStorm.
 * User: oops
 * Date: 7/24/2014
 * Time: 3:44 PM
 */

/**
 * @method Object onRest(string $event, Callable $listener)
 * @method emitRest()
 */
abstract class APIController extends CController{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter +
                REST.GET, REST.PUT, REST.POST, REST.DELETE, REST.OPTIONS'
            ),
        );
    }

    public function actions()
    {
        return array(
            'REST.'=>'RestfullYii.actions.ERestActionProvider',
        );
    }

    protected function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            if($this->isFullCOSRSupportEnabled()){
                $this->enableCORSSupport();
            }
            return true;
        }
        return false;
    }


    protected function enableCORSSupport(){
        $this->onRest(ERestEvent::REQ_AUTH_CORS, function ($allowed_origins) {
            return true;
        });

        $this->onRest(ERestEvent::REQ_CORS_ACCESS_CONTROL_ALLOW_METHODS, function() {
            return ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS']; //List of allowed http methods (verbs)
        });
    }

    /**
     * Is full CORS support enabled?
     * @return boolean
     */
    protected abstract function isFullCOSRSupportEnabled();

}