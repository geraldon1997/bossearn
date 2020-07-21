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
<script>window.location = 'login.php' </script>
<?php } ?>
        <section class="section lb">
            <div class="container">

            

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="page-wrapper">

                        <?php foreach (Post::findPost('type', 'sponsored') as $post) : ?>
                            
                            <div class="blog-custom-build">
                            
                                <div class="blog-box wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                                    <div class="post-media">
                                        <a href="https://bossearn.com/news.php?news=<?php echo $post['id'] ?>" title="">
                                            <img src="<?php echo $post['image'] ?>" alt="" class="img-fluid post-img">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">

                                        <?php if ($post['date'] > time() ) :?>
                                            <ul class="list-inline">
                                                <li><share-button post-id="<?php echo $post['id'] ?>" data-url="https://bossearn.com/news.php?news=<?php echo $post['id'] ?>" data-description="<?php echo $post['title'] ?>">share</share-button></li>
                                            </ul>
                                        <?php endif; ?>
                                        </div><!-- end post-sharing -->
                                        <h4 id="title" > <?php echo $post['title']; ?> </h4>
                                        <p><?php echo substr($post['body'], 0, 120).' . . .'; ?></p>
                                        <a href="https://bossearn.com/news.php?news=<?php echo $post['id'] ?>" class="btn" post-id="<?php echo $post['id'] ?>" id="read">Read more</a>
                                        <hr class="invis">
                                            <?php if (Role::role(User::findLoginUser('uname', $_SESSION['uname'])[0]['role_id'])[0]['role'] === 'admin' || $_SESSION['uname'] === 'tonyinye') : ?>
                                                <a href="editpost.php?id=<?php echo $post['id'] ?>" class="btn btn-ep">edit post</a>
                                            <form method="post"  onsubmit="return confirm('Do you really want to delete this post ?');">
                                                <input type="hidden" name="pid" value="<?php echo $post['id'] ?>">
                                                <button type="submit" class="btn btn-ep">delete post</button>
                                            </form>
                                            <?php endif; ?>
                                        <hr class="invis">

                                        
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                            </div>
                    
                        <?php endforeach; ?>

                        </div>
                            
                    </div>

                </div><!-- end col -->
                    
                </div><!-- end row -->
            </div><!-- end container -->
        </section>


<?php require_once 'layout/footer.php' ?>