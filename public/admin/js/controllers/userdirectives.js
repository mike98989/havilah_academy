module.filter('trustedAudioUrl', function($sce) {
    return function(path, audioFile) {
        return $sce.trustAsResourceUrl(path + audioFile);
    };
});
    

    
    ///// SERVICE FOR INFORMATION GATHERING/////
   module.factory('infogathering', ['$http', function($http) {
    var siteUrl = window.location.pathname;;
    var webUrl= siteUrl.split("/");
    
    //splice the url to fit in both on localhost and onine server
    var i = webUrl.indexOf('hellogospel');    
    webUrl.splice(i, 1);        
        
    //var dirlocation = 'www.surewellnessreferrals.com/';
    var dirlocation = window.location.hostname+'/hellogospel/';
    //var current_user = $('#current_user_value').val();
    return {dirlocation: dirlocation, urlSplit:webUrl}

   }])
    
   
     ///// SERVICE FOR SESSION INFO GATHERING/////
    module.factory('user_session', ['$http','infogathering','$cookies', function($http, datagrab,$cookies) {
   
    //////////FETCH CURRENT USER COMMUNITY     
    var user_session = $http.get("http://"+datagrab.dirlocation+"api/get_session")
    .then(function(response) {
        
    var user_session = angular.fromJson(response.data.details);    
    var user_counter = angular.fromJson(response.data.counter);  
    //$cookies.put('session', JSON.stringify(user_session));
    //$cookies.put('counter', JSON.stringify(user_counter));    
    return response.data;
    },function errorCallback(response) {    
    return response.status;
    });
    
     
    return {user_session_details:user_session};
    

    }])
    
    
        ///// SERVICE FOR ALL REGISTERED USERS/////
    module.factory('all_users', ['$http','infogathering', function($http, datagrab) {
       
    //////////FETCH ALL USER COMMUNITY     
    var all_users = $http.get("http://"+datagrab.dirlocation+"api/get_all_users")
    .then(function(response) { 
    return response.data;    
    },function errorCallback(response) {    
    return response.status;
    }); 
       
            
    return {all_users:all_users};
    

    }])
    
    
    ///// SERVICE FOR ALL REGISTERED USERS/////
    module.factory('misc_functions', ['$http','infogathering', function($http, datagrab) {
    
    /////////AUDIO MUTE    
   var muteaudio = function(){
    var myAudio = document.getElementById("audioplayer");    
    if(myAudio.muted){
    myAudio.muted = false;
     document.getElementById("mutebutton").style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/volume.png') no-repeat;";
   }else{  
     myAudio.muted = true;
    document.getElementById("mutebutton").style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/mute.png') no-repeat;";   
   } 
        
    };
       
    //////////////SET VOLUME    
    var setvolume = function setvolume(){   
    var myAudio = document.getElementById("audioplayer");   
    var volumeslider = document.getElementById("volumeslider");    
    myAudio.volume = volumeslider.value / 100;    
    }    
        
    
    /////////////AUDIO TIMELINE
    var audiotimeline = function audiotimeline(seeking,seek_first){
    var myAudio = document.getElementById("audioplayer"); 
    var seekslider = document.getElementById("seekslider");    
      
    
    ////////SEEK EVENT
    if(seek_first==true){seek(event);}    
        
    function seek(event){
    //alert('seeking is '+seeking);    
    //var seekslider = document.getElementById("seekslider");  
    //var myAudio = document.getElementById("audioplayer");     
   
    if(seeking){
    myAudio.pause();    
   
    //seekslider.value = event.clientX - seekslider.offsetLeft;
    //alert('event clientx value is '+ event.clientX);  
        
    seekto = myAudio.duration * (seekslider.value / 100);
    //alert('audioduration is '+seekto);    
    myAudio.currentTime = seekto;
        
    }      
    }
        
     }
    

    var playpause = function(){
    var playbtn = document.getElementById("playpausebutton");    
    var myAudio = document.getElementById("audioplayer");    
    if (myAudio.paused) {    
    myAudio.play();
     //$('.playsong'+id).html("<i class='fa fa-pause'></i>"); 
     playbtn.style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/pausebtn.png') no-repeat;";    
    } else{
     myAudio.pause();
    //$('.fa-play'+id).html("<i class='fa fa-play'></i>"); 
    playbtn.style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/playbtn.png') no-repeat;";     
        
    }
    }
    
    /////////FUNCTION FOR PLAYING SONG//////
    var playsong = function(author, song_title, path, cover, id, index){
    current = parseInt(index);  
    playlist = $('#playlist'); 
    tracks = playlist.find('.playlistclass a');
    len = tracks.length;
    //alert(len); 
    
    playbtn = document.getElementById("playpausebutton");
    nextbtn = document.getElementById("nextbutton"); 
    nextbtn.value = current++;  
       
    $('.author').text(author);
    $('.song_title').text(song_title);  
    //alert(index);
    /////CHANGE TH ALBUM COVER////    
    $('#album-art').attr('src', 'http://'+datagrab.dirlocation+'public/'+cover); 
    $('#album-cover').attr('src', 'http://'+datagrab.dirlocation+'public/'+cover);
    $('#album-cover-mobile').attr('src', 'http://'+datagrab.dirlocation+'public/'+cover);    
    $('.mobile-disc-cover').addClass('rotatedisc');   
     document.getElementById("coin_icon").style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/coin_icon2b.png') no-repeat;";      
    //$('#coin_icon').css({"background-color":"yellow","background":"url('http://"+datagrab.dirlocation+"views/images/coin_icon.png')no-repeat","height":"20px","width":"20px"});    
    document.getElementById("downloadbutton").value = path;
       
    //////Assign the Audio Player Source
   
    var myAudio = document.getElementById("audioplayer");
    
         /////CHANGE IF THE AUDIO FILES ARE THESAME////      
    if(myAudio.src=='http://'+datagrab.dirlocation+'public/'+path){
      
    ////// If the audio is paused    
    if (myAudio.paused) {    
    myAudio.play();
     $('.mobile-disc-cover').removeClass('stoprotatedisc').addClass('rotatedisc');     
     $('.playsong'+id).html("<i class='fa fa-pause'></i>");        
     playbtn.style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/pausebtn.png') no-repeat;";    
    } 
        
    ////// If the audio is Playing        
    else {
    myAudio.pause();
     $('.mobile-disc-cover').removeClass('rotatedisc').addClass('stoprotatedisc');    
    $('.playsong'+id).html("<i class='fa fa-play'></i>"); 
    playbtn.style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/playbtn.png') no-repeat;";            
    }
       
    }
    /////CHANGE IF THE AUDIO FILES ARE NOT THESAME////          
    else{
    $('.allplaygroup').html("<i class='fa fa-play'></i>");     
    $('.playsong'+id).html("<i class='fa fa-pause'></i>"); 
    $('.song_playing_now').html(author+'-'+song_title);  
    $('.mobile-disc-cover').removeClass('stoprotatedisc').addClass('rotatedisc');       
    playbtn.style.cssText="background: url('http://"+datagrab.dirlocation+"views/images/pausebtn.png') no-repeat;";    
    myAudio.src = 'http://'+datagrab.dirlocation+'public/'+path;  
    myAudio.play();    
    }
        
        
    myAudio.addEventListener('ended',function(e){
    //current++;                   
    //alert('current is '+current+' and length is '+len);    
    if(current == len){
        current = 0;
        link = playlist.find('.playlistclass a')[0];
        
    }else{
        link = playlist.find('.playlistclass a')[current];  
    } 
    var splitval = link.rel.split("@");
    nextsong();    
    //playsong(splitval[0],splitval[1],splitval[2],splitval[3],splitval[4],splitval[5]);    
    //return false;
        //run(link,myAudio);
    });
          
        
    /////ADD EVENT LISTERNER TO AUDIO PLAYER FOR READING THE PLAYED TIME///////
    myAudio.addEventListener("timeupdate", function(){seektimeupdate();});
        
    function seektimeupdate(){
        var seekslider = document.getElementById("seekslider"); 
        var currentplayertime = document.getElementById("currentplaytime");
        var totalplaytime = document.getElementById("totalplaytime");
        var nt = myAudio.currentTime * (100/myAudio.duration); 
        seekslider.value = nt;
        var curmins = Math.floor(myAudio.currentTime / 60);
        var cursecs = Math.floor(myAudio.currentTime - curmins * 60);
        var durmins = Math.floor(myAudio.duration / 60);
        var dursecs = Math.floor(myAudio.duration - durmins * 60);
        
        //////CONDITIONAL
        if(cursecs<10){cursecs = '0'+ cursecs;}
        if(dursecs<10){dursecs = '0'+ dursecs;}
        if(curmins<10){curmins = '0'+ curmins;}
        if(durmins<10){durmins = '0'+ durmins;}
        currentplayertime.innerHTML = curmins+':'+cursecs;
        totalplaytime.innerHTML = durmins+':'+dursecs;
    }

    
    }; 
    
    
    var nextsong = function(){
    nextbtn = document.getElementById("nextbutton");  
    val = parseInt(nextbtn.value); 
      
    nextval = val +1;    
    //playlist = document.getElementById("playlist"); 
    playlist = $('#playlist'); 
    tracks = playlist.find('.playlistclass a');
    len = tracks.length;
    if(nextval == len){
        nextval = 0;
        link = playlist.find('.playlistclass a')[0];
        
    }else{
        link = playlist.find('.playlistclass a')[nextval];  
    } 
    var splitval = link.rel.split("@");
     
    playsong(splitval[0], splitval[1], splitval[2], splitval[3], splitval[4], splitval[5]);    
        
    }
    
    
    var prevsong = function(){
    nextbtn = document.getElementById("nextbutton");  
    val = parseInt(nextbtn.value); 
    prevval = val -1;    
    //playlist = document.getElementById("playlist"); 
    playlist = $('#playlist'); 
    tracks = playlist.find('.playlistclass a');
    len = tracks.length;
   
    if(prevval <0){
        prevval = 0;
        link = playlist.find('.playlistclass a')[0];
        
    }else{
        link = playlist.find('.playlistclass a')[prevval];  
    } 
    var splitval = link.rel.split("@");     
    playsong(splitval[0], splitval[1], splitval[2], splitval[3], splitval[4], splitval[5]);    
        
    }
    
    ///////FOLLOW BUTTON ACTIVITY
        
    var follow = function(artist_id, user_id){
      
    if(user_id==null){
    $('#loginWindowModal').appendTo("body").modal('show');     
    }else{   
    //////////FOLLOW ARTIST//////
    $http.get("http://"+datagrab.dirlocation+"api/follow?user_id="+user_id+"&artist_id="+artist_id)
    .then(function(response) {
    //alert(response.data); 
    $('#follow'+artist_id).addClass('btn-purple');    
    $('#follow'+artist_id).text('Following');    
    return response.data;    
    },function errorCallback(response) {    
    return response.status;
    });
        
        
    }
        
    }
    
    
            
    ///////UNFOLLOW BUTTON ACTIVITY
        
    var unfollow = function(artist_id, user_id){
      
    if(user_id==null){
    $('#loginWindowModal').appendTo("body").modal('show');     
    }else{   
    //////////FOLLOW ARTIST//////
    $http.get("http://"+datagrab.dirlocation+"api/unfollow?user_id="+user_id+"&artist_id="+artist_id)
    .then(function(response) {
    //alert(response.data); 
    $('#unfollow'+artist_id).removeClass('btn-purple').addClass('btn-default');    
    $('#unfollow'+artist_id).text('Follow');    
    return response.data;    
    },function errorCallback(response) {    
    return response.status;
    });
        
        
    }
        
    }
    
    var getfollower = function(user_id,dataarray){
        //alert(user_id); 
        var artist_id = ' '+user_id;
       var datasplit=dataarray.split(";");
            
       var numOfTrue = 0;     
        
       for (var i = 0; i < datasplit.length; i++) {
        if (datasplit[i] === artist_id) { //increment if true
          numOfTrue++; 
        }
        }
       
        return numOfTrue;
        
    }
      

    
    return {playsong:playsong, follow:follow, getfollower:getfollower, unfollow:unfollow, muteaudio:muteaudio,setvolume:setvolume,audiotimeline:audiotimeline,playpause:playpause,nextsong:nextsong,prevsong:prevsong};
    

    }])
    
    ///// SERVICE FOR SESSION INFO GATHERING/////
    module.factory('user_community', ['$http','infogathering', function($http,datagrab) {
   
       
     return {
        // this function get/sets the value of the private variable variable1
        user_communities: function (val) {
     
        var communities = $http.get("http://"+datagrab.dirlocation+"api/get_user_communities?communities="+val)
        .then(function(response) { 
        return response.data;
        },function errorCallback(response) {   
        return response.status;
        });
        return communities;    
        }
    };
        

    }]);



 module.factory('profile_status', ['$http','infogathering', function($http,datagrab) {
   
       
    return {
      user_profile_status: function (val) {
        var user_status = $http.get("http://"+datagrab.dirlocation+"api/get_user_profile_status?id="+val)
        .then(function(response) { 
        return response.data;
        },function errorCallback(response) {   
        return response.status;
        });
        return user_status;    
        }
        
        
   };
        

    }]);


 module.factory('loader', ['$http','infogathering', function($http,datagrab) {
   
       
    return {
      isloading: function (val) {
        alert(val);
        return val;    
        }
        
        
   };
        

    }]);


module.directive('embedSrc', function () {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      scope.$watch(
        function() {
          return attrs.embedSrc;
        },
        function() {
          element.attr('src', attrs.embedSrc);
        }
      );
    }
  };
});

//})();
