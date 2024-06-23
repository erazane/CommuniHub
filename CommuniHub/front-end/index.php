
<?php
            session_start();
            if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']); // Clear the message after displaying
            }
            if(isset($_SESSION['register'])) {
              echo $_SESSION['register'];
              unset($_SESSION['register']); // Clear the message after displaying
              }
            ?>

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
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +012 6497487
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : nazeera.nashar@gmail.com
              </span>
            </a>
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
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
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
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="user-login.php">Login</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-md-6 ">
          <div class="detail-box">
              <h1>
                One Step Solution To<br>
                Suburban 
                Management
              </h1>
              <h3>
                A better community will create better lives.
          </h3>
              <a href="user-register.php">
                Register
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/communityCircle.png" alt="">
            </div>
            <br>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
<!-- feature section -->
<section class="feature_section">
  <div class="container">
    <div class="feature_container">
      <div class="box">
        <div class="img-box">
          <img src="images/mind-map.png" width="100" height="100">
        </div>
        <h5 class="name">
          Comprehensive
        </h5>
      </div>
      <div class="box">
        <div class="img-box">
          <img src="images/epidemiology.png" width="100" height="100">
        </div>
        <h5 class="name">
          Community
        </h5>
      </div>
      <div class="box">
        <div class="img-box">
          <img src="images/social-justice.png" width="100" height="100">
        </div>
        <h5 class="name">
          Connections
        </h5>
      </div>
    </div>
  </div>
</section>


  <!-- end feature section -->

  <!-- about section -->

  <section class="about_section layout_padding-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-6">
          <div class="detail-box">
            <h2>
              About us
            </h2>
            <p>
            CommuniHub is an advanced suburb management system designed to streamline and enhance community living. With a user-friendly interface, it facilitates efficient communication, neighborhood updates, and collaborative initiatives, fostering a connected and well-informed residential community. From event planning to issue reporting, 
            CommuniHub serves as a centralized platform, empowering residents and authorities alike to contribute to a vibrant and harmonious neighborhood.
            </p>
            <a href="about.html">
              Read More
            </a>
          </div>
        </div>
        <div class="col-lg-7 col-md-6">
          <div class="img-box">
            <img src="../Images/house.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->


  <!-- professional section -->

  <section class="professional_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <!-- <img src="images/professional-img.png" alt=""> -->
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="detail-box">
            <h2>
              We Provide Professional <br>
              suburban management operation.
            </h2>
            <p>
            Revolutionizing suburban living by expertly blending professional management with the warmth of community spirit. It's more than just a service; it's your partner in creating a harmonious, vibrant, and 
            efficiently-managed neighborhood where every voice matters and community bonds flourish."
            </p>
            <!-- <a href="">
              Read More
            </a> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end professional section -->

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container ">
      <div class="heading_container heading_center">
        <h2> Our Services </h2>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-comments-o fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
               Discussion Board
              </h5>
              <p>
               Seamlessly bringing residents together, our platform ensures efficient and effective 
               communication, fostering a sense of unity, collaboration, and shared experiences. 
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-star fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
                Activities
              </h5>
              <p>
                Streamlines your suburban life with efficient activity scheduling. Whether it's community events, sports matches,
                 or local gatherings, our system keeps you informed and connected.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-calendar fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
                Waste Management
              </h5>
              <p>
              Efficient garbage collection and recycling programs are designed to reduce the ecological footprint while maintaining the beauty of your suburb.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-money fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
                Donation 
              </h5>
              <p>
              Seamless platform for residents to support local causes and charities, fostering a culture of generosity and social responsibility in your suburb.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-flag fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
                Complaint
              </h5>
              <p>
              Ensures your concerns are heard and addressed promptly, maintaining a peaceful and satisfying living environment for all residents.
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 mx-auto">
          <div class="box ">
            <div class="img-box">
            <i class="fa fa-user fa-5x" aria-hidden="true"></i>
            </div>
            <div class="detail-box">
              <h5>
               User Profile
              </h5>
              <p>
              An easy and comprehensive user profile where you can view your community engagement such as activity joined,donation history and user complaints and history.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-box">
        <!-- <a href="">
          View More
        </a> -->
      </div>
    </div>
  </section>

  <!-- end service section -->

  
  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Contact Us
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <form action="">
            <div>
              <input type="text" placeholder="Name" />
            </div>
            <div>
              <input type="text" placeholder="Phone Number" />
            </div>
            <div>
              <input type="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" />
            </div>
            <div class="d-flex ">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap" style="width:100%;height:100%;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->


  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <h4>
        Get In Touch
      </h4>
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="info_items">
            <div class="row">
              <div class="col-md-4">
                <a href="">
                  <div class="item ">
                    <div class="img-box ">
                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <p>
                      Universiti Kuala Lumpur
                    </p>
                  </div>
                </a>
              </div>
              <div class="col-md-4">
                <a href="">
                  <div class="item ">
                    <div class="img-box ">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                    </div>
                    <p>
                      +012-6497487
                    </p>
                  </div>
                </a>
              </div>
              <div class="col-md-4">
                <a href="">
                  <div class="item ">
                    <div class="img-box">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <p>
                      nazeera.nashar@gmail.com
                    </p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="social-box">
      <h4>
        Follow Us
      </h4>
      <div class="box">
        <a href="">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-youtube" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>



  <!-- end info_section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayDateYear"></span> All Rights Reserved By
        
      </p>
      <p>
     
         <a class="nav-link" href="../Administator/admin-login.php">Admin</a>
         <a class="nav-link" href="../Committee/Committee-login.php">Committee </a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->


</body>

</html>