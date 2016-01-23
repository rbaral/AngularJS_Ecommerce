<?php
$email = @$_REQUEST["Email"];

$connection=mysqli_connect("localhost","root","","ossdatabase");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 /* 
//check user role
$SQL = "SELECT userrole.usertype AS permsionType
		FROM user, userrole
		WHERE user.email='".$email."' AND user.rid=userrole.rid" ;
$result = mysqli_query($connection,$SQL);
$result = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
if(isset($result['permsionType']) && $result['permsionType']!='admin') die ("You have no permissions to see this page");
 */
// Perform queries
$SQL = "SELECT product.pname AS itemName, ltselling.price AS price, ltselling.sdate AS startDate, ltselling.edate AS endDate, ltselling.qty AS qty
		FROM ltselling, product
		WHERE ltselling.pid= product.pid" ;
		
//echo ($SQL);

$result = mysqli_query($connection,$SQL);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
$rows[] = $row;
}
$result=$rows;
mysqli_close($connection);

/*
$result = array(
    array('itemNo'=>"4",'itemName'=>"pencil", 'price'=>"5.00", 'startDate'=>"$2014-12-23",'endDate'=>"2014-12-24",'qty'=>"2",'sold'=>"0"),
    array('itemNo'=>"5",'itemName'=>"pencil", 'price'=>"6.00", 'startDate'=>"$2014-12-23",'endDate'=>"2014-12-24",'qty'=>"2",'sold'=>"0"),
    array('itemNo'=>"6",'itemName'=>"pencil", 'price'=>"7.00", 'startDate'=>"$2014-12-23",'endDate'=>"2014-12-24",'qty'=>"2",'sold'=>"1"),
    array('itemNo'=>"7",'itemName'=>"pencil", 'price'=>"8.00", 'startDate'=>"$2014-12-23",'endDate'=>"2014-12-24",'qty'=>"2",'sold'=>"0")
);
*/

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>