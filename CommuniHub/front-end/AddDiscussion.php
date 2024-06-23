<?php
session_start();
require_once('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php'); // Include database connection file

if (isset($_POST['title']) && isset($_POST['description'])) {
    $UserID = $_SESSION["UserID"];  // Assuming the UserID is stored in the session
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date("d-m-y H:i:s");  // Get the current date and time

    if (!empty($title) && !empty($description)) {
        $query = "INSERT INTO discussion (UserID, title, description, date)
                  VALUES ('$UserID', '$title', '$description', '$date')";

        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            $_SESSION['status'] = "Successful";
            $_SESSION['status_code'] = "success";
            header('Location: Discussion.php');
            exit();
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($dbc);
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Unable to insert data";
        $_SESSION['status_code'] = "error";
        
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<br>
<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Add Discussions</h2>
                <hr style="width: 350px; text-align: center">
                <div class="img-box">
        <img src="./images/discussions.jpg" class="img-fluid rounded-circle" width="300" height="300" alt="Upload Receipt File">
    </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="d-flex justify-content-between">
                                    <h5>Name: 
                                        <?php 
                                            if (isset($_SESSION['UserFirstName']) && isset($_SESSION['UserLastName'])) {
                                                echo htmlspecialchars($_SESSION['UserFirstName']) . ' ' . htmlspecialchars($_SESSION['UserLastName']);
                                            }
                                        ?>
                                    </h5>
                                    <h5>Date: <?php echo date("d-m-y"); ?></h5>
                                </div>
                                <br>
                                <form id="addDiscussion" method="POST">
                                    <hr>
                                    <?php
                                        if(isset($_SESSION['success'])){
                                            echo '<script>swal("Success!", "' . $_SESSION['success'] . '", "success");</script>';
                                            unset($_SESSION['success']);
                                        }
                                        if(isset($_SESSION['error'])){
                                            echo '<script>swal("Error!", "' . $_SESSION['error'] . '", "error");</script>';
                                            unset($_SESSION['error']);
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" id="description" name="description" rows="10" required></textarea>
                                    </div>
                                </form>
                                <div class="text-right">
                                    <a href="Discussion.php" class="btn btn-secondary btn-lg">Back</a>
                                    <button type="button" onclick="addDiscussion();" class="btn btn-primary btn-lg">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function addDiscussion() {
        var title = document.getElementById("title").value.trim();
        var description = document.getElementById("description").value.trim();

        if (title === "" || description === "") {
            swal("Error!", "Please fill out all required fields.", "error");
            return;
        }

        swal({
            title: "Would you like to add this discussion?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                document.getElementById("addDiscussion").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
