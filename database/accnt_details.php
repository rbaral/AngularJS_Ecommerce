<?php
$email = @$_REQUEST["Email"];




$result = array(
	'FirstName'=>"lolo", 
	'LastName'=>"lala", 
	'Email'=>"email@email.com",
	'Address'=>"44 E"
);




$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>