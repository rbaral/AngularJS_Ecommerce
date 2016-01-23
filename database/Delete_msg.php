<?php
$emailNo = @$_REQUEST["emailNo"];
$email = @$_REQUEST["email"];

if (!$emailNo) die("Email number is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
$SQL = "DELETE FROM messages 
		WHERE messages.mid ='".$emailNo."'" ;
//echo $SQL;
$result = mysqli_query($connection,$SQL);
//$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
//var_dump($result);

mysqli_close($connection);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>