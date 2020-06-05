

    
    
    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
 module.controller('footerController', ['$scope','$http','infogathering','all_users','misc_functions','user_session', function($scope, $http, datagrab, all_users, misc_functions, user_session) {
           
       ////////////MUTE AUDIO 

     $scope.muteaudio = function muteaudio(){     
      misc_functions.muteaudio();   
     }
      
     $scope.volumecontrol = function volumecontrol(){
        misc_functions.setvolume(); 
     }
     
      $scope.audiotimeline = function (seeking,seek){  
        misc_functions.audiotimeline(seeking,seek); 
     }
    
    /////PLAY PAUSE FUNCTION 
    $scope.playpause = function (){
       //alert('yessss'); 
     misc_functions.playpause();      
    }
    
    /////NEXT SONG FUNCTION
    $scope.nextsong = function(){
    misc_functions.nextsong();      
    }
    
    $scope.prevsong = function(){
    misc_functions.prevsong();      
    }
    
    
    ///////DOWNLOAD SONG
    $scope.download = function(){
    var val = document.getElementById("downloadbutton").value;   
    alert(val);    
        
    }
    }]);