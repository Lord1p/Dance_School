(function() {
  "use strict";

  angular.module("main").controller("MyCoursesController", MyCoursesController);

  MyCoursesController.$inject = ["$rootScope", "$scope", "$http"];
  function MyCoursesController($rootScope, $scope, $http) {
    $scope.courses = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      if ($rootScope.currentUser.type != $rootScope.userType.anonim) {
        $http.get("./server/get-client-courses.php/"+$rootScope.currentUser.id).then(res => {
          console.log(res.data.clCourses);
          $scope.courses = res.data.clCourses;
        });
      }
    }
  }
})();
