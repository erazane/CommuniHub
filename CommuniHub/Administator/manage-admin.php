<?php 
session_start();
include('include/header.php');
?>

<!-- end header section -->
</div>

<?php
require_once('../Database/database.php');

// Make the query
$query = "SELECT adminID, adminName, adminUserName, adminPwd FROM admin ORDER BY adminID ASC";
$result = mysqli_query($dbc, $query); // Run the query
?>

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Activity Board</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="pillbox border">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="manage-admin.php">Active Administrator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-admin.php">Add Administrator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">History</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['adminID']; ?></td>
                            <td><?php echo $row['adminName']; ?></td>
                            <td><?php echo $row['adminUserName']; ?></td>
                            <td>
                                <div class="btn-group" style="padding: 5;">
                                    <br><br>
                                    <button type="button" class="btn btn-secondary" onclick="deleteAdmin(<?php echo $row['adminID']; ?>)">Delete Admin</button>
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
    function deleteAdmin(adminID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this admin!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete-admin.php with adminID
                window.location.href = 'delete-admin.php?adminID=' + adminID;
            }
        });
    }
</script>
