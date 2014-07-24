<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('protected', realpath(__DIR__ . '/..'));
Yii::setPathOfAlias('vendor', realpath(__DIR__ . '/../vendor'));


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Time tracker 2',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',

        //bootstrap3
        'bootstrap3.behaviors.*',
        'bootstrap3.helpers.*',
        'bootstrap3.widgets.*',

        'application.modules.srbac.controllers.SBaseController',

        'eoauth.*',
        'eoauth.lib.*',
        'lightopenid.*',
        'eauth.*',
        'eauth.services.*',
    ),

    'aliases' => [
        'bootstrap3' => 'vendor.drmabuse.yii-bootstrap-3-module',
        'RestfullYii' => 'vendor.starship.restfullyii.starship.RestfullYii',

        'eoauth' => 'vendor.itmages.yii-eoauth',
        'lightopenid' => 'vendor.itmages.lightopenid.src',
        'eauth' => 'vendor.nodge.yii-eauth',
    ],

    'modules' => [
        'v1' => [
        ],

        'gii' => [
            'class' => 'system.gii.GiiModule',
            'password' => '1111',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '10.*.*.*'),
        ],

        'srbac' => [
            'userclass' => 'User',
            'userid' => 'id',
            'username' => 'first_name',
            'pageSize' => 10,
            'superUser' => 'admin',
            'css' => 'srbac.css',
            'debug' => true,
            'layout' => 'application.views.layouts.main',
            'notAuthorizedView' => 'application.views.site.login',
            'alwaysAllowed' => array(),
            'userActions' => array(),
            'listBoxNumberOfLines' => 15,
            'imagesPath' => 'srbac.images',
            'imagesPack' => 'noia',
            'iconText' => true,
        ]
    ],

    // application components
    'components' => array(
        'user' => array(
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => require('routes.php'),
        ),
        'db' => require("db.php"),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

        'authManager' => array(
            // The type of Manager (Database)
            'class' => 'CDbAuthManager',
            // The database compnent used
            'connectionID' => 'db',
            // The itemTable name (default:authitem)
            'itemTable' => 'AuthItem',
            // The assignmentTable name (default:authassignment)
            'assignmentTable' => 'AuthAssignment',
            // The itemChildTable name (default:authitemchild)
            'itemChildTable' => 'AuthItemChild',
        ),

        'loid' => array(
            'class' => 'lightopenid.loid',
        ),

        'eauth' => require("eauth.php"),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);