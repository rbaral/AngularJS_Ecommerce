<?php
$email = @$_REQUEST["Email"];
$itemid = @$_REQUEST["itemid"];
$price = @$_REQUEST["price"];
$time = @$_REQUEST["time"];
$bidType= @$_REQUEST["bidType"]; //can be userbid, systembid or adminbid(bid created)
$bidID=@$_REQUEST["bidID"];
$bidAmount=@$_REQUEST["userbidAmount"];

//include the db connection file
include_once 'accnt_dbConnect.php';
//here the user's email is not considered but shopping cart of user1 is retrieved
$db = new Db();

//insert into bids table
if($bidType=='userBid'){
	$varQuery = "CALL sp_insertuserbid('$email','$bidID','$bidAmount', @bidStatus)";
	$result = $db -> query($varQuery);
	$varNewQuery="SELECT @bidStatus";
	$result= $db -> select($varNewQuery);
}else{
	$result = true;	
}

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>