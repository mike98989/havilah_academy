

//var framework="frameworkmlm";
//(function(){

module.config(function($routeProvider, $locationProvider) {
	$routeProvider
		.when('/', {
            template:'<h4>This is the index page</h4>',
            
			//controller: 'artistController',
		})
    
     .when('/tracks', {
            templateUrl:"../views/userdashboard/views/tracks.php",
			controller: 'trackController',
		})
    .when('/tracks/new', {
            templateUrl:"../views/userdashboard/views/tracks_new.php",
			controller: 'trackUploadController',
		})
     .when('/albums', {
			controller: 'albumController',
            templateUrl:"../views/userdashboard/views/albums.php",
		})
    .when('/albums/new', {
			controller: 'albumUploadController',
            templateUrl:"../views/userdashboard/views/albums_new.php",
		})
     .when('/videos', {
            controller: 'videoController',    
            templateUrl:"../views/userdashboard/views/videos.php",
		})
    .when('/videos/new', {
            controller: 'videoUploadController',    
            templateUrl:"../views/userdashboard/views/videos_new.php",
		})
     
       .when('/group', {
            controller: 'groupController',    
            templateUrl:"../views/userdashboard/views/groups.php",
		})
    
         .when('/profile', {
            controller: 'profileController',    
            templateUrl:"../views/userdashboard/views/profile.php",
		})
        .when('/profile/following', {
            controller: 'profileController',    
            templateUrl:"../views/userdashboard/views/profile_following.php",
		})
         .when('/profile/fans', {
            controller: 'profileController',    
            templateUrl:"../views/userdashboard/views/profile_fans.php",
		})
     .when('/profile/who_to_follow', {
            controller: 'profileController',    
            templateUrl:"../views/userdashboard/views/profile_who_to_follow.php",
		})
         .when('/wallet', {
            controller: 'walletController',    
            templateUrl:"../views/userdashboard/views/wallet.php",
		})
        .when('/playlist', {
            controller: 'playlistController',    
            templateUrl:"../views/userdashboard/views/playlist.php",
		})
    
        .when('/playlist/new', {
            controller: 'playlistController',    
            templateUrl:"../views/userdashboard/views/playlist_new.php",
		})
         .when('/campeign', {
            controller: 'campeignController',    
            templateUrl:"../views/userdashboard/views/campeign.php",
		})

        .when('/error', {
            template:"<h4>This is error page</h4>",
			//controller: 'trialController',
		})

		.otherwise({
			redirectTo: '/error'
		});
    
        $locationProvider.html5Mode(true);
        
});

