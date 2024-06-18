<?php
session_start();
include('include/header.php');

$counter = 1;
// Fetch data for garbage schedule
$query = "SELECT GarbageDay, Time, DateUpdated FROM schedule ORDER BY ScheduleID DESC LIMIT 1";
$garbageResult = mysqli_query($dbc, $query);

if (!$garbageResult) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Fetch data for glass schedule
$query = "SELECT GlassPickupday, Time, DateUpdated FROM glassSchedule ORDER BY glassScheduleID DESC LIMIT 1";
$glassResult = mysqli_query($dbc, $query);

if (!$glassResult) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Fetch data for paper schedule
$query = "SELECT PaperPickupDay, Time, DateUpdated FROM paperSchedule ORDER BY paperScheduleID DESC LIMIT 1";
$paperResult = mysqli_query($dbc, $query);

if (!$paperResult) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Fetch data for plastic schedule
$query = "SELECT PlasticPickupDay, Time, DateUpdated FROM plasticSchedule ORDER BY plasticScheduleID DESC LIMIT 1";
$plasticResult = mysqli_query($dbc, $query);

if (!$plasticResult) {
    die('Query failed: ' . mysqli_error($dbc));
}
?>
</div>
<!-- end header section -->

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Schedule Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-schedule-admin.php">Current Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="waste.php">General waste</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paper.php">Paper </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="plastic.php">Plastic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="glass.php">Glass</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Day</th>
                            <th scope="col">Time</th>
                            <th scope="col">Last Updated</th>            
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $counter++; ?></td> 
                            <td><?php echo $row['UserFirstName']; ?></td>
                            <td><?php echo $row['UserLastName']; ?></td>
                            <td><?php echo $row['UserUserName']; ?></td>
                            <td><?php echo $row['UserAge']; ?></td>
                            <td><?php echo $row['UserMartialStatus']; ?></td>
                            <td><?php echo $row['UserOccupation']; ?></td>
                            <td><?php echo $row['UserContactDetails']; ?></td>
                            <td><?php echo ($row['CommiteeID']) ? "Committee" : "Resident"; ?></td> 
                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    <button type="button" class="btn btn-secondary" onclick="deleteUser(<?php echo $row['UserID']; ?>)">Delete </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php include('include/footer.php'); ?>
