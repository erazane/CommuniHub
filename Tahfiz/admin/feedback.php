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
                        <h2 class="title-1">User Feedback</h2>

                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
               $feed = $connection->query("SELECT * FROM feedback");
               while($row2 = $feed->fetch_array()){
                       ?>
                                    <td>
                                        <?php echo $row2['name'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['email'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['date'];?>
                                    </td>
                                    <td>
                                        <?php echo $row2['subject'];?>
                                    </td>
                                    <td><a class="btn btn-outline-primary btn-sm" href="feedbackdetails.php?feedback_ID=<?php echo $row2['feedback_ID'];?>">View</a></td>
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
