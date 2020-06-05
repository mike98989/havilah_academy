<?php
/*
if (!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}
*/
ini_set('error_reporting', E_ALL);
ob_start();
// Use an autoloader!
require 'libs/Bootstrap2.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';

// Library
require 'libs/mysqliz.php';
require 'libs/Database.php';
require 'libs/Session.php';

require 'config/paths.php';
require 'config/database.php';

$app = new Bootstrap();
//}

