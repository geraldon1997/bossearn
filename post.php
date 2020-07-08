<?php

use App\Controllers\PostController;

require_once 'layout/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = PostController::createPost($_POST);
    if ($post) {
        echo "<script>window.location = '/' </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <form class="form-wrapper" method="POST" enctype="multipart/form-data">
            <h4>Post form</h4>
                <select name="type" id="" class="form-control">
                    <option value="">select type of post</option>
                    <option value="blog">blog post</option>
                    <option value="sponsored">sponsored post</option>
                </select>
                <input type="text" class="form-control" placeholder="Title" name="title">
                <textarea name="body" id="" cols="30" rows="10" class="form-control" placeholder="body of post"></textarea>
                <input type="file" name="image" id="" class="form-control">
                <button type="submit" class="btn btn-primary">upload <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require_once 'layout/footer.php'; ?>