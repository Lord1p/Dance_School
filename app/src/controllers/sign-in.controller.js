(function() {
  "use strict";

  angular
    .module("main")
    .controller("SignUpController", SignUpController);

  SignUpController.$inject = ["$rootScope", "$scope", "$http"];
  function SignUpController($rootScope, $scope, $http) {
    $scope.user = {
      email: "",
      password: "",
    };
    $scope.logIn = logIn;

    init();

    function init() {}

    function logIn() {
      $http.post("./server/post-signin.php", $scope.user).then(res => {
        console.log(res.data);
        $rootScope.isAuthorizated = true;
        $rootScope.currentUser = res.data.client;
      });
    }
  }
})();
