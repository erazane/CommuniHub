<?php
        include('../connection.php');
	session_start();

  $parents_ID = $_SESSION['parents_ID'];
  $schools_ID = $_POST['schools_ID'];
  $favorited = $_POST['favstatus'];

   $con  =  mysqli_connect("localhost","root","","tahfizcare");
   $checker =mysqli_num_rows(mysqli_query($con,"SELECT *
   FROM favorite WHERE parents_ID = '$parents_ID' AND
   schools_ID = '$schools_ID'"));





  if($checker == 0 ){
    $insert = $connection->query("INSERT INTO favorite(favstatus, parents_ID, schools_ID) VALUES('$favorited', '$parents_ID',
      '$schools_ID');");

          $_SESSION['success'] = '';
           // echo "<script type='text/javascript'>alert('Favorited!');"
           // . "window.location='schoolprofile.php?schools_ID=". $schools_ID . " ';"
           //         . "</script>";

            header('location:schoolprofile.php?schools_ID='.$schools_ID);
  }
  else if($checker == 1 ){
      $insert = $connection->query("DELETE FROM favorite WHERE parents_ID = '$parents_ID' AND
    schools_ID = '$schools_ID'");

          $_SESSION['success'] = '';
           // echo "<script type='text/javascript'>alert('Favorited!');"
           // . "window.location='schoolprofile.php?schools_ID=". $schools_ID . " ';"
           //         . "</script>";

           header('location:schoolprofile.php?schools_ID='.$schools_ID);
  }
else {
  echo "<script type='text/javascript'>alert('Something wrong!');"
  . "window.location='schoolprofile.php?schools_ID=". $schools_ID . " ';"
          . "</script>";
}

?>
