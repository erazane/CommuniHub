<?php
include_once'../parents/headerreceipt.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
      <div class="jumbotron">
      <?php
    $sch = $connection->query("SELECT * FROM schools WHERE schools_ID='" . $_GET['schools_ID'] . "'");
    while ($fetch = $sch->fetch_array()) {
        ?>
          <br>
          <!--Jumbotron-->
          <div class="jumbotron" style="background: #F4F4F4;">
              <!--Title-->
              <h1 class="text-center">Receipt</h1>
              <hr>
              <!--Subtitle-->
              <div class="row">
                  <div class="col-md-6">
                      <?php
              $cardno = $connection->query("SELECT * FROM parents WHERE parents_ID='".$_SESSION['parents_ID']."'");
              while($row2 = $cardno->fetch_array()){
                      ?>
                      <label class="font-weight-bold black-text align="right"">Name:</label>
                      <label><?php echo $row2['firstname'];?> <?php echo $row2['lastname'];?></label>
                      <?php  } ?>
                  </div>
                  <div class="col-md-6">
                      <?php
                  $org = $connection->query("SELECT schools.*,donation.*
                                              FROM donation
                                              INNER JOIN schools ON schools.schools_ID= donation.schools_ID
                                              WHERE  donation.schools_ID=".$_GET['schools_ID']."");
                  while($fetch = $org->fetch_array()){ ?>
                      <label class="font-weight-bold black-text" style="margin-top: 2px; margin-bottom: 2px;">Donate to:</label>
                      <label><?php echo $fetch['school_name'];?>, <?php echo $fetch['donationtitle'];?></label>
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



          </div>
          <div class="">
            <button class="btn btn-primary" onclick="window.print()" style="border-color: #1f9d68; background-color: #2bbf7d;"><i class="fa fa-print mr-1"></i> Print</button>
          </div>
    </div>
  </div>
    <?php } ?>
</section>

<?php
include_once'../parents/footer.php';
?>
