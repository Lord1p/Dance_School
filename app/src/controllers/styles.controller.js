(function() {
  "use strict";

  angular
    .module("main")
    .controller("StylesController", StylesController);

  StylesController.$inject = ['$scope', '$http'];
  function StylesController($scope, $http) {
    $scope.styles = [];
    $scope.empty = "А стилей, то нет";
    var counter = 0;
    var maxCounter = 7;
    init();

    function init() {
      $http.get('./server/get-styles.php')
        .then(res => {
          console.log(res.data.styles);
          $scope.styles = res.data.styles;
          for (let i of $scope.styles) {
            i.color = generateColor();
          }
        });
    }

    function generateColor() {
      ++counter;
      if (counter == 8) counter = 1;

      switch (counter) {
        case 1: return 'bg-primary';
        case 2: return 'bg-secondary';
        case 3: return 'bg-success';
        case 4: return 'bg-danger';
        case 5: return 'bg-warning';
        case 6: return 'bg-info';
        case 7: return 'bg-dark';
      }
    }
  }
})();
