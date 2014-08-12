'use strict';

angular.module('app', [
    'ngRoute',
    'app.filters',
    'app.services',
    'app.directives',
    'app.controllers',
]).config(function($routeProvider) {
    $routeProvider
        .when('/tablo', { templateUrl: 'partials/tablo.html',    controller: 'TabloCtrl' })
        .otherwise({ redirectTo: '/tablo' });
});
