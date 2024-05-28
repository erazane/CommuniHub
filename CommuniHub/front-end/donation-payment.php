<?php
include('include/header.php');
session_start();
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
    $_SESSION["UserID"] = $_GET['UserID']; // Set UserID in session if it's not already set
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../Database/database.php');

    $DonationTotal = $_POST['DonationTotal'];
    $DonationMessage = $_POST['DonationMessage'];

    if (!isset($_SESSION['UserID'])) {
        $_SESSION['UserID'] = $UserID;
    } else {
        $UserID = $_SESSION['UserID'];
    }

    $query = "SELECT UserFirstName, UserLastName, UserEmail, UserContactDetails FROM user WHERE UserID = $UserID";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
        $UserFirstName = $userData['UserFirstName'];
        $UserLastName = $userData['UserLastName'];
        $UserEmail = $userData['UserEmail'];
        $UserContactDetails = $userData['UserContactDetails'];
    } else {
        echo "Error: " . mysqli_error($dbc);
    }
}

if (isset($_POST['DonationTotal']) && isset($_POST['DonationMessage']) && isset($_POST['CardHolder'])) {
    $UserID = $_SESSION["UserID"];  // Assuming the UserID is stored in the session
    $DonationTotal = $_POST['DonationTotal'];
    $DonationMessage = $_POST['DonationMessage'];
    $CardHolder = $_POST['CardHolder'];  // Fixed the method of retrieving POST data
    $cardType = $_POST['cardType'];
    $CardNumber = $_POST['CardNumber'];
    $expmonth = $_POST['expmonth'];
    $CVV = $_POST['CVV'];

    if (!empty($DonationTotal) && !empty($DonationMessage) && !empty($CardHolder) && !empty($cardType)
        && !empty($CardNumber)  && !empty($expmonth) && !empty($CVV)) {
        $query = "INSERT INTO donationjoined (UserID, DonationTotal, DonationMessage, CardHolder, cardType, CardNumber, expmonth, CVV)
                  VALUES ('$UserID', '$DonationTotal', '$DonationMessage', '$CardHolder', '$cardType', '$CardNumber', '$expmonth', '$CVV')";

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
?>

<!-- Your HTML content starts here -->
<div class="container" style="padding: 2%;">
    <div class="heading_container heading_center">
        <h1>Checkout</h1>
    </div>
    <section class="Summary_section">
        <div class="row">
            <!-- Left card section for user details -->
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                         <h4 class="card-header">Credit/Debit Card Payment </h4>
                    </div>
                    <div class="card-body">
                        <form id="paymentdetails" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <h3>Card Details</h3>
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
                                    <label for="CardHolder">Name on card :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="CardHolder" name="CardHolder" placeholder="Cardholder's Name" required>
                                    </div>
                                </div>
                                <label for="cardType">Payment Type :</label>
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
                                    <label for="CardNumber"> Card Number :</label>
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
                                            <label for="expmonth">Expiry Date :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                </div>
                                                <input type="month" class="form-control" id="expmonth" name="expmonth" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="form-group">
                                            <label for="CVV">CVV :</label>
                                            <input type="text" class="form-control" id="CVV" name="CVV" placeholder="•••" maxlength="3" inputmode="numeric" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right card section for summary -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="user-details">
                            <br>
                            <div class="form-group">
                                <strong>First Name:</strong>
                                <span><?php echo isset($UserFirstName) ? $UserFirstName : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <strong>Last Name:</strong>
                                <span><?php echo isset($UserLastName) ? $UserLastName : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                <span><?php echo isset($UserEmail) ? $UserEmail : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <strong>Contact Detail:</strong>
                                <span><?php echo isset($UserContactDetails) ? $UserContactDetails : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <strong>Donation Amount:</strong> RM 
                                <span><?php echo isset($DonationTotal) ? $DonationTotal : ''; ?></span>
                            </div>
                            <div class="form-group">
                                <strong>Message:</strong>
                                <span><?php echo isset($DonationMessage) ? $DonationMessage : ''; ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="payment-options">
                            <button type="button" onclick="history.back();" class="btn btn-primary btn-lg">Back</button>
                            <button type="button" onclick="confirmPayment();" class="btn btn-primary btn-lg">Proceed</button>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </section>
</div>

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
        var DonationTotal = document.querySelector("[name='DonationTotal']").value.trim();
        var DonationMessage = document.querySelector("[name='DonationMessage']").value.trim();
        var CardHolder = document.getElementById("CardHolder").value.trim();
        var cardType = document.querySelector('input[name="cardType"]:checked');
        var CardNumber = document.getElementById("CardNumber").value.trim();
        var expmonth = document.getElementById("expmonth").value.trim();
        var CVV = document.getElementById("CVV").value.trim();

        console.log(DonationTotal, DonationMessage, CardHolder, cardType, CardNumber, expmonth, CVV);

        if (DonationTotal=="" || DonationMessage==""|| CardHolder=="" || cardType=="" || CardNumber=="" || expmonth==""|| CVV=="") {
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
                document.getElementById("paymentdetails").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include('include/footer.php'); ?>
