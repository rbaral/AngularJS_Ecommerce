<?php
$email = @$_REQUEST["Email"];




$result = array(
	'unreadEmail'=>"5", 
	'noItemsBoughtLastMonth'=>"5", 
	'noItemsSoldLastMonth'=>"6",
	'soldNotShipped'=>"5", 
	'SoldNotRenew'=>"2"
);




$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>