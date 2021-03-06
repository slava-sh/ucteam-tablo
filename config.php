<?php

date_default_timezone_set('Asia/Yekaterinburg');

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!empty($_POST)) {
    $config = $_POST;
    $config['auditoriums'] = preg_split('/\s+/', $config['auditoriums']);
    $lesson_name_map = array();
    foreach ($config['lesson_name_map'] as $i) {
        if (!empty($i['from']) && !empty($i['to'])) {
            $lesson_name_map[$i['from']] = $i['to'];
        }
    }
    $config['lesson_name_map'] = $lesson_name_map;

    file_put_contents('config.json', json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

?>
<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="utf-8">
    <title>Конфиг</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .form-group .row {
            margin: 0 0 10px 0;
        }
        .form-group .row > div {
            padding-left: 0;
            padding-right: 5px;
        }
    </style>
    <script>
        angular.module('app', [])
            .controller('ctrl', function($scope) {
                $scope.config = <?= file_get_contents('config.json') ?>;
                var lesson_name_map = [];
                for (var key in $scope.config.lesson_name_map) {
                    lesson_name_map.push({ from: key, to: $scope.config.lesson_name_map[key] });
                }
                $scope.config.lesson_name_map = lesson_name_map;
            });
    </script>
</head>
<body ng-controller="ctrl">
    <div class="container">
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                    <div class="form-group">
                        <label>Заглушки</label>
                        <div class="row" ng-repeat="item in config.specials">
                            <div class="col-xs-5 col-sm-2">
                                <input name="specials[{{ $index }}][from]" type="datetime" class="form-control" ng-model="item.from">
                            </div>
                            <div class="col-xs-5 col-sm-2">
                                <input name="specials[{{ $index }}][until]" type="datetime" class="form-control" ng-model="item.until">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <input name="specials[{{ $index }}][message]" type="text" class="form-control" ng-model="item.message">
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <button type="button" class="btn btn-default" ng-click="config.specials.splice($index, 1)"><i class="fa fa-trash-o"></i></button>
                                <button type="button" class="btn btn-default" ng-click="config.specials.splice($index + 1, 0, { from: '<?= date('Y-m-d\T00:00:00\Z') ?>', until: '<?= date('Y-m-d\T23:59:59\Z') ?>' })"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_elevens">Когда перестать показывать 11 классы?</label>
                        <div class="row">
                            <div class="col-xs-5 col-sm-4 col-md-2">
                                <input name="no_elevens" id="no_elevens" type="datetime" class="form-control" ng-model="config.no_elevens">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Как изменять названия предметов?</label>
                        <div class="row" ng-repeat="item in config.lesson_name_map">
                            <div class="col-xs-5 col-sm-4 col-md-2">
                                <input name="lesson_name_map[{{ $index }}][from]" type="text" class="form-control" ng-model="item.from">
                            </div>
                            <div class="col-xs-5 col-sm-4 col-md-2">
                                <input name="lesson_name_map[{{ $index }}][to]" type="text" class="form-control" ng-model="item.to">
                            </div>
                            <div class="col-xs-1">
                                <button type="button" class="btn btn-default" ng-click="config.lesson_name_map.splice($index, 1)"><i class="fa fa-trash-o"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5 col-sm-4 col-md-2">
                                <button type="button" class="btn btn-default btn-block" ng-click="config.lesson_name_map.push({})"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="auditoriums">Все аудитории</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea id="auditoriums" name="auditoriums" type="text" class="form-control" ng-bind="config.auditoriums.join(' ')"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
