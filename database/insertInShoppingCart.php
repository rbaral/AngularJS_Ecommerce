<?php
$email = @$_REQUEST["Email"];
$itemid = @$_REQUEST["itemid"];
$price = @$_REQUEST["price"];
$qty = @$_REQUEST["qty"];
/**
 * first check if the user has active
 * shopping cart or not, if there is one
 * add to that cart, else create a new cart
 * and add this item to that cart
 * -everything is handled in query
 */
//include the db connection file
include_once 'accnt_dbConnect.php';

$db = new Db();
$varQuery = "";
$varQuery .= " CALL sp_insertshoppingcartitem('$email','$itemid','$qty','$price')";

$result = $db -> query($varQuery);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>