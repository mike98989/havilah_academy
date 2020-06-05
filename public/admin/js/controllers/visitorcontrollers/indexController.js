

   
    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
  module.controller('indexController', ['$scope','$http','infogathering','misc_functions','user_session', function($scope, $http, datagrab, misc_functions, user_session) {
    
    
    $scope.dirlocation=datagrab.dirlocation;  
     //////////FETCH ALL TRENDING MUSIC AND COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/get_community_trending_content")
    .then(function(response) {
    $scope.trending = response.data;    
    //alert(JSON.stringify($scope.trending));    
    },function errorCallback(response) {
    
    return response.status;
    }); 
      
    
   //////////FETCH LATEST SONGS UPLOAD
    $http.get("http://"+datagrab.dirlocation+"api/get_latest_audio_upload")
    .then(function(response) {
    $scope.latest_audio = response.data;    
    //alert(JSON.stringify($scope.latest_audio));    
    },function errorCallback(response) {
    
    return response.status;
    }); 
      
     ////////////PLAY SONG 
      $scope.playsong = function(author, song_title, path, cover, id, index){
      $scope.play = misc_functions.playsong(author, song_title, path, cover, id, index);  
        //alert($scope.play);      
     }
       
       ////////////PLAY SONG 
      $scope.muteaudio = function(){
        alert('yessss');  
      //$scope.muteaudio = misc_functions.muteaudio();    
     }
    
    $scope.change_currency_biller = function(value){
    split = value.split('@');  
    $scope.plan_one_amount = 0 * split[0];    
    $scope.plan_two_amount = 50 * split[0];
    $scope.plan_three_amount = 1000 * split[0];  
    $scope.money = split[1];    
    }
   
    }]);