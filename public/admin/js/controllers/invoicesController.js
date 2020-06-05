

   
    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
  module.controller('invoicesController', ['$scope','$http','infogathering','misc_functions','user_session', function($scope, $http, datagrab, misc_functions, user_session) {
    
    $scope.dirlocation = datagrab.dirlocation;
    $scope.loader = true;
    $scope.currentPage = 1;
    $scope.pageSize = 10;
    //alert(datagrab.urlSplit);  
    ///////////GET ALL CUSTOMERS/////
    $scope.invoice = {};
    $http.get("http://"+datagrab.dirlocation+"api/invoices")
    .then(function(response) {  
    $scope.invoices = response.data; 
    //alert(JSON.stringify($scope.invoices));    
    },function errorCallback(response) {
    return response.status;
    });   
      

    $scope.get_invoice_items = function(id){
    $http.get("http://"+datagrab.dirlocation+"api/get_invoice_items?id="+id)
    .then(function(response) {
    $scope.invoices_items = response.data; 
    //alert(JSON.stringify($scope.invoices_items)); 
    return response.data;   
    },function errorCallback(response) {
    return response.status;
    });   
     } 


    $scope.printable = function(id){
    window.open('http://'+datagrab.dirlocation+'invoice_print?id='+id, 'Print Invoice', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

    //var prtContent = document.getElementById("printable");
    /*
    var WinPrint = window.open('http://'+datagrab.dirlocation+'invoice_print?id='+id, 'Print Invoice', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    if (WinPrint.focus) {newwindow.focus()}
    return false;
    }

    window.setTimeout(function() {
  WinPrint.print();
  WinPrint.close();
}, 3);

    //WinPrint.print();
    //WinPrint.close();   
    */
    } 
 


    }]);