<?php 
require_once 'layout/header.php'; 

use App\Models\Role;
use App\Models\User;
use App\Controllers\CouponController;
use App\Models\Post;

?>

<style>
    #bg{
        margin-top: 50px;
        width: 100%;
        height: 500px;
    }
  @media (max-width: 700px){
    #bg{
      width: 100%;
      height: 100%;
    }
  }
    .btn-news:hover{
        cursor: pointer;
        color: gold !important;
    }
    .btn-ep{
        background-color: orange !important;
        color: black !important;
    }
    .btn-ep:hover{
        background-color: black !important;
        color: white !important;
    }
</style>
<img src="App/Assets/Images/b1.jpeg" alt="" id="bg">
<marquee><b>Welcome to BOSSEARN please do login or click the Register to enjoy</b></marquee>
<div style="width:100%; text-align: center;">
<?php if (!isset($_SESSION['uname'])) {?>
<a href="register.php" class="btn" >Register</a>
<?php } ?>
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <?php
                            $post = Post::allPosts();
                            foreach ($post as $key) {
                            ?>
                            <div class="blog-custom-build">
                            
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="news.php?news=<?php echo $key['id'] ?>" title="">
                                            <img src="<?php echo $key['image'] ?>" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">
                                            <ul class="list-inline">
                                            <?php if (isset($_SESSION['uname'])) {?>
                                            <?php if (Role::role(User::findUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'user') {?>
                                            <?php if (CouponController::userCouponStatus($_SESSION['uname']) > 0) {?>
                                                <li><share-button>share</share-button></li>
                                            <?php } ?>
                                            <?php } else {?>
                                                <li><share-button>share</share-button></li>
                                            <?php } ?>
                                            <?php } ?>
                                            </ul>
                                        </div><!-- end post-sharing -->
                                        <h4><?php echo $key['title'] ?></h4>
                                        <a href="news.php?news=<?php echo $key['id'] ?>" class="btn">Read more</a>
                                        <hr class="invis">
                                        <a href="editpost.php?id=<?php echo $key['id'] ?>" class="btn btn-ep">edit post</a>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                            </div>
                            <?php } ?>
                        </div>

                        <hr class="invis">


                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">


                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="App/Assets/Images/small_07.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">5 Beautiful buildings you need to before dying</h5>
                                                <small>12 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="App/Assets/Images/small_08.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Let's make an introduction for creative life</h5>
                                                <small>11 Jan, 2016</small>
                                            </div>
                                        </a>

                                        <a href="marketing-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 last-item justify-content-between">
                                                <img src="App/Assets/Images/small_09.jpg" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">Did you see the most beautiful sea in the world?</h5>
                                                <small>07 Jan, 2016</small>
                                            </div>
                                        </a>
                                    </div>
                                </div><!-- end blog-list -->
                            </div><!-- end widget -->

                        </div><!-- end sidebar -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php require_once 'layout/footer.php' ?>