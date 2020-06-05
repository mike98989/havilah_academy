

   
    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
  module.controller('customersController', ['$scope','$http','infogathering','misc_functions','user_session', function($scope, $http, datagrab, misc_functions, user_session) {
    
    
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 10;
      
    ///////////GET ALL CUSTOMERS/////
    $http.get("http://"+datagrab.dirlocation+"api/customers")
    .then(function(response) {
    $scope.customers = response.data; 
    //alert(JSON.stringify($scope.customers));    
    },function errorCallback(response) {
    return response.status;
    });   

    $scope.get_invoice = function(id){
    ///////////GET ALL CUSTOMERS/////
    $http.get("http://"+datagrab.dirlocation+"api/get_customer_invoice?id="+id)
    .then(function(response) {
    $scope.customers_invoice = response.data; 
    return response.data;
    //alert(JSON.stringify($scope.customers_invoice));    
    },function errorCallback(response) {
    return response.status;
    });     
    }
      
    }]);    
