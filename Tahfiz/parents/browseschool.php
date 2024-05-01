<?php include_once'../parents/header.php';
?>

<div class="bg">
  <div class="container">
  </div>
</div>

<section id="about-sec">
    <div class="container">
        <div class="row text-center">
            <h2>FIND THE RIGHT SCHOOL<br>
                FOR YOUR CHILD</h2>
            <hr>
            <h3>Filter your school:</h3>
            <br>
            <!-- <br> -->
            <!-- <h5>Choose school stage:</h5> -->
            <!-- <h3><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
            <form action="" method="post">
                <div class="center-on-page">

                    <div class="col-xs-6 col-sm-3">
                        <input class="form-control" name="cari" placeholder="Search by school name" type="text">
                    </div>


                    <div class="col-xs-6 col-sm-3">
                        <select class="form-control" name="level">
                            <option value="0" selected="selected">
                                Select Level...
                            </option>
                            <?php
                        $level = $connection->query("SELECT DISTINCT category_name FROM school_category");
                        while($fetch = $level->fetch_array()){ ?>
                            <option value="<?php echo $fetch['category_name'];?>"><?php echo $fetch['category_name'];?></option>
                    <?php } ?>
                        </select>
                    </div>

                    <div class="col-xs-6 col-sm-3">
                        <select class="form-control" name="state">
                            <option value="0" selected="selected">
                               Select State..
                            </option>
                            <?php
                        $state = $connection->query("SELECT DISTINCT school_liststate FROM school_list");
                        while($fetch = $state->fetch_array()){ ?>
                            <option value="<?php echo $fetch['school_liststate'];?>"><?php echo $fetch['school_liststate'];?></option>
                    <?php } ?>

                        </select>
                    </div>

                    <div class="col-xs-6 col-sm-3">
                        <select class="form-control">
                            <option value="0" selected="selected">
                                Average Fees
                            </option>
                            <option value="1">
                                RM 100 - RM 200
                            </option>
                            <option value="2">
                                RM 200 - RM 300
                            </option>
                            <option value="3">
                                RM 300 - RM 400
                            </option>
                            <option value="4">
                                RM 400 - RM 500
                            </option>
                        </select>
                    </div>
                </div>
        </div>

    </div>
    <div class="col-md submit-button text-center">
        <input type="submit" value="Search" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 20px 0 0 0">
    </div>

</form>
<hr>

<div class="container">
    <?php
    if (isset($_POST['search'])) {
        $search = $_POST['cari'];
        $level = $_POST['level'];
        $state = $_POST['state'];

        ?>
        <h4 class="h5-responsive font-weight-bold my-2 text-center black-text">List of Tahfiz School</h4>
        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center"><strong>School Name</strong></th>
                    <th class="text-center"><strong>Level</strong></th>
                    <th class="text-center"><strong>State</strong></th>
                    <th class="text-center"><strong>Registration Fees</strong></th>
                    <th class="text-center"><strong>Website</strong></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $list = $connection->query("SELECT a.school_catID, b.school_catID, b.category_name, a.school_listname, a.school_listfees, a.school_liststate
                        FROM school_list a
                        INNER JOIN
                        school_category b
                        WHERE (a.school_listname LIKE '%" . $search . "%') && a.school_catID=b.school_catID && (a.school_liststate LIKE '%" . $state . "%') && (b.category_name LIKE '%" . $level . "%')");
                        while ($fetch = $list->fetch_array()) {



                ?>

                    <tr>
                        <td class="text-center">
                            <?php echo $fetch['school_listname']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $fetch['category_name']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $fetch['school_liststate']; ?>
                        </td>
                        <td class="text-center">RM
                            <?php echo $fetch['school_listfees']; ?>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $fetch['school_listwebsite']; ?>">Visit Website
                        </td>
                    </tr>

    <?php } ?>

            </tbody>
        </table>
    </div>

<?php } else { ?>

    <div class="container">

        <h4 class="h5-responsive font-weight-bold my-2 text-center black-text">List of Tahfiz School</h4>
        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center"><strong>School Name</strong></th>
                    <th class="text-center"><strong>Level</strong></th>
                    <th class="text-center"><strong>State</strong></th>
                    <th class="text-center"><strong>Registration Fees</strong></th>
                    <th class="text-center"><strong>Website</strong></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $list = $connection->query("SELECT a.school_catID, b.school_catID, b.category_name, a.school_listname, a.school_listfees, a.school_liststate
                        FROM school_list a
                        INNER JOIN
                        school_category b
                        WHERE a.school_catID=b.school_catID ");
                        while ($fetch = $list->fetch_array()) {
                ?>

                    <tr>
                        <td class="text-center">
                            <?php echo $fetch['school_listname']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $fetch['category_name']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $fetch['school_liststate']; ?>
                        </td>
                        <td class="text-center">RM
        <?php echo $fetch['school_listfees']; ?>
                        </td>
                        <td class="text-center"><a style="color:#444444" data-toggle="tooltip" data-placement="top" title="Tooltip on top"
                                                   href="<?php echo $fetch['school_listwebsite']; ?>">Visit Website</td>
                    </tr>

    <?php } ?>

            </tbody>
        </table>
    </div>
<?php } ?>
</section>

<?php include_once'../parents/footer.php';
?>
