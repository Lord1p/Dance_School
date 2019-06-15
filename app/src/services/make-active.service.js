(function () {
    'use strict';

    angular
        .module('main')
        .service('makeActive', MakeActive)

    function MakeActive() {
        this.activate = activate;
        this.deactivate = deactivate;

        function activate(idNames) {
            var elem;
            for (let id of idNames) {
                elem = angular.element(document.getElementById(id));
                elem.addClass("active");
            }
        }

        function deactivate(idNames) {
            var elem;
            for (let id of idNames) {
                elem = angular.element(document.getElementById(id));
                elem.removeClass("active");
            }
        }
    }
})();