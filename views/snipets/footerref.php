



<!-- jQuery 2.2.3 -->
<script src="<?php echo URL;?>public/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo URL;?>public/css/bootstrap4/popper.js"></script>
<script src="<?php echo URL;?>public/css/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo URL;?>public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo URL;?>public/plugins/easing/easing.js"></script>


  <!---LIBRARIES-->
<script src="<?php echo URL;?>public/js/angular/angular.js"></script>
<script src="<?php echo URL;?>public/js/angular/angular-route.js"></script>
<script src="<?php echo URL;?>public/js/dirPagination.js"></script>
<script src="<?php echo URL;?>public/js/angular/angular-sanitize.js"></script>
<script src="<?php echo URL;?>public/js/angular/angular-cookies.js"></script>
<script src="<?php echo URL;?>public/js/angular/ngStorage.min.js"></script>
<!---MODULE-->
<script src="<?php echo URL;?>public/js/controllers/module.js"></script>
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


<!---DIRECTIVE-->
<script src="<?php echo URL;?>public/js/controllers/directives.js"></script>

</body>
</html>