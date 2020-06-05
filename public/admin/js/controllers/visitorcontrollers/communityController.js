
    
    
    ///////////// THIS IS THE COMMUNITY CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE COMMUITY PAGE
    /////////////////////////
  module.controller('communityController', ['$scope','$http','infogathering','all_users','misc_functions','user_session', function($scope, $http, datagrab, all_users, misc_functions, user_session) {
      
   ///////////GET ALL REGISTERED USERS/////
    all_users.all_users.then(function(response){
   $scope.all_users = response;  
    })
    
    
    
     //////////FETCH ALL COMMUNITIES
    $http.get("http://"+datagrab.dirlocation+"api/get_community")
    .then(function(response) {
    $scope.communities = response.data;    
    //alert(JSON.stringify($scope.communities));    
    },function errorCallback(response) {
    
    return response.status;
    }); 
      
      
        
    //////GET ALL GENRES
    $http.get("http://"+datagrab.dirlocation+"api/get_genres")
    .then(function(response) {
   
    $scope.genres = response.data; 
    //alert(JSON.stringify($scope.genres));    
    },function errorCallback(response) {
    
    return response.status;
    }); 
        
      
        /////SESSION DETAILS////
    user_session.user_session_details.then(function(response){
    $scope.user_session = angular.fromJson(response.details); 
    $scope.user_counter = angular.fromJson(response.counter);
    
       
    });
      
      
    
    $scope.dirlocation=datagrab.dirlocation;  
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 10;
     
    $scope.community= datagrab.urlSplit[2]; 
     
      
      
    ///////FOLLOW BUTTON ACTIVITY
    $scope.follow = function(artist_id, user_id){
    if(user_id==null){
    $('#loginWindowModal').appendTo("body").modal('show');     
    }else{
        
    //////////FOLLOW ARTIST//////
    $http.get("http://"+datagrab.dirlocation+"api/follow?user_id="+user_id+"&artist_id="+artist_id)
    .then(function(response) {
    //alert(response.data); 
    $('#follow').addClass('btn-success');    
    $('#follow').text('Following');    
    return response.data;    
    },function errorCallback(response) {    
    return response.status;
    });
        
        
    }
        
    }
    //////FOLLOW ACTIVITY
    $scope.follow = function(artist_id, user_id){   
    return misc_functions.follow(artist_id, user_id);
     }
    //////UNFOLLOW ACTIVITY
     $scope.unfollow = function(artist_id, user_id){   
    return misc_functions.unfollow(artist_id, user_id);
     }
     
     ////GET FOLLOWERS
     $scope.getfollower = function(user_id, dataarray){
     return misc_functions.getfollower(user_id, dataarray); 
     }
     
     
      
    
     //////////FETCH ALL MUSIC UNDER THIS COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/community_content?group_url="+datagrab.urlSplit[2])
    .then(function(response) {
    $scope.content = response.data;
    
    },function errorCallback(response) {
    
    return response.status;
    }); 
     
     
      
    ////////////PLAY SONG 
      $scope.playsong = function(author, song_title, path, cover, id, index){
          alert(index);
      $scope.play = misc_functions.playsong(author, song_title, path, cover, id, index);    
     }
  

    }]);