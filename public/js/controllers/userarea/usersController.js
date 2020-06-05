    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('usersController', ['$scope','$sce','$http','infogathering','$routeParams', function($scope, $sce, $http, datagrab, $routeParams) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  
    
    var url = window.location.href;
    if (url.indexOf("#")>1){
    var page = window.location.href.split('#');
    var pager = page[1].split('=').pop();
    //var pager = sessionStorage.getItem("pager");
    if((pager=='')||(pager=='undefined')||(pager==null)||(pager=='0')){
    pager='1';
    } 
    }else{
      pager='1';
    }

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = pager;
    $scope.pageSize = 10;
    

    ////FETCH  USERS
    $scope.get_users = function(deviceToken){
         //alert(datagrab.completeUrlLocation);
         $('.loader').show();  
         $('.result').hide();

         var req = {"type": '100',"user_token": deviceToken};
         $http
         .post(datagrab.completeUrlLocation+'api/get_users', req)
         .then(
             function (response) {
                 $scope.all_users=response.data.data;
             }, 
             function () {
                 alert("there was an error");
             }
         );

    }


    ////ACTIVATE  USERS
    $scope.activate_or_deactivate_user = function(value,user,deviceToken,key){
      $('.loader_'+user.id).show();
         var formData = new FormData();
         formData.append("value",value);
         formData.append("user_token",deviceToken);
         formData.append("user_id",user.id);

  $.ajax({
      url: datagrab.completeUrlLocation+'api/activate_or_deactivate_user',
      type: 'POST',
      //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
      data: formData,
      async: true,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      success: function (answer) {
      
      var response=JSON.stringify(answer);
      var parsed = JSON.parse(response);
      var msg=angular.fromJson(parsed);
      
      $('.loader_'+user.id).hide();    

      if(msg.status=='1'){
     // $scope.user[key].activated=value;
     
      $scope.$apply(function() {
        $scope.all_users[key].activated=value;
      });

      
      }
      
      }
    })
 }

    $scope.delete_user = function(book){
     var conf = confirm("Do you want to delete this book '"+book.book_title+"'");
     if(conf==true){ 
    $('.loader_'+book.book_id).show();
    $http.get(datagrab.completeUrlLocation+"api/delete_book?book_id="+book.book_id+"&path="+book.book_cover)
   .then(function(response) {
    if(response.data.status=='1'){
    $scope.books.splice(book, 1);
    category = null;
    }
    $('.loader_'+book.book_id).hide();
   },function errorCallback(response) {
    $('.loader_'+book.book_id).hide();
   return response.status;
   }); 
 }

    }

    $scope.get_user_details = function(){

      $http.get(datagrab.completeUrlLocation+"api/get_book_details?book_id="+$routeParams.book_id)
   .then(function(response) {
    //$('.loader').hide();
    $scope.book = response.data.data;
    //alert(JSON.stringify($scope.book));
   },function errorCallback(response) {
    //$('.loader').hide();
   return response.status;
   }); 
    }




    }]);
