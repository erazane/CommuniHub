<?php 
session_start();
require_once('include/header.php'); 
?>
</div>

<?php
require_once('../Database/database.php'); // Establish database connection

// Initialize variables
$UserID = null;
$DonationID = null;

// Get UserID and DonationID from URL parameters
if (isset($_GET['UserID']) && isset($_GET['DonationID'])) {
    $UserID = $_GET['UserID'];
    $DonationID = $_GET['DonationID'];
    // Set UserID in session if not already set
    if (!isset($_SESSION["UserID"])) {
        $_SESSION["UserID"] = $UserID;
    }
} else {
    die("UserID and DonationID are required.");
}


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// $newImageName = null;
//         if ($_FILES["image"]["error"] != 4) {
//             $filename = $_FILES["image"]["name"];
//             $filesize = $_FILES["image"]["size"];
//             $tmpName = $_FILES["image"]["tmp_name"];
    
//             $validImageExtension = ['jpg', 'jpeg', 'png'];
//             $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
//             if (!in_array($imageExtension, $validImageExtension)) {
//                 echo "<script>alert('Invalid Image Extension');</script>";
//             } elseif ($filesize > 1000000) {
//                 echo "<script>alert('Image Size Too large');</script>";
//             } else {
//                 $newImageName = uniqid() . '.' . $imageExtension;
//                 move_uploaded_file($tmpName, '../front-end/images/QRTransfers/' . $newImageName);
//             }
//            // Prepare the insert query
//             $insertQuery = "INSERT INTO donationjoined (DateJoined, ReceiptImages, DonationID
//                             VALUES ('$DateJoined', '$DonationTotal','$ReceiptImages', '$DonationID', '$UserID')";
    
//             // Execute the insert query
//             $insertResult = mysqli_query($dbc, $insertQuery);
            
//             if ($insertResult) {
//                 $_SESSION['paid'] = "Donation successful!";
//                 $_SESSION['paid_code'] = "success";
//                 header('Location: joined-donation-QR.php?DonationID='.$DonationID.'&UserID='.$UserID);
//                 exit;
//             } else {
//                 $_SESSION['paid'] = "An error occurred while processing your donation.";
//                 $_SESSION['paid_code'] = "error";
//                 // Redirect back to the payment page to display the error message
//                 header('Location: paymentPage.php?DonationID='.$DonationID.'&UserID='.$UserID);
//                 exit;
//             }
//         }
//     }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $CardNumber = base64_encode($_POST['CardNumber']);
        $expmonth = $_POST['expmonth'] . '-01';
        $CVV = base64_encode($_POST['CVV']);
        $DateJoined = date("Y-m-d H:i:s");

        

        // Prepare the insert query
        $insertQuery = "INSERT INTO donationjoined (DateJoined, DonationTotal, DonationID, UserID, CardHolder, cardType, CardNumber, expmonth, CVV)
                        VALUES ('$DateJoined', '$DonationTotal', '$DonationID', '$UserID', '$CardHolder', '$cardType', '$CardNumber', '$expmonth', '$CVV')";

        // Execute the insert query
        $insertResult = mysqli_query($dbc, $insertQuery);

        if ($insertResult) {
            $_SESSION['paid'] = "Donation successful!";
            $_SESSION['paid_code'] = "success";
            header('Location: joined-donation.php?DonationID='.$DonationID.'&UserID='.$UserID);
            exit;
        } else {
            $_SESSION['paid'] = "An error occurred while processing your donation.";
            $_SESSION['paid_code'] = "error";
            // Redirect back to the payment page to display the error message
            header('Location: paymentPage.php?DonationID='.$DonationID.'&UserID='.$UserID);
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

<section class="service_section layout_padding wider_section">
    <div class="container" style="max-width: 1500px;">
        <div class="heading_container heading_center">
            <h2>Payment</h2>
            <hr style="width: 350px; text-align: center">
        </div>
        <div class="row justify-content-center align-items-start mt-3">
            <div class="col-md-8">
                <div class="card">
                    
                        <!-- Credit/Debit Card Payment Form -->
                        <div class="text-center">
                            <h4 class="card-header">Credit/Debit Card Payment</h4>
                        </div>
                        <div class="col-md-12">
                        <div class="card-body">
                            <form id="paymentdetails" method="POST">
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
                                        <input type="radio" name="cardType" value="amex">
                                        <img src="../front-end/images/payment types/amex.png" alt="American Express" style="max-width: 100px; max-height: 60px;">
                                    </label>
                                    <label class="card-label" style="padding: 2%;">
                                        <input type="radio" name="cardType" value="UnionPay">
                                        <img src="../front-end/images/payment types/unionpay.png" alt="Union Pay" style="max-width: 100px; max-height: 60px;">
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CVV">CVV:</label>
                                            <input type="text" class="form-control" id="CVV" name="CVV" placeholder="•••" maxlength="3" inputmode="numeric" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="button" onclick="history.back();" class="btn btn-primary btn-lg mr-2">Back</button>
                                    <button type="button" onclick="confirmPayment()" class="btn btn-primary btn-lg">Proceed</button>
                                </div>
                            </form>
                        </div>
                        </div>

                    
                </div>

                <div class="card">
                    <div class="text-center">
                        <h4 class="card-header">Others</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                           <h3>Bank Transfer</h3>
                           <h5>If you are unable to use online banking via card, you may transfer funds to our bank account.</h5>
                            <br>
                            <hr>
                           <p>
                           Account Name: CommuniHub <br>
                           Business Registration No: 811025-T <br>
                           
                           Bank Name: Hong Leong Bank Berhad <br>
                           Account Number: 00100915325 <br>
                           
                           Bank Branch: Kuala Lumpur Main Branch <br>
                           Bank Address: Level 2, Wisma Hong Leong, 18, Jalan Perak, 50450 Kuala Lumpur, Malaysia <br>
                            </p>

                            <hr>
                            <h3>QR Transfer</h3>
                           <h5>If you prefer,you may also use QR transfer.If you do choose this method of payment,<br>then please upload the receipt aswell.</h5>
                           <!-- <form id="receipt" enctype="multipart/form-data">
                            <input type="file" name="ReceiptImages" id="image" accept=".jpg, .jpeg, .png" > -->
                            <br>
                           <br>
                           <br>
                           <div class="d-flex justify-content-between">
                           <div>
                                 <figure class="text-center">
                                     <figcaption>TNG QR</figcaption>
                                     <img class="img-fluid img-thumbnail" src="./images/payment types/tngQR.png" style="width: 350px;">
                                 </figure>
                             </div>
                             <div>
                                <figure class="text-center">
                                     <figcaption>DuitNow QR</figcaption>
                                     <img class="img-fluid img-thumbnail" src="./images/payment types/duitnowQR.png" style="width: 350px;">
                                 </figure>  
                             </div>
                           </div>
                           <br>
                           <!-- <div class="text-center">
                                <button type="button" onclick="addReceipt();" class="btn btn-primary btn-lg">Confirm</button>
                            </div> -->
                            <!-- </form> -->
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
        <div class="row justify-content-center align-items-start mt-3">
        <div class="col-md-8">
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

    function confirmPayment() {
        var DonationTotal = document.getElementById("DonationTotal").value.trim();
        var CardHolder = document.getElementById("CardHolder").value.trim();
        var cardType = document.querySelector('input[name="cardType"]:checked');
        var CardNumber = document.getElementById("CardNumber").value.trim();
        var expmonth = document.getElementById("expmonth").value.trim();
        var CVV = document.getElementById("CVV").value.trim();

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

<!-- <script>
    function addReceipt() {
    var ReceiptImages = document.getElementById("image").value.trim();
    if (!ReceiptImages) {
        Swal.fire("Error!", "Please select an image to upload.", "error");
        return;
    }

    Swal.fire({
        title: "Would you like to upload this image?",
        text: "Click confirm if you wish to proceed",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Trigger click event on file input to submit the form
            document.getElementById("receipt").click();
        }
    });
}

    </script> -->
<?php include('include/footer.php'); ?>
