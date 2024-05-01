<?php
include_once'../schools/header.php';
?>

<div class="bg">
    <div class="container">
    </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row">
          <div class="text-center">
              <?php
                     $admin = $connection->query("SELECT * FROM donation WHERE schools_ID='".$_SESSION['schools_ID']."'");
                     while($row2 = $admin->fetch_array()){
              ?>
              <h2>Donation List</h2>
              <hr>
          </div>
          <div class="col-md-8">
            <table class="table table-borderless table-data3">
              <thead>
                  <tr>
                      <th style="padding-left: 20px; font-weight: 600; background: #e4e3e3;">Parents ID</th>
                      <th style="font-weight: 600; background: #e4e3e3;">Donors Name</th>
                      <th style="font-weight: 600; background: #e4e3e3;">Amount Needed</th>
                      <th style="font-weight: 600; background: #e4e3e3;">Date</th>
                      <th style="font-weight: 600; background: #e4e3e3;">Donation Title</th>
                      <th style="font-weight: 600; background: #e4e3e3;">Receipt No.</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <?php
   $don = $connection->query("SELECT * FROM donationpayment WHERE schools_ID='".$_SESSION['schools_ID']."'");
   while($row2 = $don->fetch_array()){
           ?>
                      <td style="font-size: 16px; padding-left: 20px; font-weight: 500;"><?php echo $row2['donpayment_ID'];?></td>
                      <td style="font-size: 16px; font-weight: 500;"><?php echo $row2['donationtitle'];?></td>
                      <td style="font-size: 16px; font-weight: 500;">RM <?php echo $row2['donationamount'];?></td>
                      <td style="font-size: 16px; font-weight: 500;"><?php echo $row2['donationstartdate'];?></td>
                      <td style="font-size: 16px; font-weight: 500;"><?php echo $row2['donationenddate'];?></td>
                      <td><a class="btn btn-primary btn-sm" href="schoollistdetails.php?schools_ID=<?php echo $row2['schools_ID'];?>">View</a></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>



          <?php } ?>
        </div>
        <br>

    </div>
</section>

<?php
include_once'../schools/footer.php';
?>
