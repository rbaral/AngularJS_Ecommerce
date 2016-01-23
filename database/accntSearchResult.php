<?php
$name = @$_REQUEST["Name"];
$categoriesId = @$_REQUEST["CategoriesId"];
$sortBy = @$_REQUEST["Sortby"];
$format = @$_REQUEST["Format"];


$result = array(
    array('itemNo'=>"4",'itemName'=>"pencil", 'itemFormat'=>"buy now", 'price'=>"$6",'mainPic'=>'img/images1.jpg'),
    array('itemNo'=>"5",'itemName'=>"pe", 'itemFormat'=>"bid", 'price'=>"$7",'mainPic'=>'img/images2.jpg'),
    array('itemNo'=>"6",'itemName'=>"penciiuhgiul", 'itemFormat'=>"buy now", 'price'=>"$8",'mainPic'=>'img/images3.jpg'),
    array('itemNo'=>"7",'itemName'=>"pencjlkjil", 'itemFormat'=>"bid", 'price'=>"$6",'mainPic'=>'img/images1.jpg')
);

$return_values = json_encode($result);
header('Content-Type: application/json');
echo $return_values;
?>