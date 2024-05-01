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
            <?php
                       $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
                       while($row2 = $admin->fetch_array()){
                ?>
            <h5>Hello
                <?php echo $row2['firstname'];?>
                <?php echo $row2['lastname'];?>,<br>
                you can edit and update your payment details here.</h5>
            <div class="submit-button">
                <a class="btn2" href="editprofile.php" style="border:none; margin: 20px 0 0 0">Members Information</a>

                <a class="btn2" href="editpayment.php" style="border:none; margin: 20px 0 0 0; background: #118f56;">Payment Details</a>
            </div>


            <hr>
            <h3>Payment Details</h3>
            <br>
            <label>Supported Debit:</label>
            <br>
            <img src="http://matancentre.com/wp-content/uploads/2015/06/bank.png">


        </div>


        <form action="editpayment2.php" method="post">
            <br>
            <div class="row">
                <?php
                $display = $connection->query("SELECT * FROM payment WHERE parents_ID='".$_SESSION['parents_ID']."'");
                $row = $display->fetch_array();
                ?>
                <div class="col-md-6 form-group">
                    <label>Bank Name:</label>
                    <select class="form-control" name="bankname">
                        <option value="<?php echo $row['bankname'];?>" selected="selected">
                            <?php echo $row['bankname'];?>
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
                    <label>Card Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['card_name'];?>" name="card_name" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Card Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['card_no'];?>" name="card_no" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>CVV Number (3 digits code on back of your card):</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['cvv'];?>" name="cvv" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Expiry Date:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['exp_date'];?>" name="exp_date" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address 1:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['address1'];?>" name="address1" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address 2:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['address2'];?>" name="address2" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>State:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['state'];?>" name="state" placeholder="" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label>Postcode:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['postcode'];?>" name="postcode" placeholder="" required="required">
                </div>

                <!-- <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                      <label>Upload a photo here:</label>
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled" value="Upload a photo here">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="image-preview-input"/>
                                </div>
                            </span>
                        </div>
                    </div> -->
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
    include_once'../parents/footer.php';
?>
