<?php

$arr = [
    'class' => 'eauth.EAuth',
    'popup' => true, // Use the popup window instead of redirecting.
    'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
    'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.'
    'services' => [
        'google' => [
            'class' => 'GoogleOpenIDService',
            //'realm' => '*.example.org',
        ],
        'google_oauth' => array(
            // register your app here: https://code.google.com/apis/console/
            'class' => 'TGoogleOAuthService',
            'client_id' => '977021753164-1f4sevnnrf10h9h03tpjt909h3c349d6.apps.googleusercontent.com',
            'client_secret' => 'ghDfYR7HkOmfsHNtDUqaGWdt',
            'title' => 'Google (OAuth)',
        ),
    ]
];

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

return $arr;