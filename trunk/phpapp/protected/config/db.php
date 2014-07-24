<?php

switch(SERVER_TYPE){
    case 'danylo-vbox':
        $db_conf = array(
            'connectionString' => 'mysql:host=localhost;dbname=time_tracker2',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        );
        break;

    case 'romanPC':
        $db_conf = array(
            'connectionString' => 'mysql:host=localhost;dbname=time_tracker2',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8'
        );
        break;

    //production ukraine
    default:
        $db_conf = array(
            'connectionString' => 'mysql:host=feoktist.mysql.ukraine.com.ua;dbname=time-tracker2',
            'emulatePrepare' => true,
            'username' => 'feoktist_tt',
            'password' => 'vza350r1',
            'charset' => 'utf8'
        );
        break;
}

return $db_conf;