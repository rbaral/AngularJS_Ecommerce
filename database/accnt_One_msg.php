<?php
$email = @$_REQUEST["Email"];
$emailNo = @$_REQUEST["EmailNo"];



$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$SQL = "SELECT mid AS emailNo, fromemail, toemail, subject, msg
		FROM messages
		WHERE mid='".$emailNo."'" ;
//echo $SQL;
		$result = mysqli_query($connection,$SQL);
$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
  


//$result = array('emailNo'=>"4",'from'=>"pencil", 'to'=>"5", 'Subject'=>"this is a sub", 'msg'=>"body of msg");




$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>