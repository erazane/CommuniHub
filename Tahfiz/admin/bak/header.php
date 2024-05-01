<?php
	include('../connection.php');
	session_start();

	if(!isset($_SESSION['admin_ID']) AND $_SESSION['email'] == ''){
		header('location:../login.php');
	}
?>

<!DOCTYPE HTML>

<html class="no-js" lang="de">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="index,follow">

  <title>Welcome To Tahfiz Care</title>

  <link rel="icon" href="../images/favicon.png" type="image/png" />
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/animate.css" rel="stylesheet">
  <link href="../css/bootsnav.css" rel="stylesheet">
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/fancySelect.css">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/dropdown.css" rel="stylesheet">
  <link href="../css/search.css" rel="stylesheet">
  <link href="../css/select.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/swipebox.css">
  <link rel="stylesheet" type="text/css" href="../css/responsive.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
  <!-- <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="bar-phone">
          <i class="fa fa-phone"></i> <span>Call Us :</span> <strong>+1-310-341-3870</strong>
        </div>
        <div class="bar-mail">
          <i class="fa fa-envelope"></i> <span>Mail Us :</span> <strong>info@charityhope.com</strong>
        </div>
        <div class="header-social">
          <a class="facebook" href="#" title="facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i>  </a>
          <a class="twitter" href="#" title="twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i>  </a>
          <a class="linkedin" href="#" title="linkedin" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i>  </a>
          <a class="google" href="#" title="google-plus" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i>  </a>
          <a class="youtube" href="#" title="youtube-play" target="_blank" rel="nofollow"><i class="fa fa-youtube-play"></i>  </a>
        </div>
      </div>
    </div>
  </div> -->
  <nav class="navbar navbar-default navbar-sticky bootsnav">
    <div class="container">
      <div class="row">
        <div class="attr-nav">
					<a class="login-button" href="../login.php">Edit Profile</a>
          <a class="logout-button" href="../registeras.php">Logout</a>
        </div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand logo" href="index.php"><img src="../images/logo1.png" class="img-responsive" /></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
          <nav class="main_nav">
            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp" style="list-style:none;">
              <li><a href="index.php">Home</a></li>
              <li><a href="schooltype.php">Where To Study</a>

            </li>
              <li><a href="">Donate</a></li>
              <li><a href="">Event</a>
								<div class="dropdownContain">
								<div class="dropOut">
											<div class="triangle"></div>
											<ul>
											<li><a style="color:black;" href="index.php">Primary</a></li>
											<li><a style="color:black;" href="index.php">Secondary</a></li>
											</ul>
											</div>
											</div>
							</li>

        <li><a href="">About Us</a></li>
        <li><a href="">Contact Us</a></li>
        </ul>
      </div>
    </div>
    </div>
  </nav>
