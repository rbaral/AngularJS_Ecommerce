<?php
$email = @$_REQUEST["Email"];
$itemNo = @$_REQUEST["itemno"];
$itemname = @$_REQUEST["itemname"];
$itemdescription = @$_REQUEST["itemdescription"];
$itemprice = @$_REQUEST["itemprice"];
$itemqty = @$_REQUEST["itemqty"];
$itempics = @$_REQUEST["itempics"];
$itemweight = @$_REQUEST["itemweight"];
$itemdimension = @$_REQUEST["itemdimension"];
$itemtype = @$_REQUEST["itemtype"];

//update items into table

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>