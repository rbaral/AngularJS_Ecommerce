<?php
$fName = $_REQUEST['fName'];
$mName = @$_REQUEST['mName'];
$lName = $_REQUEST['lName'];
$address = $_REQUEST['Address'];
$phoneNumber = @$_REQUEST['pNumber'];
$email = $_REQUEST['Email'];
$pass = $_REQUEST['Password'];
//$pass =  md5($pass);


if (!$fName) die("First Name is required.");
if (!$lName) die("Last Name is required.");
if (!$address) die("Address is required.");
if (!$email) die("Email is required.");
if (!$pass) die("Password is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//check if it exist
$SQL = "SELECT user.fname AS FirstName
		FROM user
		WHERE user.email='".$email."'" ;
$result = mysqli_query($connection,$SQL);
if (($result->num_rows)>0) die("User Already Exist");
  
//if it doesn't exist then perform queries
$SQL = "INSERT INTO ossdatabase.user (`fname`, `mname`, `lname`, `address`, `email`, `phone`, `password`, `login`) VALUES ('".$fName."','".$mName."','".$lName."','".$address."','".$email."','".$phoneNumber."','".$pass."','".$email."')";
$result = mysqli_query($connection,$SQL);

mysqli_close($connection);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>