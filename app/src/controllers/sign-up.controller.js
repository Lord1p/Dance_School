(function() {
  "use strict";

  angular
    .module("main")
    .controller("SignUpController", SignUpController);

  SignUpController.$inject = ["$rootScope", "$scope", "$http", "encryptor", "$location"];
  function SignUpController($rootScope, $scope, $http, encryptor, $location) {
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
        clientName: $scope.user.firstName + " " + $scope.user.lastName,
        email: $scope.user.email,
        tellNumber: $scope.user.tellNumber,
        password: encryptor.enctypt("abcdefghijclmnopqrstwxyz6157480932" ,$scope.user.password),
        mailSending: $scope.user.mailSending
      };
      $http.post("./server/post-registration.php", preparedData).then(res => {
        console.dir(res.data.error);
        if (!res.data.error) {
          $rootScope.isAuthorizated = true;
          $rootScope.currentUser = res.data;
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
