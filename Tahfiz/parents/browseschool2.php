<?php
        include('../connection.php');
          $display = $connection->query("SELECT * FROM school_list")
          $row = $display->fetch_array();

?>
