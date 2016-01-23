<?php
$email = $_REQUEST["email"];

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
$SQL = "SELECT user.uid, user.fname AS FirstName, user.mname AS MiddleName, user.lname AS LastName, user.email AS Email, userrole.usertype AS permsionType
		FROM user, userrole
		WHERE user.email='".$email."' AND user.rid=userrole.rid" ;
//echo $SQL;
$result = mysqli_query($connection,$SQL);
$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
//var_dump($result);

mysqli_close($connection);

/*
$result = array(
	'uid' => "4"
	'FirstName'=>"lolo", 
	'LastName'=>"lala", 
	'Email'=>"email@email.com",
	'permsionType'=>"admin",
	'permsionSesion'=>"4543t3g44g64646g42gt",
);
*/

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>