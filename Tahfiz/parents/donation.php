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
            <h2>Donation</h2>
            <hr>
            <h5>Choose school to donate</h5>
            <br>
            <h6>Search by name:</h6>
            <div class="col-md-4 col-md-offset-4">
                <input class="form-control" name="cari" placeholder="Search by school name" type="text" style="margin-top: 5px;">
            </div>
            <div class="col-md-4 col-md-offset-4 submit-button text-center">
                <input type="submit" value="Search" name="searchname" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 20px 0 0 0">
            </div>
        </div>
        <br>
        <div class="row center">
            <?php
            $sch = $connection->query("SELECT * FROM schools WHERE status='Approved'");
            while ($fetch = $sch->fetch_array()) {
                ?>

            <div class="thumbnail col-lg-4 col-md-12 mb-lg-0 mb-4 text-center">
                <!-- Featured image -->
                <br>
                <div style="border-color: black;" class="overlay rounded mb-4">
                    <?php if ($fetch['file_name'] == '') { ?>
                    <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                    <?php } else { ?>
                    <img class="img-fluid" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px;">
                    <?php } ?>
                </div>
                <!-- Category -->
                <br>
                <!-- Post title -->
                <h5>
                    <?php echo $fetch['school_name']; ?>
                </h5>
                <!-- Post data -->
                <br>
                <i class="far fa-envelope-open" aria-hidden="true"> </i><a style="font-weight: 400;">
                    <?php echo $fetch['email']; ?></a>
                <p style="font-weight: 600;"><i class="far fa-phone" aria-hidden="true"></i>
                    <?php echo $fetch['phonenum']; ?>
                </p>
                <!-- Excerpt -->
                <p style="font-weight: 600;"><i class="far fa-map-marker-alt" aria-hidden="true"></i>
                    <?php echo $fetch['street_name']; ?>,
                    <?php echo $fetch['state']; ?>
                </p>
                <!-- Read more button -->
                <a class="btn2" style="margin-left:0px;" href="schoolprofile.php?schools_ID=<?php echo $fetch['schools_ID'] ?>">View profile</a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
