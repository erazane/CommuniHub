<?php
include_once'../parents/headerreceipt.php';
?>
<div class="container" style="background: #dfe1e4;" align="center">
    <?php
  $sch = $connection->query("SELECT schools.*,donationpayment.*,parents.*,donation.*,payment.*
                             FROM ((((donationpayment
                             INNER JOIN schools ON schools.schools_ID= donationpayment.schools_ID)
                             INNER JOIN donation ON donation.donation_ID= donationpayment.donation_ID)
                             INNER JOIN payment ON payment.parents_ID= donationpayment.parents_ID)
                             INNER JOIN parents ON parents.parents_ID=donationpayment.parents_ID)
                             WHERE  donationpayment.parents_ID=".$_SESSION['parents_ID']." AND  donationpayment.receiptno=".$_GET['receiptno']."");
      while ($fetch = $sch->fetch_array()) {
      ?>
    <table class="wrapper" bgcolor="#ECEEF1" style="background-color:#dfe1e4;width:70%; margin-top: 0px; margin-bottom: 0px; box-shadow: 0px 0px 0px #a6a6a6;">
        <td class="container transaction-mailer" bgcolor="#FFFFFF" style="font-family:SF Pro Display, Helvetica, sans-serif;color:#6f6f6f;display:block;max-width:600px;margin-top:50px; margin-bottom: 50px;padding:20px;padding-bottom:0px;border:1px solid #CED3D8;box-shadow: 0px 0px 6px -1px rgba(0,0,0,0.28);">

            <img alt="our wonderful wistia logo" border="0" class="img-fluid" height="46" src="../images/logos.png" width="200" height="300" style="display:block; margin-top:0px;margin-bottom:0px;margin-left:130px;margin-right:0px;height:50%;width:50%;">

            <div class="content" style="display:block;margin:0 auto;max-width:650px;padding-top:0px;padding-bottom:20px;padding-left:20px;padding-right:20px;-webkit-font-smoothing:antialiased">
                <div class="receipt">
                    <div class="head">

                        <h1 class="light title" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;line-height:130%;-webkit-font-smoothing:antialiased;margin-top:10px;color:#b9b9b9;font-size:26px;text-align:left">Receipt</h1>

                        <div class="account-item" style="margin:10px 0;font-size:18px">
                            <span class="light" style="padding-right:5px;color:#999999">Your Name:</span>

                            <span class="item-detail" style="padding-right:5px;color:#434343"><?php echo $fetch['firstname']; ?> <?php echo $fetch['lastname']; ?></span>
                        </div>
                        <div class="account-item" style="margin:10px 0;font-size:18px">
                            <span class="light" style="padding-right:5px;color:#999999">Donation Date:</span>

                            <span class="item-detail" style="padding-right:5px;color:#434343"><?php echo date('d/m/Y', strtotime($fetch['don_date'])); ?></span>
                        </div>
                        <div class="account-item" style="margin:10px 0;font-size:18px">
                            <span class="light" style="padding-right:5px;color:#999999">Receipt Number:</span>

                            <span class="item-detail" style="padding-right:5px;color:#434343"><?php echo $fetch['receiptno']; ?></span>
                        </div>
                    </div>
                    <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC">
                        <div class="message">

                            <h1 class="emphasis" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;margin-top:10px;-webkit-font-smoothing:antialiased;font-size:28px;line-height:130%;text-align:left;color:#54bbff">Thank you for your donation.</h1>

                            <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">The credit card,
                                <em><?php echo $fetch['card_no']; ?></em> has been successfully charged RM <?php echo $fetch['don_amount']; ?>. Your donation was successfully channeled to <?php echo $fetch['school_name']; ?> on <?php echo $fetch['donationtitle']; ?>.
                                <br />
                                <br />
                                A copy of this receipt is also in your
                                <a href="onldonationhistory.php" target="_blank" style="color:#54bbff">Donation History</a>.</p>
                            <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">If you have any questions, please let us know. We'll get back to you as soon as we can.</p>
                            <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">Tahfiz Care Team,
                                <br>
                                <a href="mailto:tahfizcare@gmail.com" style="color:#54bbff">tahfizcare@gmail.com</a>
                            </p>
                        </div>
                    </div>
                    <!-- <div class="billing">
                        <div class="divider" style="margin-top:20px;padding-top:10px;border-top:1px solid #CCC"> <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Subscription</strong>

                            <strong class="total" style="margin-top:5px;color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">$XX</strong>
                            <p style="color:#434343;line-height:150%;text-align:left;padding:0;font-weight:400;font-size:18px;margin-bottom:5px;margin-top:5px">For the upcoming year, beginning August XX, XXXX</p>
                            <ul style="width:80%;text-align:left;list-style-type:none;font-size:18px;margin:0px;padding:0px">
                                <li style="padding-bottom:5px;font-size:18px;color:#434343;line-height:150%">40 Plan (annual) - $XXX.XX</li>
                                <li style="padding-bottom:5px;font-size:18px;color:#434343;line-height:150%">20% annual discount (annual) -$XX.XX</li>
                            </ul>
                        </div>
                        <div class="divider" style="margin-top:20px;padding-top:10px;border-top:1px solid #CCC">
                            <div class="grand-total">
                                <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Total</strong>

                                <strong class="total" style="margin-top:5px;color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">$XXX</strong>
                            </div>
                        </div>
                    </div>
                    <div class="foot">
                        <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">
                            <strong>You are all set.</strong> Your card has been charged, and no further action is required on your part.</p>
                    </div> -->
                </div>
                <button class="btn btn-primary" id="printPageButton" onclick="window.print()" style="border-color: #1f9d68; background-color: #2bbf7d;"><i class="fa fa-print mr-1"></i> Print</button>
            </div>
            <!-- /content -->
        </td>

        <!-- /BODY -->
    </table>

</div>
<?php } ?>
</body>
<!-- /wrapper -->
