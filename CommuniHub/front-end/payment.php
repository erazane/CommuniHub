<?php 
session_start();
require_once('include/header.php'); 
?>
</div>
<?php
require_once('../Database/database.php'); // Establish database connection


// Get UserID and DonationID from URL parameters
if (isset($_GET['UserID']) && isset($_GET['DonationID'])) {
    $UserID = $_GET['UserID'];
    $DonationID = $_GET['DonationID'];
}

// Set UserID in session if not already set
if (!isset($_SESSION["UserID"])) {
    $_SESSION["UserID"] = $_GET['UserID'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo"heh";
    if (
        isset($_POST['DonationTotal']) && 
        isset($_POST['CardHolder']) &&
        isset($_POST['cardType']) &&
        isset($_POST['CardNumber']) &&
        isset($_POST['expmonth']) &&
        isset($_POST['CVV'])
    ) {
        $DonationTotal = $_POST['DonationTotal'];
        $CardHolder = $_POST['CardHolder'];
        $cardType = $_POST['cardType'];
        $CardNumber = $_POST['CardNumber'];
        $expmonth = $_POST['expmonth'] . '-01';
        $CVV = $_POST['CVV'];
        $DateJoined = date("Y-m-d H:i:s");

        // Prepare the insert query
        $insertQuery = "INSERT INTO donationjoined (DateJoined, DonationTotal, DonationID, UserID, CardHolder, cardType, CardNumber, expmonth, CVV)
                        VALUES ('$DateJoined', '$DonationTotal', '$DonationID', '$UserID', '$CardHolder', '$cardType', '$CardNumber', '$expmonth', '$CVV')";

        // Execute the insert query
        $insertResult = mysqli_query($dbc, $insertQuery);

        if ($insertResult) {
            $_SESSION['paid'] = "Donation successful !";
            $_SESSION['paid_code'] = "success";
            header('Location: joined-donation.php?DonationID='.$DonationID.'&UserID='.$UserID);
            exit;
        } else {
            $_SESSION['paid'] = "An error occurred while processing your donation.";
            $_SESSION['paid_code'] = "error";
            // Redirect back to the payment page to display the error message
            header('Location: payment.php?DonationID='.$DonationID.'&UserID='.$UserID);
            exit;
        }
    }        
}

// Fetch donation details
$query = "SELECT DonationID, DonationName, DonationTarget, image FROM donation WHERE DonationID = $DonationID";
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
                        <!-- Credit/Debit Card Payment Form -->
                        <div class="card">
                            <div class="text-center">
                                <h4 class="card-header">Credit/Debit Card Payment</h4>
                            </div>
                            <div class="card-body">
                                <form id="paymentdetails"  method="POST">
                                    <h3>Card Details</h3>
                                    <div class="form-group">
                                        <label for="DonationTotal">Donation Amount:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="DonationTotal" name="DonationTotal" placeholder="Enter Amount">
                                        </div>
                                    </div>
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
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" onclick="history.back();" class="btn btn-primary btn-lg mr-2">Back</button>
                            <button type="button" onclick="confirmPayment(<?php echo $DonationID; ?>)" class="btn btn-primary btn-lg">Proceed</button>
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
                            </div>
                            <img class="img-fluid img-thumbnail" src="../Committee/images/donations/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($DonationName); ?>">
                        </div>
                        <p class="card-text">Target: <?php echo htmlspecialchars($DonationTarget); ?></p>
                        <div class="progress mt-3" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
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

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="list-group-item">
                                        <span><?php echo htmlspecialchars($row['DonationName']); ?></span>
                                        <div class="d-flex justify-content-between align-items-center">
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
  document.getElementById("DonationTotal").addEventListener("input", function(event) {
        let value = event.target.value;
        event.target.value = value.replace(/\D/g, "");
    });

    function confirmPayment(DonationID) {
        var DonationTotal = document.getElementById("DonationTotal").value.trim();
        var CardHolder = document.getElementById("CardHolder").value.trim();
        var cardType = document.querySelector('input[name="cardType"]:checked');
        var CardNumber = document.getElementById("CardNumber").value.trim();
        var expmonth = document.getElementById("expmonth").value.trim();
        var CVV = document.getElementById("CVV").value.trim();

        console.log(
            'swol data: ',
            DonationTotal,
            CardHolder,
            cardType,
            CardNumber,
            expmonth,
            CVV,
        )
        if (!DonationTotal || !CardHolder || !cardType || !CardNumber || !expmonth || !CVV) {
            Swal.fire("Error!", "Please fill out all required fields.", "error");
            return;
        }

        Swal.fire({
            title: "Would you like to proceed with this payment?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById("paymentdetails").submit();
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
