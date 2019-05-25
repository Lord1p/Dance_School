(function() {
  "use strict";

  angular.module("main").controller("SignInController", SignInController);

  SignInController.$inject = ["$rootScope", "$scope", "$http", "$location"];
  function SignInController($rootScope, $scope, $http, $location) {
    $scope.user = {
      email: "",
      password: ""
    };
    $scope.logIn = logIn;
    $scope.isOk = true;

    function logIn() {
      $http.post("./server/post-signin.php", $scope.user).then(res => {
        console.log(res.data);
        if (res.data.email) {
          $rootScope.isAuthorizated = true;
          $rootScope.currentUser = res.data;
          $rootScope.currentUser.type = res.data.type;
          $location.url(['/mycourses']);
        }
        else {
          $scope.isOk = false;
          console.log("error");
        }
      });
    }
  }
})();
