<?php
$fromemail = @$_REQUEST["FromEmail"];
$toemail = @$_REQUEST["ToEmail"];
$subject = @$_REQUEST["Subject"];
$msg = @$_REQUEST["Msg"];

if (!$fromemail) die("Your email is required.");
if (!$toemail) die("recipient email is required.");
if (!$subject) die("subject is required.");
if (!$msg) die("email body is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
//if it doesn't exist then perform queries
$SQL = "INSERT INTO messages (`fromemail`, `toemail`, `subject`, `msg`) VALUES ('".$fromemail."','".$toemail."','".$subject."','".$msg."')";
$result = mysqli_query($connection,$SQL);

mysqli_close($connection);


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>