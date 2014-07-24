<?php
/**
 * Created by PhpStorm.
 * User: oops
 * Date: 7/24/2014
 * Time: 3:44 PM
 */

class APIController extends CController{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter +
                REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    }

    public function actions()
    {
        return array(
            'REST.'=>'RestfullYii.actions.ERestActionProvider',
        );
    }

}