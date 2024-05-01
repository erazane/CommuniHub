<?php include_once'header.php';
?>

<section id="about-sec">
    <div class="container">
        <form action="regtahfiz2.php" method="POST" name="image_upload_form" id="image_upload_form" enctype="multipart/form-data">
            <div class="row text-center">
                <h2 style="margin-top:1;">Tahfiz School Registration<br>

                </h2>
                <hr>

                <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                    <img src="images/defaultimage.png" class="avatar img-circle img-thumbnail" style="height:200px; width:200px; padding:15px; margin-bottom:10px;">
                    <br>
                    <label>Upload school's logo here:</label>
                    <br>
                    <input type="file" class="text-center center-block file-upload" name="images_upload[]" accept="image/png, image/jpeg, image/gif" id="image_upload" multiple>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>School Name:</label>
                    <input type="text" name="school_name" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Email:</label>
                    <input type="text" name="email" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Street Name:</label>
                    <input type="text" name="street_name" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>State:</label>
                    <input type="text" name="state" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Postcode:</label>
                    <input type="text" name="postcode" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Phone Number:</label>
                    <input type="text" name="phonenum" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Registration Number:</label>
                    <input type="text" name="register_no" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Category:</label>
                    <select class="form-control" name="category">
                        <option value="0" selected="selected">
                            Select Level..
                        </option>
                        <option value="Primary">
                            Primary
                        </option>
                        <option value="Secondary">
                            Secondary
                        </option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Sector:</label>
                    <select class="form-control" name="sector">
                        <option value="0" selected="selected">
                            Select Sector...
                        </option>
                        <option value="Government">
                            Government
                        </option>
                        <option value="Private">
                            Private
                        </option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Monthly Fees:</label>
                    <div class="col-md-6 input-group" style="padding-left: 0px; padding-right: 0px; width: 100%;">
                        <span class="input-group-addon" style="font-weight: 600;">
                            RM
                        </span>
                        <input type="text" name="monthlyfees" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <label>School Website URL:</label>
                    <input type="text" name="school_url" class="form-control" value="" aria-required="true" aria-invalid="false" placeholder="">
                </div>
                <div class="col-md-6 form-group">
                    <label>Bank Name:</label>
                    <select class="form-control" name="bank_name">
                        <option value="0" selected="selected">
                            Choose bank..
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
                    <input type="text" id="name" class="form-control" value="" name="acc_name" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Account's Number:</label>
                    <input type="text" id="name" class="form-control" value="" name="acc_no" placeholder="" required="required">
                </div>
                <div class="col-md-12 form-group">
                    <label>School Description:</label>
                    <textarea type="text" id="name" class="form-control" rows="10" name="descriptions" placeholder="" required="required"></textarea>
                </div>

                <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                  <label>Upload a school's certificate here:</label>

                  <div class="input-group image-preview">
                      <input type="text" class="form-control filename" disabled="disabled" placeholder="Upload a photo here">

                      <span class="input-group-btn">

                          <div class="btn image-preview-input">

                              <span style="font-family: SF Pro Display;"><i class="fas fa-upload browse-button-text"></i> Browse</span>
                              <!-- <input type="file" name="cert_upload[]" accept="image/png, image/jpeg, image/gif, application/pdf" id="cert_upload" multiple> -->
                              <input type="file" name="cert_upload[]" accept="image/png, image/jpeg, image/gif, application/pdf" multiple>
                          </div>
                      </span>
                  </div>
                </div>

            </div>

            <!--  <div class="containerupload">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <p>Upload your certificates here:</p>
 <input type="file" name="upload[]" class="btn btn-black" multiple>
                        </div>
                    </div>
                </div>

                <!--<div class="containerupload">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <!-- image-preview-filename input [CUT FROM HERE]-->
            <!--      <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" placeholder="Upload your documents here*"
                                    disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
            <!--      <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
            <!--        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                    </button>
                                    <!-- image-preview-input -->
            <!--        <div class="btn btn-default image-preview-input" style="margin: 30px 0 0 0">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="upload[]" multiple />
                                        <!-- rename it -->
            <!--  </div>
                                </span>
                            </div><!-- /input-group image-preview [TO HERE]-->
            <!--        </div>
                    </div>
                </div>-->

            <div class="col-xs-12 submit-button text-center">
                <input type="submit" value="Register"  class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
            </div>
    </div>
    </form>
</section>

<?php include_once'footer.php';
?>
