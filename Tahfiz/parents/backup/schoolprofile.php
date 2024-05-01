<?php
include_once'../parents/header.php';
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
                    <div class="profile-card js-profile-card text-center" style="margin-right: 0px;">
                        <div class="profile-card__cnt js-profile-cnt">
                            <div style="border-color: black;" class="overlay rounded mb-4">
                                <?php if ($fetch['file_name'] == '') { ?>
                                <img class="avatar img-circle img-thumbnail" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                                <?php } else { ?>
                                <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">
                                <?php } ?>
                            </div>
                            <br>
                            <h4>
                                <?php echo $fetch['school_name']; ?>
                            </h4>
                            <br>
                            <b><i class="far fa-map-marker-alt" aria-hidden="true"></i>
                                <?php echo $fetch['street_name']; ?>,
                                <br>
                                <?php echo $fetch['state']; ?>,
                                <?php echo $fetch['postcode']; ?></b>
                            <br>
                            <br>
                            <b style="font-weight: 600;">Contact us:
                                <br>
                                <i class="far fa-envelope-open" aria-hidden="true"> </i>
                                <?php echo $fetch['email']; ?>
                                <br>
                                <i class="far fa-phone" aria-hidden="true"></i>
                                <?php echo $fetch['phonenum']; ?></b>
                            <br>
                            <br>
                            <!-- <form action="" method="post"> -->
                                <button class="btn btn-primary" style="border-color: #1f9d68; background-color: #2bbf7d;">
                                    <a class="follow" style="color: #ffffff" href="donating.php?schools_ID=<?php echo $fetch['schools_ID'] ?>"><i class="fa fa-heart" style="color: #ffffff"></i> Donate</a>
                                </button>
                                <button class="btn btn-primary btn-favorite" style="min-width: 100px;">
                                    <span class="favorite" name="favorited"><i class="fa fa-user-plus"></i> Favorite</span>
                                    <span class="unfavorite" style="display:none;">Unfavorite</span>
                                    <span class="favorited" style="display:none;">Favorited</span>
                                </button>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="width: 745px;">
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
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">Photos Gallery
                        </div>
                        <div class="panel-body">
                            <?php if ($fetch['file_name'] == '') { ?>
                            <img class="avatar img-circle img-thumbnail" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                            <?php } else { ?>
                            <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>





            <br>
        </div>
        <?php } ?>

    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
