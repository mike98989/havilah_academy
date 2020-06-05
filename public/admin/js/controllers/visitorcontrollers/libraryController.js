      
    ///////////// THIS IS THE ARTIST VIDEO CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE ARTIST VIDEO PAGE
    /////////////////////////
  module.controller('libraryController', ['$scope','$http','infogathering','all_users','misc_functions', function($scope, $http, datagrab, all_users, misc_functions) {
    
   ///////////GET ALL REGISTERED USERS/////
    all_users.all_users.then(function(response){
   $scope.all_users = response;  
    })
    
    $scope.dirlocation=datagrab.dirlocation;  
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 4;
     
    
     //////////FETCH ALL MUSIC UNDER THIS COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/get_community_trending_content")
    .then(function(response) {
    $scope.trending =  response.data;  
    },function errorCallback(response) {
    
    return response.status;
    }); 
      
        
   
     //////////FETCH ALL MUSIC UNDER THIS COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/get_discover")
    .then(function(response) {
    $scope.discover_content = angular.fromJson(response.data.content); 
    $scope.discover_album = angular.fromJson(response.data.album);
    $scope.discover_members = angular.fromJson(response.data.members);     
    },function errorCallback(response) {
    
    return response.status;
    });   
      
      
      
     ////////////PLAY SONG
     $scope.playsong = function(author, song_title, path, cover, id, index){
      $scope.play = misc_functions.playsong(author, song_title, path, cover, id, index);    
     }  

    }]);