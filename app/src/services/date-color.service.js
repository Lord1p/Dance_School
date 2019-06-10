(function () {
    'use strict';

    angular
        .module('main')
        .service('dateColor', dateColor)

    function dateColor() {
        this.colorize = colorize;
        var currentDate = new Date();
        var result;
        function colorize(data) {
            result = data;
            for (let i of result) {
                if (new Date(i.date) < currentDate)
                    i.color = 'red';
                if (new Date(i.date) > currentDate)
                    i.color = 'green';
            }

            return result;
        }
    }
})();