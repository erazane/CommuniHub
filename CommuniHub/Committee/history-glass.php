<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->

<?php
require_once('../Database/database.php'); // Connect to the db.
global $dbc;

// Make the query for the schedule history.
$queryHistory = "SELECT GlassPickupday, Time, DateUpdated
                FROM glassschedule
                ORDER BY glassscheduleID  DESC";
$resultHistory = @mysqli_query($dbc, $queryHistory);
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Schedule History</h2>
            <hr>
            <!-- Button group for switching between current and history -->
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="schedule-glass.php" class="btn btn-secondary ">Current</a>
                <a href="history-glass.php" class="btn btn-primary active">History</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Day</th>
                            <th scope="col">Time</th>
                            <th scope="col">Date Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter=1;
                        while ($historyRow = mysqli_fetch_assoc($resultHistory)) : ?>
                            <tr>
                                <td><?php echo $counter++ ?></td>
                                <td><?php echo $historyRow['GlassPickupday']; ?></td>
                                <td><?php echo $historyRow['Time']; ?></td>
                                <td><?php echo $historyRow['DateUpdated']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
