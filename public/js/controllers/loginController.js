    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('loginController', ['$scope','$sce','$http','infogathering', function($scope, $sce, $http, datagrab) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    

    $scope.admin_login = function(){
    $('.loader').show();    
    $('.result').hide();
    var formData = new FormData($('#admin_login')[0]);
    $.ajax({
         url: datagrab.completeUrlLocation+'api/user_login',
         type: 'POST',
         //data: JSON.stringify({'user_email':'mike98989@gmail.com'}),
         data: formData,
         async: true,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         processData: false,
         success: function (answer) {
         //alert(answer);
         var response=JSON.stringify(answer);
         var parsed = JSON.parse(response);
         var msg=angular.fromJson(parsed);
        if(msg.status=='2'){
        window.location.href=datagrab.completeUrlLocation+'userarea'
        }else{
        $('.loader').hide();    
        $('.result').html(msg.message);  
        $('.result').show();
        //$('.signup_loader').hide();
        //$('.alert').html(answer);
        }
        
         }
       });
    }


    }]);
