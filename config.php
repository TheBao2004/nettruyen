<?php 

const _MODULE_DEFAULT = 'home'; 
const _ACTIVE_DEFAULT = 'lists'; 

const _MODULE_DEFAULT_ADMIN = 'dashboard';
const _ACTIVE_DEFAULT_ADMIN = 'lists';

const _COUNT_ITEM = 2; 

const _LIST_BOOKS = 4; 

const _TIME_HISTORY = 7;

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/-nettruyen');
define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/templates');
define('_WEB_HOST_ERORR', _WEB_HOST_ROOT.'/modules/erorrs');

define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');

const _PATH_ERORR_DEFAULT = _WEB_PATH_ROOT.'/modules/erorrs/404.php';

define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT.'/admin');


const _HOST = 'localhost';
const _USER = 'root';
const _PASS = '';
const _DB = 'nettruyen';
const _DRIVER = 'mysql';

?>