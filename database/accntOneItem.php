<?php
$email = @$_REQUEST["Email"];
$itemNo = @$_REQUEST["ItemNo"];



$result = array(
	'productID'=>"1",
	'ItemName'=>"jojojoj", 
	'ItemDescription'=>"this is the description of the item hhhhhh", 
	'itemprice'=>"$6.90",
	'itemqty'=>"5", 
	'itemtype'=>"bid",
	'bidID'=>'1',
	'bidStatus'=>"no bid on yet",
	'lastBid'=>"1.09",
	'nextMinBid'=>"1.29",
	'itemweight'=>"2",
	'itemdimension'=>"6X10X23",
	'packagedimension'=>"6X10X23",
	'pics' => array(array("picNo"=>"1", "pic"=>"images1.jpg"),array("picNo"=>"2","pic"=>"images2.jpg"),array("picNo"=>"3","pic"=>"images3.jpg"),array("picNo"=>"4","pic"=>"index.jpg")),	
	'itemExpire'=>"11/16/2014  5:00pm",
	'shipingPolicy'=>"it takes 2-5 bussiness day and it goes through usps ground",
	'returnPolicy'=>"no returns allow on this item"
);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>