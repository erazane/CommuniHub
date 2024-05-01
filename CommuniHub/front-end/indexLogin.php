
<?php
            session_start();
            if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']); // Clear the message after displaying
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
                Call : +01 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : CommuniHub@gmail.com
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
              <!-- <a href="../user/userRegister.php">
                Register
              </a> -->
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
              <img src="images/s1.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>
                Centralised communication
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
              <img src="images/s1.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>
                Activity Scheduling
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
              <img src="images/s1.png" alt="" />
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
              <img src="images/s1.png" alt="" />
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
              <img src="images/s2.png" alt="" />
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
              <img src="images/s3.png" alt="" />
            </div>
            <div class="detail-box">
              <h5>
                Alerts
              </h5>
              <p>
              Whether it's weather warnings, emergency notifications, or 
              important community updates, our system keeps you up-to-date, ensuring your safety and well-being in the suburb."
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

  <!-- client section -->
<!-- 
  <section class="client_section ">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          What Our Clients Say
        </h2>
      </div>
      <div class="carousel-wrap layout_padding2-top ">
        <div class="owl-carousel">
          <div class="item">
            <div class="box">
              <div class="client_id">
                <div class="img-box">
                  <img src="images/client-1.jpg" alt="">
                </div>
                <div class="client_detail">
                  <div class="client_info">
                    <h6>
                      Jorch morik
                    </h6>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
              </div>
              <div class="client_text">
                <p>
                  chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum
                </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="client_id">
                <div class="img-box">
                  <img src="images/client-2.jpg" alt="">
                </div>
                <div class="client_detail">
                  <div class="client_info">
                    <h6>
                      Jorch morik
                    </h6>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
              </div>
              <div class="client_text">
                <p>
                  chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum
                </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="client_id">
                <div class="img-box">
                  <img src="images/client-1.jpg" alt="">
                </div>
                <div class="client_detail">
                  <div class="client_info">
                    <h6>
                      Jorch morik
                    </h6>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
              </div>
              <div class="client_text">
                <p>
                  chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum
                </p>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="client_id">
                <div class="img-box">
                  <img src="images/client-2.jpg" alt="">
                </div>
                <div class="client_detail">
                  <div class="client_info">
                    <h6>
                      Jorch morik
                    </h6>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <i class="fa fa-quote-left" aria-hidden="true"></i>
                </div>
              </div>
              <div class="client_text">
                <p>
                  chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  end client section -->

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
                      Lorem Ipsum is simply dummy text
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
                      +02 1234567890
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
                      demo@gmail.com
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
        <a class="nav-link" href="../admin/adminLogin.php">Admin</a>
         <a class="nav-link" href="../commitee/login/commiteeLogin.php">Committee </a>
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