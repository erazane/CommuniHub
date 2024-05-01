<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec" style="background: #F4F4F4;">
    <div class="container">
        <?php
        $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='" . $_SESSION['parents_ID'] . "'");
        while ($row2 = $admin->fetch_array()) {
            ?>
            <div class="row text-center">
                <h2>Welcome, <?php echo $row2['firstname']; ?> <?php echo $row2['lastname']; ?></h2>
            <?php } ?>
            <hr>
            <!-- <div class="clearfix"></div> -->
            <h5>You can manage your profile,<br>
                make donation and join events from this page.</h5>
            <br>

            <div class="col-lg-12">
          <p>
            <a href="browseschool.php" class="btn btn-sq-lg btn-primary" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                <i class="fas fa-graduation-cap fa-5x"></i><br/>
                Where To<br>Study
            </a>
            <a href="donation.php" class="btn btn-sq-lg btn-success" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
              <i class="fas fa-hands-usd fa-5x"></i><br/>
              <br>Donate
            </a>
            <a href="eventlist.php" class="btn btn-sq-lg btn-danger" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
              <i class="fas fa-calendar-week fa-5x"></i><br/>
              <br>Event
            </a>
            <a href="editprofile.php" class="btn btn-sq-lg btn-warning" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
              <i class="fa fa-user fa-5x"></i><br/>
              <br>Edit Profile
            </a>
            <!-- <a href="#" class="btn btn-sq-lg btn-danger" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
              <i class="fa fa-user fa-5x"></i><br/>
              Demo Danger <br>Button
            </a> -->
          </p>
        </div>
            <!-- <div class="col-md-3">
                <ul class="vertical-sidenav account-menu">
                    <li><a href="/account">Profile</a></li>
                    <li><a href="/account/work_opportunities">Work Opportunities</a></li>
                    <li><a href="/account/password">Password</a></li>
                    <li class="active"><a href="/account/social_profiles">Social Profiles</a></li>
                    <li><a href="/account/notifications">Email Notifications</a></li>
                    <li><a href="/account/sessions">Sessions</a></li>
                    <li><a href="/account/applications">Applications</a></li>
                    <li><a href="/account/export">Data Export</a></li>
                </ul>
            </div> -->

        </div>

    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
