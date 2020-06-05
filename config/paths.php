<?php
/*
define('URL', 'https://'.$_SERVER['HTTP_HOST'].'/');
//define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/');

define('UPLOAD_SIZE', 2097152); // 2MB
define('UPLOAD_DIR', "prison_cms_files");
define('MEMCACHED_HOST', "67.225.142.244");
define('MEMCACHED_PORT', "11211");
*/


define("FOLDER","havilah_academy/");
define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/'.FOLDER);
//define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('UPLOAD_SIZE', 2097152); // 2MB
define('APP_NAME','HAVILAH ACADEMY');
define('UPLOAD_DIR', "{$_SERVER['DOCUMENT_ROOT']}/havilah_academy/uploads");
define('PROFILE_IMG_DIR', "{$_SERVER['DOCUMENT_ROOT']}/havilah_academy/public/images/logos");



