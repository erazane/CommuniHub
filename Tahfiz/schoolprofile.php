<?php
include_once'header.php';
include('connection.php');
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row">

            <?php
          $sch = $connection->query("SELECT * FROM schools WHERE schools_ID='" . $_GET['schools_ID'] . "'");
          while ($fetch = $sch->fetch_array()) {
              ?>

            <div class="row">
                <div class="col-md-4">
                    <form action="" method="post" id="myForm">
                        <div class="profile-card js-profile-card text-center" style="margin-right: 0px;">
                            <div class="profile-card__cnt js-profile-cnt">
                                <div style="border-color: black;" class="overlay rounded mb-4">
                                    <?php if ($fetch['file_name'] == '') { ?>
                                    <img class="avatar img-circle img-thumbnail" src="images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                                    <?php } else { ?>
                                    <img class="avatar img-circle img-thumbnail" src="images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">
                                    <?php } ?>

                                </div>
                                <br>
                                <h4>
                                    <?php echo $fetch['school_name']; ?>
                                </h4>
                                <br>
                                <b style="font-weight: 500; color: #1b8257;"><b style="font-weight: 600;">Address:</b>
                                    <br />
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo $fetch['street_name']; ?>,
                                    <br>
                                    <?php echo $fetch['state']; ?>,
                                    <?php echo $fetch['postcode']; ?></b>
                                <br>
                                <br>
                                <b style="font-weight: 500; color: #1b8257;"><b style="font-weight: 600;">Contact Us:</b>
                                    <br>
                                    <i class="fas fa-envelope"></i>
                                    <?php echo $fetch['email']; ?>
                                    <br>
                                    <i class="fas fa-phone"></i>
                                    <?php echo $fetch['phonenum']; ?></b>
                                <br>
                                <br>

                                <input type="hidden" value="<?php echo $_GET['schools_ID']; ?>" name="schools_ID">
                                <input type="hidden" value="<?php echo $_SESSION['parents_ID']; ?>" name="parents_ID">
                                <!-- <button class="btn btn-primary btn-favorite" style="min-width: 100px;">
                                    <span name="favorited" value="favorited"><i class="fa fa-user-plus"></i> Favorite</span>
                                    <span class="unfavorite" name="unfavorited" value="unfavorited" style="display:none;">Unfavorite</span>
                                    <span class="favorited" style="display:none;">Favorited</span>
                                </button> -->



                                <!-- <select class="form-control" name="favunfav">
                                    <option value="Favorite">
                                        Favorite
                                    </option>
                                    <option value="Unfavorite">
                                        Unfavorite
                                    </option>
                                </select> -->

                                <!-- <div class="col-md-4">
                                    <input type="text" name="favstatus" value="favorite" size="40" class="" id="favorited" aria-required="true" aria-invalid="false" placeholder="Your Name*">
                                </div>
                                <div class="col-xs-12 submit-button text-center">
                                    <input type="submit" value="Follow"  class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
                                </div> -->



                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="width: 745px; margin-bottom: 0px;">
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">About
                            <?php echo $fetch['school_name']; ?>
                        </div>
                        <div class="panel-body">
                            <?php echo $fetch['descriptions']; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 275px; margin-left: -400px;">
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
            </form>
        </div>
        <?php } ?>

    </div>
</section>

<?php
include_once'footer.php';
?>
