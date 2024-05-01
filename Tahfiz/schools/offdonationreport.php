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
                <h2>Donation Report</h2>
                <hr>
                <div class="submit-button">
                    <a class="btn2" href="onldonationreport.php" style="border:none; margin: 0px 0 15px 0; background: #ababab; transform:none;">Online</a>

                    <a class="btn2" href="offdonationreport.php" style="border:none; margin: 0px 0 15px 0; background: #118f56; transform:none;">Offline</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="padding-left: 20px; font-weight: 600; background: #118f56; color: #ffffff;">No.</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Donation Title</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Members Name</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Amount</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Date</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Receipt No.</th>
                            <th style="font-weight: 600; background: #118f56; color: #ffffff;">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i=1;
$don = $connection->query("SELECT schools.*,donationpaymentoffline.*,parents.*,donation.*
                          FROM (((donationpaymentoffline
                          INNER JOIN schools ON schools.schools_ID= donationpaymentoffline.schools_ID)
                          INNER JOIN donation ON donation.donation_ID= donationpaymentoffline.donation_ID)
                          INNER JOIN parents ON parents.parents_ID=donationpaymentoffline.parents_ID)
                          WHERE  donationpaymentoffline.schools_ID=".$_SESSION['schools_ID']."");
                          while($row2 = $don->fetch_array()){
                          ?>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?= $i ?>.
                            </td>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?php echo $row2['donationtitle'];?>
                            </td>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?php echo $row2['firstname'];?>
                                <?php echo $row2['lastname'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">RM
                                <?php echo $row2['don_amount'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo date('d/m/Y', strtotime($row2['donoff_date'])); ?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['receiptno'];?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm" style="font-size: 13px; font-weight: 500; border-radius: 4px; background: #19a164; border-color: #12774a;" href="../images/<?php echo $row2['donoff_receipt'];?>">View Receipt</a>
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
