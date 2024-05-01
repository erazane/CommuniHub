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
          $evt = $connection->query("SELECT * FROM event WHERE schools_ID='" . $_GET['schools_ID'] . "'");
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
                                <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:150px; ">
                                <?php } ?>
                            </div>
                            <br>
                            <h4>
                                <?php echo $fetch['eventtitle']; ?>
                            </h4>
                            <br>
                            <b><i class="far fa-map-marker-alt" aria-hidden="true"></i>
                                <?php echo $fetch['eventvenue']; ?>,

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
                                <button class="btn btn-primary" style="border-color: #1f9d68; background-color: #2bbf7d;">
                                    <a class="follow" style="color: #ffffff" href="donating.php?schools_ID=<?php echo $fetch['schools_ID'] ?>"><i class="fa fa-heart" style="color: #ffffff"></i> Join</a>
                                </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="width: 745px;">
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">About
                            <?php echo $fetch['school_name']; ?>
                        </div>
                        <div class="panel-body">
                            <?php echo $fetch['eventdescription']; ?>
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
