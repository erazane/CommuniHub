<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Fetch filter values
$filterType = isset($_GET['filterType']) ? mysqli_real_escape_string($dbc, $_GET['filterType']) : '';
$filterOrder = isset($_GET['filterOrder']) ? mysqli_real_escape_string($dbc, $_GET['filterOrder']) : 'DESC';

// Pagination settings
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Make the query with filters and pagination
$query = "
    SELECT a.ActivityID, a.Activityname, a.ActivityLocation, a.ActivityDate, a.ActivityTime, a.ActivityType, a.Status,
           COUNT(aj.UserID) AS NumJoined
    FROM activities a
    LEFT JOIN activitiesJoined aj ON a.ActivityID = aj.ActivityID
    WHERE a.Status = 'Ongoing'";

if ($filterType) {
    $query .= " AND a.ActivityType = '$filterType'";
}

$query .= " GROUP BY a.ActivityID, a.Activityname, a.ActivityLocation, a.ActivityDate, a.ActivityTime, a.ActivityType, a.Status";
$query .= " ORDER BY a.ActivityDate $filterOrder, a.ActivityTime $filterOrder";
$query .= " LIMIT $limit OFFSET $offset";

$result = mysqli_query($dbc, $query);

// Check if query was successful
if (!$result) {
    // Display error message and exit if query fails
    echo "Error: " . mysqli_error($dbc);
    exit();
}

// Count total records for pagination
$countQuery = "
    SELECT COUNT(*) AS total
    FROM activities
    WHERE Status = 'Ongoing'";

if ($filterType) {
    $countQuery .= " AND ActivityType = '$filterType'";
}

$countResult = mysqli_query($dbc, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRecords / $limit);
?>


<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-activities.php">Current Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities-joined.php">Activities joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-activities.php">Add Activities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="activities-history.php">History</a>
                        </li>
                    </ul>
                </div>
                <!-- Filter form -->
                <form class="form-inline justify-content-end" method="GET" action="">
                    <div class="form-row align-items-center">
                        <div class="col-auto mb-2">
                            <label for="filterType" class="mr-2">Type:</label>
                            <select class="form-control" id="filterType" name="filterType">
                                <option value="">All</option>
                                <option value="Clean-up Day" <?= ($filterType == 'Clean-up Day') ? 'selected' : '' ?>>Clean-up Day</option>
                                <option value="Block-Party" <?= ($filterType == 'Block-Party') ? 'selected' : '' ?>>Block-Party</option>
                                <option value="Community-Garden" <?= ($filterType == 'Community-Garden') ? 'selected' : '' ?>>Community Garden</option>
                                <option value="Fitness-Classes" <?= ($filterType == 'Fitness-Classes') ? 'selected' : '' ?>>Fitness-Classes</option>
                                <option value="Holiday-Celebrations" <?= ($filterType == 'Holiday-Celebrations') ? 'selected' : '' ?>>Holiday Celebrations</option>
                                <option value="Workshops" <?= ($filterType == 'Workshops') ? 'selected' : '' ?>>Workshops</option>
                                <option value="Other" <?= ($filterType == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-auto mb-2">
                            <label for="filterOrder" class="mr-2">Order:</label>
                            <select class="form-control" id="filterOrder" name="filterOrder">
                                <option value="DESC" <?= ($filterOrder == 'DESC') ? 'selected' : '' ?>>Descending</option>
                                <option value="ASC" <?= ($filterOrder == 'ASC') ? 'selected' : '' ?>>Ascending</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 w-100">
                            <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Location</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Type</th>
                            <th scope="col">Participation</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter=1;
                         while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $row['Activityname']; ?></td>
                            <td style="text-align: justify;"><?php echo $row['ActivityLocation']; ?></td>
                            <td><?php echo $row['ActivityDate']; ?></td>
                            <td><?php echo $row['ActivityTime']; ?></td>
                            <td><?php echo $row['ActivityType']; ?></td>
                            <td><?php echo $row['NumJoined']; ?></td>
                            <td><?php echo$row['Status'];?></td>
                            <td>
                                     <div class="btn-group">
                                    <button type="button" class="btn btn-warning" onclick="deleteActivity(<?php echo $row['ActivityID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i> </button>

                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#UpdateActivity" data-activityid="<?php echo $row['ActivityID']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                     </div>
                                    <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#UpdateActivity">Update</button> -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="UpdateActivity" tabindex="-1" role="dialog" aria-labelledby="UpdateActivityTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Activity</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <?php
                                                $activityName = '';
                                                $activityLocation = '';
                                                $activityDate = '';
                                                $activityTime = '';
                                                $activityType = '';
                                                $status = '';

                                                    if (isset($_GET["ActivityID"])) {
                                                        $activityID = mysqli_real_escape_string($dbc, $_GET['ActivityID']);
                                                        
                                                        // Query to fetch activity data based on ActivityID
                                                        $query = "SELECT * FROM activities WHERE ActivityID = $activityID";
                                                        $result = mysqli_query($dbc, $query);
                                                    
                                                        if ($result && mysqli_num_rows($result) == 1) {
                                                            $row = mysqli_fetch_assoc($result);
                                                    
                                                            // Assign fetched activity data to variables
                                                            $activityName = $row["Activityname"];
                                                            $activityLocation = $row['ActivityLocation'];
                                                            $activityDate = $row['ActivityDate'];
                                                            $activityTime = $row['ActivityTime'];
                                                            $activityType = $row['ActivityType'];
                                                            $status = $row['Status'];
                                                        } else {
                                                            // Handle error if no activity found
                                                            echo "Error: Unable to fetch activity data.";
                                                        }
                                                    }
                                                    ?>

                                                    <section class="user_profile_section layout_padding">
                                                        <div class="container">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-10">
                                                                    <div class="update_container">
                                                                    <form id="updateActivitiesForm" action="#" method="POST" enctype="multipart/form-data">
                                                                    <h4><strong>Fill out the form below to update current activity</strong></h4>
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <label for="ActivityName">Title:</label>
                                                                        
                                                                        <!-- <input type="text" class="form-control" id="ActivityName" name="ActivityName" value="<?php if(isset($ActivityName)) echo $ActivityName ?>" > -->
                                                                        <input type="text" class="form-control" id="ActivityName" name="ActivityName" value="<?php echo $activityName; ?>" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ActivityLocation">Location:</label>
                                                                        <textarea class="form-control" id="ActivityLocation" name="ActivityLocation" rows="5"><?php echo $activityLocation; ?></textarea>
                                                                        <!-- <textarea class="form-control" id="ActivityLocation" name="ActivityLocation" rows="5" value="<?php if (isset($ActivityLocation)) echo $ActivityLocation ?>"></textarea> -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ActivityDate">Date:</label>
                                                                        <input type="date" class="form-control" id="ActivityDate" name="ActivityDate" value="<?php echo $activityDate; ?>" >
                                                                        <!-- <input type="date" class="form-control" id="ActivityDate" name="ActivityDate" value="<?php if(isset($ActivityDate)) echo $ActivityDate ?>" > -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ActivityTime">Time:</label>
                                                                        <input type="time" class="form-control" id="ActivityTime" name="ActivityTime" value="<?php echo $activityTime; ?>" >
                                                                        <!-- <input type="time" class="form-control" id="ActivityTime" name="ActivityTime" value="<?php if(isset($ActivityTime)) echo $ActivityTime ?>" > -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ActivityType">Activity Type:</label>
                                                                        <select class="form-control" id="ActivityType" name="ActivityType">
                                                                            <option value="" disabled selected>Select Type</option>
                                                                            <option value="Clean-up Day" <?php if (isset($activityType) && $activityType == 'Clean-up Day') echo 'selected="selected"'; ?>>Clean-up Day</option>
                                                                            <option value="Block-Party" <?php if (isset($activityType) && $activityType == 'Block-Party') echo 'selected="selected"'; ?>>Block Party</option>
                                                                            <option value="Community-Garden" <?php if (isset($activityType) && $activityType == 'Community-Garden') echo 'selected="selected"'; ?>>Community Gardening</option>
                                                                            <option value="Fitness-Classes" <?php if (isset($activityType) && $activityType == 'Fitness-Classes') echo 'selected="selected"'; ?>>Fitness-Classes</option>
                                                                            <option value="Holiday-Celebrations" <?php if (isset($activityType) && $activityType == 'Holiday-Celebrations') echo 'selected="selected"'; ?>>Holiday Celebrations</option>
                                                                            <option value="Workshops" <?php if (isset($activityType) && $activityType == 'Workshops') echo 'selected="selected"'; ?>>Workshops</option>
                                                                            <option value="Other" <?php if (isset($activityType) && $activityType == 'Other') echo 'selected="selected"'; ?>>Other..</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="Status">Status:</label>
                                                                        <select class="form-control" id="Status" name="Status" required>
                                                                            <option value="" disabled selected>Select status</option>
                                                                            <option value="Ongoing" <?php if (isset($status) && $status == 'Ongoing') echo 'selected="selected"'; ?>>Ongoing</option>
                                                                            <option value="Completed" <?php if (isset($status) && $status == 'Completed') echo 'selected="selected"'; ?>>Completed</option>
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" id="ActivityID" name="ActivityID" value="">
                                                                    
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="updateActivities(<?php echo $row['ActivityID'];?>)">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal -->
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>">Previous</a></li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>&filterType=<?= $filterType ?>&filterOrder=<?= $filterOrder ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>
            
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteActivity(ActivityID) {
        console.log("Deleting activity with ID: " + ActivityID);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-activities.php with ActivityID
                window.location.href = 'delete-activities.php?ActivityID=' + ActivityID;
            }
        });
    }
</script>

<script>
    function updateActivities(ActivityID) {
        console.log("Updating activity with ID: " + ActivityID);
        Swal.fire({
            title: 'Update this activity?',
            text: 'You will not be able to undo this.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#ActivityID').val(ActivityID);
                $('#UpdateActivity form').submit();
                // Redirect to update-activities.php with ActivityID
                // window.location.href = 'update-activity.php?ActivityID=' + ActivityID;
            }
        });
    }
</script>


<?php include('include/footer.php'); ?>