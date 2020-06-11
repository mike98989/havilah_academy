
<body class="bg-gradient-primary">

    <div class="container"  ng-controller="registerController">
  
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image" style="background-image: url('<?php echo URL;?>public/images/register_banner1.jpg')"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                <img src="<?php echo URL;?>public/images/havilah_logo.png" style="width:140px;margin-bottom:10px"/><br/>
                  <h1 class="h3 text-gray-900 mb-4"><?php echo APP_NAME?><br/>
                  <h1 class="h4 text-gray-900 mb-4">Create Account<br/>
                </h1>
                </div>
                <div class="result alert alert-info" style="display:none"></div>
                <form class="user" id="registrationForm" ng-submit="submit_registration()">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" required class="first_name form-control form-control-user" id="exampleFirstName" name="first_name" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" required class="last_name form-control form-control-user" id="exampleLastName" name="last_name" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" required class="email form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" required class="password form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input type="password" required class="confirm_password form-control form-control-user" id="exampleRepeatPassword" name="confirm_password" placeholder="Repeat Password">
                    </div>
                  </div>
                  <button class="btn btn-primary btn-user btn-block">
                  <img src="{{dirlocation}}public/images/spinner2.gif" class="loader" style="width:30px;display:none">
                    Register Account
                  </button>
                  <hr style="display:none">
                  <a href="index.html" class="btn btn-google btn-user btn-block" style="display:none">
                    <i class="fab fa-google fa-fw"></i> Register with Google
                  </a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block" style="display:none">
                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                  </a>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="#">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="{{dirlocation}}userlogin">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    </div>

  </body>