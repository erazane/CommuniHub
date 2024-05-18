<?php 
session_start();
require_once('include/header.php'); 
?>

    <!-- start donation form -->

    <!-- start php -->

    <?php
        // error_reporting(E_ALL);
        require_once ('../Database/database.php');
        
        // Retrieve from URL parameter
        $UserID = $_GET["UserID"];
        $DonationID = $_GET["DonationID"];

        // echo "UserID: " . $UserID . "<br>";
        // echo "DonationID: " . $DonationID . "<br>";

        // Check if UserID is set in session, if not, use the one from URL parameter
        if(!isset($_SESSION["UserID"])) {
            $_SESSION["UserID"] = $UserID; // Set UserID in session if it's not already set
        }

        // Retrieve user information based on UserID
        $query = "SELECT UserFirstName, UserLastName, UserEmail, UserContactDetails FROM user WHERE UserID = $UserID";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            // Fetch user information
            $userData = mysqli_fetch_assoc($result);
            $UserFirstName = $userData['UserFirstName'];
            $UserLastName = $userData['UserLastName'];
            $UserEmail = $userData['UserEmail'];
            $UserContactDetails = $userData['UserContactDetails'];
        } else {
            echo "Error: " . mysqli_error($dbc);
        }

        //retrive user information for donation
        $query = "SELECT DonationTotal, DonationMessage FROM donationjoined WHERE DonationID = $DonationID AND UserID = $UserID";
        $result = mysqli_query($dbc, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch donation total
            $donationData = mysqli_fetch_assoc($result);
            $DonationTotal = $donationData['DonationTotal'];
            // Check if DonationMessage is set before accessing its value
            $DonationMessage = isset($donationData['DonationMessage']) ? $donationData['DonationMessage'] : null;
        } else {
            // Handle case where no donation data is found
            echo "No donation data found.";
        }
    ?>


    <!-- end php -->

    <section class="service_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Make a Difference Today</h2>
                <p class="text-card">
                    Ensure that your community has everything it needs to maintain a peaceful way of life.
                </p>
            </div>
            </div>
            <div class="row">
                
                <div class="col-md-6 mx-auto" style="max-width: 800px;">
                    <div class="card">
                    <div class="card bg-dark text-black" style="font-weight: bolder;">
                        <img class="card-img" 
                        src="https://media.istockphoto.com/id/182386857/photo/row-of-paper-people.jpg?s=612x612&w=0&k=20&c=ZBWK0LbKok3acZ5-NIXO3-pHW58pujorsSS5KBEte98=" 
                        alt="Card image">
                        </div>
                        <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <h4><strong>Fill out the form below to support the cause with your generous donation. </strong></h4>
                        <hr>
                        <div class="form-group">
                            <label for="UserFirstName">First Name:</label>
                            <input type="text" class="form-control" id="UserFirstName" name="UserFirstName" value="<?php echo $UserFirstName; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="UserLastName">Last Name:</label>
                            <input type="text" class="form-control" id="UserLastName" name="UserLastName" value="<?php echo $UserLastName; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="UserEmail">Email:</label>
                            <input type="email" class="form-control" id="UserEmail" name="UserEmail" value="<?php echo $UserEmail; ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="UserContactDetails">Contact Detail:</label>
                            <input type="text" class="form-control" id="UserContactDetails" name="UserContactDetails" value="<?php echo $UserContactDetails; ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="DonationTotal">Donation Amount:</label>
                            <select class="form-control" id="DonationTotal" name="DonationTotal">
                                <option value="" disabled selected>Select Amount</option>
                                <option value="10">RM 10</option>
                                <option value="30">RM 30</option>
                                <option value="50">RM 50</option>
                                <option value="100">RM 100</option>
                                <option value="150">RM 150</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="DonationMessage">Message:</label>
                            <textarea class="form-control" id="DonationMessage" name="DonationMessage" rows="3"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="DonationImage">Upload receipt:</label>
                            <input type="file" class="form-control-file" id="DonationImage" name="DonationImage" accept="image/*">
                        </div> -->
                        <div class="text-right">
                             <a href="donations.php" onclick="confirmJoin();" class="btn btn-primary btn-lg ">Back</a>
                             <a href="#" onclick="confirmJoin();" class="btn btn-primary btn-lg ">Join</a>
                        </div>
                        
                        
                        <script>
                            function confirmJoin() {
                                console.log("Function called"); // Check if function is being called
                                // Validate form fields
                                var UserFirstName = document.getElementById("UserFirstName").value.trim();
                                var UserLastName = document.getElementById("UserLastName").value.trim();
                                var UserEmail = document.getElementById("UserEmail").value.trim();
                                var UserContactDetails = document.getElementById("UserContactDetails").value.trim();
                                var DonationTotal = document.getElementById("DonationTotal").value.trim();
                                var DonationMessage = document.getElementById("DonationMessage").value.trim();

                                console.log(UserFirstName, UserLastName, UserEmail, UserContactDetails, DonationTotal,DonationMessage); // Check form field values

                                if (UserFirstName === "" || UserLastName === "" || UserEmail === "" || UserContactDetails === "" || DonationTotal === "") {
                                    // If any of the required fields are empty, show an error message
                                    swal(
                                        "Error!",
                                        "Please fill out all required fields.",
                                        "error");
                                    return; // Stop further execution
                                }
                                // Check if swal is called
                                console.log("SweetAlert called");
                                swal({
                                    title: "Are you sure?",
                                    text: "Do you want to proceed with this donation?",
                                    icon: "info",
                                    buttons: true,
                                    dangerMode: true,
                                }).then((willJoin) => {
                                    console.log("SweetAlert confirmed:", willJoin); // Check if user confirms or cancels
                                    if (willJoin) {
                                        // If the user confirms, insert data into the donationjoined table
                                        var UserID = <?php echo json_encode($_SESSION["UserID"]); ?>;
                                        var DonationID = <?php echo json_encode($_GET["DonationID"]); ?>;
                                        
                                        // Ajax call to insert data into donationjoined table
                                        $.ajax({
                                            type: "POST",
                                            url: "insert_donation.php",
                                            data: {UserID: UserID, DonationID: DonationID, DonationTotal: DonationTotal , DonationMessage :DonationMessage},
                                            success: function(response) {
                                                // Redirect to donation summary page
                                                var url = `donation-summary.php?DonationID=${DonationID}&UserID=${UserID}`;
                                                console.log('Form submitted');
                                                console.log("Redirecting to:", url); // Check the URL being redirected to
                                                window.location.href = url;
                                            },
                                            error: function(xhr, status, error) {
                                                console.error("Error:", error); // Log any errors
                                            }
                                        });
                                    } else {
                                        // If the user cancels, do nothing
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

    <!-- end form -->

    
    <?php include('include/footer.php'); ?>