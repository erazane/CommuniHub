<?php 
session_start();
require_once('include/header.php'); 
?>
</div>
<?php

// Establish database connection
require_once('../Database/database.php');

if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
    echo '<script>swal("Success!", "' . htmlspecialchars($_SESSION['status']) . '", "' . htmlspecialchars($_SESSION['status_code']) . '");</script>';
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}

if (isset($_GET['UserID']) && isset($_GET['DonationID'])) {
    $UserID = $_GET['UserID'];
    $DonationID = $_GET['DonationID'];
}

// Check if UserID is set in session, if not, use the one from URL parameter
if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] = $_GET['UserID'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['DonationTotal']) && isset($_POST['CardHolder'])) {
        $DonationTotal = $_POST['DonationTotal'];
        $DonationMessage = isset($_POST['DonationMessage']) ? $_POST['DonationMessage'] : ''; // Fix: retrieve DonationMessage from the form
        $CardHolder = $_POST['CardHolder'];  
        $cardType = $_POST['cardType'];
        $CardNumber = $_POST['CardNumber'];
        $expmonth = $_POST['expmonth'];
        $CVV = $_POST['CVV'];
        $DateJoined = date("Y-m-d H:i:s");

        if (!empty($DonationTotal) && !empty($CardHolder) && !empty($cardType)
            && !empty($CardNumber) && !empty($expmonth) && !empty($CVV)) {
            $insertQuery = "INSERT INTO donationjoined (DateJoined, DonationTotal, DonationID, UserID, DonationMessage,CardHolder,cardType
            CardNumber,expmonth,CVV)
            VALUES (NOW(), '$DonationTotal', $DonationID, $UserID, '$DonationMessage','$CardHolder','$cardType'
            '$CardNumber' ,'$expmonth','$CVV')";
            $insertResult = mysqli_query($dbc, $query);

    
            if ($insertResult) {
                $_SESSION['status'] = "Inserted successfully!";
                $_SESSION['status_code'] = "success";
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
}
$query = "SELECT  
    DonationID, DonationName, 
    DonationTarget, image
    FROM donation ";

$result = mysqli_query($dbc, $query);

if ($result) {
    $userData = mysqli_fetch_assoc($result);
    $DonationName = $userData['DonationName'];
    $DonationTarget = $userData['DonationTarget'];
    $image = $userData['image'];
} else {
    echo "Error: " . mysqli_error($dbc);
}
?>



<section class="service_section layout_padding">
    <div class="container" style="max-width: 1200px; padding: 2%;">
        <div class="heading_container heading_center">
            <h2>Payment Details</h2>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                <div class="card">
                    <div class="text-center">
                        <h4 class="card-header">Donation Amount</h4>
                    </div>
                    <div class="card-body">
                        <form id="amount" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="DonationTotal">Donation Amount:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="DonationTotal" name="DonationTotal" placeholder="Enter Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 offset-md-2">
                                    <div class="form-group">
                                        <label for="DonationMessage">Message:</label>
                                        <input type="text" class="form-control" id="DonationMessage" name="DonationMessage" placeholder="Optional">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Credit/Debit Card Payment Form -->
                <div class="card">
                    <div class="text-center">
                        <h4 class="card-header">Credit/Debit Card Payment</h4>
                    </div>
                    <div class="card-body">
                        <form id="paymentdetails" method="POST" enctype="multipart/form-data">
                                <h3>Card Details</h3>
                                <div class="form-group">
                                    <label for="CardHolder">Name on card:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="CardHolder" name="CardHolder" placeholder="Cardholder's Name" required>
                                    </div>
                                </div>
                                <label for="cardType">Payment Type:</label>
                                <div class="card-buttons">
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" value="visa">
                                        <img src="../front-end/images/payment types/visa.png" alt="Visa Card" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" value="mastercard">
                                        <img src="../front-end/images/payment types/mastercard.png" alt="Mastercard Card" style="max-width: 80px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" value="tng">
                                        <img src="../front-end/images/payment types/tng.png" alt="Touch and Go wallet" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" value="grab">
                                        <img src="../front-end/images/payment types/grab.png" alt="Grab Wallet" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="CardNumber">Card Number:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="CardNumber" name="CardNumber" placeholder="•••• •••• •••• ••••" maxlength="16" minlength="16" inputmode="numeric" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="expmonth">Expiry Date:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                </div>
                                                <input type="month" class="form-control" id="expmonth" name="expmonth" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 offset-md-2">
                                        <div class="form-group">
                                            <label for="CVV">CVV:</label>
                                            <input type="text" class="form-control" id="CVV" name="CVV" placeholder="•••" maxlength="3" inputmode="numeric" required>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            
                    </div>
                    <hr>
                </div>
                <div class="d-flex justify-content-center mt-4">
                        <button type="button" onclick="history.back();" class="btn btn-primary btn-lg mr-2">Back</button>
                        <button type="button" onclick="confirmPayment();" class="btn btn-primary btn-lg">Proceed</button>
                    </div>
            </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Current Donation</h4>
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="card-title"><?php echo htmlspecialchars($DonationName); ?></h5>
                                <!-- <p class="card-text">Target: <?php echo htmlspecialchars($DonationTarget); ?></p> -->
                            </div>
                            
                                <img class="img-fluid img-thumbnail" src="../Committee/images/donations/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($DonationName); ?>">

                        </div>
                        <p class="card-text">Target: <?php echo htmlspecialchars($DonationTarget); ?></p>

                        <div class="progress mt-3" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- <a href="payment.php?DonationID=<?php echo $DonationID; ?>&UserID=<?php echo $UserID; ?>" class="btn btn-primary btn-lg btn-block mt-3">Join</a> -->
                    </div>
                </div>

                <br>
                

                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title">Join Others</h4>
                        <ul class="list-group">
                            <?php
                            // Fetch the first three donations from the database
                            $query = "SELECT DonationID, DonationName FROM donation LIMIT 3";
                            $result = mysqli_query($dbc, $query);

                            // Check if query was successful
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="list-group-item">
                                    <span><?php echo htmlspecialchars($row['DonationName']); ?></span>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- <span><?php echo htmlspecialchars($row['DonationName']); ?></span> -->
                                            <div class="progress" style="width: 60%;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo rand(10, 90); ?>%;" aria-valuenow="<?php echo rand(10, 90); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <a href="payment.php?DonationID=<?php echo $row['DonationID']; ?>&UserID=<?php echo $UserID; ?>" class="btn btn-primary btn-sm">Donate</a>
                                        </div>
                                    </li>
                                    <?php
                                }
                            } else {
                                echo "Error: " . mysqli_error($dbc);
                            }
                            ?>
                        </ul>
                        <div class="text-center mt-3">
                            <a href="donations.php" class="btn btn-secondary" id="seeMoreBtn">See More</a>
                        </div>
                    </div>
                </div>

                <!-- </div> -->
                
            </div>

            
           
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById("CardNumber").addEventListener("input", function(event) {
        let value = event.target.value;
        event.target.value = value.replace(/\D/g, "");
    });

    document.getElementById("CVV").addEventListener("input", function(event) {
        let value = event.target.value;
        event.target.value = value.replace(/\D/g, "");
    });

    function confirmPayment() {
        var DonationTotal = document.getElementById("DonationTotal").value.trim();
        var DonationMessage = document.getElementById("DonationMessage").value.trim();
        var CardHolder = document.getElementById("CardHolder").value.trim();
        var cardType = document.querySelector('input[name="cardType"]:checked');
        var CardNumber = document.getElementById("CardNumber").value.trim();
        var expmonth = document.getElementById("expmonth").value.trim();
        var CVV = document.getElementById("CVV").value.trim();

        if (!DonationTotal || !CardHolder || !cardType || !CardNumber || !expmonth || !CVV) {
            swal("Error!", "Please fill out all required fields.", "error");
            return;
        }

        swal({
            title: "Would you like to proceed with this payment?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                // Submit the form
                document.getElementById("paymentdetails").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }

    // Function to handle redirection after payment success
    function redirectToJoinedDonation() {
        // Redirect to joined-donation.php
        window.location.href = "joined-donation.php";
    }
</script>
<?php include('include/footer.php'); ?>

