<?php
$email = @$_REQUEST["Email"];
$from = @$_REQUEST["From"];
$to = @$_REQUEST["To"];


$result = array(
    array('itemNo'=>"4",'itemName'=>"pencilodsihv lisdhlsid hvlisd hvlis dhvlisdh vlisd vh sdhliv shld hvlds hvlsd hls v", 'amount'=>"5", 'price'=>"$6",'shipDate'=>"5/13/14"),
    array('itemNo'=>"5",'itemName'=>"pencil", 'amount'=>"5", 'price'=>"$6",'shipDate'=>"5/13/14"),
    array('itemNo'=>"6",'itemName'=>"pencil", 'amount'=>"5", 'price'=>"$6",'shipDate'=>"5/13/14"),
    array('itemNo'=>"7",'itemName'=>"pencil", 'amount'=>"5", 'price'=>"$6",'shipDate'=>"5/13/14")
);


$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>