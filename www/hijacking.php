<?php


    $titlename='Hijkiong-1';
	include_once('php-inc/header.php');


include 'config/config.php';
if(isset($_GET['data']))
{    
     $data = $_GET['data'];
     $sql = "INSERT INTO storeData (data) VALUES ('$data')";
     if (mysqli_query($link, $sql)) {
        echo "";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($link);
     }
     mysqli_close($link);
}
?>


<table class="table" id="data">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">儲存資料</th>
    </tr>
  </thead>
  <tbody>

<?php
include 'config/config.php';
$sql = "SELECT data FROM storeData";
$result = mysqli_query($link, $sql);
$num=1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        echo '<tr>';
        echo '<th scope="row">'.$num.'</th>';
        echo '<td>'.$row["data"].'</a></td>';
        $num = $num +1;

    }
} else {
    echo "0 results";
  }
  mysqli_close($link);
?>

  </tbody>
</table>

<script>
$(document).ready(function() {
  $('#data').DataTable();
});
</script>

<?php

include_once('php-inc/footer.php');