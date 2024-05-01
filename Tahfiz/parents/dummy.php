<?php
include_once'../parents/headerreceipt.php';
?>

<div class="container">
    <br>
    <!--Jumbotron-->
<div class="jumbotron">
    <div class="logo text-center">
        <img src="../images/S (300x300).png" class="img-fluid" style="width:100px; height:100px;">
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php
            $org = $connection->query("SELECT * FROM schools WHERE schools_ID=".$_GET['schools_ID']."");
                while($fetch = $org->fetch_array()){ ?>

            <label class="font-weight-bold">Organization ID: <?php echo $fetch['schools_ID'];?></label>
            <br>
            <label class=""><?php echo $fetch['school_name'];?></label>
            <br>
            <label class=""><?php echo $fetch['street_name'];?></label>
            <br>
            <label><?php echo $fetch['state'];?></label>
            <br>
            <label><?php echo $fetch['postcode'];?></label>

            <?php  } ?>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
            <?php
            $don = $connection->query("SELECT a.firstname, a.lastname, a.email, a.state, a.ic_number, b.donationtitle, b.donationstartdate, b.donationamount, b.image, b.donationenddate, b.schools_ID, b.donation_ID FROM parents a INNER JOIN donation b WHERE a.parents_ID=b.donation_ID && b.donation_ID=a.parents_ID");
            while($row2 = $don->fetch_array()){
                    ?>
            <label class="font-weight-bold">Donor ID: <?php echo $row2['donation_ID'];?></label>
            <br>
            <label>Donor Name:  <?php echo $row2['firstname'];?>  <?php echo $row2['lastname'];?></label>
            <br>
            <label>Date:  <?php echo date("Y/m/d");?></label>
            <br>
            <label>Receipt No:  <?php echo $_GET['receiptno'];?></label>
            <br>
               <?php  } ?>
        </div>
    </div>
    <!--Title-->
    <h1 class="card-title h2-responsive mt-2 text-center"><strong>Receipt</strong></h1>
    <!--Subtitle-->
    <p class="blue-text mb-4 font-bold"></p>



    <!--Text
    <div class="d-flex justify-content-center">
        <p class="card-text mb-3" style="max-width: 43rem;">Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium,
            totam rem aperiam. Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium
            doloremque laudantium, totam rem aperiam.
        </p>
    </div>-->
    <hr>
    <table class="table table-hover">

                    <thead>
                        <tr>
                            <th class="text-center"><strong>Donor ID</strong></th>
                            <th class="text-center"><strong>Donor Name</strong></th>
                            <th class="text-center"><strong>Donate to</strong></th>
                            <th class="text-center"><strong>Date</strong></th>
                            <th class="text-center"><strong>Donate Amount</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>


           <?php
            $don = $connection->query("SELECT a.Pub_ID, a.firstname, a.lastname FROM publicpeople a INNER JOIN temppayment b WHERE b.temppayment_ID='".$_GET['temppayment_ID']."' && a.Pub_ID=".$_SESSION['Pub_ID']."");
            while($row2 = $don->fetch_array()){
                    ?>
                            <td class="text-center"><em><?php echo $row2['Pub_ID'];?></em></h4></td>
                            <td class="text-center"><?php echo $row2['firstname'];?> <?php echo $row2['lastname'];?></td>
                            <?php  } ?>
            <?php
            $org = $connection->query("SELECT Org_ID, Name_Of_Org, streetName, city, state, passcode, acc_no FROM organizations WHERE Org_ID=".$_GET['Org_ID']."");
                while($fetch = $org->fetch_array()){ ?>
                            <td class="text-center"><?php echo $fetch['Name_Of_Org'];?></td>
                            <?php  } ?>
                            <td class="text-center"><?php echo date("Y/m/d");?></td>
                             <?php
            $org = $connection->query("SELECT paydonate FROM donation WHERE temppayment_ID=".$_GET['temppayment_ID']." && receipt_no=".$_GET['receipt_no']."");
                while($fetch = $org->fetch_array()){ ?>
                            <td class="text-center"><?php echo $fetch['paydonate'];?></td>
                             <?php  } ?>

                        </tr>
                        <tr>

                        </tr>
                        <tr>
                                                    </tr>
                    </tbody>
        </table>
    <button class="btn btn-outline-black btn-rounded float-right" onclick="window.print()"><i class="fa fa-print mr-1"></i> Print</button>



</div>
<!--Jumbotron-->
</div>

<?php
include_once'../parents/footer.php';
?>
