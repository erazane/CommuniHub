<?php
session_start();
include('include/header.php');
?>
</div>
<?php
// Pagination variables
$results_per_page = 10; // Number of results per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

// Default filter values
$filterStatus = isset($_GET['filterStatus']) ? $_GET['filterStatus'] : '';
$filterOrder = isset($_GET['filterOrder']) ? $_GET['filterOrder'] : 'DESC';

// Calculate the starting point of the results
$offset = ($current_page - 1) * $results_per_page;

// Fetch donations query with filters and pagination
$query = "SELECT DonationID, DonationDesc, DonationName, DonationTarget, DonationCollectAmount, DonationStartDate, DonationEndDate, DonationStatus 
          FROM donation";

// Apply filters
$whereClause = " WHERE 1";
if (!empty($filterStatus)) {
    $whereClause .= " AND DonationStatus = '$filterStatus'";
}

$query .= $whereClause . " ORDER BY DonationID $filterOrder LIMIT $offset, $results_per_page";

$result = mysqli_query($dbc, $query);

// Count total number of results for pagination
$count_query = "SELECT COUNT(*) AS total FROM donation" . $whereClause;
$count_result = mysqli_query($dbc, $count_query);
$row_count = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($row_count / $results_per_page);

?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Donation Dashboard</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-donation.php">Current Donation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-joined.php">Donations Joined</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-donation.php">Add Donations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-history.php">History</a>
                        </li>
                    </ul>
                </div>
                <br>
                <br>
                <!-- Filter -->
                <form class="form-inline justify-content-end mb-4" method="GET" action="">
                    <div class="form-row align-items-center">
                        <div class="col-md-auto mb-2">
                            <label for="filterStatus" class="mr-2">Status:</label>
                            <select class="form-control" id="filterStatus" name="filterStatus">
                                <option value="" <?php if ($filterStatus == '') echo 'selected'; ?>>All</option>
                                <option value="High" <?php if ($filterStatus == 'High') echo 'selected'; ?>>High</option>
                                <option value="Medium" <?php if ($filterStatus == 'Medium') echo 'selected'; ?>>Medium</option>
                                <option value="Low" <?php if ($filterStatus == 'Low') echo 'selected'; ?>>Low</option>
                            </select>
                        </div>
                        <div class="col-md-auto mb-2">
                            <label for="filterOrder" class="mr-2">Order:</label>
                            <select class="form-control" id="filterOrder" name="filterOrder">
                                <option value="DESC" <?php if ($filterOrder == 'DESC') echo 'selected'; ?>>Descending</option>
                                <option value="ASC" <?php if ($filterOrder == 'ASC') echo 'selected'; ?>>Ascending</option>
                            </select>
                        </div>
                        <div class="form-group mb-2 w-100">
                            <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                        </div>
                    </div>
                </form>

                <!-- End Filter -->
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Target</th>
                            <th scope="col">Current Collection</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = ($current_page - 1) * $results_per_page + 1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row['DonationName']; ?></td>
                                <td style="text-align: justify;"><?php echo $row['DonationDesc']; ?></td>
                                <td><?php echo $row['DonationTarget']; ?></td>
                                <td><?php echo $row['DonationCollectAmount']; ?></td>
                                <td><?php echo $row['DonationStartDate']; ?></td>
                                <td><?php echo $row['DonationEndDate']; ?></td>
                                <td><?php echo $row['DonationStatus']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning" onclick="deleteDonation(<?php echo $row['DonationID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-secondary" onclick="editDonation(<?php echo $row['DonationID']; ?>)" data-toggle="modal" data-target="#editDonationModal">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <hr>
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                            <li class="page-item <?php if ($current_page == $page) echo 'active'; ?>">
                                <a class="page-link" href="manage-donation.php?page=<?php echo $page; ?><?php if (!empty($filterStatus)) echo '&filterStatus=' . $filterStatus; ?><?php if (!empty($filterOrder)) echo '&filterOrder=' . $filterOrder; ?>">
                                    <?php echo $page; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
</section>

<!-- Modal for updating donation -->
<div class="modal fade" id="editDonationModal" tabindex="-1" role="dialog" aria-labelledby="editDonationModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDonationModalLabel">Edit Donation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for updating donation details -->
                <form id="update_donation.php" action="update_donation.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editDonationID" name="DonationID" value="">
                    <div class="form-group">
                        <label for="DonationName">Title:</label>
                        <input type="text" class="form-control" id="DonationName" name="DonationName"  value="<?php echo $DonationName?>">
                    </div>
                    <div class="form-group">
                        <label for="editDonationDesc">Description:</label>
                        <textarea class="form-control" id="editDonationDesc" name="DonationDesc" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editDonationTarget">Target:</label>
                        <input type="text" class="form-control" id="editDonationTarget" name="DonationTarget" required>
                    </div>
                    <div class="form-group">
                        <label for="editDonationStartDate">Start Date:</label>
                        <input type="date" class="form-control" id="editDonationStartDate" name="DonationStartDate" required>
                    </div>
                    <div class="form-group">
                        <label for="editDonationEndDate">End Date:</label>
                        <input type="date" class="form-control" id="editDonationEndDate" name="DonationEndDate" required>
                    </div>
                    <div class="form-group">
                        <label for="editDonationStatus">Priority:</label>
                        <select class="form-control" id="editDonationStatus" name="DonationStatus" required>
                            <option value="High">High Priority</option>
                            <option value="Medium">Medium Priority</option>
                            <option value="Low">Low Priority</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDonationStatus">Status:</label>
                        <select class="form-control" id="editDonationStatus" name="status" required>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDonationImage">Image:</label>
                        <input type="file" class="form-control-file" id="editDonationImage" name="image" accept=".jpg, .jpeg, .png">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitUpdate()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
                      // Function to submit the form data
                      function submitForm() {
                        // Submit the form
                        $('#updateDonationForm form').submit();
                      }
                    </script>
                  </div>
<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to delete donation
    function deleteDonation(DonationID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this donation!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-donation.php with DonationID
                window.location.href = 'delete-donation.php?DonationID=' + DonationID;
            }
        });
    }

   

    // Function to submit update form
    // Function to submit update form
    function submitUpdate() {
        // Serialize the form data
        var formData = new FormData($('#updateDonationForm')[0]);

        // Send AJAX request
        $.ajax({
            url: 'update_donation.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success response (if any)
                console.log(response);
                // Close the modal
                $('#editDonationModal').modal('hide');
                // Optionally, you can reload the donation dashboard or perform other actions
                location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                // Optionally, show an error message to the user
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to update donation. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    }
</script>
