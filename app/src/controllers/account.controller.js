(function() {
  "use strict";

  angular
    .module("main")
    .controller("AccountController", AccountController);

  AccountController.$inject = ["$rootScope", "$scope", "$http"];
  function AccountController($rootScope, $scope, $http) {
    $scope.user = {};
    $scope.firstName = "";
    $scope.lastName = "";
    $scope.password = "";
    $scope.save = save;
    console.log("!");
    init();

    function init() {
      console.log($rootScope.currentUser.profile);
      if ($rootScope.isAuthorizated && $rootScope.currentUser.profile) {
        let name = "";
        if ($rootScope.currentUser.profile.type == $rootScope.userType.client) {
          name = $rootScope.currentUser.profile.clientName;
        }
        if ($rootScope.currentUser.profile.type == $rootScope.userType.teacher) {
          name = $rootScope.currentUser.profile.trainerName;
        }

        name = name.split(" ");
        $scope.firstName = name[0];
        $scope.lastName = name[1];
        $scope.user = $rootScope.currentUser.profile;
        console.log($scope.user);
      }
    }

    function save() {
      console.log($rootScope.isAuthorizated);
      if ($rootScope.isAuthorizated) {
        if ($rootScope.currentUser.profile.type == $rootScope.userType.client) {
          $scope.user.clientName = $scope.firstName + " " + $scope.lastName;
        }
        if ($rootScope.currentUser.profile.type == $rootScope.userType.teacher) {
          $scope.user.trainerName = $scope.firstName + " " + $scope.lastName;
        }
        console.log($scope.user);
        $http.post("./server/post-save-profile.php", $scope.user).then(res => {
          console.log(res.data);
          $rootScope.currentUser.profile = res.data;
          init();
        });
      }
    }
  }
})();
