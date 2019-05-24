(function() {
  "use strict";

  angular
    .module("main")
    .controller("SignUpController", SignUpController);

  SignUpController.$inject = ["$rootScope", "$scope", "$http"];
  function SignUpController($rootScope, $scope, $http) {
    $scope.user = {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      tellNumber: "",
      mailSending: true,
    };
    $scope.registration = registration;

    init();

    function init() {}

    function registration() {
      let preparedData = {
        name: $scope.user.firstName + $scope.user.lastName,
        email: $scope.user.email,
        tellNumber: $scope.user.tellNumber,
        password: $scope.user.password,
        mailSending: $scope.user.mailSending,
      }
      $http.post('./server/post-registration.php', preparedData)
        .then(res => {
            console.log(res.data);
            $rootScope.isAuthorizated = true;
            $rootScope.currentUser = res.data.client;
        });
    }
  }
})();
