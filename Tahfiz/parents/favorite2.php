<?php
        include('../connection.php');
	session_start();

  $parents_ID = $_SESSION['parents_ID'];
  $schools_ID = $_POST['schools_ID'];
  $favorited = $_POST['favorited'];
  $update = $connection->query("UPDATE favorite SET favorited WHERE parents_ID = '$parents_ID' AND schools_ID = '$schools_ID'");

?>
