(function() {
  "use strict";

  angular
    .module("main")
    .controller("StylesController", StylesController);

  StylesController.$inject = ['$scope', '$http'];
  function StylesController($scope, $http) {
    $scope.styles = [];
    $scope.empty = "А стилей, то нет";
    init();

    function init() {
      $http.get('./server/get-styles.php')
        .then(res => {
          console.log(res.data.styles);
          $scope.styles = res.data.styles;
        });
    }
  }
})();
