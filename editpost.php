<?php

use App\Controllers\PostController;
use App\Models\Post;

require_once 'layout/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>window.location = '/' </script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = PostController::updatePost($_POST);
    $h = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_INFO'];

    if ($update) {
        echo "<script>window.location =".$h."</script>";
    }
}

$post = Post::findPost('id', $_GET['id'])[0];
?>

<style>
    [type='image']{
        width: 600px;
        height: 600px
    }
</style>

<div class="page-wrapper">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <form class="form-wrapper" method="POST" enctype="multipart/form-data">
            <h4>Update Post</h4>
                <input type="hidden" name="pid" value="<?php echo $post['id'] ?>">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $post['title']; ?>">
                <label for="body">body</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control" ><?php echo $post['body'] ?></textarea>
                <label for="image">image</label>
                <input type="image" src="<?php echo $post['image'] ?>" alt="" >
                <input type="file" name="image" id="" class="form-control">
                <button type="submit" class="btn btn-primary">update <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
    
</div>

<?php require_once 'layout/footer.php'; ?>