(function () {
  'use strict';
  angular
    .module('main')
    .controller('RegistrationController', Registration)

  Registration.$inject = ['$scope', '$rootScope', '$routeParams', '$location', '$http'];
  function Registration($scope, $rootScope, $routeParams, $location, $http) {
    $scope.flag = true;
    init();

    function init() {
      console.log($rootScope.currentUser);
      $scope.flag = $routeParams.flag;
      console.dir($routeParams.id);
    }
  }
})();