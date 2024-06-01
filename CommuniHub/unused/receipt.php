<?php 
session_start();
require_once('include/header.php'); 

// Check if UserID is set in session, if not, use the one from URL parameter
if (!isset($_SESSION["UserID"])) {
  $_SESSION["UserID"] = $_GET['UserID']; // Set UserID in session if it's not already set
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once('../Database/database.php');

  $UserID = $_POST['UserID'];
  $DonationID = $_POST['DonationID'];
  $DonationTotal = $_POST['DonationTotal'];
  $DonationMessage = $_POST['DonationMessage'];
  $cardType =$_POST ['cardType'];


  if (!isset($_SESSION['UserID'])) {
      $_SESSION['UserID'] = $UserID;
  } else {
      $UserID = $_SESSION['UserID'];
  }

  $query = "SELECT UserFirstName, UserLastName  FROM user WHERE UserID = $UserID";
  $result = mysqli_query($dbc, $query);

  if ($result) {
      $userData = mysqli_fetch_assoc($result);
      $UserFirstName = $userData['UserFirstName'];
      $UserLastName = $userData['UserLastName'];
  } else {
      echo "Error: " . mysqli_error($dbc);
  }
}
?>

<section class="service_section layout_padding">
    <div class="container" style="max-width: 800px; padding: 2%;">
        <div class="row justify-content-center">
            <!-- Left card section for user details -->
            <div class="col-md-12" style="max-width: 1200px;">
                <div class="card" style="padding: 5%;">
                <div class="heading_container heading_center">
                    <h2>Transaction Successful</h2>
                    <hr>
                </div>
                    <div class="card-body text-center"> <!-- Center the content -->
                        <img src="./images/receipt/verified.gif" alt="Transaction Verified" style="width: 400px; display: block; margin: 0 auto;"> <!-- Center the image -->
                    </div>
                        <h4>Dear <?php echo 'UserFirstName'; ?>,</h4>
                        <h5>Your donation of <?php echo 'DonationTotal'; ?> has been successfully processed.</h5>
                        <br>
                        <h5>Your support means a lot to us. Thank you for your generosity!</h5>
                        <hr>
                        <a href="donations.php" class="btn btn-secondary mt-3">Back</a> 
                        <a href="generate-pdf.php" class="btn btn-primary mt-3">Generate PDF</a> 
                    </div>
                
            </div>
        </div>
    </div>
</section>

<?php include('include/footer.php'); ?>
