

<?php


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /account/login.php".(isset($_SERVER['REQUEST_URI'])?"?redirect=".$_SERVER['REQUEST_URI']:""));
    exit;
}


	include_once('../../php-inc/header.php');


include_once("config2.php");


$sql = "SELECT b.id,b.username,COUNT(*) FROM `challenges` as a \n"

    . "join users as b on a.user_id =b.id WHERE b.created_at > '2022-07-04 00:00:00'\n"

    . "GROUP by user_id;";


  $result = mysqli_query($link,$sql);


?>

<table class="table" id="user">
  <thead>
    <tr>
    <th scope="col">使用者 ID</th>
      <th scope="col">使用者名稱</th>
      <th scope="col">解題數量</th>
    </tr>
  </thead>
  <tbody>



<?php


while($row = mysqli_fetch_array($result)){
  echo "<tr>";
      echo "<td><a href='challenges.php?id=" . $row[0] ."'>". $row[0] .  "</a></td>";
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
	include_once('../../php-inc/header.php');
?>

