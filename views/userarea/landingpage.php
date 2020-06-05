<div ng-controller="headerController" ng-init="get_session_details()">
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" ng-cloak>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <a href="{{dirlocation}}userarea/profile">
      <div class="user-panel">
        <div class="pull-left image" style="height:50px">
          <img src="{{dirlocation}}public/images/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          {{user_data.first_name}}  {{user_data.last_name}}<br/>
        <span style="font-size:11px">{{user_data.email}}</span>
        </div>
      </div>
      </a>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
      <li class="active treeview">
          <a href="<?php echo URL;?>userarea/home">
            <i class="fa fa-th"></i> <span>Home</span>
            
          </a>
          
        </li>

        <li class="treeview">
          <a href="<?php echo URL;?>userarea/map">
            <i class="fa fa-map-marker"></i> <span>Map</span>
            
          </a>
          
        </li>
        <li class="">
          <a href="{{dirlocation}}userarea/users">
            <i class="fa fa-user"></i>
            <span>All Users</span>           
          </a>
        </li>
        <li class="">
          <a href="{{dirlocation}}userarea/groups">
            <i class="fa fa-group"></i>
            <span>Groups</span>           
          </a>
        </li>
        
        <li class="">
        <a href="{{dirlocation}}userarea/sms">
            <i class="fa fa-comment"></i>
            <span>SMS Messages</span>           
          </a>
        </li>

        <li class="">
          <a href="{{dirlocation}}userarea/documents">
            <i class="fa fa-group"></i>
            <span>Documents</span>           
          </a>
        </li>
       
        
        <li><a href="<?php echo URL;?>logout"><i class="fa fa-sign-out text-green"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>
        Users Dashboard
      </h4>
      <ol class="breadcrumb">
        <li><a href="<?php echo URL;?>userarea/"><i class="fa fa-th"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-cloak>

      <div class="row" style="padding:0 0">


        <!-- Left col -->
        <div class="row">
          <ng-view>


        </ng-view>
        </div>



   
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs" style="display:none">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?></strong> All rights
    reserved.
  </footer>


</div>
</div>
