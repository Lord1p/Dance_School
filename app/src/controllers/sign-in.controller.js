(function() {
    "use strict";
  
    angular
      .module("main")
      .controller("SignInController", SignInController);
  
      SignInController.$inject = ['$scope', '$http'];
    function SignInController($scope, $http) {
      init();
  
      function init() {}
    }
  })();
  