<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">

            <?php
          $evt = $connection->query("SELECT schools.*,event.*
                                      FROM event
                                      INNER JOIN schools ON schools.schools_ID= event.schools_ID
                                      WHERE  event.event_ID=".$_GET['event_ID']."");


          while ($fetch = $evt->fetch_array()) {
              ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-card js-profile-card text-center" style="margin-right: 0px;">
                        <div class="profile-card__cnt js-profile-cnt">
                            <div style="border-color: black;" class="overlay rounded mb-4">
                                <?php if ($fetch['image'] == '') { ?>
                                <img class="avatar img-circle img-thumbnail" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                                <?php } else { ?>
                                <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px; border-radius: 8px; box-shadow: 0px 0px 14px -6px rgba(0,0,0,0.61);">
                                <?php } ?>
                            </div>
                            <br>
                            <input type="hidden" value="<?php echo $_GET['event_ID']; ?>" name="event_ID">
                            <h4>
                                <?php echo $fetch['eventtitle']; ?>
                            </h4>
                            <br>
                            <h5>Organizer:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 15px; margin: 0px 0 15px 0;">
                                <?php echo $fetch['school_name']; ?>
                            </p>
                            <h5>Date:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 15px 0;"><i class="fas fa-calendar-alt"></i>
                                <?php echo date('d/m/Y', strtotime($fetch['eventstartdate'])); ?> until
                                <?php echo date('d/m/Y', strtotime($fetch['eventenddate'])); ?>
                            </p>
                            <h5>Address:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 15px 0;"><i class="fas fa-map-marker-alt"></i>
                                <?php echo $fetch['eventvenue']; ?>
                            </p>
                            <h5>Contact us:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 0 0;"><i class="fas fa-envelope"></i>
                                <?php echo $fetch['email']; ?>
                            </p>
                            <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 15px 0;"><i class="fas fa-phone"></i>
                                <?php echo $fetch['phonenum']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="width: 745px;">
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">
                            Event Description
                        </div>
                        <div class="panel-body" style="font-weight: 600;">
                            <?php echo $fetch['eventdescription']; ?>
                            <br />
                            <br />Venue:
                            <?php echo $fetch['eventvenue']; ?>
                            <br />Date:
                            <?php echo date('d/m/Y', strtotime($fetch['eventstartdate'])); ?>
                            <br />Time:
                            <?php echo date('h:i A', strtotime($fetch['eventtime'])); ?>
                        </div>
                    </div>
                    <div class="panel panel-default" style="width: 745px;">
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">
                            <?php echo $fetch['school_name']; ?> on Map
                        </div>
                        <div class="panel-body">
                            <div class="mapouter">
                                <div class="gmap_canvas"><iframe width="710" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $fetch['street_name']; ?>%2C%20%20<?php echo $fetch['state']; ?>%2C%20<?php echo $fetch['postcode']; ?>%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com"></a></div>
                                <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 250px;
                                    width: 710px;
                                }

                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 250px;
                                    width: 710px;
                                }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <br>


            <br>
        <?php } ?>

    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
