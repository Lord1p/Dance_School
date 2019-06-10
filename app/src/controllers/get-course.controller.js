(function() {
    "use strict";
    angular
      .module("main")
      .controller("GetCourseController", GetCourseController);
  
      GetCourseController.$inject = ['$rootScope', '$scope', '$routeParams', 'lessons', 'dateColor'];
    function GetCourseController($rootScope, $scope, $routeParams, lessons, dateColor) {
      $scope.courseId = null;
      $scope.loadLessons = loadLessons;
      $scope.empty = "Вы должны зарегистрироваться, или войти для того, чтобы записаться на курс";
      $scope.teacher = "Преподаватели не могут сами назначать себе курсы, обратитесь к администратору";
      $scope.admin = "Как администратор, вы можете только просмотреть рассписание занитий";
      $scope.lessons;
      init();
  
      function init() {
        console.log($rootScope.currentUser);
        $scope.courseId = $routeParams.id;
        console.dir($routeParams.id);
        $scope.loadLessons();
      }

      function loadLessons() {
        lessons.getByCourseId($scope.courseId)
          .then((res) => {
            console.dir(res.data.lessons);
            $scope.lessons = dateColor.colorize(res.data.lessons);
            console.dir($scope.lessons);
          });
      }
    }
  })();
  