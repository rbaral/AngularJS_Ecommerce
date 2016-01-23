<?php
$email = @$_REQUEST["Email"];
//price = price per unit

$result = array(
    array('itemNo'=>"4",'itemName'=>"pencil", 'amount'=>"1", 'price'=>"$6", 'itemType'=>"bid"),
    array('itemNo'=>"5",'itemName'=>"pencil", 'amount'=>"5", 'price'=>"$6", 'itemType'=>"buy now"),
    array('itemNo'=>"6",'itemName'=>"pencil", 'amount'=>"1", 'price'=>"$6", 'itemType'=>"bid/buy now"),
    array('itemNo'=>"7",'itemName'=>"pencil", 'amount'=>"1", 'price'=>"$6", 'itemType'=>"bid")
);


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>