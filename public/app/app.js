var app= angular.module('my-app', [] ,function($interpolateProvider) {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');

 

}).constant('API', 'http://duckien.dev:8080/');
