'use strict';

var timeTracker = angular.module('timeTracker', [
    'ui.router',
    'chart.js'
]);

timeTracker.config(function ($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.otherwise("/menu/main");

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
        })

        .state('menu.main', {
            url: "/main",
            templateUrl: "partials/main.html"
        });

    $.material.init();
});

timeTracker.controller("BarCtrl", function ($scope) {
    $scope.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    $scope.data = [
        [6, 8, 12, 6, 10, 2, 0]
    ];
});