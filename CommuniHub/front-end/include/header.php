<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>CommuniHub</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- font awesome style -->
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
        <div class="contact_nav">
              <div class="user-info">
              <span style="color: #ffffff; font-weight: bold;"> <!-- Adjust font weight as needed -->
                    Welcome User !
                </span>
              </div>
            <div class="user_info">
                <i class="fa fa-user-circle fa-lg" aria-hidden="true" style="color: #ff8a1d;margin-right: 5px;"></i>
                <span style="color: #ffffff; font-weight: bold;"> <!-- Adjust font weight as needed -->
                    
                    <?php 
                    if (isset($_SESSION['UserFirstName']) && isset($_SESSION['UserLastName'])) {
                        echo $_SESSION['UserFirstName'] . ' ' . $_SESSION['UserLastName'];
                    } 
                    ?>
                </span>
            </div>
        </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              <span>
                CommuniHub
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link" href="indexLogin.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="schedule.php"> Schedule</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="activities.php">Activities</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="complaint.php">Complaint</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="donations.php">Donations</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="alert.php">Alerts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="UserProfile-read.php">User Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../user/userLogout.php">Logout</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
