<form action="" method="post" enctype="multipart/form-data">
<input type="image" name="image" src="App/Assets/Images/Posts/Screenshot_2020-04-19_10-35-23.png" alt="">
<input type="file" name="image" id="">
<button type="submit">submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_FILES['image'], $_POST);
}
