
<?php

$Login = isLogin();

if(empty($Login)){
	redirect(_WEB_HOST_ROOT.'?module=auth&active=login');
	die();
}else{

  $userId = $Login['id_user'];

  $detailUser = getFirstRow("SELECT * FROM users WHERE id='$userId'");

  define('_MY_DATA', $detailUser);

  if($detailUser['admin'] != 1){
    redirect(_WEB_HOST_ROOT.'?module=erorrs&active=permission');
  }

}




?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- icon website -->
  <link rel="icon" type="image/png" href="https://www.ybs.co.uk/documents/100493/331040/what-kind-of-saver-are-you-b-l.png/7dbf17ef-4842-4fdb-6ff6-db435f0dd11a?t=1662105750152&download=true">
  <!-- title wensite -->
  <title> <?php echo $data['nameTitle']; ?> </title>
  <!-- Favicon  -->
  <link rel="icon" type="image/png" href="">
  <!-- link cdn font-awesome -->
  <link rel="apple-touch-icon" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- My style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/css/main.css?ver=<?php echo rand(); ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown d-none">
        <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
        <i class="fa fa-bell"></i>

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-user mx-1"></i> 
            
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="text-success dropdown-item dropdown-header"><?php echo _MY_DATA['fullname']; ?></span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=users&active=profile'; ?>" class="dropdown-item">
          <i class="fa fa-address-card mx-2"></i> Profile
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT.'?module=auth&active=logout'; ?>" class="dropdown-item">
          <i class="fa fa-angle-double-left mx-2"></i> Logout
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT; ?>" class="dropdown-item dropdown-footer">To truyen B</a>
        </div>
      </li>
    
    </ul>
  </nav>
  <!-- /.navbar -->