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
    <div ng-controller="tablo" ng-include="'partials/tablo.html'" class="container"></div>
    <script type="text/ng-template" id="partials/tablo.html">
        <input ng-model="search.group" type="text" class="form-control">
        <div ng-repeat="day in days" class="row">
            <div class="col-xs-12">
                <h2>{{ day.header }}</h2>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th></th>
                            <th ng-repeat="header in day.table.headers" colspan="2">{{ header }}</th>
                        </tr>
                    </thead>
                    <tbody class="lessons">
                        <tr ng-repeat="row in shown_rows = (day.table.rows | filter: search)" id="{{ row.group }}">
                            <th class="group">{{ row.group | spaced_group }}</th>
                            <td ng-repeat-start="lesson in row.lessons" class="auditorium text-muted">
                                <div ng-repeat="sublesson in lesson">{{ sublesson.auditorium }}</div>
                            </td>
                            <td ng-repeat-end class="lesson">
                                <div ng-repeat="sublesson in lesson">{{ sublesson.name }}</div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot ng-if="shown_rows.length > 5">
                        <tr>
                            <th></th>
                            <th ng-repeat="header in day.table.headers" colspan="2">{{ header }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-xs-12">
                <h3>Где свободно?</h3>
                <ul class="list-unstyled">
                    <li ng-repeat="header in day.table.headers">
                        <strong>{{ header }}:</strong> {{ day.free_auditoriums[$index] | joinBy: ', ' }}
                    </li>
                </ul>
            </div>
        </div>
    </script>
</body>
</html>
