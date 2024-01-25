
<?php

$Login = isLogin();

removeAllLastActivity();

if(empty($Login)){
	redirect(_WEB_HOST_ROOT.'?module=auth&active=login');
	die();
}else{

	$userId = $Login['id_user'];
  
	$detailUser = getFirstRow("SELECT * FROM users WHERE id='$userId'");

	define('_MY_DATA', $detailUser);
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta tag -->
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="Radix" content="Responsive Multipurpose Business Template">
		<meta name='copyright' content='Radix'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<!-- Title Tag -->
        <title><?php echo $data['nameTitle']; ?></title>
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="https://vignette.wikia.nocookie.net/tier-zoo/images/5/56/B.jpg/revision/latest?cb=20180829095546">	
       
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">
		
		<!-- Bootstrap Css -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/bootstrap.min.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/font-awesome.min.css">
		<!-- Slick Nav CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/slicknav.min.css">
		<!-- Cube Portfolio CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/cubeportfolio.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/magnific-popup.min.css">
		<!-- Fancy Box CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/jquery.fancybox.min.css">
		<!-- Nice Select CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/niceselect.css">
		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/owl.theme.default.css">
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/owl.carousel.min.css">
		<!-- Slick Slider CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/slickslider.min.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/animate.min.css">
		
		<!-- Radix StyleShet CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/reset.css">	
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/style.css">
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/responsive.css">	

		<!-- Radix Color CSS -->
		<link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/client/css/color/color1.css">
		<link rel="stylesheet" href="#" id="colors">	

		<!-- link cdn icon -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

		  <!-- My style -->
		  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE; ?>/admin/assets/css/main.css?ver=<?php echo rand(); ?>">
    </head>
    <body>
	
		<!-- Preloader -->
		 <!-- <div class="preloader">
		  <div class="preloader-inner">
			<div class="single-loader one"></div>
			<div class="single-loader two"></div>
			<div class="single-loader three"></div>
			<div class="single-loader four"></div>
			<div class="single-loader five"></div>
			<div class="single-loader six"></div>
			<div class="single-loader seven"></div>
			<div class="single-loader eight"></div>
			<div class="single-loader nine"></div>
		  </div>
		</div> -->
		<!-- End Preloader -->
		
		<!-- Get Pro Button -->
		<ul class="pro-features">
			<a class="get-pro" href="#">Get Pro</a>
			<li class="title">Pro Version Some Features</li>
			<li>Multipage & Onepage Homepage</li>
			<li>26+ HTML5 pages</li>
			<li>All Premium Features</li>
			<li>Documentation Included</li>
			<li>6+ Month Dedicated Support!</li>
			<div class="button">
				<a href="https://www.codeglim.com/downloads/radix-multipurpose-business-consulting-template/" target="_blank" class="btn">Buy Pro Version</a>
				<a href="https://www.codeglim.com/downloads/radix-multipurpose-business-consulting-template/" target="_blank" class="btn">View Details</a>
			</div>
		</ul>
		
		<!-- Start Header -->
		<header id="header" class="header">
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- Contact -->
							<ul class="contact">
								<!-- <li><i class="fa fa-headphones"></i> +(123) 45678910</li>
								<li><i class="fa fa-envelope"></i> <a href="mailto:info@yourmail.com">info@yourmail.com</a></li>
								<li><i class="fa fa-clock-o"></i>Opening: 09am-5pm</li> -->
							</ul>
							<!--/ End Contact -->
						</div>
						<div class="col-lg-6 col-12">
							<div class="topbar-right">
								<!-- Search Form -->
								<div class="search-form active">
									<a class="icon" href="#"><i class="fa fa-search"></i></a>
									<form class="form" action="" method="get">
										<input type="hidden" name="module" value="books">
										<input placeholder="Search & Enter" type="text" name="check">
									</form>
									 
								</div>
								<!--/ End Search Form -->
								<!-- Social -->
								<!-- <ul class="social">
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								</ul> -->
								<!--/ End Social -->


								 <!-- Navbar -->
								 <nav class="social main-header navbar navbar-expand navbar-white navbar-light">

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
	<a class="nav-link d-flex align-items-center css_client_user" style="" data-toggle="dropdown" href="#">
	<i class="fa fa-user text-light"></i>
		
	</a>
	<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header text-success text-center"><?php echo _MY_DATA['fullname']; ?></span>
		  <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT.'?module=users&active=profile'; ?>" class="dropdown-item">
          <i class="fa fa-address-card mx-2"></i> Profile
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT.'?module=auth&active=logout'; ?>" class="dropdown-item">
          <i class="fa fa-angle-double-left mx-2"></i> Logout
            <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
          </a>
		  <?php if(_MY_DATA['admin'] == 1): ?>
			<div class="dropdown-divider"></div>
          	<a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="text-center fa-1x dropdown-item dropdown-footer">To admin</a>
		  <?php endif; ?>		
    </div>
</li>

</ul>
</nav>
<!-- /.navbar -->


							</div>
						</div>
					</div>
				</div>	
			</div>
			<!--/ End Topbar -->
			<!-- Middle Bar -->
			<div class="middle-bar">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-12">	
							<!-- Logo -->
							<div class="logo_home logo d-flex align-items-center" style="">
								<!-- <a href="index.html"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/client/images/logo.png" alt="logo"></a> -->
								<a class="text-light fa-2x" style="" href="<?php echo _WEB_HOST_ROOT; ?>">Truyen B</a>
							</div>
							<!-- <div class="link"><a href="<?php echo _WEB_HOST_ROOT; ?>">Truyen<span>B</span></a></div> -->
							<!--/ End Logo -->
							<button class="mobile-arrow"><i class="fa fa-bars"></i></button>
							<div class="mobile-menu"></div>
						</div>
						<div class="col-lg-10 col-12">
							<!-- Main Menu -->
							<div class="mainmenu">
								<nav class="navigation">
									<ul class="nav menu">


										<li class="<?php echo empty($_GET['module'])?'active':''; ?>"><a href="<?php echo _WEB_HOST_ROOT; ?>">Home</a></li>
										<li class="<?php echo getActive('books')?'active':''; ?>"><a href="<?php echo _WEB_HOST_ROOT.'?module=books'; ?>">Books</a></li>
										<li class="<?php echo getActive('history')?'active':''; ?>"><a href="<?php echo _WEB_HOST_ROOT.'?module=history'; ?>">History</a></li>
										<li class="<?php echo getActive('follwor')?'active':''; ?>"><a href="<?php echo _WEB_HOST_ROOT.'?module=follwor'; ?>">Follwor</a></li>
										<li class="d-none"><a href="#">Test<i class="fa fa-caret-down"></i></a>
											<ul class="dropdown">
												<li><a href="about-us.html">About Us</a></li>
												<li><a href="team.html">Our Team</a></li>
												<li><a href="pricing.html">Pricing</a></li>
											</ul>
										</li>

									</ul>
								</nav>
								<!-- Button -->
								<!-- <div class="button">
									<a href="contact.html" class="btn">Get a quote</a>
								</div> -->
								<!--/ End Button -->
							</div>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
			<!--/ End Middle Bar -->
		</header>
		<!--/ End Header -->