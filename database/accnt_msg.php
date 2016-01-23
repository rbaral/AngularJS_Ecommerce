<?php
$email = @$_REQUEST["Email"];

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//check user role
$SQL = "SELECT userrole.usertype AS permsionType
		FROM user, userrole
		WHERE user.email='".$email."' AND user.rid=userrole.rid" ;
$result = mysqli_query($connection,$SQL);
$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
  

 
// Perform queries
$SQL = "SELECT mid AS emailNo, fromemail, subject
		FROM messages
		WHERE toemail='".$email."'" ;
		
if(isset($result['permsionType']) && $result['permsionType']=='admin') $SQL = $SQL . " OR toemail = 'admin'";

$result = mysqli_query($connection,$SQL);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
$rows[] = $row;
}
$result=$rows;
mysqli_close($connection);


/*
$result = array(
    array('emailNo'=>"4",'from'=>"pencil", 'subject'=>"5"),
	array('emailNo'=>"6",'from'=>"pencil", 'subject'=>"5"),
    array('emailNo'=>"8",'from'=>"pencil", 'subject'=>"5"),
    array('emailNo'=>"9",'from'=>"pencil", 'subject'=>"5"),
    array('emailNo'=>"14",'from'=>"pencil", 'subject'=>"5")
    );

*/


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>