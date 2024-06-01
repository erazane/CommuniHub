<?php 
session_start();
require_once('include/header.php'); 
?>
</div>
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

    //retrive the description and image for the summary page
    $query ="SELECT DonationDesc,image,DonationName FROM donation WHERE DonationID=$DonationID ";
    $result= mysqli_query($dbc,$query);

    if($result && mysqli_num_rows($result)){
        //fetch the description
        $row =mysqli_fetch_assoc($result);
        $DonationDesc = isset($row['DonationDesc']) ? $row['DonationDesc'] : ''; 
        $image = isset($row['image']) ? $row['image'] : '';
        $DonationName = isset($row['DonationName']) ? $row['DonationName'] : '';

    }

    ?>


    <!-- end php -->

    <section class="service_section layout_padding">
    <div class="container" style="max-width: 1200px ; padding :2%";>
    <div class="heading_container heading_center">
            <h2>Payment Details</h2>
            
        </div>
        <div class="row">
            <!-- Left card section for user details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                         <h4 class="card-header"><?php echo isset($DonationName) ? $DonationName : '' ;?></h4>
                    </div>
                        <div class="card-body">
                        <!-- <img class="card-img-top" src="<?php echo isset($image) ? $image : 'placeholder_image_url.jpg'; ?>" alt="Image"> -->
                        <img class="card-img-top" src="../Committee/images/donations/<?php echo $image; ?>" alt="<?php echo $DonationName; ?>" >
                          <br><br>  
                            
                        <div class="intro-text" style="padding: 2%;">
                                 <h3 style="font-weight: bold;">
                                    Thank you for considering a donation to our cause.<br>
                                    Below, you'll find more details about the specific donation you've selected:
                                    </h3>
                            </div>
                            <div class="card-body">
                            <p class="card-text" style="text-align: justify;"><?php echo isset($DonationDesc) ? $DonationDesc : '' ;?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right card  -->
            <div class="col-md-4 mx-auto" style="max-width: 800px;">
                    <div class="card">
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                </div>
                            <input type="text" class="form-control" id="UserContactDetails" name="UserContactDetails" value="<?php echo $UserContactDetails; ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="DonationTotal">Donation Amount:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RM</span>
                                </div>
                             <input type="text" class="form-control" id="DonationTotal" name="DonationTotal" placeholder="Enter Amount">
                        </div>

                        <div class="form-group">
                            <label for="DonationMessage">Message:</label>
                            <textarea class="form-control" id="DonationMessage" name="DonationMessage" rows="7" placeholder="Optional"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="DonationImage">Upload receipt:</label>
                            <input type="file" class="form-control-file" id="DonationImage" name="DonationImage" accept="image/*">
                        </div> -->
                        <hr>
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
      </section>
</div>

    <!-- end form -->

    
    <?php include('include/footer.php'); ?>