<?php
$email = @$_REQUEST["Email"];

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//check user role
$SQL = "SELECT ptypeid AS categoryId, typename AS Category
		FROM ptype" ;		

$result = mysqli_query($connection,$SQL);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
$rows[] = $row;
}
$result=$rows;
mysqli_close($connection);


/*
$result = array(
	array('categoryId'=>"1",'Category'=>"All"),
	array('categoryId'=>"1",'Category'=>"Electronics"),
    array('categoryId'=>"1",'Category'=>"Books"),
    array('categoryId'=>"1",'Category'=>"Miscellaneous"),
    );
*/


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>