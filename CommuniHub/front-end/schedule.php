<?php 
session_start();
require_once('include/header.php'); 
?>

        <!-- end header section -->
    </div>

  <!-- about section -->


  <?php
   require_once('../Database/database.php');

   // Fetch data for garbage schedule
   $query = "SELECT GarbageDay, Time, DateUpdated FROM schedule ORDER BY ScheduleID DESC LIMIT 1";
   $garbageResult = mysqli_query($dbc, $query);

   if (!$garbageResult) {
      die('Query failed: ' . mysqli_error($dbc));
   }

   // Fetch data for glass schedule
   $query = "SELECT GlassPickupday, Time, DateUpdated FROM glassSchedule ORDER BY glassScheduleID DESC LIMIT 1";
   $glassResult = mysqli_query($dbc, $query);

   if (!$glassResult) {
      die('Query failed: ' . mysqli_error($dbc));
   }

   // Fetch data for paper schedule
   $query = "SELECT PaperPickupDay, Time, DateUpdated FROM paperSchedule ORDER BY paperScheduleID DESC LIMIT 1";
   $paperResult = mysqli_query($dbc, $query);

   if (!$paperResult) {
      die('Query failed: ' . mysqli_error($dbc));
   }

   // Fetch data for plastic schedule
   $query = "SELECT PlasticPickupDay, Time, DateUpdated FROM plasticSchedule ORDER BY plasticScheduleID DESC LIMIT 1";
   $plasticResult = mysqli_query($dbc, $query);

   if (!$plasticResult) {
      die('Query failed: ' . mysqli_error($dbc));
   }
  ?>
  

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="detail-box">
            <h2>Waste Management Schedule</h2>
            <p>Below are the upcoming garbage schedule.Stay informed about the upcoming garbage collection times.</p>
            <!-- <a href="#">Read More</a> -->
            <br>
            <br>
            
            <div class="card-deck">
                <!-- Display garbage schedule -->
                <div class="card">
                <img class="card-img-top" src="../Committee/images/waste.jpg" alt="Card image cap">
                  <div class="card-body">
                    <?php
                      if ($garbageRow = mysqli_fetch_assoc($garbageResult)) {
                        echo "<h5 class='card-title'>Garbage Pickup</h5>";
                        echo "<p class='card-text'>Day: " . $garbageRow['GarbageDay'] . "</p>";
                        echo "<p class='card-text'>Time: " . $garbageRow['Time'] . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Last updated: " . $garbageRow['DateUpdated'] . "</small></p>";
                      }
                    ?>
                  </div>
                </div>

                <!-- Display glass schedule -->
                <div class="card">
                <img class="card-img-top" src="../Committee/images/glass.jpg" alt="Card image cap">
                  <div class="card-body">
                    <?php
                      if ($glassRow = mysqli_fetch_assoc($glassResult)) {
                        echo "<h5 class='card-title'>Glass Pickup</h5>";
                        echo "<p class='card-text'>Day: " . $glassRow['GlassPickupday'] . "</p>";
                        echo "<p class='card-text'>Time: " . $glassRow['Time'] . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Last updated: " . $glassRow['DateUpdated'] . "</small></p>";
                      }
                    ?>
                  </div>
                </div>

                <!-- Display paper schedule -->
                <div class="card">
                <img class="card-img-top" src="../Committee/images/paper.jpg" alt="Card image cap">
                  <div class="card-body">
                    <?php
                      if ($paperRow = mysqli_fetch_assoc($paperResult)) {
                        echo "<h5 class='card-title'>Paper Pickup</h5>";
                        echo "<p class='card-text'>Day: " . $paperRow['PaperPickupDay'] . "</p>";
                        echo "<p class='card-text'>Time: " . $paperRow['Time'] . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Last updated: " . $paperRow['DateUpdated'] . "</small></p>";
                      }
                    ?>
                  </div>
                </div>

                <!-- Display plastic schedule -->
                <div class="card">
                <img class="card-img-top" src="../Committee/images/plastic.jpg" alt="Card image cap">
                  <div class="card-body">
                    <?php
                      if ($plasticRow = mysqli_fetch_assoc($plasticResult)) {
                        echo "<h5 class='card-title'>Plastic Pickup</h5>";
                        echo "<p class='card-text'>Day: " . $plasticRow['PlasticPickupDay'] . "</p>";
                        echo "<p class='card-text'>Time: " . $plasticRow['Time'] . "</p>";
                        echo "<p class='card-text'><small class='text-muted'>Last updated: " . $plasticRow['DateUpdated'] . "</small></p>";
                      }
                    ?>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end plastic -->
    <!-- end -->
  </section>
  <!-- end about section -->
  
 
  <?php include('include/footer.php'); ?>
