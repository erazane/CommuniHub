<?php
	include('../connection.php');
	session_start();

	if(!isset($_SESSION['admin_ID']) AND $_SESSION['email'] == ''){
		header('location:../login.php');
	}
?>

<html class="no-js" lang="de">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Welcome To Tahfiz Care (Admin)</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/print.css" rel="stylesheet">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
		<link rel="icon" href="images/favicon.png" type="image/png" />

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <!-- <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a> -->
                        <!-- <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button> -->
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="index.php">
                                <i class="fas fa-user-crown"></i>Dashboard</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-school"></i>Schools</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">School Authentication</a>
                                </li>
                                <li>
                                    <a href="register.html">All School List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="memberlist.php">
                                <i class="far fa-users"></i>Members List</a>
                        </li>
                        <li>
                            <a href="donationreport.php">
                                <i class="far fa-clipboard"></i>Donation Report</a>
                        </li>
                        <li>
                            <a href="feedback.php">
                                <i class="far fa-comment-alt-smile"></i>Feedback</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="../images/logos.png" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="index.php">
                                <i class="far fa-user-cog"></i>Dashboard</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="far fa-school"></i>Schools <i class="fas fa-angle-down" style="margin-left: 96px;"></i></a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="schoolauth.php">School Authentication</a>
                                </li>
                                <li>
                                    <a href="schoollist.php">All School List</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="memberlist.php">
                                <i class="far fa-users"></i>Members List</a>
                        </li>

												<li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="far fa-clipboard" style="padding-right:5px; padding-left:3px;"></i>Donation Report <i class="fas fa-angle-down" style="margin-left: 28px;"></i></a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="onldonationreport.php">Online Donation</a>
                                </li>
                                <li>
                                    <a href="offdonationreport.php">Offline Donation</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="feedback.php">
                                <i class="far fa-comment-alt-smile" style="padding-right:2px; padding-left:1px;"></i>Feedback</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header">

                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="Admin" />
                                        </div>
                                        <?php
																				           $admin = $connection->query("SELECT * FROM admin WHERE admin_ID='".$_SESSION['admin_ID']."'");
																				           while($row2 = $admin->fetch_array()){
																				                   ?>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">
                                                <?php echo $row2['username'];?></a>
                                            <?php } ?>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="Admin" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Admin</a>
                                                    </h5>
                                                    <span class="email">admin@gmail.com</span>
                                                </div>
                                            </div>
                                            <!-- <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div> -->
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
