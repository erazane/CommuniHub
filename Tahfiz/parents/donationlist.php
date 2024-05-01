<?php
include_once'../parents/headerdonate.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row text-center">
            <h2>Donation</h2>
            <hr>
            <h5>Choose school to donate
            </h5>
            <!-- <h6>Search by name:</h6>
            <div class="col-md-4 col-md-offset-4">
                <input class="form-control" name="cari" placeholder="Search by school name" type="text" style="margin-top: 5px;">
            </div>
            <div class="col-md-4 col-md-offset-4 submit-button text-center">
                <input type="submit" value="Search" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 20px 0 0 0">
            </div> -->
        </div>
        <br>
        <div class="row">
            <?php
            $don = $connection->query("SELECT schools.*,donation.*
                                        FROM donation
                                        INNER JOIN schools ON schools.schools_ID= donation.schools_ID
                                        WHERE  donation.schools_ID=donation.schools_ID");
            while ($fetch = $don->fetch_array()) {
                ?>


            <div class="col-md-4" style="margin-bottom: 20px;">
                <div class="profile-card js-profile-card text-center" style="margin-right: 0px;">
                    <!-- Featured image -->
                    <br>
                    <div style="border-color: black;" class="overlay rounded mb-4">
                        <?php if ($fetch['image'] == '') { ?>
                        <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:350px;">
                        <?php } else { ?>
                        <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px; border-radius: 6px;">
                        <?php } ?>
                    </div>
                    <!-- Category -->
                    <br>
                    <!-- Post title -->
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
                        <!-- Read more button -->
                        <a class="btn2" style="margin-left:0px;" href="donationlistdetails.php?schools_ID=<?php echo $fetch['schools_ID'] ?>& donation_ID=<?php echo $fetch['donation_ID'] ?>">View Details</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
