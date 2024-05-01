<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
  <div class="container">
      <div class="row text-center">
          <h2>Events Conducted by Tahfiz Schools</h2>
          <hr>
          <!-- <br>
      <h6>Search by name:</h6>
      <div class="col-md-4 col-md-offset-4">
          <input class="form-control" name="cari" placeholder="Search by school name" type="text" style="margin-top: 5px;">
      </div>
      <div class="col-md-4 col-md-offset-4 submit-button text-center">
          <input type="submit" value="Search" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 20px 0 0 0">
      </div> -->
      </div>
      <div class="row">
          <?php
      $evt= $connection->query("SELECT schools.*,event.*
                                  FROM event
                                  INNER JOIN schools ON schools.schools_ID= event.schools_ID
                                  WHERE  event.schools_ID=event.schools_ID");
      while ($fetch = $evt->fetch_array()) {
          ?>
          <div class="col-md-4">
              <div class="profile-card js-profile-card text-center" style="margin-right: 0px; margin-bottom: 20px;">
                  <!-- Featured image -->
                  <br>
                  <div style="border-color: black;" class="overlay rounded mb-4">
                      <?php if ($fetch['image'] == '') { ?>
                      <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:350px;">
                      <?php } else { ?>
                      <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px; border-radius: 8px; box-shadow: 0px 0px 14px -6px rgba(0,0,0,0.61);">
                      <?php } ?>
                  </div>
                  <!-- Category -->
                  <br>
                  <!-- Post title -->
                  <h5>School Name:</h5>
                  <p style="color: #049963; font-weight: 600; font-size: 15px; margin: 0px 0 15px 0;">
                      <?php echo $fetch['school_name']; ?>
                  </p>
                  <h5>Event Title:</h5>
                  <p style="color: #049963; font-weight: 600; font-size: 15px; margin: 0px 0 15px 0;">
                      <?php echo $fetch['eventtitle']; ?>

                      <h5>Date:</h5>
                      <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 15px 0;"><i class="fas fa-calendar-alt"></i>
                          <?php echo date('d/m/Y', strtotime($fetch['eventstartdate'])); ?> until
                          <?php echo date('d/m/Y', strtotime($fetch['eventenddate'])); ?>
                      </p>
                      <h5>Address:</h5>
                      <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 0 0;"><i class="fas fa-map-marker-alt"></i>
                          <?php echo $fetch['eventvenue']; ?>
                      </p>
                      <!-- Read more button -->
                      <a class="btn2" style="margin-left:0px;" href="eventview.php?schools_ID=<?php echo $fetch['schools_ID'] ?>& event_ID=<?php echo $fetch['event_ID'] ?>">View Details</a>
              </div>
          </div>
          <?php } ?>
      </div>
  </div>
</section>

<?php
include_once'../parents/footer.php';
?>
