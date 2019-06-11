(function () {
  'use strict';
  angular
    .module('main')
    .controller('RegistrationController', Registration)

  Registration.$inject = ['$scope', '$rootScope', '$routeParams', 'generateCode', '$http'];
  function Registration($scope, $rootScope, $routeParams, generateCode, $http) {
    $scope.flag = true;
    $scope.makeOrder = makeOrder;
    $scope.deleteOrder = deleteOrder;
    $scope.msg = "";

    $scope.regData = {
      clientId: -1,
      courseId: -1,
      code: -1,
    };

    init();

    function makeOrder() {
      $scope.regData.courseId = $routeParams.id;
      $scope.regData.clientId = $rootScope.currentUser.clientId;
      $scope.regData.code = generateCode.get();

      $http.post('./server/post-make-order.php', $scope.regData)
        .then((res) => {
          console.dir(res.data);
          if (res.data.lessons) {
            $scope.msg = 'Вы успешно записаны на курс, на указанный вами при регистрации email должно прийти письмо! При возникновении проблем свяжитесь с нами!'
          }
          if (res.data.error) {
            $scope.msg = res.data.error.msg;
          }
        });
    }

    function deleteOrder() {

    }

    function init() {
      console.log($rootScope.currentUser);
      $scope.flag = $routeParams.flag;
      if ($scope.flag) {
        showById("make-order");
        hideByID("delete-order");
      }
      else {
        showById("delete-order");
        hideByID("make-order");
      }
      //hideByID("suc-alert");
    }
  }
})();