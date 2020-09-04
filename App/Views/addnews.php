<?php 

use App\Models\News; 

?>

<div class="content">
<?php if (isset($data['news']) ) {echo $data['news'];} ?>
<?php if (isset($data['error']) ) {echo $data['error'];} ?>
<h1>Add new post</h1>

    <div class="row">
        <div class="col-md-6 m-auto">
            <form action="<?php echo ADDNEWS; ?>" method="post" class="form-wrapper" enctype="multipart/form-data">
                <select name="newstypeid" class="form-control">
                    <option value="<?php if (isset($data['data']['newstyped'])) {echo $data['data']['newstypeid'];} ?>">choose type of post</option>
                    <?php foreach(News::newsType() as $newstype) : ?>
                    <option value="<?php echo $newstype['id']; ?>"><?php echo $newstype['type']; ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="text" name="title" id="" class="form-control" placeholder="title of post" value="<?php if (isset($data['data']['title'])) {echo $data['data']['title'];} ?>">

                <textarea name="body" class="form-control" placeholder="body of post"><?php if (isset($data['data']['body'])) {echo $data['data']['body'];} ?></textarea>

                <input type="file" name="image" class="form-control" value="test">

                <button type="submit" class="btn">upload post</button>
            </form>
        </div>
    </div>
</div>