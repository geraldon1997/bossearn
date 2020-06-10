<?php

require_once 'layout/header.php';
?>
<style>
    .section{
        margin-top: 100px;
        /* margin-bottom: 50px; */
    }
</style>
<section class="section lb">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget-no-style">
                        <div class="newsletter-widget text-center align-self-center">
                            <h3>Subscribe Today!</h3>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <form class="form-inline" method="post">
                                <input type="text" name="email" placeholder="Add your email here.." required class="form-control" />
                                <input type="submit" value="Subscribe" class="btn btn-default btn-block" />
                            </form>         
                        </div><!-- end newsletter -->
                    </div>

                    
                </div><!-- end sidebar -->
            </div><!-- end col -->
            
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="row">
                        
                    </div><!-- end row -->

                    <hr class="invis">

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-wrapper">
                            <h4>Contact form</h4>
                                <input type="text" class="form-control" placeholder="Your name">
                                <input type="text" class="form-control" placeholder="Email address">
                                <input type="text" class="form-control" placeholder="Phone">
                                <input type="text" class="form-control" placeholder="Subject">
                                <textarea class="form-control" placeholder="Your message"></textarea>
                                <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                            </form>
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<?php require_once 'layout/footer.php'; ?>