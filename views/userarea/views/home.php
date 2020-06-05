        
        <div class="col-md-12" style="display:nne" ng-init="count_related_tables(token)">
        
         <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <a href="{{dirlocation}}userarea/users" style="color:inherit">
            <div class="info-box-content">
              <span class="info-box-text">Total Users</span>
              <span class="info-box-number">{{counted_records[0].counted_users}}</span>
            </div>
            </a>

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          <!-- /.info-box -->

           <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-group"></i></span>
            <a href="{{dirlocation}}userarea/groups" style="color:inherit">
            <div class="info-box-content">
              <span class="info-box-text">Groups</span>
              <span class="info-box-number">{{counted_records[0].counted_groups}}</span>
            </div>
            </a>

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
          
          
          
        </div>
        <!-- /.col -->