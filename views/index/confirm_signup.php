
<body class="bg-gradient-primary">

    <div class="container"  ng-controller="registerController">
  
      <div class="col-lg-6 col-md-8 col-sm-12 card o-hidden border-0 shadow-lg my-5" style="float:none;margin:30px auto !important">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
         
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                <img src="<?php echo URL;?>public/images/havilah_logo.png" style="width:140px;margin-bottom:10px"/><br/>
                  <h1 class="h3 text-gray-900 mb-4"><?php echo APP_NAME?><br/>
                  <h1 class="h4 text-gray-900 mb-4">Confirm Signup<br/>
                </h1>
                </div>
                <div class="result alert alert-default" style="display:nne;text-align:center">
                <?php echo $message['msg'];?>
                </div>
                <hr>
                <div class="text-center">
                  <a class="" href="{{dirlocation}}userlogin">Proceed to Login!</a>
                </div>
                <div class="text-center">
                  <a class="small" href="{{dirlocation}}">I don't have an account yet!</a>
                </div>
                
              </div>
         
          </div>
        </div>
      </div>
  
    </div>

  </body>