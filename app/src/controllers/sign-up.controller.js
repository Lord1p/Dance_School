(function() {
  "use strict";

  angular
    .module("main")
    .controller("SignUpController", SignUpController);

  SignUpController.$inject = ["$rootScope", "$scope", "$http", "encryptor", "$location", "makeActive"];
  function SignUpController($rootScope, $scope, $http, encryptor, $location, makeActive) {
    $scope.user = {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      tellNumber: "",
      mailSending: true
    };
  
    $scope.registration = registration;
    $scope.isOk = true;

    init();

    function init() {
      makeActive.deactivate(['news-link', 'courses-link', 'trainers-link', 'styles-link', 'login-link']);
    }

    function registration() {
      if ($scope.user.firstName.length == 0) {

      }
      let preparedData = {
        clientName: $scope.user.firstName + " " + $scope.user.lastName,
        email: $scope.user.email,
        tellNumber: $scope.user.tellNumber,
        password: encryptor.enctypt($scope.user.password),
        mailSending: $scope.user.mailSending
      };
      $http.post("./server/post-registration.php", preparedData).then(res => {
        console.dir(res.data);
        if (!res.data.error) {
          $rootScope.isAuthorizated = true;
          $rootScope.currentUser = res.data;
          $rootScope.currentUser.type = $rootScope.userType.client;
          $location.url(['/mycourses']);
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
  }
})();
