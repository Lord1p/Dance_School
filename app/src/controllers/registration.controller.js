(function () {
  'use strict';
  angular
    .module('main')
    .controller('RegistrationController', Registration)

  Registration.$inject = ['$scope', '$rootScope', '$routeParams', 'generateCode', '$http'];
  function Registration($scope, $rootScope, $routeParams, generateCode, $http) {
    $scope.flag = true;
    $scope.order = order;
    $scope.msg = "";

    $scope.regData = {
      clientId: -1,
      courseId: -1,
      code: -1,
    };

    init();

    function order() {
      $scope.regData.courseId = $routeParams.id;
      $scope.regData.clientId = $rootScope.currentUser.clientId;
      if ($scope.flag === 'true') {
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
      else {
        $http.post('./server/post-delete-order.php', $scope.regData)
          .then((res) => {
            console.dir(res.data);
            if (res.data.clCourses) {
              $scope.msg = 'Вы успешно отменили курс'
            }
            if (res.data.error) {
              $scope.msg = res.data.error.msg;
            }
          });
      }
    }

    function init() {
      console.log($rootScope.currentUser);
      $scope.flag = $routeParams.flag;
      console.dir($scope.flag);
      let btn = angular.element(document.getElementById('orderBtn'));
      if ($scope.flag === 'true') {
        showById("make-order");
        hideByID("delete-order");
        btn.text('Записаться');
      }
      else {
        showById("delete-order");
        hideByID("make-order");
        btn.text('Отписаться');
      }
    }
  }
})();