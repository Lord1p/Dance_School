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
      $('.dropdown-toggle').dropdown();
      $http.get('./server/get-courses.php')
        .then(res => {
          console.log(res.data.courses);
          $scope.courses = res.data.courses;
        });
    }
  }
})();
