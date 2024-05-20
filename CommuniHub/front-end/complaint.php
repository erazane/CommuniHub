<?php 
session_start();
require_once('include/header.php'); 
?>
</div>


<br>

<br>
<div class="container" style="max-width: 1500px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="heading_container heading_center">
                <h2>Schedule Dashboard</h2>
                <hr style="width: 350px; text-align: center">
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#AddDiscussion">New Discussion</button>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="./images/profile-picture/default_profile_picture.png" style="width: 100%;" alt="Profile Picture">
                    </div>
                    <div class="col-md-10">
                    <div class="box">
                            <div class="d-flex justify-content-between">
                                <h5>Name : <?php echo $UserFirstName . ' ' . $UserLastName; ?></h5>
                                <h5>Date : <?php echo $UserFirstName ?> </h5>
                            </div>
                            <br>
                            <h5>Title : <?php echo $Title ?> ]</h5>
                            <p>Description : <?php echo $Description ?> </p>

                            <div class="text-left">
                                <a href="" class="btn btn-secondary mt-3">Back</a> 
                                <a href="reply.php" class="btn btn-primary mt-3">Reply</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="AddDiscussion" tabindex="-1" role="dialog" aria-labelledby="AddDiscussion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddDiscussion">New Discussion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="user_profile_section layout_padding">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="user_profile_container">
                                        <form id="addDiscussionForm" action="AddDiscussion.php" method="POST" enctype="multipart/form-data"> 
                                            <div class="form-group">
                                                <label for="Title">Title:</label>
                                                <input type="text" class="form-control" id="Title" name="Title"  required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Desc">Description:</label>
                                                <input type="text-area" class="form-control" id="Desc" name="Desc"  required>
                                            </div>
                                            <input type="hidden" name="user_id" value="<?php echo $UserID; ?>">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>

</div>

<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function submitForm() {
        var Desc = document.getElementById("Desc").value.trim();
        var Title = document.getElementById("Title").value.trim();

        if (Desc === "" || Title === "") {
            Swal.fire(
                "Error!",
                "Please fill out all required fields.",
                "error"
            );
            return; // Stop further execution
        }

        Swal.fire({
            title: "Add Discussion",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addDiscussionForm").submit(); // Submit the form
            }
        });
    }
</script>


<?php include('include/footer.php'); ?>
