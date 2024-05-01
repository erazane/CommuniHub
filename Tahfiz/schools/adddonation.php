<?php
    include_once'../schools/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <?php
               $admin = $connection->query("SELECT * FROM schools WHERE schools_ID='".$_SESSION['schools_ID']."'");
               while($row2 = $admin->fetch_array()){
                       ?>
        <div class="row text-center">
            <h2>Donation Advertisement</h2>
            <hr>
            <!-- <div class="clearfix"></div> -->

        </div>

        <div class="container">
            <form action="adddonation2.php" method="POST" name="image_upload_form" id="image_upload_form" enctype="multipart/form-data">
                <div class="row">

                  <input type="hidden" value="<?php echo $_GET['schoolbank_ID']; ?>" name="schoolbank_ID">

                    <div class="col-md-12">
                        <label>Title of The Donation:</label>
                        <input type="text" id="name" class="form-control" name="donationtitle" placeholder="Example: School Sport Facility Donation" required="required">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="exampleFormControlTextarea1">Description of the donation:</label>
                        <textarea name="donationdesc" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" required="required"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Amount Needed:</label>
                        <input type="text" id="name" class="form-control" name="donationamount" placeholder="" required="required">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Donation Start Date:</label>
                        <input type="date" name="donationstartdate" id="date" class="form-control" required="required" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Donation End Date:</label>
                        <input type="date" name="donationenddate" id="date" class="form-control" required="required" />
                    </div>
                    <div class="col-md-6">
                        <label>Upload a photo here:</label>

                        <div class="input-group image-preview">
                            <input type="text" class="form-control filename" disabled="disabled" placeholder="Upload a photo here">

                            <span class="input-group-btn">

                                <!-- <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button> -->

                                <div class="btn image-preview-input">

                                    <span><i class="fas fa-upload browse-button-text"></i> Browse</span>
                                    <input type="file" name="images_upload[]" accept="image/png, image/jpeg, image/gif" multiple>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 submit-button text-center">
                    <input type="submit" value="Add Donation" class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
                </div>
            </form>
        </div>



        <?php } ?>
    </div>
    </div>
</section>

<?php
    include_once'../schools/footer.php';
?>
