
<body class="bg-gradient-primary">
  <div class="container" ng-controller="loginController">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-7 col-md-8 col-sm-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                  <img src="<?php echo URL;?>public/images/havilah_logo.png" style="width:140px;margin-bottom:10px"/><br/>
                  <h1 class="h3 text-gray-900 mb-4"><?php echo APP_NAME?><br/>
                </h1>
                    
                  </div>

                  <form class="user" ng-submit="admin_login()" id="admin_login">
                  <div class="result" style="display:none;text-align:center"></div>
                    <div class="form-group">
                      <input type="email" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <select class="form-control form-control-user">
                      <option value="0">Select Department</option>
                      <option value="1">Engineering Service</option>
                      <option value="2">Engineering Design & Evaluation</option>
                      <option value="1">ICT</option>
                      </select>
                    </div>
                    <input type="hidden" name="source" value="browser">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                    <img src="<?php echo URL;?>public/images/spinner2.gif" style="display:none" width="20px" class="loader"> Login
</button>
                    <hr>
                  </form>
                  

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  