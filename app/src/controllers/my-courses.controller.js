(function () {
  "use strict";

  angular.module("main").controller("MyCoursesController", MyCoursesController);

  MyCoursesController.$inject = ["$rootScope", "$scope", "$http"];
  function MyCoursesController($rootScope, $scope, $http) {
    $scope.courses = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      if ($rootScope.currentUser.type == "client") {
        $http.get("./server/get-client-courses.php" + "?id=" + $rootScope.currentUser.clientId).then(res => {
          console.log(res.data.clCourses);
          $scope.courses = res.data.clCourses;
        })
      };
      if ($rootScope.currentUser.type == "trainer") {
        $http.get("./server/get-trainer-courses.php" + "?id=" + $rootScope.currentUser.trainerId).then(res => {
          console.log(res.data.trCourses);
          $scope.courses = res.data.trCourses;
        })
      };
      if ($rootScope.currentUser.type == "admin") {
        $http.get("./server/get-client-courses.php" + "?id=" + $rootScope.currentUser.clientId).then(res => {
          console.log(res.data.clCourses);
          $scope.courses = res.data.clCourses;
        })
      };
    }
  }
})();
