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
            <div class="col-lg-3" style="height: 900px;">
                <ul id="menu-dashboard" class="nav nav-pills nav-stacked" style="padding-left: 0px; width: 100%; margin-right: 0px;">
                    <li><a href="index.php"><span class="icon-home4"></span> <span class="hidden-xs">Dashboard</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#submenu" aria-expanded="false">
                            <span class="icon-link2"></span>
                            Tahfiz School<span class="caret" style="margin-left: 5px;"></span></a>
                        <ul class="nav collapse" id="submenu" role="menu" aria-labelledby="btn-1" style="padding-left: 0px;">
                            <li><a href="listschool.php">List of Tahfiz School</a></li>
                            <li><a href="favoriteview.php">Favorited Tahfiz School</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="editprofileside.php"><span class="icon-user3"></span> <span class="hidden-xs">Profile</span></a></li>
                    <li><a href="editpaymentside.php"><span class="icon-search-2"></span> <span class="hidden-xs">Bank Details</span></a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <?php
                       $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
                       while($row2 = $admin->fetch_array()){
                ?>
                <h5>
                    Edit and update your personal information.</h5>


                <hr style="margin-left: 0px; width: 350px;">
            </div>
            <form action="editprofile2.php" method="post">




                <!-- <br>
                     <h4 class ="h4-responsive font-weight-bold my-2 text-center black-text">Add Activity</h4>
                      <hr class="black">
                      <div class="row">
                         <div class="col-md-12">
                             <label>Upload photos of the activity:</label><br>
                             <input type="file" name="upload[]" class="btn btn-black" required="required" multiple>
                         </div>
                     </div> -->
                <br>

                <?php
                    $display = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
                    $row = $display->fetch_array();
                    ?>

                <div class="col-md-8 form-group">
                    <label>First Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['firstname'];?>" name="firstname" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Last Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['lastname'];?>" name="lastname" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Phone Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['phoneno'];?>" name="phoneno" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Email:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['email'];?>" name="email" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Street:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['street_name'];?>" name="street_name" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>State:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['state'];?>" name="state" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>City:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['city'];?>" name="city" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Postcode:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['postcode'];?>" name="postcode" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>IC Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['ic_number'];?>" name="ic_number" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Password:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['password'];?>" name="password" placeholder="" required="required">
                </div>
                <div class="col-md-8 submit-button text-center">
                    <input type="submit" value="Save" class="btn2" id="sub" style="border:none; margin: 0px 695px 0 0;">
                </div>
            </form>



            <?php } ?>
        </div>
    </div>
</section>

<?php
    include_once'../parents/footer.php';
?>
