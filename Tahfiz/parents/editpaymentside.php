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
                    <li><a href="editprofileside.php"><span class="icon-user3"></span> <span class="hidden-xs">Profile</span></a></li>
                    <li class="active"><a href="editpaymentside.php"><span class="icon-search-2"></span> <span class="hidden-xs">Bank Details</span></a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <?php
                       $admin = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
                       while($row2 = $admin->fetch_array()){
                ?>
                <h5>
                    Edit and update your payment details.</h5>

                <hr style="margin-left: 0px; width: 350px;">
                <label>Supported Debit:</label>
                <br>
                <img src="../parents/images/bank.png" style="width: 325; height:77px; margin-bottom: 15px;">
            </div>

            <form action="editpayment2.php" method="post">
                <br>
                <?php
                $display = $connection->query("SELECT * FROM payment WHERE parents_ID='".$_SESSION['parents_ID']."'");
                $row = $display->fetch_array();
                ?>
                <div class="col-md-8 form-group">
                    <label>Bank Name:</label>
                    <select class="form-control" name="bankname">
                        <option value="0" selected="selected">
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
                <div class="col-md-8 form-group">
                    <label>Card Name:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['card_name'];?>" name="card_name" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Card Number:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['card_no'];?>" name="card_no" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>CVV Number (3 digits code on back of your card):</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['cvv'];?>" name="cvv" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Expiry Date:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['exp_date'];?>" name="exp_date" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Address 1:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['address1'];?>" name="address1" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Address 2:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['address2'];?>" name="address2" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>State:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['state'];?>" name="state" placeholder="" required="required">
                </div>
                <div class="col-md-8 form-group">
                    <label>Postcode:</label>
                    <input type="text" id="name" class="form-control" value="<?php echo $row['postcode'];?>" name="postcode" placeholder="" required="required">
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
