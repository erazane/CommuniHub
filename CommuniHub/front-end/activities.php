<?php 
session_start();
require_once('include/header.php'); 
?>

    <!-- end header section -->
  </div>

  <?php
require_once('../Database/database.php');

$sessionUserID = $_SESSION["UserID"];
// $query = "SELECT  
//     ActivityID,ActivityName, ActivityLocation,
//     ActivityDate, ActivityTime, ActivityType
//     FROM activities
//     ORDER BY ActivityID DESC";
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
                            <script>

                            function confirmJoin(activityID) {
                                swal({
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
