<?php
include_once'../parents/headerreceipt.php';
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
          <br>
          <!--Jumbotron-->

                  <!-- BODY -->
                  <table class="body-wrap" style="margin:0 auto;margin-bottom: 80px;">
                    <tr>
                      <td></td>
                      <td class="container transaction-mailer" bgcolor="#FFFFFF" style="font-family:Source Sans Pro, Helvetica, sans-serif;color:#6f6f6f;display:block;max-width:600px;margin:0 auto;padding:40px;border:1px solid #CED3D8;">
                        <div class="content" style="display:block;margin:0 auto;max-width:650px;padding:20px;-webkit-font-smoothing:antialiased">
                          <div class="receipt">
                            <div class="head">

                              <h1 class="light title" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;line-height:130%;-webkit-font-smoothing:antialiased;margin-top:10px;color:#ccc;font-size:26px;text-align:left">Invoice</h1>

                              <div class="account-item" style="margin:10px 0;font-size:18px">
                                <span class="light" style="padding-right:5px;color:#ccc">Your account:</span>

                                <span class="item-detail" style="padding-right:5px;color:#434343"><?php echo $fetch['schools_ID']; ?></span>
                              </div>
                              <div class="account-item" style="margin:10px 0;font-size:18px">
                                <span class="light" style="padding-right:5px;color:#ccc">Billing date:</span>

                                <span class="item-detail" style="padding-right:5px;color:#434343">August XX, 2016</span>
                              </div>
                            </div>
                            <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC">
                              <div class="message">

                                <h1 class="emphasis" style="margin:0;padding:0;margin-bottom:20px;font-weight:700;margin-top:10px;-webkit-font-smoothing:antialiased;font-size:28px;line-height:130%;text-align:left;color:#54bbff">Thank you for your business.</h1>

                                <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">The credit card ending in
                                  <em>XXXX</em> has been successfully charged $XXX.XX. A copy of this receipt is also in your
                                  <a href="#" target="_blank" style="color:#54bbff">Billing Statements</a>.</p>
                                <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">If you have any questions, please let us know. We'll get back to you as soon as we can.</p>
                                <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">Your friends,
                                  <br>
                                  <a href="mailto:billing@wistia.com" style="color:#54bbff">billing@wistia.com</a>
                                </p>
                              </div>
                            </div>
                            <div class="billing">
                              <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC"> <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Subscription</strong>

                                <strong class="total" style="margin-top:5px;color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">$XX</strong>
                                <p style="color:#434343;line-height:150%;text-align:left;padding:0;font-weight:400;font-size:18px;margin-bottom:5px;margin-top:5px">For the upcoming year, beginning August XX, XXXX</p>
                                <ul style="width:80%;text-align:left;list-style-type:none;font-size:18px;margin:0px;padding:0px">
                                  <li style="padding-bottom:5px;font-size:18px;color:#434343;line-height:150%">40 Plan (annual) - $XXX.XX</li>
                                  <li style="padding-bottom:5px;font-size:18px;color:#434343;line-height:150%">20% annual discount (annual) -$XX.XX</li>
                                </ul>
                              </div>
                              <div class="divider" style="margin-top:30px;padding-top:10px;border-top:1px solid #CCC">
                                <div class="grand-total">
                                  <strong style="color:black;display:inline-block;font-size:18px;margin-bottom:5px;margin-top:5px">Total</strong>

                                  <strong class="total" style="margin-top:5px;color:black;display:inline-block;margin-bottom:5px;font-size:18px;float:right">$XXX</strong>
                                </div>
                              </div>
                            </div>
                            <div class="foot">
                              <p style="color:#434343;text-align:left;line-height:150%;padding:0;font-weight:400;font-size:18px">
                                <strong>You are all set.</strong> Your card has been charged, and no further action is required on your part.</p>
                            </div>
                          </div>
                        </div>
                        <!-- /content -->
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  <!-- /BODY -->

          <div class="">
            <button class="btn btn-primary" onclick="window.print()" style="border-color: #1f9d68; background-color: #2bbf7d;"><i class="fa fa-print mr-1"></i> Print</button>
          </div>

  </div>
    <?php } ?>
</section>

<?php
include_once'../parents/footer.php';
?>
