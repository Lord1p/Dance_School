(function () {
  "use strict";

  angular
    .module("main")
    .controller("AccountController", AccountController);

  AccountController.$inject = ["$rootScope", "$scope", "$http", "encryptor", "makeActive"];
  function AccountController($rootScope, $scope, $http, encryptor, makeActive) {
    $scope.user = {};
    $scope.firstName = "";
    $scope.lastName = "";
    $scope.password = "";
    $scope.save = save;
    $scope.setAvatar = setAvatar;
    $scope.fileName = "";
    console.log("!");
    hideByID('suc-alert');
    init();

    function init() {
      makeActive.deactivate(['news-link', 'courses-link', 'trainers-link', 'styles-link', 'login-link']);
      console.log($rootScope.currentUser);
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

    function getUser() {
      if ($rootScope.isAuthorizated) {
        $http.post("./server/get-user.php", $scope.user).then(res => {
          console.log(res.data);
          if (res.data.error) {
            alert("Извините произошла ошибка при обновлении данных, перезагркзите страницу");
          }
          
          $rootScope.currentUser = res.data;
          init();
        });
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
        let data = Object.assign({}, $scope.user);
        data.password = encryptor.enctypt($scope.user.password);
        $http.post("./server/post-save-profile.php", data).then(res => {
          console.log(res.data);
          if (res.data.error) {
            alert("Извините произошла ошибка при сохранении, перезагркзите страницу");
          }
          else {
            showById("suc-alert");
          }
          getUser();
        });
      }
    }

    function setAvatar() {
      let input = document.getElementById("avatarFile");
      input.accept = ".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*";
      input.click();
      input.onchange = function() {
        let file = input.files[0];
        console.log(file);
        sendAvatar(file);
      };
    }

    function sendAvatar(file) {
      const formData = new FormData();
      formData.append('file', file);
      formData.append('UserType', $rootScope.currentUser.type);

      if ($rootScope.currentUser.type == $rootScope.userType.client) {
        formData.append('clientId', $rootScope.currentUser.clientId);
      }
      if ($rootScope.currentUser.type == $rootScope.userType.teacher) {
        formData.append('trainerId', $rootScope.currentUser.trainerId);
      }

      fetch("./server/post-set-avatar.php", {
        method: 'POST',
        body: formData,
      }).then(response => {
        console.log(response);
        if (response.ok) {
          getUser();
        }
      })
    }
  }
})();
