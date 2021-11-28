<?php

error_reporting(E_ERROR  | E_PARSE);
$con=mysqli_connect('localhost','root','','imsfinal');

$query="SELECT SUM(stockdetails.BillingQty+stockdetails.OtherQty), subcategories.subcategory_name FROM stockdetails JOIN systable,productmst,subcategories,categories WHERE systable.SysId=stockdetails.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id=productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND categories.active_status=1 GROUP BY subcategories.subcategory_name";
$run=mysqli_query($con,$query);
echo $query;
$row=mysqli_fetch_array($run);
while ($row=mysqli_fetch_array($run)) {
	$countno=$row[0];
	$lable=$row[1];
}

echo json_encode($data);	
?>