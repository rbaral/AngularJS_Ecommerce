<?php
//include the db connection file
include_once 'accnt_dbConnect.php';

$Email = @$_REQUEST["Email"];
//$Email= 'user1@gmail.com';
//here the user's email is not considered but shopping cart of user1 is retrieved
$db = new Db();
$varQuery = "";
$varQuery .= "select c.scid, p.pid as itemNo, p.pname as itemName, c.price, c.qty, c.price*c.qty as Total, 
		'regularsale' as pType from shoppingcartdetails c, product p, user u, shoppingcart sc 
		where c.pid=p.pid and u.uid=sc.uid and sc.scid=c.scid and sc.uid= (select uid from user where email='$Email')" ;
$rows = $db -> select($varQuery);

//var_dump(count($rows));

/*
$result = array(
    array('itemNo'=>"4",'itemName'=>$rows[0]['itemName'], 'price'=>"6",'qty'=>'5','Total'=>'30','pType'=>'bid'),
    array('itemNo'=>"6",'itemName'=>"test", 'price'=>"5",'qty'=>'8','Total'=>'40','pType'=>'bid'),
    array('itemNo'=>"7",'itemName'=>"pencsdvdil", 'price'=>"3",'qty'=>'6','Total'=>'18','pType'=>'bid'),
    array('itemNo'=>"8",'itemName'=>"pencsdvdsil", 'price'=>"2",'qty'=>'4','Total'=>'6 ','pType'=>'bid'),
);
*/

$return_values = json_encode($rows);
header('Content-Type: application/json');
echo $return_values;
?>