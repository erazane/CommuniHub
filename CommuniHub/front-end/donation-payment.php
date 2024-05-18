<?php
include('include/header.php');
session_start();

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
                            <!-- User details hidden fields -->
                            <input type="hidden" id="UserFirstName" name="UserFirstName" value="<?php echo isset($UserFirstName) ? $UserFirstName : ''; ?>">
                            <input type="hidden" id="UserLastName" name="UserLastName" value="<?php echo isset($UserLastName) ? $UserLastName : ''; ?>">
                            <input type="hidden" id="DonationTotal" name="DonationTotal" value="<?php echo isset($DonationTotal) ? $DonationTotal : ''; ?>">
                            <input type="hidden" id="DonationMessage" name="DonationMessage" value="<?php echo isset($DonationMessage) ? $DonationMessage : ''; ?>">

                            <div class="container">
                                <h3>Card Details</h3>
                                <div class="form-group">
                                    <label for="CardHolder">Name on card :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="CardHolder" name="CardHolder" placeholder="Cardholder's Name">
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
                                        <img src="../front-end/images/payment types/mastercard.png" alt="Mastercard Card" style="max-width: 80px; max-height: px;">
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
                                        <input type="text" class="form-control" id="CardNumber" name="CardNumber" placeholder="•••• •••• •••• ••••" maxlength="16" inputmode="numeric">
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
                                                <input type="date" class="form-control" id="expmonth" name="expmonth" placeholder="MM/YY">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-md-offset-2">
                                        <div class="form-group">
                                            <label for="CVV">CVV :</label>
                                            <input type="text" class="form-control" id="CVV" name="CVV" placeholder="•••" maxlength="3">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="payment-options">
                                    <button type="button" onclick="history.back();" class="btn btn-primary btn-lg">Back</button>
                                    <button type="button" onclick="confirmJoin();" class="btn btn-primary btn-lg">Proceed</button>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                                <strong>Donation Amount : </strong>  RM 
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
                                    <button type="button" onclick="confirmJoin();" class="btn btn-primary btn-lg">Proceed</button>
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

</script>

<script>
    function confirmJoin() {
        var CardHolder = document.getElementById("CardHolder").value.trim();
        var CardNumber = document.getElementById("CardNumber").value.trim();
        var expmonth = document.getElementById("expmonth").value.trim();
        var CVV = document.getElementById("CVV").value.trim();
        
        if (CardHolder === "" || CardNumber === "" || expmonth === "" || CVV === "") {
            Swal.fire(
                "Error!",
                "Please fill out all required fields.",
                "error"
            );
            return; // Stop further execution
        }

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to proceed with the payment?",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("paymentdetails").submit(); // Submit the form
                window.location.href = "receipt.php";
                
            }
        });
    }
</script>


<?php include('include/footer.php'); ?>


<!-- var insertdata = {
                    UserID: "<?php echo $_SESSION['UserID']?>",
                    DonationID: "<?php echo $_SESSION['DonationID']?>",
                    DonationTotal: document.getElementById("DonationTotal").value.trim(),
                    DonationMessage: document.getElementById("DonationMessage").value.trim(),
                };

                $.ajax({
                    type: "POST",
                    url: "insert_donation.php",
                    data: insertdata,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "receipt.php";
                        } else {
                            Swal.fire(
                                "Error!",
                                response.error,
                                "error"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            "Error!",
                            "An error occurred while processing your request.",
                            "error"
                        );
                    }
                }); -->