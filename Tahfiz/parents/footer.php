<footer class="footer">
    <div class="footer-body">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="footer-section">
                        <h4 class="footer-section-title">About Tahfiz Care</h4><!-- /.footer-section-title -->

                        <div class="footer-section-body">
                            <p style="color: #878C92;">Tahfiz Care application is about enhancing the relations between the muslim society and Tahfiz schools. Tahfiz Care allow Tahfiz Schools to advertise school information, events and donations. Society can use this application to identify and make a comparison between Tahfiz Schools in Malaysia.
                            </p>
                        </div><!-- /.footer-section-body -->
                    </div><!-- /.footer-section -->
                </div><!-- /.columns large-3 medium-12 -->

                <div class="col-6 col-md-4">
                    <div class="footer-section">
                        <h4 class="footer-section-title">Quick Links</h4><!-- /.footer-section-title -->

                        <div class="footer-section-body">
                            <ul class="list-links">
                                <li>
                                    <a href="index.php">Home</a>
                                </li>

                                <li>
                                    <a href="">School List</a>
                                </li>

                                <li>
                                    <a href="">Donation</a>
                                </li>
                                <li>
                                    <a href="">Events</a>
                                </li>

                                <li>
                                    <a href="">About Us</a>
                                </li>

                                <li>
                                    <a href="">Contact Us</a>
                                </li>

                            </ul><!-- /.list-links -->

                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-3">
          <div class="footer-section">
            <h4 class="footer-section-title">Newsletter Signup</h4>

            <div class="footer-section-body">
              <p>Select your newsletters, enter your email address, and click "Subscribe"</p>

              <div class="subscribe">
                <form action="?" method="post">
                  <input type="submit" value="Go" class="subscribe-btn">

                  <div class="subscribe-inner">
                    <input type="email" id="mail" name="mail" value="" placeholder="Email Address" class="subscribe-field">
                </div>
                </form>
              </div>
            </div>
          </div>
        </div> -->

                <div class="col-6 col-md-4">
                    <div class="footer-section">
                        <h4 class="footer-section-title">Contact Us</h4><!-- /.footer-section-title -->

                        <div class="footer-section-body">
                            <p style="color: #878C92;"><b><i class="fas fa-map-marker-alt"></i> Address:</b> Unikl City Campus, Jalan Sultan Ismail, Kuala Lumpur</p>

                            <div class="footer-contacts">
                                <p style="color: #878C92;">
                                    <b>
                                        <i class="fa fa-phone"></i> Phone:
                                    </b>

                                    013-990 1824
                                </p>

                                <p style="color: #878C92;">
                                    <b>
                                        <i class="fas fa-envelope-open"></i> Email:
                                    </b>

                                    syedzaquan@gmail.com
                                </p>
                            </div><!-- /.footer-contacts -->
                        </div><!-- /.footer-section-body -->
                    </div><!-- /.footer-section -->
                </div><!-- /.columns large-3 medium-12 -->
            </div><!-- /.row -->
        </div>
    </div><!-- /.footer-body -->

    <div class="bwt-footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-text">Copyright &copy; Tahfiz Care 2018. All Rights Reserved</div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="../js/fancySelect.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../js/bootsnav.js"></script>
<script src="../js/banner.js"></script>
<script src="../js/jquery.swipebox.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        /* Basic Gallery */
        $('.swipebox').swipebox();

        /* Video */
        $('.swipebox-video').swipebox();

        /* Dynamic Gallery */
        $('#gallery').click(function(e) {
            e.preventDefault();
            $.swipebox([{
                    href: 'http://swipebox.csag.co/mages/image-1.jpg',
                    title: 'My Caption'
                },
                {
                    href: 'http://swipebox.csag.co/images/image-2.jpg',
                    title: 'My Second Caption'
                }
            ]);
        });

    });
</script>

<script>
    $(function() {
        $("input[name='others']").click(function() {
            if ($("#othersradio").is(":checked")) {
                $("#enteramount").show();
            } else {
                $("#enteramount").hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('change', function() {
            var selvalue = $("[name='amount']:checked").val();
            $('#selvalue').val($("[name='amount']:checked").val());
        });
    });
</script>

<script>
    function myFunction() {
        document.getElementById("selvalue").value = document.getElementById("txtamount").value;
    }
</script>

<script>
    $(document).ready(function() {
        $('#menu').fancySelect();
    });
</script>

<script>
    // unfollow mouseover effect
    $(document).on({
        mouseenter: function() {
            $(this).addClass("btn-danger");
            $('.favorited').hide();
            $('.unfavorite').show();
        },
        mouseleave: function() {
            //stuff to do on mouse leave
            $(this).removeClass("btn-danger");
            $('.unfavorite').hide();
            $('.favorited').show();
        }
    }, ".btn-favorited"); //pass the element as an argument to .on
</script>

<script>
    // follow/unfollow button handling
    $('.btn-favorite').click(function() {
        if ($(this).hasClass('btn-favorited')) {
            // successful unfollow
            $(this).removeClass('btn-favorited');
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-primary');
            $('.favorited').hide();
            $('.unfavorite').hide();
            $('.favorite').show();

            // unfollow ajax here
        } else {
            // successful follow
            $(this).addClass('btn-favorited');
            $(this).removeClass('btn-primary');
            $('.favorite').hide();
            $('.favorited').show();

            // follow ajax here
        }

    });
</script>

<script>
    $(function() {
        $(".heart").on("click", function() {
            $(this).toggleClass("is-active");
            setTimeout(function() {
                window.location.reload();
            }, 1250);
        });
    });
</script>

<script>
    $("#sub1").click(function() {
        $.post($("#myForm").attr("action"),
            $("#myForm :input").serializeArray(),
            function(info) {
                $("#result").html(info);
            });
        // clearInput();
    });
</script>

<!-- <script>
    $("#myForm").submit(function() {
        return false;
    });
</script> -->

<script>
    function clearInput() {
        $("#myForm :input").each(function() {
            $(this).val('');
        });
    }
</script>

<script>
    $(function() {
        $(".heart2").on("click", function() {
            $(this).toggleClass("is-active2");
        });
    });
</script>

<script>
    $("#sub2").click(function() {
        $.post($("#myForm").attr("action"),
            $("#myForm :input").serializeArray(),
            function(info) {
                $("#result").html(info);
            });
        // clearInput();
    });
</script>

<!-- <script>
    $("#myForm").submit(function() {
        return false;
    });
</script> -->

<script>
    function clearInput() {
        $("#myForm :input").each(function() {
            $(this).val('');
        });
    }
</script>



<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script>
    $(".btn input:file").change(function() {
        $("input[name='images_upload[]']").each(function() {
            var fileName = $(this).val().split('/').pop().split('\\').pop();
            $(".filename").val(fileName);
        });
    });
</script>

<script>
$(document).ready(function(){

       $('#submenu li a').on('click', function(e){
          // $('#submenu').removeClass('in');
         $('#submenu').toggleClass();
       });

    });
</script>

<script src="../js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
<script>
    if (!window.jQuery) document.write('<script src="../js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="../js/cart.js"></script> <!-- Resource jQuery -->
<script src="js/classie.js"></script>
<script src="js/compare.js"></script>
</body>

</html>
