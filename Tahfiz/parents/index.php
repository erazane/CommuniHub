<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec" style="background: #F4F4F4;">
    <div class="container">
        <div class="row">

            <!-- <div class="clearfix"></div> -->
            <div class="col-lg-3">
                <ul id="menu-dashboard" class="nav nav-pills nav-stacked" style="padding-left: 0px; width: 100%; margin-right: 0px;">
                    <li class="active"><a href="index.php"><span class="icon-home4"></span> <span class="hidden-xs">Dashboard</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#submenu" aria-expanded="false">
                            <span class="icon-link2"></span>
                            Tahfiz School<span class="caret" style="margin-left: 5px;"></span></a>
                        <ul class="nav collapse" id="submenu" role="menu" aria-labelledby="btn-1" style="padding-left: 0px;">
                            <li><a href="listschool.php">List of Tahfiz School</a></li>
                            <li><a href="favoriteview.php">Favorited Tahfiz School</a></li>
                        </ul>
                    </li>
                    <li><a href="editprofileside.php"><span class="icon-user3"></span> <span class="hidden-xs">Profile</span></a></li>
                    <li><a href="editpaymentside.php"><span class="icon-search-2"></span> <span class="hidden-xs">Bank Details</span></a></li>
                </ul>
            </div>

            <div class="col-md-8">
                <h5>Manage your profile, make donation and join events from this page.</h5>
                <hr style="margin-left: 0px; width: 350px;">
                <p style="margin-left: 0px; margin-top: 0px; width: 100%;">
                    <a href="compareschool.php" class="btn btn-sq-lg btn-primary" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-graduation-cap fa-5x"></i><br />
                        School<br>Comparison
                    </a>
                    <a href="donationlist.php" class="btn btn-sq-lg btn-success" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-hands-usd fa-5x"></i><br />
                        <br>Donate
                    </a>
                    <a href="eventlist.php" class="btn btn-sq-lg btn-danger" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fas fa-calendar-week fa-5x"></i><br />
                        <br>Event
                    </a>
                    <a href="editprofile.php" class="btn btn-sq-lg btn-warning" style="width: 150px; height: 150px; border-radius:6px; padding: 18px 0px 0px 0px; font-weight: 600;">
                        <i class="fa fa-user fa-5x"></i><br />
                        <br>Edit Profile
                    </a>
                </p>
            </div>
        </div>

    </div>
</section>

<?php
include_once'../parents/footer.php';
?>
