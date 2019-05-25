(function() {
    "use strict";
  
    angular
      .module("main")
      .controller("TrainersController", TrainersController);
  
    TrainersController.$inject = ['$scope', '$http'];
    function TrainersController($scope, $http) {
      $scope.teachers = [];
      $scope.empty = "А у нас то никто не работает пацаны! :(";
      init();
  
      function init() {
        $http.get('./server/get-trainers.php')
          .then(res => {
            console.log(res.data.trainers);
            $scope.trainers = res.data.trainers;
          });
      }
    }
  })();
  