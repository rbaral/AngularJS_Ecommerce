<?php
$email = @$_REQUEST["email"];
$pid= @$_REQUEST["pid"];
$cartid= @$_REQUEST["scid"];

//include the db connection file
include_once 'accnt_dbConnect.php';

/*
 * this method should delete the entry from shoppingcartdetails
 * table. If this is the only entry with the given cartid in shoppingcart details,
 * then it should also delete the entry from the shoppingcart table
 * @author Ramesh Baral
 * @Nov 11, 2014
 */
$db = new Db();
$varQuery = "";
$varQuery .= " CALL sp_deleteshoppingcartitem('$cartid','$pid')";

$result = $db -> query($varQuery);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>