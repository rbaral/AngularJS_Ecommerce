<?php
//ALTER TABLE `ltselling` CHANGE `saleid` `saleid` INT(11) NOT NULL AUTO_INCREMENT;

$email = @$_REQUEST["Email"];
$itemId = @$_REQUEST["itemName"];
$price = @$_REQUEST["price"];
$startDate = @$_REQUEST["startDate"];
$endDate = @$_REQUEST["endDate"];
$qty = @$_REQUEST["qty"];


if (!$itemId) die("Item name is required.");
if (!$price) die("Price is required.");
if (!$startDate) die("Start Date is required.");
if (!$endDate) die("End date is required.");
if (!$qty) die("quantity is required.");

$connection=mysqli_connect("localhost","root","","ossdatabase");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
//perform queries
$SQL = "INSERT INTO ltselling (`pid`, `price`, `sdate`, `edate`, `qty`) VALUES ('".$itemId."','".$price."','".$startDate."','".$endDate."','".$qty."')";
$result = mysqli_query($connection,$SQL);

mysqli_close($connection);


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>