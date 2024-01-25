<?php
session_start();
ob_start();

require '../config.php';
require '../includes/contect.php';
require '../includes/databases.php';
require '../includes/sessions.php';
require '../includes/functions.php';


$module = _MODULE_DEFAULT_ADMIN;
$active = _ACTIVE_DEFAULT_ADMIN;

$erorr = _PATH_ERORR_DEFAULT;

if(!empty($_GET['module'])){
    $module = $_GET['module'];
}

if(!empty($_GET['active'])){
    $active = $_GET['active'];
}

$path = 'modules/'.$module.'/'.$active.'.php';

if(file_exists($path)){
    require $path;
    die();
}else{
    require $erorr;
    die();
}















?>