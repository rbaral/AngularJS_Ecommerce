<?php
$email = @$_REQUEST["email"];
$itemNo = @$_REQUEST["itemNo"];
$qtty = @$_REQUEST["qty"];
$pid= @$_REQUEST["pid"];
$cartid= @$_REQUEST["scid"];

//include the db connection file
include_once 'accnt_dbConnect.php';

//here the user's email is not considered but shopping cart of user1 is retrieved
$db = new Db();
$varQuery = "";
$varQuery .= "update shoppingcartdetails set qty='$qtty' where scid='$cartid' and pid='$pid'";

$result = $db -> query($varQuery);




$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>