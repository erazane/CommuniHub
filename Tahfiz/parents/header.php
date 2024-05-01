<?php
	include('../connection.php');
	session_start();

	if(!isset($_SESSION['parents_ID']) AND $_SESSION['email'] == ''){
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

    <link rel="icon" href="../schools/images/favicon.png" type="image/png" />
    <link href="../parents/css/font-awesome.min.css" rel="stylesheet">
    <link href="../parents/css/animate.css" rel="stylesheet">
    <link href="../parents/css/bootsnav.css" rel="stylesheet">
    <link href="../parents/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../parents/css/fancySelect.css">
    <link href="../parents/css/style.css" rel="stylesheet">
    <link href="../parents/css/dropdown.css" rel="stylesheet">
    <link href="../parents/css/search.css" rel="stylesheet">
    <link href="../parents/css/itemlist.css" rel="stylesheet">
    <link href="css/donateselect.css" rel="stylesheet">
    <link rel="stylesheet" href="../parents/css/swipebox.css">
    <link rel="stylesheet" href="../parents/css/verticalmenu.css">
		<link rel="stylesheet" href="../parents/css/cart.css">
    <link rel="stylesheet" type="text/css" href="../parents/css/responsive.css">
		<link rel="stylesheet" type="text/css" href="../parents/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../parents/css/component.css" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
</head>

<body style="background: #F4F4F4;">
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
    <nav class="navbar navbar-default bootsnav">
        <div class="container">
            <?php
	               $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
	               while($row2 = $admin->fetch_array()){
	                       ?>
            <div class="row">
                <div class="attr-nav">
                    <a class="login-button" href="editprofile.php">Edit Profile</a>
                    <a class="logout-button" href="logout.php">Logout</a>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand logo" href="index.php"><img src="../images/logo1.png" class="img-responsive" /></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <nav class="main_nav">
                        <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp" style="list-style:none;">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="compareschool.php">School Comparison</a></li>
                            <li><a href="">Donation</a>
                                <div class="dropdownContain">
                                    <div class="dropOut">
                                        <div class="triangle"></div>
                                        <ul>
                                            <li><a style="color:#3d526d; font-weight:500;" href="donationlist.php">Make Donation</a></li>
                                            <li><a style="color:#3d526d; font-weight:500;" href="onldonationhistory.php">Donation History</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="eventlist.php">Events</a></li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp" style="list-style:none;">
                            <!-- <li><a style="text-transform: uppercase; margin-right: -50px;" href="index.php">Welcome, </a></li> -->
                        </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="col-sm-4 col-sm-push-8 text-center">
        <div class="panel panel-default" style="width: 320px; margin-top: 0px;">
            <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">Welcome,
                <?php echo $row2['firstname'];?>
                <?php echo $row2['lastname'];?>

            </div>
        </div>
    </div>
    <?php } ?>
    </nav>
