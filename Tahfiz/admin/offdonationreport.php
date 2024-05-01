<?php
    include_once'../admin/header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1" style="color: #ff7a00">Offline Donation Report</h2>
                        <button class="btn btn-primary" id="printPageButton" onclick="window.print()" style="border-color: #c65f00; background-color: #ff7a00; box-shadow:0px;"><i class="fa fa-print mr-1"></i> Print</button>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3 text-center">
                            <thead>
                                <tr>
                                    <th>Members Name</th>
                                    <th>Schools Donated</th>
                                    <th>Date</th>
                                    <th>Receipt No.</th>
                                    <th>Amount (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
           $don = $connection->query("SELECT schools.*,donationpaymentoffline.*,parents.*
                                       FROM ((donationpaymentoffline
                                       INNER JOIN schools ON schools.schools_ID= donationpaymentoffline.schools_ID)
                                       INNER JOIN parents ON parents.parents_ID=donationpaymentoffline.parents_ID)");
           while($row2 = $don->fetch_array()){
                   ?>
                                    <td>
                                        <?php echo $row2['firstname'];?> <?php echo $row2['lastname'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['school_name'];?>
                                    </td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($row2['donoff_date'])); ?>
                                    </td>
                                    <td>
                                        <?php echo $row2['receiptno'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['don_amount'];?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->
</div>

</div>

<?php
    include_once'../admin/footer.php';
?>
