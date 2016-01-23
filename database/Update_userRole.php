<?php
$role = @$_REQUEST["Role"];
$userEmail = @$_REQUEST["userEmail"];
$email = @$_REQUEST["email"];

if($email == $userEmail) die("You cannot delete your own account.");

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
$SQL = "UPDATE user SET `rid` = '".$role."'
		WHERE user.email='".$userEmail."'" ;
//echo $SQL;
$result = mysqli_query($connection,$SQL);
//$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
//var_dump($result);
//$result = true;
mysqli_close($connection);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>