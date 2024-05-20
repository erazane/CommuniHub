<?php
include('include/header.php');
session_start();
require_once('../Database/database.php');

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

        // //retrive user information for donation
        // $query = "SELECT DonationTotal, DonationMessage FROM donationjoined WHERE DonationID = $DonationID AND UserID = $UserID";
        // $result = mysqli_query($dbc, $query);
        
        // if ($result && mysqli_num_rows($result) > 0) {
        //     // Fetch donation total
        //     $donationData = mysqli_fetch_assoc($result);
        //     $DonationTotal = $donationData['DonationTotal'];
        //     // Check if DonationMessage is set before accessing its value
        //     $DonationMessage = isset($donationData['DonationMessage']) ? $donationData['DonationMessage'] : null;
        // } else {
        //     // Handle case where no donation data is found
        //     echo "No donation data found.";
        // }
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
                            <!-- <input type="hidden" id="UserFirstName" name="UserFirstName" value="<?php echo isset($UserFirstName) ? $UserFirstName : ''; ?>">
                            <input type="hidden" id="UserLastName" name="UserLastName" value="<?php echo isset($UserLastName) ? $UserLastName : ''; ?>">
                            <input type="hidden" id="DonationTotal" name="DonationTotal" value="<?php echo isset($DonationTotal) ? $DonationTotal : ''; ?>">
                            <input type="hidden" id="DonationMessage" name="DonationMessage" value="<?php echo isset($DonationMessage) ? $DonationMessage : ''; ?>"> -->

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
                                        <input type="radio" name="cardType" id="cardType" value="visa">
                                        <img src="../front-end/images/payment types/visa.png" alt="Visa Card" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" id="cardType" value="mastercard">
                                        <img src="../front-end/images/payment types/mastercard.png" alt="Mastercard Card" style="max-width: 80px; max-height: px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" id="cardType" value="tng">
                                        <img src="../front-end/images/payment types/tng.png" alt="Touch and Go wallet" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" id="cardType" value="grab">
                                        <img src="../front-end/images/payment types/grab.png" alt="Grab Wallet" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="CardNumber"> Card Number :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="CardNumber" name="CardNumber" placeholder="•••• •••• •••• ••••" maxlength="16" minlength="16" inputmode="numeric">
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
    console.log("Function called"); // Check if function is being called
    // Validate form fields
    var DonationTotal = document.getElementById("DonationTotal").value.trim();
    var $DonationMessage = document.getElementById("$DonationMessage").value.trim();
    var CardHolder = document.getElementById("CardHolder").value.trim();
    var cardType = document.querySelector('input[name="cardType"]:checked');
    var CardNumber = document.getElementById("CardNumber").value.trim();
    var expmonth = document.getElementById("expmonth").value.trim();
    var CVV = document.getElementById("CVV").value.trim();

    console.log(CardHolder, cardType, CardNumber, expmonth, CVV); // Check form field values

    // Display SweetAlert confirmation prompt
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to proceed with this payment?",
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
                url: "insert-cardDetails.php",
                data: {UserID: UserID, DonationID: DonationID, CardHolder: CardHolder , cardType :cardType, 
                    CardNumber : CardNumber , expmonth:expmonth ,CVV:CVV  ,DonationMessage:$DonationMessage, DonationTotal:DonationTotal},
                success: function(response) {
                    swal({
                        title: "Payment Successful!",
                        text: "Thank you for your donation.",
                        icon: "success",
                        button: "OK",
                    }).then(() => {
                        var url = `receipt.php?DonationID=${DonationID}&UserID=${UserID}`;
                        console.log('Form submitted');
                        console.log("Redirecting to:", url); // Check the URL being redirected to
                        window.location.href = url;
                    });
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


<?php include('include/footer.php'); ?>

