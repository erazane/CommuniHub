<?php
include_once'../schools/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row">
          <?php
        $sch = $connection->query("SELECT schools.*,donation.*
                                    FROM donation
                                    INNER JOIN schools ON schools.schools_ID= donation.schools_ID
                                    WHERE  donation.schools_ID=".$_SESSION['schools_ID']."");
            while ($fetch = $sch->fetch_array()) {
            ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-card js-profile-card text-center" style="margin-right: 0px;">
                        <div class="profile-card__cnt js-profile-cnt">
                            <div style="border-color: black;" class="overlay rounded mb-4">
                                <?php if ($fetch['image'] == '') { ?>
                                <img class="avatar img-circle img-thumbnail" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                                <?php } else { ?>
                                <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px; border-radius: 5px;">
                                <?php } ?>
                            </div>
                            <br>
                            <input type="hidden" value="<?php echo $_GET['donation_ID']; ?>" name="donation_ID">
                            <h5>School Name:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 15px; margin: 0px 0 15px 0;">
                                <?php echo $fetch['school_name']; ?>
                            </p>
                            <h5>Donation Title:</h5>
                            <p style="color: #049963; font-weight: 600; font-size: 15px; margin: 0px 0 15px 0;">
                                <?php echo $fetch['donationtitle']; ?>
                                </h5>
                                <h5>Donation Date:</h5>
                                <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 15px 0;"><i class="fas fa-calendar-alt"></i>
                                  <?php echo date('d/m/Y', strtotime($fetch['donationstartdate'])); ?> until
                                  <?php echo date('d/m/Y', strtotime($fetch['donationenddate'])); ?></p>
                                </p>
                                <h5>Amount Needed:</h5>
                                <p style="color: #049963; font-weight: 600; font-size: 14px; margin: 0px 0 0 0;"><i class="fas fa-money-bill-wave"></i> RM
                                    <?php echo $fetch['donationamount']; ?>
                                </p>
                                <br />
                            <!-- <form action="" method="post"> -->
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default" style="width: 745px;">
                        <div class="panel-heading" style="text-transform: uppercase; font-weight: 600;">Donation Description
                        </div>
                        <div class="panel-body" style="font-weight: 500;">
                            <div class="text-center">
                                <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px; ">
                            </div>
                            <br />
                            <label style="margin-top: 3px; margin-bottom: 3px;">
                                Descriptions:
                            </label>
                            <?php echo $fetch['donationdesc']; ?>
                            <br />

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<?php
include_once'../schools/footer.php';
?>
