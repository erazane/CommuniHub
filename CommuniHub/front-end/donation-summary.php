<?php include('include/header.php');
session_start();
 ?>


    <!-- end header section -->
  </div>

<!-- start php -->
<?php
require_once('../Database/database.php');

//retrieve the UserID from the Url
$UserID=$_GET["UserID"];
$DonationID=$_GET["DonationID"];

if(!isset($_SESSION[$UserID])){
    $UserID=$_SESSION["UserID"];
    // $_SESSION["UserID"]=$UserID;
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

  //retrive user information for donation
  $query = "SELECT DonationTotal, DonationMessage FROM donationjoined WHERE DonationID = $DonationID AND UserID = $UserID";
  $result = mysqli_query($dbc, $query);
  
  if ($result && mysqli_num_rows($result) > 0) {
    // Fetch donation total
    $donationData = mysqli_fetch_assoc($result);
    $DonationTotal = $donationData['DonationTotal'];
    // Check if DonationMessage is set before accessing its value
    $DonationMessage = isset($donationData['DonationMessage']) ? $donationData['DonationMessage'] : null;
} else {
    // Handle case where no donation data is found
    echo "No donation data found.";
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


<!-- start summary -->
<br>
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
                         <h4 class="card-header">Payment </h4>
                    </div>
                        <div class="card-body">
                        <<form action="#" method="POST" enctype="multipart/form-data">
                            <div class="row">
                            <div class="container">
                                <h3>Card Details</h3>
                                <div class="form-group">
                                    <label for="CardHolder">Name on card :</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                    <input type="text" class="form-control" id="CardHolder" name="CardHolder">
                                </div>
                                </div>
                                <label for="cardType">Payment Type :</label>
                                <div class="card-buttons">
                                    <label class="card-label" style="padding: 2%;">
                                        <!-- <div class="card" style=" width: 100px; height: 60px;"> -->
                                            <input type="radio" name="cardType" value="visa">
                                            <img src="../front-end/images/payment types/visa.png" alt="Visa Card" style="max-width: 100px; max-height: 60px;">
                                        <!-- </div> -->
                                    </label>

                                    <label class="card-label" style="padding: 2%;">
                                        <!-- <div class="card" style=" width: 100px; height: 60px;"> -->
                                            <input type="radio" name="cardType" value="mastercard">
                                            <img src="../front-end/images/payment types/mastercard.png" alt="Mastercard Card" style="max-width: 80px; max-height: px;">
                                        <!-- </div> -->
                                    </label>

                                    <label class="card-label" style="padding: 2%;">
                                        <!-- <div class="card" style=" width: 100px; height: 60px;"> -->
                                            <input type="radio" name="cardType" value="tng">
                                            <img src="../front-end/images/payment types/tng.png" alt="Touch and Go wallet" style="max-width: 100px; max-height: 60px;">
                                        <!-- </div> -->
                                    </label>

                                    <label class="card-label" style="padding: 2%;">
                                        <!-- <div class="card" style=" width: 100px; height: 60px;"> -->
                                            <input type="radio" name="cardType" value="grab">
                                            <img src="../front-end/images/payment types/grab.png" alt="Grab Wallet" style="max-width: 100px; max-height: 60px;">
                                        <!-- </div> -->
                                    </label>
                                </div>

                                    <div class="form-group">
                                        <label for="CardDetails"> Card Number :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="CardNumber" name="CardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" pattern="\d{16}" title="Please enter a 16-digit card number" inputmode="numeric">
                                        </div>
                                    </div>



                                <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="month">Expiry Date :</label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>
                                        <input type="date" class="form-control" id="CardHolder" name="CardHolder" placeholder="MM/YY">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-2">
                                    <div class="form-group">
                                        <label for="CVV">CVV :</label>
                                        <input type="text" class="form-control" id="CardHolder" name="CardHolder" placeholder="***">
                                    </div>
                                    </div>
                                </div> 
                                </div>
                            
                            </div>
                        </div>
                    </div>
            </div>


            <!-- Right card section for payment options (placeholder) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Summary</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="user-details">
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
                        <h5>Select Payment Method:</h5>
                        <div class="payment-options">
                            <button class="btn btn-primary btn-lg btn-block mb-3" onclick="selectPayment('online')">Online Transfer</button>
                            <button class="btn btn-primary btn-lg btn-block" onclick="selectPayment('card')">Debit/Credit Card</button>
                        </div>
                    </div>
                </div>
                <br>
               
             </div>
            </div>
      </section>
</div>

<!-- end summary -->

<!-- end form -->
<br>
<br>
<?php include('include/footer.php'); ?>
