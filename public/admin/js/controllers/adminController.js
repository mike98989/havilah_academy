

   
    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
  module.controller('adminController', ['$scope','$http','infogathering','misc_functions','user_session', function($scope, $http, datagrab, misc_functions, user_session) {
    
    $scope.dirlocation = datagrab.dirlocation;
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 3;
    //alert(datagrab.urlSplit);  
    ///////////GET ALL CUSTOMERS/////
    $http.get("http://"+datagrab.dirlocation+"api/get_admins")
    .then(function(response) {
    $scope.admins = response.data; 
    //alert(JSON.stringify($scope.admins));    
    },function errorCallback(response) {
    return response.status;
    });  


    }]);