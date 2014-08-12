'use strict';

angular.module('app.filters', [])
    .filter('spaced_group', function() {
        return function(group) {
            return group.replace(/(\d+)/, '$1 '); // TODO: nbsp
        };
    })
    .filter('joinBy', function() {
        return function(input, delimiter) {
            return input.join(delimiter);
        };
    });
