(function () {
  "use strict";

  angular
    .module("main")
    .controller("NewsController", NewsController);

  NewsController.$inject = ['$scope', '$http', 'makeActive'];
  function NewsController($scope, $http, makeActive) {
    $scope.news = [];
    $scope.empty = "Пока ничего нового :(";
    init();

    function init() {
      makeActive.activate(['news-link']);
      makeActive.deactivate(['courses-link', 'trainers-link', 'styles-link', 'login-link']);
      $('.carousel').carousel({
        interval:2500
      });
      $http.get('./server/get-news.php')
        .then(res => {
          console.log(res.data.news);
          $scope.news = res.data.news;
        });
    }
  }
})();
