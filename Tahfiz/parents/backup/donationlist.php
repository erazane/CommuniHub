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
            <br>
            <!-- <h6>Search by name:</h6>
            <div class="col-md-4 col-md-offset-4">
                <input class="form-control" name="cari" placeholder="Search by school name" type="text" style="margin-top: 5px;">
            </div>
            <div class="col-md-4 col-md-offset-4 submit-button text-center">
                <input type="submit" value="Search" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 20px 0 0 0">
            </div> -->
        </div>
        <br>
        <div class="row center">
            <?php
            $don = $connection->query("SELECT a.school_name, b.donationtitle, b.donationstartdate, b.donationamount, b.image, b.donationenddate
                                        FROM schools a
                                        INNER JOIN donation b
                                        WHERE a.schools_ID=b.schools_ID && b.schools_ID=a.schools_ID");
            while ($fetch = $don->fetch_array()) {
                ?>

                <div class="thumbnail col-lg-4 col-md-12 mb-lg-0 mb-4 text-center" style="height: 500px;">
                    <!-- Featured image -->
                    <br>
                    <div style="border-color: black;" class="overlay rounded mb-4">
                        <?php if ($fetch['image'] == '') { ?>
                            <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:350px;">
                        <?php } else { ?>
                            <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px; border-radius: 5px;">
    <?php } ?>
                    </div>
                    <!-- Category -->
                    <br>
                    <!-- Post title -->
                    <h5><?php echo $fetch['school_name']; ?></h5>
                    <h5><?php echo $fetch['donationtitle']; ?></h5>
                    <!-- Post data -->
                    <p style="font-weight: 700; font-size: 15px;">Donation Date:</p>
                    <p style="font-weight: 400; font-size: 13px;"><i class="far fa-calendar-alt"></i> <?php echo $fetch['donationstartdate']; ?> until <?php echo $fetch['donationenddate']; ?></p>
                    <!-- Excerpt -->
                    <p style="font-weight: 700; font-size: 15px;">Amount Needed:</p>
                    <p style="font-weight: 400;"><i class="fas fa-money-bill-wave"></i> RM <?php echo $fetch['donationamount']; ?></p>
                    <!-- Read more button -->
                    <a class="btn2" style="margin-left:0px;" href="eventview.php?schools_ID=<?php echo $fetch['schools_ID'] ?>">View Details</a>
                </div>
<?php } ?>
        </div>
    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
