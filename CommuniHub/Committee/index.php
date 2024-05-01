<?php
session_start();
 include('include/header.php'); ?>
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
              
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/communityCircle.png" alt="">
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- end feature section -->

  <section class="service_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Active Administrator</h2>
            <p class="text-card">
                Ensure that your community has everything it needs to maintain a peaceful way of life.
            </p>
            <hr style=" width: 350px; text-align:center">
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto d-flex justify-content-center"> 
                <a href="editprofile.php" class="btn btn-sq-lg btn-warning" style="width: 250px; height: 250px; border-radius:3px; font-weight: 600; padding :6%">
                    <i class="fa fa-user fa-5x"></i>
                    <br>Active Administrator<br>
                </a>
                <a href="editprofile.php" class="btn btn-sq-lg btn-warning ml-5" style="width: 250px; height: 250px; border-radius:3px; font-weight: 600; padding :6%"> 
                    <i class="fa fa-user fa-5x"></i>
                    <br>Add Administrator <br>
                </a>
            </div>
        </div>
    </div>
</section>
  
  

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
      <a class="nav-link" href="../Administator/admin-login.php">Admin</a>
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