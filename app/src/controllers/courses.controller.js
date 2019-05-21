(function() {
    "use strict";
  
    angular
      .module("main")
      .controller("CoursesController", CoursesController);
  
    function CoursesController($scope) {
      $scope.news = [
          {header: "H1", date: "25.12.1998", text: "TTT1"},
          {header: "H2", date: "25.12.1998", text: "TTT2"},
          {header: "H3", date: "25.12.1998", text: "TTT3"}
      ];
      $scope.empty = "Пока ничего нового :(";
      init();
  
      function init() {
        console.log($scope.empty);
        console.dir($scope.news);
      }
    }
  })();
  