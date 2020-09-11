<div class="content">
    <h1>Edit user</h1>
    <hr>
    <form action="<?= UPDATE_USER; ?>" method="post" class="col-md-6 m-auto form-wrapper">
        <input type="hidden" name="userid" value="<?= $data['id']; ?>">
        <input type="email" name="email" value="<?= $data['email']; ?>" class="form-control" placeholder="email address">
        <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" placeholder="username">
        <button type="submit" class="btn">update</button>
    </form>
</div>