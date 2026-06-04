

<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


	include_once('../php-inc/header.php');


include_once("config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM `challenges` WHERE `user_id` = ". $id ;



  $result = mysqli_query($link,$sql);


?>
<a href='user.php'>back</a>
<table class="table" id="user">
  <thead>
    <tr>
    <th scope="col">序號</th>
      <th scope="col">題目名稱</th>
      <th scope="col">完成</th>
    </tr>
  </thead>
  <tbody>



<?php


while($row = mysqli_fetch_array($result)){
  echo "<tr>";
      echo "<td>" . $row[0] . "</td>";
      echo "<td>" . $row[1] . "</td>";
      echo "<td>" . $row[2] . "</td>";
  echo "</tr>";
}

?>

  </tbody>
</table>



  </tbody>
</table>


<script>
$(document).ready(function() {
  $('#user').DataTable();
});
</script>
<?php
    $titlename='User data';
	include_once('../php-inc/header.php');
?>

