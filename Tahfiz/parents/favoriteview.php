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
            <div class="col-lg-3">
                <ul id="menu-dashboard" class="nav nav-pills nav-stacked" style="padding-left: 0px; width: 100%; margin-right: 0px;">
                    <li><a href="index.php"><span class="icon-home4"></span> <span class="hidden-xs">Dashboard</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#submenu" aria-expanded="false">
                            <span class="icon-link2"></span>
                            Tahfiz School<span class="caret" style="margin-left: 5px;"></span></a>
                        <ul class="nav collapse" id="submenu" role="menu" aria-labelledby="btn-1" style="padding-left: 0px;">
                            <li><a href="listschool.php">List of Tahfiz School</a></li>
                            <li class="active"><a href="favoriteview.php">Favorited Tahfiz School</a></li>
                        </ul>
                    </li>
                    <li><a href="editprofileside.php"><span class="icon-user3"></span> <span class="hidden-xs">Profile</span></a></li>
                    <li><a href="editpaymentside.php"><span class="icon-search-2"></span> <span class="hidden-xs">Bank Details</span></a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <h5>List of favorited schools.</h5>
                <hr style="margin-left: 0px; width: 350px;">
            </div>

            <div class="form-contents col-md-8" style="width: 76%;">
                <?php
  $sch = $connection->query("SELECT schools.*,favorite.*
                              FROM favorite
                              INNER JOIN schools ON schools.schools_ID= favorite.schools_ID
                              WHERE  favorite.parents_ID=".$_SESSION['parents_ID']."");
                      while ($fetch = $sch->fetch_array()) {
                ?>
                <div class="thumbnail col-lg-4 text-center" style="padding: 15px;">
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
                    <i class="fas fa-envelope"></i><a style="font-weight: 500;">
                        <?php echo $fetch['email']; ?></a>
                    <p style="font-weight: 600;"><i class="fas fa-phone"></i>
                        <?php echo $fetch['phonenum']; ?>
                    </p>
                    <!-- Excerpt -->
                    <p style="font-weight: 600;"><i class="fas fa-map-marker-alt"></i>
                        <?php echo $fetch['street_name']; ?>,
                        <?php echo $fetch['state']; ?>
                    </p>
                    <!-- Read more button -->
                    <a class="btn2" style="margin-left:0px;" href="schoolprofile.php?schools_ID=<?php echo $fetch['schools_ID'] ?>">View profile</a>

                </div>
                <?php } ?>
            </div>



        </div>
    </div>
</section>

<?php
    include_once'../parents/footer.php';
?>
