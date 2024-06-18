<?php
session_start();
include('include/header.php');
require_once('../Database/database.php');

$counter = 1; // Initialize counter

// Fetch the latest schedules for different types of waste
$schedules = [];

// General waste schedule
$query = "SELECT 'General Waste' as Type, GarbageDay as Day, Time, DateUpdated FROM schedule ORDER BY ScheduleID DESC LIMIT 1";
$garbageResult = mysqli_query($dbc, $query);
if ($garbageResult && mysqli_num_rows($garbageResult) > 0) {
    $schedules[] = mysqli_fetch_assoc($garbageResult);
} else {
    $schedules[] = ['Type' => 'General Waste', 'Day' => '-', 'Time' => '-', 'DateUpdated' => '-'];
}

// Glass schedule
$query = "SELECT 'Glass' as Type, GlassPickupday as Day, Time, DateUpdated FROM glassSchedule ORDER BY glassScheduleID DESC LIMIT 1";
$glassResult = mysqli_query($dbc, $query);
if ($glassResult && mysqli_num_rows($glassResult) > 0) {
    $schedules[] = mysqli_fetch_assoc($glassResult);
} else {
    $schedules[] = ['Type' => 'Glass', 'Day' => '-', 'Time' => '-', 'DateUpdated' => '-'];
}

// Paper schedule
$query = "SELECT 'Paper' as Type, PaperPickupDay as Day, Time, DateUpdated FROM paperSchedule ORDER BY paperScheduleID DESC LIMIT 1";
$paperResult = mysqli_query($dbc, $query);
if ($paperResult && mysqli_num_rows($paperResult) > 0) {
    $schedules[] = mysqli_fetch_assoc($paperResult);
} else {
    $schedules[] = ['Type' => 'Paper', 'Day' => '-', 'Time' => '-', 'DateUpdated' => '-'];
}

// Plastic schedule
$query = "SELECT 'Plastic' as Type, PlasticPickupDay as Day, Time, DateUpdated FROM plasticSchedule ORDER BY plasticScheduleID DESC LIMIT 1";
$plasticResult = mysqli_query($dbc, $query);
if ($plasticResult && mysqli_num_rows($plasticResult) > 0) {
    $schedules[] = mysqli_fetch_assoc($plasticResult);
} else {
    $schedules[] = ['Type' => 'Plastic', 'Day' => '-', 'Time' => '-', 'DateUpdated' => '-'];
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
                            <a class="nav-link" href="paper.php">Paper</a>
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
                            <th scope="col">No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Day</th>
                            <th scope="col">Time</th>
                            <th scope="col">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedules as $schedule) : ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($schedule['Type']); ?></td>
                            <td><?php echo htmlspecialchars($schedule['Day']); ?></td>
                            <td><?php echo htmlspecialchars($schedule['Time']); ?></td>
                            <td><?php echo htmlspecialchars($schedule['DateUpdated']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function updateSchedule(type) {
        Swal.fire({
            title: 'Update Schedule',
            text: 'Do you want to update the schedule for ' + type + '?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to update schedule page
                window.location.href = 'update-schedule.php?type=' + encodeURIComponent(type);
            }
        });
    }
</script>
