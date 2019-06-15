(function() {
  "use strict";

  angular.module("main").controller("SignInController", SignInController);

  SignInController.$inject = ["$rootScope", "$scope", "$http", "$location", "encryptor", "makeActive"];
  function SignInController($rootScope, $scope, $http, $location, encryptor, makeActive) {
    $scope.user = {
      email: "",
      password: ""
    };
    $scope.logIn = logIn;
    $scope.signUp = signUp;
    $scope.isOk = true;
    init();


    function init() {
      makeActive.activate(['login-link']);
      makeActive.deactivate(['courses-link', 'trainers-link', 'styles-link', 'news-link']);
    }

    function logIn() {
      $scope.user.password = encryptor.enctypt($scope.user.password);
      $http.post("./server/post-signin.php", $scope.user).then(res => {
        console.log(res.data);
        if (res.data.email) {
          $rootScope.isAuthorizated = true;
          $rootScope.currentUser = res.data;
          if ($rootScope.currentUser.type != $rootScope.userType.admin)
            $location.url(['/mycourses']);
          else
            $location.url(['/courses']);
          showById('account');
          //showById('myCourses');
          hideByID('sign');
        }
        else {
          $scope.isOk = false;
          console.log("error");
        }
      });
    }

    function signUp() {
      $location.url(['/sign-up']);
    }
  }
})();
