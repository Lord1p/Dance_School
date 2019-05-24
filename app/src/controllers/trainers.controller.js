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
        $http.get('./server/get-teachers.php')
          .then(res => {
            console.log(res.data.teachers);
            $scope.teachers = res.data.teachers;
          });
      }
    }
  })();
  