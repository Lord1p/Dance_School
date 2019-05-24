(function() {
  "use strict";

  angular
    .module("main")
    .controller("NewsController", NewsController);

  NewsController.$inject = ['$scope', '$http'];
  function NewsController($scope, $http) {
    $scope.news = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      $http.get('./server/get-news.php')
        .then(res => {
          console.log(res.data.news);
          $scope.news = res.data.news;
        });
    }
  }
})();
