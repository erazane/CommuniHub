<?php
session_start();
require_once "include/header.php";
require_once "../Database/database.php"; // Include database connection file

// Getting the filter value from the form
$filterOrder = isset($_GET["filterOrder"]) ? $_GET["filterOrder"] : "DESC";

// Get the discussionID from the URL
$discussionID = isset($_GET["discussionID"])
    ? intval($_GET["discussionID"])
    : 0;

if ($discussionID <= 0) {
    die("Invalid Discussion ID");
}

//for the pagination
if (isset($_GET["discussionID"])) {
    $discussionID = intval($_GET["discussionID"]);
} else {
    $discussionID = 0;
}

// Check if page number is set in the URL, default to 1 if not set
if (isset($_GET["page"])) {
    $page = intval($_GET["page"]);
} else {
    $page = 1;
}
// Define the number of replies per page
$repliesPerPage = 10;

// Calculate the offset
$offset = ($page - 1) * $repliesPerPage;

// Fetch the specific discussion based on its ID
$query = "
    SELECT d.DiscussionID, d.title AS ComplainTitle, d.description AS ComplaintDescription, d.date AS ComplaintDate, u.UserFirstName, u.UserLastName, u.image AS image
    FROM discussion d
    JOIN user u ON d.UserID = u.UserID
    WHERE d.DiscussionID = $discussionID
";
$result = mysqli_query($dbc, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($dbc));
}

$discussion = mysqli_fetch_assoc($result);

if (!$discussion) {
    die("Discussion not found");
}

// Fetch the replies for the specific discussion
$repliesQuery = "
    SELECT r.DiscussionRepliesID, r.description AS ReplyDescription, r.dateReplied AS ReplyDate, r.UserID, u.UserFirstName, u.UserLastName, u.image AS UserImage
    FROM discussionreplies r
    JOIN user u ON r.UserID = u.UserID
    WHERE r.DiscussionID = $discussionID
    ORDER BY r.dateReplied $filterOrder
    LIMIT $offset, $repliesPerPage
";

$repliesResult = mysqli_query($dbc, $repliesQuery);

if (!$repliesResult) {
    die("Query failed: " . mysqli_error($dbc));
}

$replies = [];
while ($row = mysqli_fetch_assoc($repliesResult)) {
    $replies[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["description"])) {
        $description = mysqli_real_escape_string($dbc, $_POST["description"]);
        $dateReplied = date("Y-m-d");
        $userID = $_SESSION["UserID"];

        $query = "INSERT INTO discussionreplies (description, dateReplied, UserID, DiscussionID) VALUES ('$description', '$dateReplied', '$userID', '$discussionID')";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            $_SESSION["success"] = "Reply added successfully!";
            header("Location: replies.php?discussionID=$discussionID");
            exit();
        } else {
            $_SESSION["error"] = "An error occurred while adding your reply.";
        }
    }
}
?>

<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="heading_container heading_center">
                <h2>Complain Title: <?php echo htmlspecialchars(
                    $discussion["ComplainTitle"]
                ); ?></h2>
                <hr style="width: 350px; text-align: center">
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="images/profile-picture/<?php echo $discussion[
                                "image"
                            ]
                                ? $discussion["image"]
                                : "default_profile_picture.png"; ?>" alt="Profile Picture" class="img-fluid rounded-circle">
                        </div>
                        <div class="col-md-10">
                            <div class="box">
                                <div class="d-flex justify-content-between">
                                    <h5>Name: <?php echo htmlspecialchars(
                                        $discussion["UserFirstName"]
                                    ) .
                                        " " .
                                        htmlspecialchars(
                                            $discussion["UserLastName"]
                                        ); ?></h5>
                                    <h5>Date: <?php echo htmlspecialchars(
                                        $discussion["ComplaintDate"]
                                    ); ?></h5>
                                </div>
                                <br>
                                <!-- <h5>Complain Title: <?php echo htmlspecialchars(
                                    $discussion["ComplainTitle"]
                                ); ?></h5> -->
                                <h5> Description: <br><br>
                                <?php echo htmlspecialchars(
                                    $discussion["ComplaintDescription"]
                                ); ?></h5><br>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Display replies -->
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <h3>Replies</h3>
            <div class="d-flex justify-content-between">
                <div class="text-right"><a href="#replySection" class="btn btn-primary">Reply</a></div>

                <!-- Form to apply filter order -->
                <form class="form-inline justify-content-end mb-3" method="GET" action="#">
                    <input type="hidden" name="discussionID" value="<?php echo $discussionID; ?>">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="filterOrder" class="mr-2">Order :</label>
                        <select class="form-control" id="filterOrder" name="filterOrder">
                            <option value="ASC" <?php if (
                                $filterOrder === "ASC"
                            ) {
                                echo "selected";
                            } ?>>Ascending</option>
                            <option value="DESC" <?php if (
                                $filterOrder === "DESC"
                            ) {
                                echo "selected";
                            } ?>>Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filter</button>
                </form>
            </div>

            <?php if (empty($replies)): ?>
                <div class="col-md-12">
                
                 <div class="card mb-3" style="background-color: white; display: flex; justify-content: center; align-items: center;">
                 <br>
                     <img src="./images/discussion.jpg" alt="Discussion Image" style="width: 350px; height: 350px;">
                     <h4>Looks lke there's no replies yet</h4><br><br>
                 </div>
             </div>
            <?php
                // $profilePicture = isset($reply['UserImage']) && !empty($reply['UserImage']) ? $reply['UserImage'] : 'default_profile_picture.png' ;
                // $profilePicture = isset($reply['UserImage']) && !empty($reply['UserImage']) ? $reply['UserImage'] : 'default_profile_picture.png' ;
                else: ?>
                <?php foreach ($replies as $reply): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <?php $profilePicture =
                                        isset($reply["UserImage"]) &&
                                        !empty($reply["UserImage"])
                                            ? $reply["UserImage"]
                                            : "default_profile_picture.png"; ?>
                                    <img src="images/profile-picture/<?php echo htmlspecialchars(
                                        $profilePicture
                                    ); ?>" alt="Profile Picture" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-md-10">
                                    <div class="box">
                                        <div class="d-flex justify-content-between">
                                            <h5>Name: <?php echo htmlspecialchars(
                                                $reply["UserFirstName"]
                                            ) .
                                                " " .
                                                htmlspecialchars(
                                                    $reply["UserLastName"]
                                                ); ?></h5>
                                            <h5>Date: <?php echo htmlspecialchars(
                                                $reply["ReplyDate"]
                                            ); ?></h5>
                                        </div>
                                        <br>
                                        <p><?php echo htmlspecialchars(
                                            $reply["ReplyDescription"]
                                        ); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
   

    <!-- Form to add a reply -->
    <div id="replySection" class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Add a Reply</h5>
                    <form id="addReplies" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" rows="4" required placeholder="Write your reply here ..."></textarea>
                        </div>
                        <button type="button" onclick="reply()" class="btn btn-primary">Submit Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- displaying the pagination -->
<div class="text-center mb-3">
    <?php
    // Query for the replies
    $query = "SELECT COUNT(*)  as totalreplies FROM discussionreplies WHERE DiscussionID = $discussionID";
    $results = mysqli_query($dbc, $query);
    $totalrepliesrow = mysqli_fetch_assoc($results);

    if ($totalrepliesrow) {
        $totalreplies = $totalrepliesrow["totalreplies"];

        // Calculate the total number of pages
        $totalPages = ceil($totalreplies / $repliesPerPage);

        echo '<div class="d-flex justify-content-between align-items-center">';

        // Back button
        echo '<div class="text-left">';
        echo '<a href="Discussion.php" class="btn btn-primary btn-lg mr-2">Back</a>';
        echo "</div>";

        // Pagination links
        echo "<div>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href=\"?discussionID=$discussionID&page=$i&filterOrder=$filterOrder\"";
            if ($i === $page) {
                echo " class=\"btn btn-primary mr-1\"";
            } else {
                echo " class=\"btn btn-outline-primary mr-1\"";
            }
            echo ">$i</a>";
        }
        echo "</div>";

        echo "</div>"; // Close d-flex
    } else {
        echo "No replies found.";
    }
    ?>
</div>
</div>



<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function reply() {
        var description = document.getElementById("description").value.trim();

        console.log(
            'swol data: ',
            description,
        )
        if (description === "") {
            Swal.fire("Error!", "Fields are empty.", "error");
            return;
        }

        Swal.fire({
            title: "Add Reply?",
            text: "Click confirm if you wish to proceed",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addReplies").submit();
            } else {
                console.log("User cancelled.");
            }
        });
    }
</script>

<?php include "include/footer.php"; ?>
