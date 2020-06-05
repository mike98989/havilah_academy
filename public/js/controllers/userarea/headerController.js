    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('headerController', ['$scope','$sce','$http','infogathering', function($scope, $sce, $http, datagrab) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
        ////GET USER DETAILS
    $scope.get_session_details = function(){
    //$('.loader').show();   
    $http.get(datagrab.completeUrlLocation+"api/get_session_details")
   .then(function(response) {
     //alert(JSON.stringify(response.data['data']));
    $scope.user_data = response.data['data'];
    $scope.token = response.data['token'];
    //alert(JSON.stringify($scope.user));
   },function errorCallback(response) {
    //$('.loader').hide();
   return response.status;
   }); 
    }


    }]);
