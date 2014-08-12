<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <title>Табло</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://rawgit.com/h5bp/html5-boilerplate/master/dist/css/normalize.css">
    <link rel="stylesheet" href="https://rawgit.com/h5bp/html5-boilerplate/master/dist/css/main.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/services.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/filters.js"></script>
    <script src="js/directives.js"></script>
</head>
<body>
    <div ng-controller="TabloCtrl" ng-include="'partials/tablo.html'" class="container"></div>
</body>
</html>
