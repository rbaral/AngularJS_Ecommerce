<?php
$email = @$_REQUEST["email"];

//if (!$email) die("The variable kelvin is required.");
//if (!$pass) die("The variable pass is required.");
/*
$connection=mysqli_connect("localhost","root","","onlinestore");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
$result = mysqli_query($connection,"SELECT * FROM customer");
$result = mysqli_fetch_array($result);
//var_dump($return_values);
mysqli_close($connection);
*/
$result = true;

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>