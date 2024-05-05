<?php 
session_start();
require_once('include/header.php'); 
?>
  </div>

  <!-- service section -->
  <section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Schedule Dashboard</h2>
            <hr style="width: 350px; text-align: center">
            <hr>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a href="editprofile.php" class="btn btn-sq-lg btn-warning d-flex justify-content-center align-items-center" style="height: 250px; border-radius: 3px; font-weight: 600;">
                            <i class="fa fa-user fa-5x"></i>
                            <span class="ml-2">Active Administrator</span>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="editprofile.php" class="btn btn-sq-lg btn-warning d-flex justify-content-center align-items-center" style="height: 250px; border-radius: 3px; font-weight: 600;">
                            <i class="fa fa-user fa-5x"></i>
                            <span class="ml-2">Add Administrator</span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a href="editprofile.php" class="btn btn-sq-lg btn-warning d-flex justify-content-center align-items-center" style="height: 250px; border-radius: 3px; font-weight: 600;">
                            <i class="fa fa-user fa-5x"></i>
                            <span class="ml-2">Active Administrator</span>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="editprofile.php" class="btn btn-sq-lg btn-warning d-flex justify-content-center align-items-center" style="height: 250px; border-radius: 3px; font-weight: 600;">
                            <i class="fa fa-user fa-5x"></i>
                            <span class="ml-2">Add Administrator</span>
                        </a>
                    </div>
                </div>
            </div>
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