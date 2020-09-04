<div class="content">
    <h1>Edit post</h1>

    <div class="row">
        <div class="col m-auto">
            <form action="<?php echo EDITNEWS.$data['id']; ?>" method="post" class="form-wrapper" enctype="multipart/form-data">
                <input type="text" name="title" id="" class="form-control" value="<?php echo $data['title'] ?>">
                <textarea name="body" id="" class="form-control"><?php echo $data['body']; ?></textarea>
                <input type="image" src="<?php echo '/'.$data['image']; ?>" alt="" class="form-control">
                <input type="file" name="image" id="" class="form-control">

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</div>