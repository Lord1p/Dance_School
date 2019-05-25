(function() {
  "use strict";

  angular
    .module("main")
    .controller("CoursesController", CoursesController);

    CoursesController.$inject = ['$scope', '$http'];
  function CoursesController($scope, $http) {
    $scope.courses = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      $http.get('./server/get-courses.php')
        .then(res => {
          console.log(res.data.clCourses);
          $scope.courses = res.data.clCourses;
        });
    }
  }
})();
