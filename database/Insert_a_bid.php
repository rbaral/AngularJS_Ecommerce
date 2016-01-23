<?php
$email = @$_REQUEST["Email"];
$itemid = @$_REQUEST["itemid"];
$price = @$_REQUEST["price"];
$time = @$_REQUEST["time"];

//insert into shopping cart table

$result = true;

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>