<!-- jQuery 2.2.3 -->
<script src="<?php echo URL;?>public/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo URL;?>public/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo URL;?>public/admin/plugins/iCheck/icheck.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo URL;?>public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo URL;?>public/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL;?>public/admin/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo URL;?>public/admin/dist/js/demo.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo URL;?>public/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo URL;?>public/admin/plugins/select2/select2.full.min.js"></script>

<script src="<?php echo URL; ?>public/js/angular/angular.js"></script>
<script src="<?php echo URL; ?>public/js/angular/angular-route.js"></script>
<script src="<?php echo URL; ?>public/js/dirPagination.js"></script>
<script src="<?php echo URL; ?>public/js/angular/angular-sanitize.js"></script>
<script src="<?php echo URL; ?>public/js/angular/angular-cookies.js"></script>
<!----MODULE-->
<script src="<?php echo URL.'public/js/controllers/module.js';?>"></script>


<!--INJECTED INTERNAL CONTROLLERS-->
<?php if(isset($js)){foreach($js as $jsfile){
echo "<script src=".URL.$jsfile."></script>";
}
}
//////EXTERNAL JAVASCRIPT
if(isset($external_js)){foreach($external_js as $external_jsfile){
echo "<script type='text/javascript' src=".$external_jsfile."></script>";
}
}
?>

<!---<script src="<?php echo URL.'public/js/controllers/userarea/mapController.js';?>"></script>-->
<script src="<?php echo URL.'public/js/controllers/userarea/usersController.js';?>"></script>
<script src="<?php echo URL.'public/js/controllers/userarea/groupsController.js';?>"></script>
<script src="<?php echo URL.'public/js/controllers/userarea/smsController.js';?>"></script>
<script src="<?php echo URL.'public/js/controllers/userarea/landingPageController.js';?>"></script>


<script src="<?php echo URL.'public/js/controllers/userpageapp.js';?>"></script>
<script src="<?php echo URL.'public/js/controllers/directives.js';?>"></script>
<!---CONTROLLERS---->





