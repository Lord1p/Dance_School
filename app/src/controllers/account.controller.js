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
      hideByID('suc-alert');
      console.log($rootScope.currentUser);
      if ($rootScope.isAuthorizated && $rootScope.currentUser) {
        let name = "";
        if ($rootScope.currentUser.type == $rootScope.userType.client) {
          name = $rootScope.currentUser.clientName;
        }
        if ($rootScope.currentUser.type == $rootScope.userType.teacher) {
          name = $rootScope.currentUser.trainerName;
        }

        name = name.split(" ");
        $scope.firstName = name[0];
        $scope.lastName = name[1];
        $scope.user = $rootScope.currentUser;
        console.log($scope.user);
      }
    }

    function save() {
      console.log($rootScope.isAuthorizated);
      if ($rootScope.isAuthorizated) {
        if ($rootScope.currentUser.type == $rootScope.userType.client) {
          $scope.user.clientName = $scope.firstName + " " + $scope.lastName;
        }
        if ($rootScope.currentUser.type == $rootScope.userType.teacher) {
          $scope.user.trainerName = $scope.firstName + " " + $scope.lastName;
        }
        console.log($scope.user);
        $http.post("./server/post-save-profile.php", $scope.user).then(res => {
          console.log(res.data);
          $rootScope.currentUser = res.data;
          $http.post("./server/post-signin.php", $scope.user).then(res => {
            console.log(res.data);
            if (res.data.email) {
              $rootScope.isAuthorizated = true;
              $rootScope.currentUser = res.data;
              showById('account');
              hideByID('sign');
              init();
              showById('suc-alert');
            }
          });
        });
      }
    }
  }
})();
