
<?php
session_start();
include('include/header.php');
?>
</div>
<!-- end header section -->
<?php
require_once('../Database/database.php');

// Make the query
$query = "SELECT DonationID, DonationDesc, DonationName, DonationTarget,DonationCollectAmount, DonationStartDate, DonationEndDate, DonationStatus 
 FROM donation WHERE status='Ongoing' ORDER BY DonationID ASC";

$result = mysqli_query($dbc, $query); // Run the query



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
                        $counter=1;
                        while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td><?php echo $row['DonationName']; ?></td>
                            <td style="text-align: justify;"><?php echo $row['DonationDesc']; ?></td>
                            <td><?php echo $row['DonationTarget']; ?></td>
                            <td><?php echo $row['DonationCollectAmount']?></td>
                            <td><?php echo $row['DonationStartDate']; ?></td>
                            <td><?php echo $row['DonationEndDate']; ?></td>
                            <td><?php echo $row['DonationStatus']; ?></td>
                            
                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    <button type="button" class="btn btn-warning" onclick="deleteDonation(<?php echo $row['DonationID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                                    <button type="button" class="btn btn-secondary" onclick="UpdateDonation(<?php echo $row['DonationID']; ?>)"><i class="fa fa-pencil" aria-hidden="true"></i> </button>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteDonation(DonationID) {
        console.log("Deleting donation with ID: " + DonationID);
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
                // Redirect to delete-admin.php with adminID
                window.location.href = 'delete-donation.php?DonationID=' + DonationID;
            }
        });
    }
</script>
