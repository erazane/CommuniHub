<?php
include_once'../parents/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <?php
        $sch = $connection->query("SELECT * FROM schools WHERE schools_ID='" . $_GET['schools_ID'] . "'");
        while ($fetch = $sch->fetch_array()) {
            ?>
            <div class="row text-center">
                <h5>You are about to make a donation to: <br><br>
                    <div style="border-color: black;" class="overlay rounded mb-4">
                        <?php if ($fetch['file_name'] == '') { ?>
                            <img class="avatar img-circle img-thumbnail" src="../images/missing.png" alt="Sample image" style="height:150px; width:150px;">
                        <?php } else { ?>
                            <img class="avatar img-circle img-thumbnail" src="../images/<?php echo $fetch['file_name']; ?>" alt="missing.png" style="height:150px; width:150px;">
                        <?php } ?>
                    </div>
                    <br>
                    <u><?php echo $fetch['school_name']; ?></u></h5>

            </div>
            <form action="donating2.php" method="post" id="myForm">
                <br>
                <div class="row">
                    <?php
                    $display = $connection->query("SELECT * FROM parents WHERE parents_ID='" . $_SESSION['parents_ID'] . "'");
                    $row = $display->fetch_array();

                    ?>

                    <input type="hidden" value="<?php echo $_GET['schools_ID']; ?>" name="schools_ID">


                    <div class="col-md-6 form-group">
                        <label>First Name:</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $row['firstname']; ?>" name="firstname"
                               placeholder="" required="required">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name:</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $row['lastname']; ?>" name="lastname"
                               placeholder="" required="required">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Phone Number:</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $row['phoneno']; ?>" name="phoneno"
                               placeholder="" required="required">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email:</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $row['email']; ?>" name="email"
                               placeholder="" required="required">
                    </div>

                    <div class="col-md-8 form-group">
                        <label>Amount:</label><br>

                        <div class="col-md-12 radio-group" style="padding-left: 0px; padding-right: 0px; ">
                            <label class="btn btn-amount form-check-label" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" id="option3" autocomplete="off" value="50.00" name="amount" style="display: none"><span style="font-weight: 600;">RM 50</span>
                            </label>
                            <label class="btn btn-amount form-check-label" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" id="option4" autocomplete="off" value="100.00" name="amount" style="display: none"><span style="font-weight: 600;">RM 100</span>
                            </label>
                            <label class="btn btn-amount form-check-label" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" id="option5" autocomplete="off" value="150.00" name="amount" style="display: none"><span style="font-weight: 600;">RM 150</span>
                            </label>
                            <label class="btn btn-amount form-check-label" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" id="option6" autocomplete="off" value="200.00" name="amount" style="display: none"><span style="font-weight: 600;">RM 200</span>
                            </label>
                            <label class="btn btn-amount form-check-label" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" id="option7" autocomplete="off" value="250.00" name="amount" style="display: none"><span style="font-weight: 600;">RM 250</span>
                            </label>
                            <label class="btn btn-warning form-check-label" for="othersradio" style="width: 104px; height: 50px; padding-top: 13px; margin-top: 3px">
                                <input class="form-check-input" type="radio" autocomplete="off" name="others" id="othersradio" style="display:none;"> <span style="font-weight: 600; color: #000000">Others</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 form-group" style="margin-bottom: 0px;">
                      <div class="col-md-6" id="enteramount" style="display: none; padding-left: 0px; padding-right: 0px; ">
                        <label class="font-weight-bold">Enter amount: </label>
                        <div class="col-md-12 input-group" style="width: 200%;">
                          <span class="input-group-addon" style="font-weight: 600;">
                              RM
                          </span>
                        <input type="text" class="form-control" value="0.00"  name="donate1" id="txtamount" placeholder="Example: 95.00" aria-describedby="basic-addon2">
                        </div>

                        <div class="col-md-12 input-group-append" style="padding-left: 0px; padding-right: 0px">
                            <button class="btn btn-primary" type="button" onclick="myFunction()" style="margin: 9px 0px 10px 0px; font-weight: 600;">Enter</button>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-12 form-group" style="">
                      <div class="col-md-6 input-group" style="padding-left: 0px; padding-right: 0px; width: 48.6%;">
                        <span class="input-group-addon" style="font-weight: 600;">
                                  RM
                        </span>
                          <input type="text" class="form-control font-weight-bold " name="don_amount" id="selvalue" readonly="readonly" style="font-weight: 600;">
                      </div>
                    </div>



                    <div class="col-xs-12 submit-button text-center">
                        <input type="submit" value="Donate"  class="btn2" id="sub" style="border:none; margin: 0px 0 0 0">
                    </div>
            </form>



        <?php } ?>
    </div>
  </div>
</section>

<?php
include_once'../parents/footer.php';
?>
