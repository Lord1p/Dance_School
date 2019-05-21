(function(){
  angular
    .module('main', ['ngRoute'])
    .config(Routs);

Routs.$inject = ['$routeProvider'];
function Routs( $routeProvider ) {
  $routeProvider.when('/', {
    redirectTo: '/news'
  })
  .when('/news', {
    templateUrl: './app/src/views/news.html',
    controller: 'NewsController',
  })
  .when('/courses', {
    templateUrl: './app/src/views/courses.html',
    controller: 'CoursesController',
  })
  .when('/trainers', {
    templateUrl: './app/src/views/trainers.html',
    controller: 'TrainersController',
  })
  .when('/styles', {
    templateUrl: './app/src/views/styles.html',
    controller: 'StylesController',
  });
}
})();
