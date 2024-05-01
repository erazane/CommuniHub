<?php include('../commitee/includes/menuCom.php'); ?>
<link rel="stylesheet" type="text/css" href="../Styles/committee.css">

<div class="MainContent">
<div class="table-schedule">

<h1>General Waste</h1>
<br>
<br>

<div class="schedule-collumns">
   
<h2>Garbage</h2>
<br>
<p>
    Pick Up day: 
</p>
<p>
    Pick Up Time:         
</p>
</div>
<br>
<br>

<h1>Recycling</h1>

<br>
<br>
<div class="schedule-collumns">
<h2>Glass</h2>
<br>
<p>
    Pick Up day: 
</p>
<p>
    Pick Up Time:       
</p>
</div>
<div class="schedule-collumns">
<h2>Paper</h2>
<br>
<p>
    Pick Up day: 
</p>
<p>
    Pick Up Time:       
</p>
</div>
<div class="schedule-collumns">
<h2>Plastic</h2>
<br>
<p>
    Pick Up day: 
</p>
<p>
    Pick Up Time: 
</p>
</div>


<?php
         //Displaying the admin from database into the table
         require_once ('../Database/database.php');// Connect to the db.
         global $dbc;

         // Make the query.
         $query = "SELECT GarbageDays, GarbagePickUpHour,GarbagePickupMinute, GlassPickupday,GlassPickupHour,GlassPickupMinute,PaperPickupDay,PaperPickupHour,PaperPickupMinute,PlasticPickupDay,PlasticPickupHour,PlasticPickupMinute
		   FROM schedule ORDER BY ScheduleID ASC";
         $result = @mysqli_query($dbc, $query); // Run the query.

         //to check if there is data inserted into the database
         $num = mysqli_num_rows($result);
         //if it is more then 0 then it proves we have data in the database
         if ($num > 0) {
            while($row=mysqli_fetch_assoc($result))
            {
               //using while loop to get all the data from database
               //while loop will run as long as we have data in the database

               //get data
               $GarbageDays=$row['GarbageDays'];
               $GarbagePickUpHour=$row['GarbagePickUpHour'];
               $GarbagePickupMinute=$row['GarbagePickupMinute'];
               $GlassPickupday=$row['GlassPickupday'];
               $GlassPickupHour=$row['GlassPickupHour'];
               $GlassPickupMinute=$row['GlassPickupMinute'];
               $PaperPickupDay=$row['PaperPickupDay'];
               $PaperPickupHour=$row['PaperPickupHour'];
               $PaperPickupMinute=$row['PaperPickupMinute'];
               $PlasticPickupDay=$row['PlasticPickupDay'];
               $PlasticPickupHour=$row['PlasticPickupHour'];
               $PlasticPickupMinute=$row['PlasticPickupMinute'];
               //display values into the table
               ?>
               
               <td><?php echo $GarbageDays;?></td>
               <td><?php echo $GarbagePickUpHour;?></td>
               <td><?php echo $GarbagePickupMinute;?></td>
               <td><?php echo $GlassPickupday;?></td>
               <td><?php echo $GlassPickupHour;?></td>
               <td><?php echo $GlassPickupMinute;?></td>
               <td><?php echo $PaperPickupDay;?></td>
               <td><?php echo $PaperPickupHour;?></td>
               <td><?php echo $PaperPickupMinute;?></td>
               <td><?php echo $PlasticPickupDay;?></td>
               <td><?php echo $PlasticPickupHour;?></td>
               <td><?php echo $PlasticPickupMinute;?></td>

               <?php
               
            }

         //theres no data in database
         }
         else
         {
            echo"No data in the database";
         }
         ?>
</div> 
<!-- end table schedule -->

</div>


<?php include('../commitee/includes/footerCom.php'); ?>