(function() {
    "use strict";
  
    angular
      .module("main")
      .controller("TrainersController", TrainersController);
  
    TrainersController.$inject = ['$scope', '$http', 'makeActive'];
    function TrainersController($scope, $http, makeActive) {
      $scope.teachers = [];
      $scope.empty = "А у нас то никто не работает пацаны! :(";
      init();
  
      function init() {
        makeActive.activate(['trainers-link']);
        makeActive.deactivate(['courses-link', 'news-link', 'styles-link', 'login-link']);
        $http.get('./server/get-trainers.php')
          .then(res => {
            console.log(res.data.trainers);
            $scope.trainers = res.data.trainers;
          });
      }
    }
  })();
  