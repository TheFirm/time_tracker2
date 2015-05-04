'use strict';

var timeTracker = angular.module('timeTracker', [
    'ui.router',
    'satellizer'
]);

timeTracker.config(function ($stateProvider, $urlRouterProvider, $authProvider) {

    $.material.init();

    $urlRouterProvider.otherwise("/menu/dashboard");

    $stateProvider

        .state('login', {
            url: "/login",
            templateUrl: "partials/login.html"
        })

        .state('menu', {
            url: "/menu",
            templateUrl: "partials/menu.html"
        })

        .state('menu.dashboard', {
            url: "/dashboard",
            templateUrl: "partials/dashboard.html"
        });
});
