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
          <br>
          <!--Jumbotron-->
          <div class="jumbotron text-center" style="background: #F4F4F4;">
              <!--Title-->
              <h4 class="card-title h4-responsive font-bold mt-0 font-weight-bold">Checkout donation</h4>
              <hr>
              <!--Subtitle-->
              <div class="row">
                  <div class="col-4">
                      <?php
              $cardno = $connection->query("SELECT card_no FROM payment WHERE parents_ID='".$_SESSION['parents_ID']."'");
              while($row2 = $cardno->fetch_array()){
                      ?>
                      <label class="font-weight-bold black-text">Your Card Number:</label>
                      <input type="text" id="namecard" class="form-control text-center" name="cardno" placeholder="Example: 9822876512439877" readonly="readonly" value="<?php echo $row2['card_no'];?>">
                      <?php  } ?>
                  </div>
                  <div class="col-4">
                      <?php
                  $org = $connection->query("SELECT schools.*,donation.*
                                              FROM donation
                                              INNER JOIN schools ON schools.schools_ID= donation.schools_ID
                                              WHERE  donation.schools_ID=".$_GET['schools_ID']."");
                  while($fetch = $org->fetch_array()){ ?>
                      <label class="font-weight-bold black-text" style="margin-top: 2px; margin-bottom: 2px;">Donate To:</label>
                      <input type="text" id="namecard" class="form-control text-center" name="school_name" placeholder="Example: 9822876512439877" readonly="readonly" value="<?php echo $fetch['school_name'];?>, <?php echo $fetch['donationtitle'];?>">
                      <?php  } ?>
                  </div>
                  <div class="col-4">
                      <?php
                 $payment = $connection->query("SELECT don_amount FROM donationpayment WHERE schools_ID='".$_GET['schools_ID']."'&&parents_ID='".$_SESSION['parents_ID']."'&&receiptno='".$_GET['receiptno']."' ");
                 while($row = $payment->fetch_array()){ ?>
                      <label class="font-weight-bold black-text" style="margin-top: 2px; margin-bottom: 2px;">Amount(RM):</label>
                      <input type="text" id="namecard" class="form-control text-center" name="tempamount" placeholder="Example: 9822876512439877" readonly="readonly" value="<?php echo $row['don_amount'];?>">
                      <?php  } ?>
                  </div>
              </div>
              <br />


              <button class="btn btn-danger" style="border-color: #ee8100; background-color: #ff9b25;">
              <a href="donation.php" style="color: #ffffff" class="btn btn-outline-black btn-rounded waves-effect">Cancel</a>
              </button>

              <button class="btn btn-primary" style="border-color: #1f9d68; background-color: #2bbf7d;">
                  <a class="btn" style="color: #ffffff" href="donationreceipt.php?schools_ID=<?php echo $_GET['schools_ID']; ?>& donation_ID=<?php echo $_GET['donation_ID']; ?>& receiptno=<?php echo $_GET['receiptno']; ?>">Confirm</a>
              </button>
          </div>

    </div>
    <?php } ?>
</section>

<?php
include_once'../parents/footer.php';
?>
