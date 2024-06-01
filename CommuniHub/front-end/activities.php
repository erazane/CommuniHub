<?php 
session_start();
require_once('include/header.php'); 
?> 
  </div>

  <?php
require_once('../Database/database.php');

$filterType = isset($_GET['filterType']) ? $_GET['filterType'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

$query = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
";
if ($filterType) {
    $query .= " WHERE d.type = '" . mysqli_real_escape_string($dbc, $filterType) . "'";
}

$query .= " ORDER BY d.DiscussionID $filterOrder";
$result = mysqli_query($dbc, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}

$discussions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $discussions[] = $row;
}

$sessionUserID = $_SESSION["UserID"];
$query = "SELECT  
    ActivityID ,ActivityName, ActivityLocation,
    ActivityDate, ActivityTime, ActivityType
    FROM activities
    WHERE ActivityID NOT IN
    (
        SELECT ActivityID
        FROM activitiesjoined
        WHERE activitiesjoined.UserID = '$sessionUserID' 
        
    )
    ORDER BY activities.ActivityID DESC";
$result = @mysqli_query($dbc, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($dbc));
}
?>


<section class="service_section layout_padding">
    <div class="container ">
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
                        <option value="" <?php if ($filterType == '') echo 'selected'; ?>>All</option>
                        <option value="Clean-up Day" <?php if ($filterType == 'Clean-up Day') echo 'selected'; ?>>Clean-up Day</option>
                        <option value="Block-Party" <?php if ($filterType == 'Block-Party') echo 'selected'; ?>>Block-Party</option>
                        <option value="Community-Garden" <?php if ($filterType == 'Community-Garden') echo 'selected'; ?>>Community Garden</option>
                        <option value="Fitness-Classes" <?php if ($filterType == 'Fitness-Classes') echo 'selected'; ?>>Fitness-Classes</option>
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
                    "Other"=> "misc.png",
                   
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
                        <div class="img-box" style="width:auto;" >
                          <img src="images/activity/<?php echo $imagePath; ?>" alt="<?php echo $ActivityType; ?>">
                        </div>
                        <div class="detail-box">
                          
                            <h5><?php echo htmlspecialchars($ActivityName); ?></h5>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($ActivityLocation); ?></p>
                            <p><strong>Date:</strong> <?php echo htmlspecialchars($ActivityDate); ?></p>
                            <p><strong>Time:</strong> <?php echo htmlspecialchars($ActivityTime); ?></p>
                            <p><strong>Type:</strong> <?php echo htmlspecialchars($ActivityType); ?></p>
                        </div>
                        <div class="btn-box">


                        <a href="#" onclick="confirmJoin(<?php echo $row['ActivityID']; ?>);">Join</a>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>

                            function confirmJoin(activityID) {
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "Do you want to join this activity?",
                                    icon: "info",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willJoin) => {
                                    if (willJoin) {
                                        // If the user confirms, redirect to join-activity.php with parameters
                                        window.location.href = `join-activity.php?ActivityID=${activityID}&DateJoined=<?php echo date('Y-m-d'); ?>`;
                                    } else {
                                        // If the user cancels, do nothing
                                    }
                                });
                              }             
                            </script>


                            </div>
                        </div>
                    
                </div>
            <?php
            }
            ?>
            
        </div>
        
    </div>
</section>


  <!-- end service section -->

  <?php include('include/footer.php'); ?>
