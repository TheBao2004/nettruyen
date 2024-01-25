 
<?php



?>
 
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-d-none text-center d-block">
    <i class="fa fa-bold mx-2"></i>
    <span class="brand-text font-weight-light">Truyen B</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?php echo !empty(_MY_DATA['avatar'])?_MY_DATA['avatar']:'https://yt3.ggpht.com/a/AGF-l7-_BjmTIT3g5Y7o3JaOJzxJiCaTmUK5mH73Qg=s900-c-k-c0xffffffff-no-rj-mo'; ?>" class="rounded-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block text-d-none"><?php echo _MY_DATA['fullname']; ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo empty($_GET['module'])?'actine':''; ?>">
            <i class="fab fa-houzz mx-2"></i>
            <p>
            Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
            </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="?module=authors" class="nav-link <?php echo getActive('authors')?'actine':''; ?>">
            <i class="fa fa-pen-fancy mx-2"></i>
            <p>
            Authors
                <!-- <span class="right badge badge-danger">New</span> -->
            </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="?module=kindofs" class="nav-link <?php echo getActive('kindofs')?'actine':''; ?>">
            <i class="fa fa-align-left mx-2"></i>
            <p>
            Kind of
                <!-- <span class="right badge badge-danger">New</span> -->
            </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="?module=books" class="nav-link <?php echo getActive(['books', 'chaps', 'chap_imgs'])?'actine':''; ?>">
            <i class="fa fa-book mx-2"></i>
            <p>
            Book
                <!-- <span class="right badge badge-danger">New</span> -->
            </p>
            </a>
        </li>


        <li class="nav-item">
            <a href="?module=users" class="nav-link <?php echo getActive('users')?'actine':''; ?>">
            <i class="fa fa-users mx-2"></i>
            <p>
            Users
                <!-- <span class="right badge badge-danger">New</span> -->
            </p>
            </a>
        </li>


 
        <li class="nav-item has-treeview <?php echo getActive('options')?'menu-open':''; ?>">
            <a href="" class="nav-link <?php echo getActive('options')?'actine':''; ?>">
            <i class="fa fa-cog mx-2"></i>
            <p>
                Options
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="?module=options&active=slide" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sliles</p>
                </a>
            </li>
            </ul>
        </li>





        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper"> 