(function () {
    "use strict";
  
    angular.module("main").service("lessons", Lessons);
  
    Lessons.inject = ['$http'];
    function Lessons($http) {
      this.getByCourseId = getByCourseId;

      function getByCourseId(id) {
        return $http.get(`./server/get-lessons.php?id=${id}`);
      }
    }
  })();
  