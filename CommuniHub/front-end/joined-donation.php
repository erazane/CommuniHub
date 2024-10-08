<?php
session_start();
require_once('include/header.php'); 

// Establish database connection
require_once('../Database/database.php');

// Check if UserID and DonationID are set in the URL
if(isset($_GET["UserID"]) && isset($_GET["DonationID"])) {
    $UserID = $_GET["UserID"];
    $DonationID = $_GET["DonationID"];

    // Retrieve user information based on UserID
    $query_user = "SELECT UserFirstName, UserLastName FROM user WHERE UserID = $UserID";
    $result_user = mysqli_query($dbc, $query_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $userData = mysqli_fetch_assoc($result_user);
        $UserFirstName = $userData['UserFirstName'];
        $UserLastName = $userData['UserLastName'];
    } else {
        echo "Error: " . mysqli_error($dbc);
    }

    // Retrieve the donation details based on DonationID
    $query_donation = "SELECT DonationDesc, image, DonationName FROM donation WHERE DonationID = $DonationID";
    $result_donation = mysqli_query($dbc, $query_donation);

    if($result_donation && mysqli_num_rows($result_donation) > 0) {
        $row_donation = mysqli_fetch_assoc($result_donation);
        $DonationDesc = isset($row_donation['DonationDesc']) ? $row_donation['DonationDesc'] : ''; 
        $image = isset($row_donation['image']) ? $row_donation['image'] : '';
        $DonationName = isset($row_donation['DonationName']) ? $row_donation['DonationName'] : '';
    }

    // Retrieve the most recent joined donation details
    $query_joined = "SELECT DonationTotal, CardHolder, cardType, DateJoined
                    FROM donationjoined 
                    WHERE DonationID = $DonationID AND UserID = $UserID
                    ORDER BY DateJoined DESC
                    LIMIT 1";
    $result_joined = mysqli_query($dbc, $query_joined);

    if ($result_joined && mysqli_num_rows($result_joined) > 0) {
        $row_joined = mysqli_fetch_assoc($result_joined);
        $DonationTotal = $row_joined['DonationTotal'];
        $CardHolder = $row_joined['CardHolder'];
        $cardType = $row_joined['cardType'];
        $DateJoined = $row_joined['DateJoined'];
    } else {
        // Handle default values if no donation is found
        $DonationTotal = "N/A"; // Default value or handle as appropriate
        $CardHolder = "N/A";
        $cardType = "N/A";
        $DateJoined = "N/A";
    }
} else {
    echo "UserID and DonationID are not set.";
}

?>
</div>
<!-- HTML Section -->
<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Payment Details</h2>
        </div>
        <div class="row">
            <!-- Left card section for user details -->
            <div class="col-md-8 d-flex justify-content-center">
                <div class="card">
                    <div class="text-center">
                        <h4 class="card-header"><?php echo isset($DonationName) ? $DonationName : ''; ?></h4>
                    </div>
                    <div class="card-body">
                        <img class="card-img-top" src="../Committee/images/donations/<?php echo $image; ?>" alt="<?php echo $DonationName; ?> ">
                        <br><br>
                        <div class="intro-text" style="padding: 2%;">
                            <h3 style="font-weight: bold;">
                                Thank you for considering a donation to our cause.<br>
                                Below, you'll find more details about the specific donation you've selected:
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify;"><?php echo isset($DonationDesc) ? $DonationDesc : ''; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right card -->
            <div class="col-md-4 mx-auto" style="max-width: 800px;">
                <div class="card">
                    <div class="card-body">
                        <form id="donationForm" action="generate-pdf.php" method="POST" enctype="multipart/form-data">
                            <h4><strong>Summary</strong></h4>
                            <hr>
                            <h5>Name: <?php echo $UserFirstName . ' ' . $UserLastName; ?></h5>
                            <hr>
                            <h4><strong>Payment Details</strong></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Card Holder:</strong> <?php echo $CardHolder; ?></p>
                                    <p><strong>Card Type:</strong> <?php echo $cardType; ?></p>
                                    <p><strong>Donation Amount:</strong> <?php echo $DonationTotal; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Donate On:</strong> <?php echo $DateJoined; ?></p>
                                </div>
                            </div>
                            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                            <input type="hidden" name="DonationID" value="<?php echo $DonationID; ?>">
                            <input type="hidden" name="DonationTotal" value="<?php echo $DonationTotal; ?>">
                            <input type="hidden" name="DonationMessage" value="<?php echo $DonationMessage; ?>">
                            <input type="hidden" name="cardType" value="<?php echo $cardType; ?>">
                            <hr>
                            <div class="text-right">
                                <a href="donations.php" class="btn btn-primary btn-lg mt-3">Back</a>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">Generate PDF</button> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center">
                <div class="img-box mt-4">
                    <img src="./images/payment types/payment.jpg" class="img-fluid" width="350px" height="350px">
                </div>
                </div>
                
            </div>

        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
