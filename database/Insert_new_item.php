<?php
//ALTER TABLE `product` ADD `weight` TEXT NOT NULL AFTER `pdate`, ADD `dimension` TEXT NOT NULL AFTER `weight`, ADD `packagedimension` TEXT NOT NULL AFTER `dimension`;

$email = @$_REQUEST["Email"];
$itemname = @$_REQUEST["itemname"];
$itemdescription = @$_REQUEST["itemdescription"];
$itemprice = @$_REQUEST["itemprice"];
$itemqty = @$_REQUEST["itemqty"];
$itempics = @$_REQUEST["itempics"];
$itemweight = @$_REQUEST["itemweight"];
$itemdimension = @$_REQUEST["itemdimension"];
$pckgdimension = @$_REQUEST["pckgdimension"];
$itemtype = @$_REQUEST["itemtype"];
$itemcategory = @$_REQUEST["itemcategory"];
$startdate = @$_REQUEST["startdate"];
$enddate = @$_REQUEST["enddate"];

if (!$email) die("Email is required.");
if (!$itemname) die("Item Name is required.");
if (!$itemdescription) die("Item description is required.");
if (!$itempics) die("Item picture is required.");
if (!$itemweight) die("Item weight is required.");
if (!$itemdimension) die("Item dimension is required.");
if (!$itemtype) die("Item type is required.");
if (!$itemcategory) die("Item category is required.");
if (!$itemprice) die("Item price is required.");  //start price if bid, price if it is buy now
if (!$itemqty) die("Item quantity is required.");//a number>=1 if it is buy now, 1 if it is a bid

if($itemtype=='bid'){
	if ($itemqty !=1)die("There is inconsistency between quantity and type of item.");
	if (!$enddate) die("End date is required.");
	if (!$startdate) die("Start date is required.");
}
$connection=mysqli_connect("localhost","root","","ossdatabase");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$SQL = "SELECT ptypeid
		FROM ptype
		WHERE typename='".$itemcategory."'" ;
$category = mysqli_query($connection,$SQL);	
$category = mysqli_fetch_array($category,MYSQLI_ASSOC);	
if ($category == null || $category == false) die("Error Occurred with item category");	  


//check if it exist
$SQL = "SELECT *
		FROM product
		WHERE pname='".$itemname.
			"'AND description='".$itemdescription.
			"'AND price='".$itemprice.
			"'AND qty='".$itemqty.
			"'AND packagedimension='".$pckgdimension.
			"'AND weight='".$itemweight.
			"'AND ptypeid='".$category['ptypeid'].
			"'AND dimension='".$itemdimension."'" ;
//die($SQL);
$result = mysqli_query($connection,$SQL);
if (($result->num_rows)>0) die("Item Already Exist");	

$date = date('Y-m-d');  
//if it doesn't exist then perform queries
$SQL = "INSERT INTO product (`pname`, `description`, `price`, `qty`, `packagedimension`, `weight`, `dimension`, `pdate`, `ptypeid`) 
		VALUES ('".$itemname."','".$itemdescription."','".$itemprice."','".$itemqty."','".$pckgdimension."','".$itemweight."','".$itemdimension."','".$date."','".$category['ptypeid']."')";
$result = mysqli_query($connection,$SQL);
$newrowID = mysqli_insert_id($connection);

if($itemtype=='bid') {
	$SQL = "INSERT INTO bids (`pid`, `startdate`, `enddate`, `startprice`) 
			VALUES ('".$newrowID."','".$startdate."','".$enddate."','".$itemprice."')";
	$result = mysqli_query($connection,$SQL);
}

mysqli_close($connection);

//insert into items table

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>