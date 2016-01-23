<?php
$email = @$_REQUEST["Email"];
$from = @$_REQUEST["from"];
$to = @$_REQUEST["to"];


$result = array(
    array('itemNo'=>"4",'itemName'=>"pencil", 'amount'=>"5", 'totalPrice'=>"$6",'status'=>"Shipped",'soldTo'=>"abc@gmail.com"),
    array('itemNo'=>"5",'itemName'=>"pencil", 'amount'=>"5", 'totalPrice'=>"$6",'status'=>"Proccessing",'soldTo'=>"def@gmail.com"),
    array('itemNo'=>"6",'itemName'=>"pencil", 'amount'=>"5", 'totalPrice'=>"$6",'status'=>"Proccessed",'soldTo'=>"ghi@gmail.com"),
    array('itemNo'=>"7",'itemName'=>"pencil", 'amount'=>"5", 'totalPrice'=>"$6",'status'=>"Shipped",'soldTo'=>"abc@gmail.com")
);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>