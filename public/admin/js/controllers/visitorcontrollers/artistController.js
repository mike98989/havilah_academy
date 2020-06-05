

    
    ///////////// THIS IS THE COMMUNITY CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE COMMUITY PAGE
    /////////////////////////
  module.controller('artistController', ['$scope','$http','infogathering','all_users','misc_functions','user_session', function($scope, $http, datagrab, all_users, misc_functions, user_session) {
      
   
    $scope.dirlocation=datagrab.dirlocation;  
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 10;
      
      
   ///////////GET ALL REGISTERED USERS/////
    all_users.all_users.then(function(response){
    $scope.all_users = response;  
    })
    
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
    
    //////////FETCH PLAYLISTS
    var playlists = $http.get("http://"+datagrab.dirlocation+"api/get_user_playlist?id="+$scope.user_session[0].ID)
    .then(function(response) {
    $scope.playlists = response.data;  
    return response.data;    
    },function errorCallback(response) {    
    return response.status;
    }); 
        
    });
    
    
    
    
    /////CHECK IF THE USER IS SIGNED IN///////
    $scope.check_if_signed_in = function(content_id,user_id){
    if(user_id==null){
    $('#loginWindowModal').appendTo("body").modal('show');     
    }else{
    $('#playlist_datagrab').val(content_id+'@'+user_id);    
    $('#playlistWindowModal').appendTo("body").modal('show');     
    }
           
    }
    
    //$scope.cartlist='';
        /////CHECK IF THE USER IS SIGNED IN///////
    $scope.cart = function(content_id,user_id,coins,content_title,artist_name,content_image){
    //$scope.cartlist ='';    
    if(user_id==null){
    $('#loginWindowModal').appendTo("body").modal('show');     
    }else{ 
    if(content_id!=''){
    //////////FETCH PLAYLISTS
    $http.get("http://"+datagrab.dirlocation+"api/add_to_cart?content_id="+content_id+"&artist_id="+user_id+"&coins_tag="+coins+"&content_title="+content_title+"&artist_name="+artist_name+"&content_image="+content_image)
    .then(function(response) {       
    $scope.cartlist = response.data;
    $('#cartWindowModal').appendTo("body").modal('show');    
    alert(JSON.stringify(response.data));     
      
    },function errorCallback(response) {    
    return response.status;
    }); 
         
    }; 
        
     //return response.data;        
    }
    
    //return response.status;    
    }
    
    $scope.cartlisting = function  (response){
     //$scope.carlist = response;
     alert('this is it '+JSON.stringify(response));  
      return response;     
    }
    
    /////ADD A SONG TO PLAYLIST///////
    $scope.add_to_playlist = function(playlist_id){
    var data = $('#playlist_datagrab').val();
    var details= data.split('@');  
   
    ////////UPDATE THE PLAYLIST     
    $http.get("http://"+datagrab.dirlocation+"api/add_to_playlist?content_id="+details[0]+"&user_id="+details[1]+"&playlist_id="+playlist_id)
    .then(function(response) {
    if(response.data=='true'){
    $('.check'+playlist_id).hide();    
    $('.success'+playlist_id).show();      
    }else{
    $('#playlistWindowModal').modal('hide');        
    $('#message').text(response.data);    
    $('#messageWindowModal').appendTo("body").modal('show');
       
    }
    //alert(response.data);  
    //$('.playlistadded'+content_id).text(parseInt(currentval)-1);    
   
    },function errorCallback(response) {
    
    return response.status;
    }); 
        
    }
    
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
    
    /////LIKE OR DISLIKE A CONTENT//////  
    $scope.like_dislike = function(content_id,content_type,user_id){
    var currentval = $('.likescounter'+content_id).text();
    
    if(user_id==null){
    
    $('#loginWindowModal').appendTo("body").modal('show');
        
    //window.location.href="http://"+datagrab.dirlocation+"userlogin?redirect=michael_akpos/songs";  
    }else{
    if(content_id==null){
    alert('NETWORK PROBLEM ADDING SONG... Please try again later!');
    }else{
    var findi = $('#btn'+content_id).hasClass("btn-purple");    
    //alert(findi);
  
    if(findi==false){
    $http.get("http://"+datagrab.dirlocation+"api/like_content?content_id="+content_id+"&content_type="+content_type+"&user_id="+user_id)
    .then(function(response) {
    $('#btn'+content_id).addClass('btn-purple'); 
    $('.likescounter'+content_id).text(parseInt(currentval)+1);    
    },function errorCallback(response) {
    
    return response.status;
    }); 
    }else{
        
    $http.get("http://"+datagrab.dirlocation+"api/dislike_content?content_id="+content_id+"&content_type="+content_type+"&user_id="+user_id)
    .then(function(response) {
    //alert(response.data);  
    $('.likescounter'+content_id).text(parseInt(currentval)-1);    
    $('#btn'+content_id).removeClass( "btn-purple" ).addClass('btn-default');    
    },function errorCallback(response) {
    
    return response.status;
    }); 
    }
      
    }
    }
        
    }
    
    
    $scope.getSplit = function(id, dataarray){
        
       var artist  = ' '+id;    
       var datasplit=dataarray.split(",");
            
       var numOfTrue = 0;     
        
       for (var i = 0; i < datasplit.length; i++) {
        if (datasplit[i] === artist) { //increment if true
          numOfTrue++; 
        }
        }

        return numOfTrue;
    }

          
    
    $scope.getfollower = function(user_id,dataarray){
        
        var artist_id = ' '+user_id;
       var datasplit=dataarray.split(";");
            
       var numOfTrue = 0;     
        
       for (var i = 0; i < datasplit.length; i++) {
        if (datasplit[i] === artist_id) { //increment if true
          numOfTrue++; 
        }
        }
        //alert(artist_id);
        return numOfTrue;
        
    }
      
   
     
     //////////FETCH ALL MUSIC UNDER THIS COMMUNITY
    $http.get("http://"+datagrab.dirlocation+"api/get_artist_profile?id="+datagrab.urlSplit[1])
    .then(function(response) {
   
    $scope.allsongs =  angular.fromJson(response.data.allsongs);
	$scope.albums =    angular.fromJson(response.data.albums);
           
    ///////GET FANS

    $scope.fans=$scope.allsongs[0].fans.split(";").length;  
    
    },function errorCallback(response) {
    
    return response.status;
    }); 
      
    
 

    ////////////PLAY SONG
     $scope.playsong = function(author, song_title, path, cover, id, index){
      $scope.play = misc_functions.playsong(author, song_title, path, cover, id, index);    
     }
   

    }]);
    