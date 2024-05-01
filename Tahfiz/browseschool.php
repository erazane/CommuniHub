<?php
include_once'header.php';
include('connection.php');
?>

<section id="about-sec">
    <div class="container">
        <div class="row">
            <h2 class="text-center">TAHFIZ SCHOOL</h2>
            <hr>
            <!-- <br> -->
            <!-- <h5>Choose school stage:</h5> -->
            <!-- <h3><br>WE NEED YOUR HELP TO HELP OTHERS</h3> -->
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                      <b>Search by name:</b>
                        <input class="form-control" name="cari" placeholder="Search by school name" type="text">
                    </div>
                </div>
        </div>
        <div class="col-md submit-button text-center">
            <input type="submit" value="Search by name" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 10px 0; transform:none;">
        </div>

        <div class="row">
                <div class="col-xs-3 col-md-offset-3" style="margin-bottom: 10px;">
                    <select class="form-control" name="level">
                        <option value="0" selected="selected">
                            Select Level...
                        </option>
                        <?php
                        $level = $connection->query("SELECT DISTINCT category_name FROM school_category");
                        while($fetch = $level->fetch_array()){ ?>
                        <option value="<?php echo $fetch['category_name'];?>">
                            <?php echo $fetch['category_name'];?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-xs-3">
                    <select class="form-control" name="state">
                        <option value="0" selected="selected">
                            Select State..
                        </option>
                        <?php
                        $state = $connection->query("SELECT DISTINCT school_liststate FROM school_list");
                        while($fetch = $state->fetch_array()){ ?>
                        <option value="<?php echo $fetch['school_liststate'];?>">
                            <?php echo $fetch['school_liststate'];?>
                        </option>
                        <?php } ?>

                    </select>
                </div>
        </div>
    </div>

    <div class="col-md submit-button text-center">
        <input type="submit" value="Filter by school level & state" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 0px 0 0px 0; transform:none;">
        <br>
        <input type="submit" value="Filter All" name="search" class="btn2 glyphicon-search" id="submit" style="border:none; margin: 10px 0 0px 0; transform:none; background: #118f56;">
    </div>

    </form>
    <hr>

    <!-- <div class="container"> -->
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
    <!-- </div> -->

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
                    <td class="text-center"><a style="color:#444444" data-toggle="tooltip" data-placement="top" title="Tooltip on top" href="<?php echo $fetch['school_listwebsite']; ?>">Visit Website</td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>
    <?php } ?>
</section>

<?php include_once'footer.php';
?>
