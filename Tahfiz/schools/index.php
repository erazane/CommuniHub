<?php
    include_once'../schools/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">

        <div class="row text-center">
            <?php
                 $admin = $connection->query("SELECT * FROM schools WHERE schools_ID='".$_SESSION['schools_ID']."'");
                 while($row2 = $admin->fetch_array()){
                         ?>
            <img src="../images/<?php echo $row2['file_name'];?>" class="avatar" style="height:200px; width:200px; padding:0px;" alt="avatar">


            <?php } ?>
            <hr>
            <!-- <div class="clearfix"></div> -->
            <h5>Manage your profile, create donation<br>
                advertisement and add events from this page.</h5>
            <br>

            <div class="col-lg-12">
                <p>
                    <a href="editprofile.php" class="btn btn-sq-lg btn-warning" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fa fa-user fa-5x"></i><br />
                        <br>Edit Profile
                    </a>
                    <a href="adddonation.php" class="btn btn-sq-lg btn-success" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-hands-usd fa-5x"></i><br />
                        <br>Donate
                    </a>
                    <a href="addevent.php" class="btn btn-sq-lg btn-danger" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-calendar-week fa-5x"></i><br />
                        <br>Event
                    </a>

                    <a href="onldonationreport.php" class="btn btn-sq-lg btn-primary" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-file-chart-line fa-5x"></i><br />
                        <br />Donation Report
                    </a>
                    <!-- <a href="#" class="btn btn-sq-lg btn-danger" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
        <i class="fa fa-user fa-5x"></i><br/>
        Demo Danger <br>Button
      </a> -->
                </p>
            </div>

        </div>
    </div>
</section>

<?php
    include_once'../schools/footer.php';
?>
