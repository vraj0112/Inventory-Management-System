<?php
$dataPoints = array();
error_reporting(E_ERROR  | E_PARSE);
$con=mysqli_connect('localhost','root','','imsfinal');

$catagroy=$_POST['catagroy'];


$query="SELECT SUM(stockdetails.BillingQty+stockdetails.OtherQty) as countno, subcategories.subcategory_name as label FROM stockdetails JOIN systable,productmst,subcategories,categories WHERE systable.SysId=stockdetails.SysId AND productmst.ProductID=systable.ProductId AND subcategories.subcategory_id=productmst.ProductSubCategoryID AND categories.category_id=subcategories.category_id AND categories.active_status=1 AND categories.category_id LIKE '$catagroy' GROUP BY subcategories.subcategory_name";
$run=mysqli_query($con,$query);
//echo $query;
//$result=mysqli_fetch_array($run);

	while ($row=mysqli_fetch_array($run)) {
	$countno=$row[0];
	$lable=$row[1];
	array_push($dataPoints, array("label"=> $lable, "y"=> $countno));

}



// foreach($result as $row){
//         array_push($dataPoints, array("label"=> $row->label, "y"=> $row->countno));
//     }

   // print_r($dataPoints);


   // echo $dataPoints;

// for(var i = 0; i<$row; i++){
// 	$dataPoints = array(array("label"=> label[i], "y"=> countno([i])));
// } 
// $dataPoints = array(
// 	array("label"=> "Food + Drinks", "y"=> 590),
// 	array("label"=> "Activities and Entertainments", "y"=> 261),
// 	array("label"=> "Health and Fitness", "y"=> 158),
// 	array("label"=> "Shopping & Misc", "y"=> 72),
// 	array("label"=> "Transportation", "y"=> 191),
// 	array("label"=> "Rent", "y"=> 573),
// 	array("label"=> "Travel Insurance", "y"=> 126)
// );
	
?>
<!DOCTYPE HTML>
<html>
<head> 
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script src="jquery-1.11.1.min.js"></script>
    <script src="jquery.table2excel.min.js" type="text/javascript"></script>

<!-- <script src="jquery.tableTotal.js"></script> -->

    <script src="sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='sweetalert2.min.css'>
    <script src="sweetalert-dev.js"></script>
    <link rel="stylesheet" href="sweetalert.css">


    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">


    <script src="canvasjs.min.js"></script>


<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Product in Stock"
	},
	subtitles: [{
		text: "Product Quantity"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
	<div class="container-fluid col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
					         <div class="card-header" style="background-color: #2B60DE">
                        <center>
                            <h3 class="card-title" style="color: white">Stock Visualization</h3>
                        </center>
                    </div>
                    <div class="carr card-body">
                      <form class="row g-3" id="radio-buttons" method="POST" action="graph.php">
                                            <div class="form-group col-md-1">
                        <label class="form-label">Product Type: </label>
                    </div>
                    <div class="col-md-2">
                        <select id="category_name" class="form-select col-md-12 resetsearchparam class-category" name="catagroy">
                            <option value='-1' selected>Select</option>
                            <?php
                            $conn=mysqli_connect('localhost','root','','imsfinal');

                                $query = "SELECT category_id ,category_name FROM categories where active_status=true";
                                $result = mysqli_query($conn, $query);
                                if($result)
                                {
                                    while($row = $result -> fetch_assoc())
                                    {
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];
                                        echo
                                            "<option value='".$category_id."'>".$category_name."</option>";
                                    }
                                }
                                else
                                {
                                    echo "<script>swal('Something Went Wrong', '', 'error');</script>";
                                    location.reload(true);
                                }
                            ?>
                        </select>
                    </div>

                        <div>
                          <input type="submit" value="Search" id="save" class="btn btn-success">
                          <input type="button" value="Close"  name="close" id="close" class="btn btn-success" onclick="location.href = '../admin.php';">
                        </div>
                    </div>
                </div>
                <br>
      <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
            	<div id="chartContainer" style="height: 370px; width: 30%;"></div>
            </div>       
            </div>
         </div>
      </div> 
            </section>
                



</body>
</html> 