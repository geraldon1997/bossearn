<?php

use App\Models\Post;

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

        </div>
    <?php } ?>
</div>

<?php require_once 'layout/footer.php'; ?>