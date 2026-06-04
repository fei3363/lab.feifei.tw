<?php
if (isset($_POST["submit"])) {
  $target_dir = '/tmp/';
  $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<p>Please check file at ".$target_file."</p>";
  } else {
    echo "<p>Upload failed.</p>";
  }
}
?>

<h2>This is upload page!</h2>
<form class="form-inline" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="file">Choose file to upload</label>
    <input type="file" class="form-control" name="fileToUpload">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Upload</button>
</form>