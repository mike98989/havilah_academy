
//var framework="frameworkmlm";
//(function(){
module.config(function($routeProvider, $locationProvider) {
	$routeProvider
		.when('/home', {
            templateUrl:"../views/userarea/views/home.php",
			controller: 'landingPageController',
		})
        .when('/error', {
            template:"<h4>This is error page</h4>",
			//controller: 'trialController',
		})
		.otherwise({
			redirectTo: '/home'
		});

        $locationProvider.html5Mode(true);

});
