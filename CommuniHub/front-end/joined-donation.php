<?php 
session_start();
require_once('include/header.php'); 
?>
</div>
<?php

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

    // Retrieve joined donation details
    $query_joined = "SELECT DonationTotal, DonationMessage, CardHolder, cardType, DateJoined
            FROM donationjoined 
            WHERE DonationID = $DonationID AND UserID = $UserID";
    $result_joined = mysqli_query($dbc, $query_joined);

    if($result_joined && mysqli_num_rows($result_joined) > 0) {
        $row_joined = mysqli_fetch_assoc($result_joined);
        $DonationTotal = $row_joined['DonationTotal'];
        $DonationMessage = $row_joined['DonationMessage'];
        $CardHolder = $row_joined['CardHolder'];
        $cardType = $row_joined['cardType'];
        $DateJoined = $row_joined['DateJoined'];
    } else {
        echo "Error: " . mysqli_error($dbc);
    }
} else {
    echo "UserID and DonationID are not set.";
}
?>

    <!-- end php -->

    <section class="service_section layout_padding">
    <div class="container" style="max-width: 1200px; padding: 2%;">
        <div class="heading_container heading_center">
            <h2>Payment Details</h2>
        </div>
        <div class="row">
            <!-- Left card section for user details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                        <h4 class="card-header"><?php echo isset($DonationName) ? $DonationName : ''; ?></h4>
                    </div>
                    <div class="card-body">
                        <img class="card-img-top" src="../Committee/images/donations/<?php echo $image; ?>" alt="<?php echo $DonationName; ?>">
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
                        <form id="donationForm" action="payment.php" method="POST" enctype="multipart/form-data">
                            <h4><strong>Summary</strong></h4>
                            <hr>
                            <div class="form-group">
                                <label for="UserFirstName">First Name:</label>
                                <input type="text" class="form-control" id="UserFirstName" name="UserFirstName" value="<?php echo $UserFirstName; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="UserLastName">Last Name:</label>
                                <input type="text" class="form-control" id="UserLastName" name="UserLastName" value="<?php echo $UserLastName; ?>" required>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="CardHolder">Card Holder:</label>
                                <input type="text" class="form-control" id="CardHolder" name="CardHolder" value="<?php echo $CardHolder; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cardType">Card Type:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cardType" name="cardType" value="<?php echo $cardType; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="DonationTotal">Donation Amount:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">RM</span>
                                    </div>
                                    <input type="text" class="form-control" id="DonationTotal" name="DonationTotal"  value="<?php echo $DonationTotal; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="DonationMessage">Message:</label>
                                <input type="text" class="form-control" id="DonationMessage" name="DonationMessage" value="<?php echo $DonationMessage; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="DateJoined">Donate On:</label>
                                <input type="text" class="form-control" id="DateJoined" name="DateJoined" value="<?php echo $DateJoined; ?>" required>
                            </div>

                            <input type="hidden" name="DonationID" value="<?php echo $DonationID; ?>">
                            <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                            <hr>
                            <div class="text-right">
                                <a href="donations.php" class="btn btn-primary btn-lg mt-3">Back</a>
                                <a href="generate-pdf.php" class="btn btn-primary btn-lg  mt-3">Generate PDF</a> 
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('include/footer.php');?>