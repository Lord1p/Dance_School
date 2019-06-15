(function () {
  "use strict";

  angular.module("main").controller("MyCoursesController", MyCoursesController);

  MyCoursesController.$inject = ["$rootScope", "$scope", "$http", "$location", "makeActive"];
  function MyCoursesController($rootScope, $scope, $http, $location, makeActive) {
    $scope.courses = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      makeActive.deactivate(['news-link', 'courses-link', 'trainers-link', 'styles-link', 'login-link']);
      if ($rootScope.currentUser.type == "client") {
        $http.get("./server/get-client-courses.php" + "?id=" + $rootScope.currentUser.clientId).then(res => {
          console.log(res.data);
          console.log(res.data.clCourses);
          $scope.courses = res.data.clCourses;
          if ($scope.courses.length == 0) {
            $location.url(['/courses']);
          }
        })
      };
      if ($rootScope.currentUser.type == "trainer") {
        $http.get("./server/get-trainer-courses.php" + "?id=" + $rootScope.currentUser.trainerId).then(res => {
          console.log(res.data.trCourses);
          $scope.courses = res.data.trCourses;
        })
      };
      if ($rootScope.currentUser.type == "admin") {
        $location.url(['/courses']);
      };
    }
  }
})();
