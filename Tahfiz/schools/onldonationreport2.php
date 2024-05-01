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
                <h2>Online Donation Report</h2>
                <hr>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="padding-left: 20px; font-weight: 600; background: #19a164; color: #ffffff;">Payment ID</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Donation ID</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Donation Amount</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Date</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Receipt No.</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
 $don = $connection->query("SELECT * FROM donationpayment WHERE schools_ID='".$_SESSION['schools_ID']."'");
 while($row2 = $don->fetch_array()){
         ?>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?php echo $row2['donpayment_ID'];?>
                            </td>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?php echo $row2['donation_ID'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">RM
                                <?php echo $row2['don_amount'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['don_date'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['receiptno'];?>
                            </td>
                            <td>
                              <a class="btn btn-success btn-sm" style="font-size: 13px; font-weight: 500; border-radius: 4px; background: #19a164; border-color: #12774a;" href="donationdetails.php?schools_ID=<?php echo $_SESSION['schools_ID'] ?>& parents_ID=<?php echo $fetch['parents_ID'] ?>& donation_ID=<?php echo $fetch['donation_ID'] ?>">View</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>

    </div>
</section>

<?php
include_once'../schools/footer.php';
?>
