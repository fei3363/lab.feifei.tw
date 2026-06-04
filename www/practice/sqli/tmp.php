
<?php
//including the Mysql connect parameters.
require_once "../../config/config.php";
error_reporting(0);
// take the variables 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    //logging the connection parameters to a file for analysis.
    $fp=fopen('resultsql1.txt','a');
    fwrite($fp,'ID:'.$id."\n");
    fclose($fp);

// connectivity 
$sql="SELECT * FROM users WHERE id='$id' LIMIT 0,1";
$result=mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);




	if($row)
	{
  	echo 'Your Login name:'. $row['username'];
  	echo "<br>";
  	echo 'Your Password:' .$row['password'];
  	}
	else 
	{
        echo "error";
    echo mysqli_connect_error() ;
	}
}
	else { echo "Please input the ID as parameter with numeric value. example ?id=1";}

?>






 

<?php
//including the Mysql connect parameters.
require_once "../../config/config.php";
error_reporting(0);
// take the variables 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    //logging the connection parameters to a file for analysis.
    $fp=fopen('resultsql1.txt','a');
    fwrite($fp,'ID:'.$id."\n");
    fclose($fp);

// connectivity 
$sql="SELECT * FROM users WHERE id='$id' LIMIT 0,1";
$result=mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);




	if($row)
	{
  	echo 'OK';
  	echo "<br>";

  	}
	else 
	{
        echo "error";
	}
}
	else { echo "Please input the ID as parameter with numeric value. example ?id=1";}

?>






 
