<?php

require_once 'layout/header.php';

use App\Controllers\ContactController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  ContactController::sendMail();
}
?>
<style>
    .section{
        margin-top: 100px;
        /* margin-bottom: 50px; */
    }
  .chat{
    margin: 10px;
  }
</style>
<section class="section lb">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="row">

                    </div><!-- end row -->

                    <hr class="invis">

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-wrapper" method="post">
                            <h4>Contact form</h4>
                                <input type="text" class="form-control" name="cn" placeholder="Your name">
                                <input type="text" class="form-control" name="ce" placeholder="Email address">
                                <input type="text" class="form-control" name="cs" placeholder="Subject">
                                <textarea class="form-control" name="cm" placeholder="Your message"></textarea>
                                <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                            </form>
                          <p>
                            <?php
                            if (isset(ContactController::$success['mail'])) {
                              echo ContactController::$success['mail'];
                            } elseif (isset(ContactController::$error['mail'])) {
                            	echo ContactController::$error['mail'];
                            }
                            ?>
                          </p>
							<div class="row">
                          	<div class="col-md-12 chat">
                            	<a href="https://wa.me/2347018242137?text=Welcome%20to%20bossearn.%20What%20information%20do%20you%20need%20" class="btn">click to message admin on whatsapp</a>
                            </div>
                            <div class="col-md-12 chat">
                              <a href="https://www.instagram.com/BOSSEARN_CEO" class="btn">click to message admin on instagram</a>
                            </div>
                            <div class="col-md-12 chat">
                              <a href="https://www.facebook.com/groups/563831221190622/?ref=share" class="btn">click to message admin on facebook</a>
                            </div>
                          </div>

                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<?php require_once 'layout/footer.php'; ?>