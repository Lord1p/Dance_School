(function(){
    'use strict';

    angular
        .module('main')
        .service('generateCode', GenerateCodeService)

        GenerateCodeService.$inject = ['$http'];

    function GenerateCodeService($http) {
        this.get = get;

        function get() {
            return Math.round(Math.random() * 10000);
        }
    }
})();