<?php
    include_once'../admin/header.php';
?>

<?php
           $admin = $connection->query("SELECT * FROM admin WHERE admin_ID='".$_SESSION['admin_ID']."'");
           while($row2 = $admin->fetch_array()){
                   ?>
<div class="row text-center">
                   <h2>Welcome, <?php echo $row2['username'];?></h2>
                     <?php } ?>
                     </div>

<?php
    include_once'../admin/footer.php';
?>
