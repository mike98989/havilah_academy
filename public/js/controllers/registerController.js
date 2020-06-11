    ///////////// THIS IS THE INDEXPAGE CONTROLLER///////
    ///// THIS CONTROLS EVERY ACTIVITY ON THE INDEX PAGE
    /////////////////////////

  module.controller('registerController', ['$scope','$sce','$http','infogathering', function($scope, $sce, $http, datagrab) {
    $scope.fieldcounter = 1;
    //$('.loader').show();  

    $scope.dirlocation=datagrab.completeUrlLocation;
    $scope.currentPage = 1;
    $scope.pageSize = 30;
    
    /////////////USER REGISTRATION SUBMIT PROCESS
    $scope.submit_registration = function(){
    var password = $('.password').val();
    var confirm_password = $('.confirm_password').val(); 
    if(password!==confirm_password){  
    $('.result').html("<i class='fa fa-exclamation-triangle'></i> Passwords do not match!");
    $('.result').show();
    }else{   
    $('.loader').show();    
    $('.result').hide();
    var formData = new FormData($('#registrationForm')[0]);
    $.ajax({
         url: datagrab.completeUrlLocation+'api/user_signup',
         type: 'POST',
         data: formData,
         async: true,
         cache: false,
         contentType: false,
         enctype: 'multipart/form-data',
         processData: false,
         success: function (answer) {
        //alert(answer);
        var msg=JSON.parse(answer);
        if(msg.status=='1'){
        $('.first_name').val("");
        $('.last_name').val("");
        $('.email').val("");
        $('.password').val("");
        $('.confirm_password').val("");
        $('.loader').hide();    
        $('.result').html("<i class='fa fa-exclamation-triangle'></i> "+msg.msg);
        $('.result').show();
        }else{
        $('.loader').hide();    
        $('.result').html("<i class='fa fa-exclamation-triangle'></i> "+msg.msg);
        $('.result').show();
        //$('.signup_loader').hide();
        //$('.alert').html(answer);
        }
        
         }
       });
    }
}


    }]);
