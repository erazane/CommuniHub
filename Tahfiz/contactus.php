<?php include_once'header.php';
?>

<section id="about-sec">
    <div class="container">
        <div class="row text-center">
            <h1>Contact Us</h1>
            <hr>
            <!-- <div class="clearfix"></div> -->
            <div class="con-form clearfix">
                <form action="contactus2.php" method="post">
                    <div class="col-md-4">
                        <input type="text" name="name" value="" size="40" class="" id="name" aria-required="true" aria-invalid="false" placeholder="Your Name*">
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" value="" size="40" class="" aria-required="true" aria-invalid="false" placeholder="Your Email*">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="subject" value="" size="40" class="" id="subject" aria-invalid="false" placeholder="Subject*">
                    </div>
                    <div class="col-md-12">
                        <textarea name="message" cols="40" rows="5" class="" id="message" aria-invalid="false" placeholder="Message*"></textarea>
                    </div>
                    <div class="col-xs-12 submit-button">
                        <input type="submit" value="send message" class="btn2" id="sub" style="border:none; margin: 20px 0 0 0">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include_once'footer.php';
?>
