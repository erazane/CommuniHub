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
            <h2>Events</h2>
            <hr>
            <h5>Find an information of interesting events that will
              <br>
              be held by Tahfiz School.
            </h5>
            <!-- <br>
            <h6>Search by name:</h6>
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
            $evt= $connection->query("SELECT * FROM event");
            while ($fetch = $evt->fetch_array()) {
                ?>

                <div class="thumbnail col-lg-4 col-md-12 mb-lg-0 mb-4 text-center">
                    <!-- Featured image -->
                    <br>
                    <div style="border-color: black;" class="overlay rounded mb-4">
                        <?php if ($fetch['image'] == '') { ?>
                            <img class="img-fluid" src="../images/missing.png" alt="Sample image" style="height:150px; width:350px;">
                        <?php } else { ?>
                            <img class="img-fluid" src="../images/<?php echo $fetch['image']; ?>" alt="missing.png" style="height:150px; width:250px;">
    <?php } ?>
                    </div>
                    <!-- Category -->
                    <br>
                    <!-- Post title -->
                    <h5><?php echo $fetch['eventtitle']; ?></h5>
                    <!-- Post data -->
                    <p style="font-weight: 700; font-size: 15px;">Events Date:</p>
                    <p style="font-weight: 500; font-size: 13px;"><i class="far fa-calendar-alt"></i> <?php echo $fetch['eventstartdate']; ?> until <?php echo $fetch['eventenddate']; ?></p>
                    <!-- Excerpt -->
                    <p style="font-weight: 700; font-size: 15px;">Events Location:</p>
                    <p style="font-weight: 500;"><i class="far fa-map-marker-alt" aria-hidden="true"></i> <?php echo $fetch['eventvenue']; ?></p>
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
