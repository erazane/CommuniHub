<?php include('include/header.php'); ?>

    <!-- end header section -->
  </div>

<!-- start php -->
<?php
session_start();
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
                         <h4 class="card-header"><?php echo isset($DonationName) ? $DonationName : '' ;?></h4>
                    </div>
                        <div class="card-body">
                        <!-- <img class="card-img-top" src="<?php echo isset($image) ? $image : 'placeholder_image_url.jpg'; ?>" alt="Image"> -->
                        <img class="card-img-top" src="../Committee/images/donations/<?php echo $image; ?>" alt="<?php echo $DonationName; ?>" >
                          <br><br>  
                            
                        <div class="intro-text" style="padding: 2%;">
                                 <h3 style="font-weight: bold;">
                                    Thank you for considering a donation to our cause.<br>
                                    Below, you'll find more details about the specific donation you've selected:
                                    </h3>
                            </div>
                            <div class="card-body">
                            <p class="card-text" style="text-align: justify;"><?php echo isset($DonationDesc) ? $DonationDesc : '' ;?></p>
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
                <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header text-center">
                            <h4>Join Other Donations</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                </div>
             </div>
        </div>
      </section>
</div>

<!-- end summary -->

<!-- end form -->
<br>
<br>
<?php include('include/footer.php'); ?>
