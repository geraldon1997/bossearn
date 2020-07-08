<?php 
require_once 'layout/header.php'; 

use App\Models\Role;
use App\Models\User;
use App\Controllers\CouponController;
use App\Models\Earning;
use App\Models\Post;

if (isset($_POST['pid'])) {
    Post::deletePost($_POST['pid']);
}

?>

<style>
    #bg{
        margin-top: 50px;
        width: 100%;
        height: 500px;
    }
    .post-img{
        height: 300px;
        width: 400px !important;
    }
    .recent-post-img{
        height: 50px
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
        margin-bottom: 5px;
    }
    .btn-ep:hover{
        background-color: black !important;
        color: white !important;
    }
</style>
<!-- <img src="App/Assets/Images/b1.jpeg" alt="" id="bg"> -->
<marquee><b>Welcome to BOSSEARN please do login or click the Register to enjoy</b></marquee>
<div style="width:100%; text-align: center;">
<?php if (!isset($_SESSION['uname'])) {?>
<a href="register.php" class="btn" >Register</a>
<?php } ?>
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <?php
                            $post = Post::findPost('type', 'sponsored');
                            foreach ($post as $key) {
                            ?>
                            <div class="blog-custom-build">
                            
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="news.php?news=<?php echo $key['id'] ?>" title="">
                                            <img src="<?php echo $key['image'] ?>" alt="" class="img-fluid post-img">
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
                                            <input type="hidden" id="uid" name="uid" value="<?php echo User::userId($_SESSION['uname'])[0]['id'] ?>">
                                            <?php if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'user') {?>
                                            <?php if (CouponController::userCouponStatus($_SESSION['uname']) > 0) {?>
                                            <?php 
                                                $postdate = date('d-m-Y', $key['date']);
                                                $today = date('d-m-Y', time());
                                                if ($postdate == $today) {?>
                                                <li><share-button>share</share-button></li>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } else {?>
                                                <li><share-button>share</share-button></li>
                                            <?php } ?>
                                            <?php } ?>
                                            </ul>
                                        </div><!-- end post-sharing -->
                                        <h4 id="title" data-description="<?php echo $key['title'] ?>"> <?php echo $key['title'] ?></h4>
                                        <p><?php echo substr($key['body'], 0, 120).'. . .'; ?></p>
                                        <a href="https://bossearn.com/news.php?news=<?php echo $key['id'] ?>" class="btn" data-url="https://bossearn.com/news.php?news=<?php echo $key['id'] ?>" id="read">Read more</a>
                                        <hr class="invis">

                                        <?php 
                                        if (isset($_SESSION['uname'])) {
                                        if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'admin' || $_SESSION['uname'] === 'tonyinye') { ?>
                                            <a href="editpost.php?id=<?php echo $key['id'] ?>" class="btn btn-ep">edit post</a>
                                            <form method="post"  onsubmit="return confirm('Do you really want to delete this post ?');">
                                                <input type="hidden" name="pid" value="<?php echo $key['id'] ?>">
                                                <button type="submit" class="btn btn-ep">delete post</button>
                                            </form>
                                            
                                        <?php } } ?>

                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                            </div>
                            <?php } ?>
                        </div>

                        <hr class="invis">


                    </div><!-- end col -->

                    
                </div><!-- end row -->
            </div><!-- end container -->
        </section>


<?php require_once 'layout/footer.php' ?>