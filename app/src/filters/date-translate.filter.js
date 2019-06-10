(function () {
    'use strict';

    angular
        .module('main')
        .filter('dateTranslate', dateTranslate)

    function dateTranslate() {

        return dateTranslateFilter;

        function dateTranslateFilter(input) {
            let result = input;
            if (/June/i.test(input))
                result = result.replace(/June/i, 'Июнь');
            if (/July/i.test(input))
                result = result.replace(/july/i, 'Июль');
            if (/August/i.test(input))
                result = result.replace(/August/i, 'Август');
            if (/September/i.test(input))
                result = result.replace(/September/i, 'Сентябрь');
            if (/October/i.test(input))
                result = result.replace(/October/i, 'Октябрь');
            if (/November/i.test(input))
                result = result.replace(/November/i, 'Ноябрь');
            if (/December/i.test(input))
                result = result.replace(/December/i, 'Декабрь');
            if (/January/i.test(input))
                result = result.replace(/January/i, 'Январь');
            if (/February/i.test(input))
                result = result.replace(/February/i, 'Февраль');
            if (/March/i.test(input))
                result = result.replace(/March/i, 'Март');
            if (/April/i.test(input))
                result = result.replace(/April/i, 'Апрель');
            if (/May/i.test(input))
                result = result.replace(/May/i, 'Май');
            return result;
        }
    }

}());