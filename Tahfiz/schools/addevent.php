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
            <h2>Add Events</h2>
            <hr>

        </div>

        <div class="container">
            <form action="addevent2.php" method="POST" name="image_upload_form" id="image_upload_form" enctype="multipart/form-data">

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
                <div class="row">

                    <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <label>Upload a photo here:</label>

                        <div class="input-group image-preview">
                            <input type="text" class="form-control filename" disabled="disabled" placeholder="Upload a photo here">

                            <span class="input-group-btn">

                                <!-- <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button> -->

                                <div class="btn image-preview-input">

                                    <span style="font-family: 'SF Pro Display'; font-weight: 400;"><i class="fas fa-upload browse-button-text"></i> Browse</span>
                                    <input type="file" name="images_upload[]" accept="image/png, image/jpeg, image/gif" multiple>
                                </div>
                            </span>
                        </div>
                    </div>

                    <!-- <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <div class="btn btn-default browse-button">
                                    <span class="browse-button-text">
                                        <i class="fa fa-folder-open"></i> Browse</span>
                                    <input type="file" accept=".pdf" name="attachment" />
                                </div>
                                <button type="button" class="btn btn-default clear-button" style="display:none;">
                                    <span class="fa fa-times"></span> Clear
                                </button>
                            </span>
                            <input type="text" class="form-control filename" disabled="disabled" placeholder="Please click on browse button and select a pdf file">
                            <span class="input-group-btn">
                                <button class="btn btn-primary upload-button" type="button">
                                    <i class="fa fa-upload"></i>
                                    Upload
                                </button>
                            </span>
                        </div>
                    </div> -->

                    <!-- <div class="col-md-12">
                        <label>Upload a photo here:</label>
                        <input type="file" class="text-center file-upload" name="images_upload[]" accept="image/png, image/jpeg, image/gif" id="image_upload" multiple>
                        <br>
                    </div> -->

                    <div class="col-md-12">
                        <label>Name of event:</label>
                        <input type="text" id="name" class="form-control" name="eventtitle" placeholder="Example: Gotong Royong Sempena Bulan Puasa" required="required">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="exampleFormControlTextarea1">Description of the event:</label>
                        <textarea name="eventdescription" class="form-control rounded-0" id="exampleFormControlTextarea1" rows="10" required="required"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Event Venue:</label>
                        <input type="text" id="name" class="form-control" name="eventvenue" placeholder="Example: Pusat Tahfiz Kg. Baru" required="required">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Event Start Date:</label>
                        <input type="date" name="eventstartdate" id="date" class="form-control" required="required" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Event End Date:</label>
                        <input type="date" name="eventenddate" id="date" class="form-control" required="required" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Event Time:</label>
                        <input type="time" name="eventtime" id="exit-time" value="time" class="form-control" placeholder="10:00 AM" required="required" />
                    </div>

                </div>

                <div class="col-xs-12 submit-button text-center">
                    <input type="submit" value="Add Event" class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
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
