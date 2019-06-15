(function() {
  "use strict";

  angular
    .module("main")
    .controller("CoursesController", CoursesController);

  CoursesController.$inject = ['$scope', '$http', 'makeActive'];
  function CoursesController($scope, $http, makeActive) {
    $scope.courses = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      makeActive.activate(['courses-link']);
      makeActive.deactivate(['news-link', 'trainers-link', 'styles-link', 'login-link']);
      $('.dropdown-toggle').dropdown();
      $http.get('./server/get-courses.php')
        .then(res => {
          console.log(res.data.courses);
          $scope.courses = res.data.courses;
        });
    }
  }
})();
