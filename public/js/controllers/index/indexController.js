    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('indexController', ['$scope','$sce','$http','infogathering', function($scope, $sce, $http, datagrab) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    

    ////FETCH  NEWS
    $scope.get_all_news = function(){
    //$('.loader').show();   
    $http.get(datagrab.completeUrlLocation+"api/get_all_news")
   .then(function(response) {
    //$('.loader').hide();
    $scope.news = response.data;
    //alert(JSON.stringify(response.data));
   },function errorCallback(response) {
    //$('.loader').hide();
   return response.status;
   }); 
    }



        ////FETCH  SLIDERS
    $scope.get_slider_image = function(){
    //$('.loader').show();   
    $http.get(datagrab.completeUrlLocation+"api/get_slider_image")
   .then(function(response) {
    //$('.loader').hide();
    $scope.sliders = response.data;
    //alert(JSON.stringify(response.data));
   },function errorCallback(response) {
    //$('.loader').hide();
   return response.status;
   }); 
    }


    }]);
