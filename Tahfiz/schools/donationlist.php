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

                <h2>Donation List</h2>
                <hr>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="padding-left: 20px; font-weight: 600; background: #19a164; color: #ffffff;">No.</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Donation Title</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Amount Needed</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Start Date</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">End Date</th>
                            <th style="font-weight: 600; background: #19a164; color: #ffffff;">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i=1;
   $don = $connection->query("SELECT * FROM donation WHERE schools_ID='".$_SESSION['schools_ID']."'");
   while($row2 = $don->fetch_array()){
           ?>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?= $i ?>.
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['donationtitle'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">RM
                                <?php echo $row2['donationamount'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo date('d/m/Y', strtotime($row2['donationstartdate'])); ?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo date('d/m/Y', strtotime($row2['donationenddate'])); ?>
                            </td>
                            <td><a class="btn btn-success btn-sm" style="font-size: 13px; font-weight: 500; border-radius: 4px; background: #19a164; border-color: #12774a;" href="donationdetails.php?schools_ID=<?php echo $row2['schools_ID'] ?>& donation_ID=<?php echo $row2['donation_ID'] ?>">View</a></td>
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
