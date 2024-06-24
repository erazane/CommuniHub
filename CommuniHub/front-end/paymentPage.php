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

    // Calculate the total donations collected for this donation
    $query_total_collected = "SELECT SUM(DonationTotal) AS total_collected FROM donationjoined WHERE DonationID = $DonationID";
    $result_total_collected = mysqli_query($dbc, $query_total_collected);

    if($result_total_collected && mysqli_num_rows($result_total_collected) > 0) {
        $row_total_collected = mysqli_fetch_assoc($result_total_collected);
        $DonationCollectionAmount = $row_total_collected['total_collected'];
    } else {
        $DonationCollectionAmount = 0;
    }

    // Calculate the progress percentage for this donation
    if ($DonationTarget > 0) {
        $progress = ($DonationCollectionAmount / $DonationTarget) * 100;
    } else {
        $progress = 0;
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
                                <h5>Card Details</h5>
                                <div class="form-group">
                                    <label for="DonationTotal">Donation Amount:</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><strong>RM</strong></span>
                                    </div>
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
                           <h5>Bank Transfer</h5>
                           <h6>If you are unable to use online banking via card, you may transfer funds to our bank account.</h6>
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
                            <h5>QR Transfer</h5>
                           <!-- <h5>If you prefer,you may also use QR transfer.If you do choose this method of payment,<br>then please upload the receipt aswell.</h5> -->
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
                           <div class="d-flex justify-content-center mt-4">
                                    
                           <!-- <a href="uploadReceipt.php?UserID=<?php echo $_SESSION['UserID']; ?>&DonationID=<?php echo $DonationID; ?>" class="btn btn-primary btn-lg">Upload Receipt</a> -->

                                </div>
                           <br>
                           <p style="color: #ff6a19; font-size: 16px;" class="mt-2"><b>Note:</b> When you make a transfer, please send the evidence to communiHub@gmail.com for confirmation. Thank you.</p>
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
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <h5 class="card-title">Title : <?php echo htmlspecialchars($DonationName); ?></h5>
                            </div>
                            <img class="img-fluid img-thumbnail" src="../Committee/images/donations/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($DonationName); ?>">
                        </div>
                        <br>
                        <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-text">Target: RM <?php echo htmlspecialchars($DonationTarget); ?></h5>
                        <h5 class="card-text">Current :RM <?php echo htmlspecialchars($DonationCollectionAmount); ?></h5>
                        </div>
                        
                        <div class="progress mt-3" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            <!-- <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> -->
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
                            $query = "SELECT DonationID, DonationName,DonationStatus, DonationTarget, status FROM donation WHERE status = 'Ongoing' LIMIT 3";
                            $result = mysqli_query($dbc, $query);
                
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $DonationID = $row['DonationID'];
                                    $DonationName = htmlspecialchars($row['DonationName']);
                                    $DonationTarget = $row['DonationTarget'];
                                    $DonationStatus = htmlspecialchars($row['DonationStatus']); // Ensure DonationStatus is set
                                
                                    // Fetch the total collected amount for this donation
                                    $query_total_collected = "SELECT SUM(DonationTotal) AS total_collected FROM donationjoined WHERE DonationID = $DonationID";
                                    $result_total_collected = mysqli_query($dbc, $query_total_collected);
                                
                                    if ($result_total_collected && mysqli_num_rows($result_total_collected) > 0) {
                                        $row_total_collected = mysqli_fetch_assoc($result_total_collected);
                                        $DonationCollectionAmount = $row_total_collected['total_collected'];
                                    } else {
                                        $DonationCollectionAmount = 0;
                                    }
                                
                                    // Calculate the progress percentage for this donation
                                    if ($DonationTarget > 0) {
                                        $progress = ($DonationCollectionAmount / $DonationTarget) * 100;
                                    } else {
                                        $progress = 0;
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <!-- <span><?php echo $DonationName; ?></span> -->
                                        <div class="d-flex justify-content-between align-items-center">
                                        <span><?php echo $DonationName; ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="progress" style="width: 60%;">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="col-md-3 text-center" style="width:80px;background-color: #ffc107;border-radius: 2px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                                            <span><?php echo $DonationStatus; ?></span>
                                            </div>
                                            
                                            <!-- <div class="badge bg-warning text-dark" style="width: 80px;height:20px; text-align: center; "><?php echo $DonationStatus; ?></div> -->
                                            <!-- <button type="button" class="btn btn-warning" disabled><?php echo $DonationStatus; ?></button> -->
                                            <!-- <a href="payment.php?DonationID=<?php echo $DonationID; ?>&UserID=<?php echo $UserID; ?>" class="btn btn-primary btn-sm">Donate</a> -->
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
                <br>
                <br>
                <div class="text-right">
                <button type="button" onclick="history.back();" class="btn btn-primary btn-lg mr-2">Back</button>
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



<?php include('include/footer.php'); ?>
