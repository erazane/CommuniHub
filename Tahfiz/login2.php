<?php
           include('connection.php');
           session_start();

           $email = $_POST['email'];
           $password = $_POST['password'];

           $login = $connection->query("SELECT * FROM login WHERE email='$email' AND password='$password'");

           $fetch = $login->fetch_array();


           if($login->num_rows ==1)
           {
               if($fetch['type'] == 'tahfiz' && $fetch['status'] == 'Approved' )
               {
                  $_SESSION['schools_ID'] = $fetch['schools_ID'];
                  $_SESSION['email'] = $fetch['email'];
                  header('location:schools/index.php');
               }
               else if($fetch['type'] == 'parent')
               {
                  $_SESSION['parents_ID'] = $fetch['parents_ID'];
                  $_SESSION['email'] = $fetch['email'];
                  header('location:parents/index.php');

               }
               else if($fetch['type'] == 'admin')
               {
                  $_SESSION['admin_ID'] = $fetch['admin_ID'];
                  $_SESSION['email'] = $fetch['email'];
                  header('location:admin/index.php');

               }
               if($fetch['type'] == 'tahfiz' && $fetch['status'] == 'Pending' )
               {
                  $_SESSION['schools_ID'] = $fetch['schools_ID'];
                  $_SESSION['email'] = $fetch['email'];
                  echo "<script type='text/javascript'>alert('Your school is not approve by admin yet.');
                    window.location='loginas.php';
                    </script>";
               }
           }
          else
          {
               $_SESSION['error'] = '';
               echo "<script type='text/javascript'>alert('Email or password was incorrected.');
                 window.location='loginas.php';
                 </script>";

          }
?>
