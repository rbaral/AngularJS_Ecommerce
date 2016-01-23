<?php
$email = @$_REQUEST["Email"];
$name = @$_REQUEST["name"];
$description = @$_REQUEST["description"];

if (!$email) die("Email is required.");
if (!$name) die("Category name is required.");
if (!$description) die("Category description is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
//if it doesn't exist then perform queries
$SQL = "INSERT INTO ptype (`typename`, `typedescription`) VALUES ('".$name."','".$description."')";
$result = mysqli_query($connection,$SQL);

mysqli_close($connection);


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>