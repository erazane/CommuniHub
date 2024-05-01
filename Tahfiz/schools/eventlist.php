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

                <h2>Events List</h2>
                <hr>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th style="padding-left: 20px; font-weight: 600; background: #3880FF; color: #ffffff;">No.</th>
                            <th style="font-weight: 600; background: #3880FF; color: #ffffff;">Title</th>
                            <th style="font-weight: 600; background: #3880FF; color: #ffffff;">Venue</th>
                            <th style="font-weight: 600; background: #3880FF; color: #ffffff;">Date</th>
                            <th style="font-weight: 600; background: #3880FF; color: #ffffff;">Time</th>
                            <th style="font-weight: 600; background: #3880FF; color: #ffffff;">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i=1;
   $don = $connection->query("SELECT * FROM event WHERE schools_ID='".$_SESSION['schools_ID']."'");
   while($row2 = $don->fetch_array()){
           ?>
                            <td style="font-size: 15px; padding-left: 20px; font-weight: 500;">
                                <?= $i ?>.
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['eventtitle'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo $row2['eventvenue'];?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo date('d/m/Y', strtotime($row2['eventstartdate'])); ?>
                            </td>
                            <td style="font-size: 15px; font-weight: 500;">
                                <?php echo date('h:i A', strtotime($row2['eventtime'])); ?>
                            </td>
                            <td><a class="btn btn-primary btn-sm" style="font-size: 13px; font-weight: 600; border-radius: 4px;" href="eventview.php?event_ID=<?php echo $row2['event_ID'];?>& schools_ID=<?php echo $_SESSION['schools_ID'] ?>">View</a></td>
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
