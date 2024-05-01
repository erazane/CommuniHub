<?php include('includes/menuCom.php'); ?>

    <!-- Main Content Section Starts -->

    <div class="MainContent">
    <div class="banner">
    
        <div>
            <h3>One step solution to suburban management</h3>
        </div>

        <div>
            <h1>Better Community Creates A Better Life</h1>
        </div>

        <!-- <div>
            <a href="login.php">
                <button class="button">Register</button>
            </a>
        </div>

        <div>
            <a href="register.php">
                <button class="button">Login</button>
            </a>
        </div> -->
        </div>

        <div class="wrapper">
            <h1>Committee Dashboard</h1>
        <br>
        <br>
            <!--session for when login is successful-->
            <?php
            session_start();
            if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']); // Clear the message after displaying
            }
            ?>
                <br>
                <br>

             <div class="col-4">
                <h1>5</h1>
                <br>
                Categories
             </div>
             <div class="col-4">
                <h1>5</h1>
                <br>
                Categories
             </div>
             <div class="col-4">
                <h1>5</h1>
                <br>
                Categories
             </div>
             <div class="col-4">
                <h1>5</h1>
                <br>
                Categories
             </div>
             
             <div class="clearfix"></div>

        </div>
    </div>

    <!--Main Content Section ends -->

<?php include('includes/footerCom.php'); ?>   