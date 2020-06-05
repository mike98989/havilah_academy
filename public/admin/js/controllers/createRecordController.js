


    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////
  module.controller('createRecordController', ['$scope','$http','infogathering','misc_functions','user_session', function($scope, $http, datagrab, misc_functions, user_session) {

    //////// CALCULATE TAX
    $scope.calculate_tax = function(){

   var materials = $('.materials');
    var labor = $('.labor');
    var labor_estimate = 0;
    var total_estimate = 0;
    var total=0;
    for(var i=0; i<materials.length;i++){
    if(parseInt(materials[i].value)||parseInt(labor[i].value))
            //labor_estimate += parseInt(labor[i].value);
    total_estimate += parseInt(materials[i].value*1+ labor[i].value*1);
    }
    //alert('length is '+labor.length+'added is'+tot);

    }
    //////GET TOTAL ESTIMATE/////

    $scope.calculate_total = function(){

    $scope.labor_tax_deduction = parseFloat(0.101 * $scope.total_estimate).toFixed(2);
    $scope.total=parseFloat($scope.labor_tax_deduction*1 + $scope.total_estimate*1).toFixed(2);
    }



    }]);
