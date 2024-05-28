<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Get user ID
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';
$UserID = $_SESSION["UserID"];

$query = "SELECT c.ComplaintID, c.ComplainTitle, c.ComplaintDesc, c.ComplaintDate, c.ComplaintType, c.UserID, c.image, 
                 r.respondDate, r.respondTitle, r.respondDesc
          FROM complaint c 
          JOIN respondComplaint r ON c.ComplaintID = r.ComplaintID
          WHERE r.status = 'Completed' AND c.UserID = '$UserID'
          ORDER BY c.ComplaintDate $filterOrder";

$result = mysqli_query($dbc, $query); // Run the query

// Check if query was successful
if (!$result) {
    // Display error message and exit if query fails
    echo "Error: " . mysqli_error($dbc);
    exit();
}
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity History</h2>
            <hr>
        </div>
        <div class="row justify-content-between align-items-center mt-3">
            <div class="col-md-3">
                <a class="btn btn-primary" href="pending-complaints.php">Pending</a>
                <a class="btn btn-primary active" href="resolved-complaints.php">History</a>
            </div>
            <div class="col-md-9">
                <!-- Filter Form -->
                <form class="form-inline justify-content-end" method="GET" action="">
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
            <div class="col-lg-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">Image</th>
                            <th scope="col">Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['ComplainTitle']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['ComplaintDesc']; ?></td>
                                <td><?php echo $row['ComplaintType']; ?></td>
                                <td><?php echo $row['ComplaintDate']; ?></td>
                                <td>
                                    <?php if (!empty($row['image'])) : ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageModal<?php echo $row['ComplaintID']; ?>">
                                            View 
                                        </button>
                                    <?php else : ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#responseModal<?php echo $row['ComplaintID']; ?>">Response</button>
                                </td>
                            </tr>

                            <!-- Image Modal -->
                            <div class="modal fade" id="imageModal<?php echo $row['ComplaintID']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $row['ComplaintID']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel<?php echo $row['ComplaintID']; ?>"><?php echo $row['ComplainTitle']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="profile_picture_container text-center mb-4" style="padding: 10%;">
                                                <img class="img-fluid" src="../front-end/images/complaint/<?php echo $row['image'] ? $row['image'] : "nodata.jpg"; ?>" alt="<?php echo $row['ComplainTitle']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Response Modal -->
                            <div class="modal fade" id="responseModal<?php echo $row['ComplaintID']; ?>" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel<?php echo $row['ComplaintID']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="responseModalLabel<?php echo $row['ComplaintID']; ?>">Response to: <?php echo $row['ComplainTitle']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="responseDate<?php echo $row['ComplaintID']; ?>">Response Date:</label>
                                                <p id="responseDate<?php echo $row['ComplaintID']; ?>"><?php echo $row['respondDate']; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="responseTitle<?php echo $row['ComplaintID']; ?>">Response Title:</label>
                                                <p id="responseTitle<?php echo $row['ComplaintID']; ?>"><?php echo $row['respondTitle']; ?></p>
                                            </div>
                                            <div class="form-group">
                                                <label for="responseDesc<?php echo $row['ComplaintID']; ?>">Response Description:</label>
                                                <p id="responseDesc<?php echo $row['ComplaintID']; ?>"><?php echo $row['respondDesc']; ?></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary me-md-2" href="UserProfile-read.php">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
