(function(){
  angular
    .module('main', ['ngRoute'])
    .config(Routs)
    .run(rootInit);

rootInit.$inject = ['$rootScope'];
function rootInit($rootScope) {
  $rootScope.userType = {
    anonim: -1,
    client: 0,
    teacher: 1,
    admin: 2,
  };

  $rootScope.isAuthorizated = false;
  $rootScope.currentUser = {
    type: $rootScope.userType.anonim,
  };
}

Routs.$inject = ['$routeProvider'];
function Routs( $routeProvider ) {
  $routeProvider
  .when('/', {
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
  })
  .when('/sign-up', {
    templateUrl: './app/src/views/sign-up.html',
    controller: 'SignUpController',
  })
  .when('/sign-in', {
    templateUrl: './app/src/views/sign-in.html',
    controller: 'SignInController',
  });
}
})();
