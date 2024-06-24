<?php 
session_start();
require_once('include/header.php'); 
?>
</div>

<?php
require_once('../Database/database.php');

// Check if the user is logged in
if (!isset($_SESSION["UserID"])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

$sessionUserID = $_SESSION["UserID"];

// Filter settings
$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Fetch available ongoing activities
$query = "SELECT  
    ActivityID, ActivityName, ActivityLocation, ActivityDate, ActivityTime, ActivityType
    FROM activities
    WHERE ActivityID NOT IN
    (
        SELECT ActivityID
        FROM activitiesjoined
        WHERE activitiesjoined.UserID = '$sessionUserID'
    )
    AND Status = 'Ongoing'"; // Only ongoing activities

// Apply type filter if selected
if (!empty($filterType)) {
    $query .= " AND ActivityType = '" . mysqli_real_escape_string($dbc, $filterType) . "'";
}

// Apply order filter
$query .= " ORDER BY ActivityDate $filterOrder, ActivityTime $filterOrder"; // Sort by date and time

$result = mysqli_query($dbc, $query);
if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}

// Handle joining activity
if (isset($_GET['ActivityID']) && isset($_GET['DateJoined'])) {
    $ActivityID = mysqli_real_escape_string($dbc, $_GET['ActivityID']);
    $DateJoined = mysqli_real_escape_string($dbc, $_GET['DateJoined']);

    $query = "INSERT INTO activitiesjoined (ActivityID, UserID, DateJoined) VALUES ('$ActivityID', '$sessionUserID', '$DateJoined')";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $_SESSION['status'] = "Successfully joined the activity!";
        $_SESSION['status_code'] = "success";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($dbc);
        $_SESSION['status_code'] = "error";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<section class="service_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Activity Board</h2>
        </div>
        <div class="row justify-content-between align-items-center mt-3">
            <div class="col-md-9">
                <!-- Filter Form -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-group mb-2">
                        <label for="filterType" class="mr-2">Type:</label>
                        <select class="form-control" id="filterType" name="filterType">
                            <option value="">All</option>
                            <option value="Clean-up Day" <?php if ($filterType == 'Clean-up Day') echo 'selected'; ?>>Clean-up Day</option>
                            <option value="Block-Party" <?php if ($filterType == 'Block-Party') echo 'selected'; ?>>Block-Party</option>
                            <option value="Community-Garden" <?php if ($filterType == 'Community-Garden') echo 'selected'; ?>>Community Garden</option>
                            <option value="Fitness-Classes" <?php if ($filterType == 'Fitness-Classes') echo 'selected'; ?>>Fitness Classes</option>
                            <option value="Holiday-Celebrations" <?php if ($filterType == 'Holiday-Celebrations') echo 'selected'; ?>>Holiday Celebrations</option>
                            <option value="Workshops" <?php if ($filterType == 'Workshops') echo 'selected'; ?>>Workshops</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="filterOrder" class="mr-2">Order:</label>
                        <select class="form-control" id="filterOrder" name="filterOrder">
                            <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
                </form>
            </div>
        </div>
        <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $ActivityID = $row['ActivityID'];
                $ActivityName = $row['ActivityName'];
                $ActivityLocation = $row['ActivityLocation'];
                $ActivityDate = $row['ActivityDate'];
                $ActivityTime = $row['ActivityTime'];
                $ActivityType = $row['ActivityType'];

                // Define an associative array to map activity types to image paths
                $activityImages = array(
                    "Clean-up Day" => "cleanup.png",
                    "Block-Party" => "party.png",
                    "Community-Garden" => "gardening.png",
                    "Fitness-Classes" => "fitness.png",
                    "Holiday-Celebrations" => "holidays.png",
                    "Workshops" => "workshop.png",
                    "Others" => "misc.png",
                );

                // Check if the activity type has an associated image
                if (array_key_exists($ActivityType, $activityImages)) {
                    $imagePath = $activityImages[$ActivityType];
                } else {
                    // Default image path if no specific image is defined for the activity type
                    $imagePath = "default.jpg";
                }
            ?>
                <div class="col-sm-6 col-md-4 mx-auto">
                    <div class="box">
                        <div class="img-box" style="width:auto;">
                            <img src="images/activity/<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($ActivityType); ?>">
                        </div>
                        <div class="detail-box">
                            <h5><?php echo htmlspecialchars($ActivityName); ?></h5>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($ActivityLocation); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($ActivityDate); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($ActivityTime); ?></p>
                            <p><strong>Type:</strong> <?php echo htmlspecialchars($ActivityType); ?></p>
                        </div>
                        <div class="btn-box">
                            <a href="#" onclick="confirmJoin(<?php echo $ActivityID; ?>);">Join</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmJoin(activityID) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to join this activity?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Yes, join it!",
        cancelButtonText: "No, cancel!"
    }).then((result) => {
        if (result.isConfirmed) {
            let dateJoined = new Date().toISOString().slice(0, 10); // Get current date in YYYY-MM-DD format
            window.location.href = `?ActivityID=${activityID}&DateJoined=${dateJoined}`;
        }
    });
}
</script>

<?php include('include/footer.php'); ?>
