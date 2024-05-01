<?php
session_start();
include('include/header.php');
?>
</div>
<?php
require_once('../Database/database.php');

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    // Display success message using SweetAlert
    echo '<script>swal("Success!", "' . $_SESSION['status'] . '", "' . $_SESSION['status_code'] . '");</script>';
    // Unset the session variables
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GarbageDay = isset($_POST['GarbageDay']) ? $_POST['GarbageDay'] : "";
    $Time = isset($_POST['Time']) ? $_POST['Time'] : "";
    $Date = isset($_POST['Date']) ? $_POST['Date'] : "";

    // Check for empty input
    if (!empty($GarbageDay) && !empty($Time) && !empty($Date)) {
        // Insert new schedule
        $query = "INSERT INTO schedule (GarbageDay, Time, Date) 
                  VALUES ('$GarbageDay', '$Time', '$Date')";
        $insertResult = mysqli_query($dbc, $query);

        if ($insertResult) {
            $_SESSION['status'] = "Inserted successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($dbc);
        }
    } else {
        $_SESSION['status'] = "Unable to insert data";
        $_SESSION['status_code'] = "error";
        echo "Admin with the same name already exists!";
    }
       
    }


?>


<section class="service_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Update Current General Waste Schedule</h2>
            <p class="text-card">Ensure that your community has everything it needs to maintain a peaceful way of life.</p>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto" style="max-width: 800px;">
                <div class="card">
                    <div class="card bg-dark text-black" style="font-weight: bolder;">
                        <img class="card-img" src="https://media.istockphoto.com/id/182386857/photo/row-of-paper-people.jpg?s=612x612&w=0&k=20&c=ZBWK0LbKok3acZ5-NIXO3-pHW58pujorsSS5KBEte98=" alt="Card image">
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <h4><strong>Fill out the form below to add a new user.</strong></h4>
                            <hr>
                            <?php
                                // Check if success message is set
                                if (isset($_SESSION['success'])) {
                                    // Display success message using SweetAlert
                                    echo '<script>swal("Success!", "' . $_SESSION['success'] . '", "success");</script>';
                                    // Unset the session variable
                                    unset($_SESSION['success']);
                                }
                            ?>

                            <div class="form-group">
                                <label for="GarbageDay">Garbage Day:</label>
                                <select class="form-control" id="GarbageDay" name="GarbageDay" required>
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Resident">Sunday</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="Time">Time:</label>
                                <input type="time" class="form-control" id="Time" name="Time" required>
                            </div>
                            <div class="form-group">
                                <label for="Date">Date:</label>
                                <input type="date" class="form-control" id="Date" name="Date" required>
                            </div>
                            <div class="text-right">
                                <button type="button"  onclick="update();" class="btn-primary btn-lg">Confirm</button>
                            </div>
                            <script>
                                function update() {
                                    var GarbageDay = document.getElementById("GarbageDay").value.trim();
                                    var Time = document.getElementById("Time").value.trim();
                                    var Date = document.getElementById("Date").value.trim();
                                    
                                    if (GarbageDay === "" || Time === "" || Date === "") {
                                        swal(
                                            "Error!",
                                            "Please fill out all required fields.",
                                            "error"
                                        );
                                        return;
                                    }
                                    
                                    // Check if swal is called
                                    console.log("SweetAlert called");
                                    swal({
                                        title: "Update the schedule ?",
                                        icon: "info",
                                        showCancelButton: true,
                                        confirmButtonText: 'Confirm',
                                        cancelButtonText: 'Cancel',
                                        reverseButtons: true
                                    }).then((willJoin) => {
                                        if (willJoin) {
                                            // If user confirms, submit the form
                                            document.querySelector('form').submit();
                                        } else {
                                            // If user cancels, do nothing
                                            console.log("User cancelled.");
                                        }
                                    });
                                }
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>

