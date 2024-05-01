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
                        <h2 class="title-1">School Approval Request</h2>

                    </div>
                    <p style="color: #ff7a00">
                        <i>*Pending schools</i>
                    </p>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>School ID</th>
                                    <th>School Name</th>
                                    <th>State</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
               $don = $connection->query("SELECT * FROM schools WHERE status = 'pending'");
               while($row2 = $don->fetch_array()){
                       ?>
                                    <td>
                                        <?php echo $row2['schools_ID'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['school_name'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['state'];?>
                                    </td>
                                    <?php if($row2['status'] =='Pending'){?>
                                    <td class="denied">
                                        <?php echo $row2['status'];?>
                                    </td>
                                    <?php   } else { ?>
                                    <td class="process">
                                        <?php echo $row2['status'];?>
                                    </td>
                                    <?php } ?>
                                    <td><a class="btn btn-outline-primary btn-sm" href="schoolauthdetails.php?schools_ID=<?php echo $row2['schools_ID'];?>">View</a></td>
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
