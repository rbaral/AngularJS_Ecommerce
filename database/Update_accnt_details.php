<?php
$newEmail = @$_REQUEST["newEmail"];
$email = @$_REQUEST["Email"];
$fName = @$_REQUEST["fName"];
$lName = @$_REQUEST["lName"];
$address = @$_REQUEST["Address"];



//update which ever variable exist

//return new account details

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>