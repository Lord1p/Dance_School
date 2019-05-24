(function() {
  "use strict";

  angular
    .module("main")
    .controller("SignUpController", SignUpController);

  SignUpController.$inject = ["$rootScope", "$scope", "$http", "encryptor"];
  function SignUpController($rootScope, $scope, $http, encryptor) {
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

    function init() {}

    function registration() {
      if ($scope.user.firstName.length == 0) {
        
      }
      let preparedData = {
        name: $scope.user.firstName + " " + $scope.user.lastName,
        email: $scope.user.email,
        tellNumber: $scope.user.tellNumber,
        password: encryptor.enctypt("abcdefghijclmnopqrstwxyz6157480932" ,$scope.user.password),
        mailSending: $scope.user.mailSending
      };
      $http.post("./server/post-registration.php", preparedData).then(res => {
        console.log(res.data);
        if (res.data.email) {
          $rootScope.isAuthorizated = true;
          $rootScope.currentUser = res.data;
          $rootScope.currentUser.type = $rootScope.userType.client;
        }
        else {
          $scope.isOk = false;
        }
      });
    }
  }
})();
