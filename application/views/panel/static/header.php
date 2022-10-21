<?php
$_DIR = base_url('assets/adminpanel/');
$CI =& get_instance();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $pageTitle; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo $_DIR; ?>favicon.ico" type="image/x-icon">
    <link href="<?php echo $_DIR; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/tour/css/bootstrap-tour.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/chartjs/Chart.min.css" rel="stylesheet">
    <link href="<?php echo $_DIR; ?>plugins/node-waves/waves.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>plugins/animate-css/animate.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>plugins/iziToast/css/iziToast.min.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>plugins/confirm/confirm.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>plugins/simplePagination/simplePagination.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>css/materialize.css" rel="stylesheet"/>
    <link href="<?php echo $_DIR; ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_DIR; ?>plugins/persianDatepicker/css/persianDatepicker-default.css"/>
    <link   href="<?php echo $_DIR; ?>css/themes/all-themes.css" rel="stylesheet"/>

    <script src="<?php echo $_DIR; ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/tour/js/bootstrap-tour.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/node-waves/waves.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/iziToast/js/iziToast.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/confirm/confirm.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/simplePagination/simplePagination.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/persianDatepicker/js/persianDatepicker.min.js"></script>
    <script src="<?php echo $_DIR; ?>plugins/mask/jquery.mask.min.js"></script>
    <script src="<?php echo $_DIR; ?>js/admin.js"></script>
    <script src="<?php echo $_DIR; ?>js/pages/index.js"></script>
    <script src="<?php echo $_DIR; ?>js/demo.js"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url('Panel/'); ?>";
    </script>
</head>
<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>لطفا منتظر بمانید...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand"><?php echo $pageTitle; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo $_DIR; ?>images/user.png" width="48" height="48" alt="User"/>
            </div>
            <?php
                $CI =& get_instance();
                $adminInfo = $CI->session->userdata('LoginInfo');
            ?>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false"><?php echo $adminInfo['PersonInfo']['PersonFirstName']." ".$adminInfo['PersonInfo']['PersonLastName']; ?></div>
                <div class="email"><?php echo $adminInfo['PersonInfo']['PersonNationalCode']; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a target="_blank" href="<?php echo base_url(); ?>">
                                <i class="material-icons">input</i>WebSite
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Panel/Profile'); ?>">
                                <i class="material-icons">person</i>
                                <span>پروفایل</span>
                          </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Home/doLogOut'); ?>">
                                <i class="material-icons">input</i>خروج
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <?php $uri = $CI->uri->uri_string; ?>
            <ul class="list">
                <li <?php if (strstr($uri , "Home") !== false) echo "class='active'"; ?>>
                    <a href="<?php echo base_url('Panel/Home'); ?>">
                        <i class="material-icons">home</i>
                        <span>پیشخوان</span>
                    </a>
                </li>

                <li <?php echo $CI->uri->segment(2) == 'Foundation' ? 'class="active"' : '' ?> >
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">bookmark</i>
                        <span>سازمان</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li <?php if (strstr($uri, '/Foundation/index') !== false) echo "class='active'"; ?>>
                            <a href="<?php echo base_url('Panel/Foundation/index'); ?>" class="waves-effect waves-block">فهرست</a>
                        </li>
                        <li <?php if (strstr($uri, '/Foundation/add') !== false) echo "class='active'"; ?>>
                            <a href="<?php echo base_url('Panel/Foundation/add'); ?>"
                               class="waves-effect waves-block">افزودن</a>
                        </li>
                    </ul>
                </li>


                    <li <?php echo $CI->uri->segment(2) == 'Orders' ? 'class="active"' : '' ?> >
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="material-icons">bookmark</i>
                            <span>دوره ها</span>
                        </a>
                    <ul class="ml-menu" style="display: none;">
                        <li <?php if (strstr($uri, '/Orders/index') !== false) echo "class='active'"; ?>>
                            <a href="<?php echo base_url('Panel/Orders/index'); ?>" class="waves-effect waves-block">فهرست</a>
                        </li>
                            <li <?php if (strstr($uri, '/Orders/add') !== false) echo "class='active'"; ?>>
                                <a href="<?php echo base_url('Panel/Orders/add'); ?>"
                                   class="waves-effect waves-block">افزودن</a>
                            </li>
                    </ul>
                </li>




            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>