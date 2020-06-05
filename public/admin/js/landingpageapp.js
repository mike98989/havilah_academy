
module.config(function($routeProvider, $locationProvider, $sceProvider) {
	$routeProvider
		.when('/', {
            //template:'<h4>This is the index page</h4>',
            templateUrl:"../views/index/views/songs.php",
			controller: 'artistController',
		})
		.when('/songs', {
            //template:'<h4>This is the songs page</h4>',
            templateUrl:"../views/index/views/songs.php",
			controller: 'artistController'
		})
        .when('/album', {
            //template:'<h4>This is the album page</h4>',
            templateUrl:"../views/index/views/album.php",
			controller: 'artistController'
		})
     .when('/album/albumid', {
            template:'<h4>This is the album id page</h4>',
            //templateUrl:"../views/index/views/album_albumid.php",
			//controller: 'artistController'
		})
         .when('/video', {
            //template:'<h4>This is the video page</h4>',
            templateUrl:"../views/index/views/video.php",
			controller: 'artistVideoController'
		})
       
        .when('/library/audio', {
            template:'<h4>This is the library audio page</h4>',
            //templateUrl:"../views/index/views/video.php",
			controller: 'libraryController'
		})
        .when('/library/video', {
            template:'<h4>This is the library video page</h4>',
            //templateUrl:"../views/index/views/video.php",
			controller: 'libraryController'
		})
    
        .when('/error', {
            template:"<h4>This is error page</h4>",
			controller: 'errorController',
		})

		.otherwise({
			redirectTo: '/error'
		});
    
        $locationProvider.html5Mode(true);
        $sceProvider.enabled(false);
});


//})();
