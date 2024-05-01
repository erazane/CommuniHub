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
            <h5>Hello
                <?php echo $row2['school_name'];?>
                ,<br>
                you can edit and update your school information here.</h5>

            <hr>

        </div>



        <form action="editprofile2.php" method="post" name="image_upload_form" id="image_upload_form" enctype="multipart/form-data">




            <!-- <br>
                 <h4 class ="h4-responsive font-weight-bold my-2 text-center black-text">Add Activity</h4>
                  <hr class="black">
                  <div class="row">
                     <div class="col-md-12">
                         <label>Upload photos of the activity:</label><br>
                         <input type="file" name="upload[]" class="btn btn-black" required="required" multiple>
                     </div>
                 </div> -->
            <div class="row">
                <?php
                $display = $connection->query("SELECT * FROM schools WHERE schools_ID='".$_SESSION['schools_ID']."'");
                $row = $display->fetch_array();
                ?>


                <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                    <img src="../images/<?php echo $row['file_name'];?>" class="avatar img-circle img-thumbnail" style="height:200px; width:200px; padding:15px;" alt="avatar">
                    <br>
                    <label>Upload a photo here:</label>
                    <input type="file" class="text-center center-block file-upload" name="images_upload[]" accept="image/png, image/jpeg, image/gif" id="image_upload" multiple>
                    <br>
                </div>

                <div class="col-md-6 form-group">
                    <label>School Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['school_name'];?>" name="school_name" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Street Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['street_name'];?>" name="street_name" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>State:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['state'];?>" name="state" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Postcode:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['postcode'];?>" name="postcode" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Phone Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['phonenum'];?>" name="phonenum" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Registration Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['register_no'];?>" name="register_no" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>School Category:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['category'];?>" name="category" placeholder="" required="required">
                </div>
                <div class="col-md-6">
                    <label>Monthly Fees:</label>
                </div>
                <div class="col-md-6 input-group" style="padding-left: 15px; padding-right: 15px;">
                    <span class="input-group-addon" style="font-weight: 600;">
                        RM
                    </span>
                    <input type="text" name="monthlyfees" class="form-control" value="<?php echo $row['monthlyfees'];?>" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-12 form-group">
                    <label>School Description:</label>
                    <textarea type="text" id="name" class="form-control" rows="10" name="descriptions" placeholder="" required="required"><?php echo $row['descriptions'];?></textarea>
                </div>
                <div class="col-md-6 form-group">
                    <label>Date Joined:</label>
                    <input type="date" id="date" class="form-control" value="<?php echo $row['date_joined'];?>" name="date_joined" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Sector:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['sector'];?>" name="sector" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Website:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['school_url'];?>" name="school_url" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Email:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['email'];?>" name="email" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Password:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['password'];?>" name="password" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Bank Name:</label>
                    <select class="form-control" name="bank_name">
                        <option value="<?php echo $row['bank_name'];?>" selected="selected">
                          <?php echo $row['bank_name'];?>
                        </option>
                        <option value="Affin Bank Berhad">
                            Affin Bank Berhad
                        </option>
                        <option value="Ambank">
                            Ambank
                        </option>
                        <option value="Bank Islam Malaysia Berhad">
                            Bank Islam Malaysia Berhad
                        </option>
                        <option value="CIMB Bank Malaysia">
                            CIMB Bank Malaysia
                        </option>
                        <option value="Citibank Berhad">
                            Citibank Berhad
                        </option>
                        <option value="Hong Leong Bank">
                            Hong Leong Bank
                        </option>
                        <option value="HSBC Bank Malaysia Berhad">
                            HSBC Bank Malaysia Berhad
                        </option>
                        <option value="Maybank">
                            Maybank
                        </option>
                        <option value="Public Bank Berhad">
                            Public Bank Berhad
                        </option>
                        <option value="RHB Bank">
                            RHB Bank
                        </option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Account's Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['acc_name'];?>" name="acc_name" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Account's Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['acc_no'];?>" name="acc_no" placeholder="" required="required">
                </div>

                <!-- <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> -->
                <div class="col-md-6">
                    <label>Upload a school's certificate here:</label>

                    <div class="input-group image-preview">
                        <input type="text" class="form-control filename" disabled="disabled" placeholder="Upload a photo here">

                        <span class="input-group-btn">

                            <div class="btn image-preview-input">

                                <span style="font-family: SF Pro Display; font-weight: 500;"><i class="fas fa-upload browse-button-text"></i> Browse</span>
                                <input type="file" name="cert_upload[]" accept="image/png, image/jpeg, image/gif, application/pdf" multiple>
                            </div>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 submit-button text-center">
                <input type="submit" value="Save" class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
            </div>
        </form>



        <?php } ?>
    </div>
    </div>
</section>

<?php
    include_once'../schools/footer.php';
?>
