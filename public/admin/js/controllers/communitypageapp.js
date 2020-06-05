

module.config(function($routeProvider, $locationProvider, $sceProvider) {
	$routeProvider
		.when('/', {
            //template:'<h4>This is the index page</h4>',
            templateUrl:"../views/index/views/songs.php",
			controller: 'artistController',
		})
		
		.otherwise({
			redirectTo: '/error'
		});
    
        $locationProvider.html5Mode(true);
        $sceProvider.enabled(false);
});


//})();
