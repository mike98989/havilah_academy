      
    ///////////// THIS IS THE ARTIST VIDEO CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE ARTIST VIDEO PAGE
    /////////////////////////
  module.controller('artistVideoController', ['$scope','$http','infogathering','all_users','misc_functions', function($scope, $http, datagrab, all_users, misc_functions) {
   ///////////GET ALL REGISTERED USERS/////
    all_users.all_users.then(function(response){
   $scope.all_users = response;  
    })
    
    $scope.dirlocation=datagrab.dirlocation;  
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 10;
     
    
     //////////FETCH ALL MUSIC UNDER THIS COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/get_artist_video?id="+datagrab.urlSplit[1])
    .then(function(response) {
   
    $scope.allvideos =  angular.fromJson(response.data.allvideos);
	//$scope.albums =    angular.fromJson(response.data.albums);
   
    },function errorCallback(response) {
    
    return response.status;
    }); 
      


    }]);