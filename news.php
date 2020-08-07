<?php

use App\Controllers\CommentController;
use App\Models\Comment;
use App\Models\Earning;
use App\Models\Post;
use App\Models\User;

require_once 'layout/header.php';

if (!isset($_GET['news'])) {
    echo "<script>window.location = '/' </script> ";
} else {
    $post = Post::findPost('id', $_GET['news']);
}

?>

<div class="page-wrapper">
    <?php 
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
                        
                    </div><!-- end post-sharing -->
                    <h4><?php echo $key['title'] ?></h4>
                    <p><?php echo $key['body'] ?></p>
                </div><!-- end meta -->
            </div><!-- end blog-box -->

            <hr class="invis">
                <?php if (isset($_SESSION['uname'])) :?>
                <div class="row">
                    
<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['comment'])) {
        $pid = Post::findPost('id', $_GET['news'])[0]['id'];
        $uid = User::userId($_SESSION['uname'])[0]['id'];
        $co = Comment::checkComment($uid, $pid);
        if ($co < 1) {
            CommentController::create($uid, $pid, $_POST['comment']);
            Earning::updateBearn(5, $uid);
        } else {
            CommentController::create($uid, $pid, $_POST['comment']);
        }
        
    }
}

?>
                    

                    <div class="col-lg-12 text-left">
                    <h3>Comments</h3>
                        <hr>
                        <?php CommentController::view($post[0]['id']); ?>
                    </div>

                    <div class="col-lg-12">
                        <h3>Add Comment</h3>
                        <form class="form-wrapper" method="POST">
                            <textarea name="comment" id="" cols="30" rows="10" class="form-control" placeholder="type your comment"></textarea>
                            <button type="submit" class="btn">comment <i class="fa fa-arrow-right"></i></button>
                        </form>
                    
                    </div>
                    
                </div>
                <?php endif; ?>
        </div>
    <?php } ?>
</div>

<?php require_once 'layout/footer.php'; ?>