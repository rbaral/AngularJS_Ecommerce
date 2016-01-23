<?php
$email = $_REQUEST["email"];
$pass = $_REQUEST["password"];
//$pass =  md5($pass);

if (!$email || empty($email)) die("Email field is required.");
if (!$pass || empty($pass)) die("Password field is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
$SQL = "SELECT user.fname AS FirstName, user.mname AS MiddleName, user.lname AS LastName, user.email AS Email, user.address, user.phone, userrole.usertype AS permsionType
		FROM user, userrole
		WHERE user.email='".$email."' AND user.password='".$pass."' AND user.rid=userrole.rid" ;
//echo $SQL;
$result = mysqli_query($connection,$SQL);
$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
//var_dump($result);

if (!$result || empty($result) || is_null($result)) die("your credentials were not found, try again.");

mysqli_close($connection);

/*
$result = array(
	'FirstName'=>"lolo", 
	'LastName'=>"lala", 
	'address'=>"miami, fl",
	'phone'=>"786777777", 
	'Email'=>"email@email.com",
	'permsionType'=>"admin",
	'permsionSesion'=>"4543t3g44g64646g42gt",
);
*/

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>