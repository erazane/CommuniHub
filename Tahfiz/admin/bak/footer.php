<footer class="footer">
  <div class="footer-body">
    <div class="container">
      <div class="row">
        <div class="col-6 col-md-4">
          <div class="footer-section">
            <h4 class="footer-section-title">About Tahfiz Care</h4><!-- /.footer-section-title -->

            <div class="footer-section-body">
              <p>Tahfiz Care is a non-profit project to provide the people all around Malaysia a platform to make a
                donation and have a helping hand by joining any event that was held by any Tahfiz School in Kuala
                Lumpur and Selangor.
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
              <p><b>Address:</b> Unikl City Campus, Jalan Sultan Ismail, Kuala Lumpur</p>

              <div class="footer-contacts">
                <p>
                  <b>
                    <i class="fa fa-phone"></i> Phone:
                  </b>

                  013-990 1824
                </p>

                <p>
                  <b>
                    <i class="fa fa-envelope-o"></i> Email:
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
<script src="js/fancySelect.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/banner.js"></script>
<script src="js/jquery.swipebox.js"></script>
<script type="text/javascript">
  $(document).ready(function () {

    /* Basic Gallery */
    $('.swipebox').swipebox();

    /* Video */
    $('.swipebox-video').swipebox();

    /* Dynamic Gallery */
    $('#gallery').click(function (e) {
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
  $(document).ready(function () {
    $('#menu').fancySelect();
  });
</script>

<script>
  const map = {
    Kindergarten: 'Kindergarten file name',
    Primary: 'searchprimary.php',
    Secondary: 'login.php'
  }
  document.getElementById('submit').addEventListener('click', () =>
    location.href = map[document.getElementById('menu').value])
</script>

<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
</body>

</html>
