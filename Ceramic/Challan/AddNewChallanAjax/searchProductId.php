<?php 
    include('./config.php');

    $queryPid = "SELECT * FROM productmst where ProductSubCategoryId= ". $_POST['subcategory']." and BrandId= ". $_POST['brandname']." and GradeId= ". $_POST['grade']." and ProductTypeColor= '". $_POST['colortype']."' and SizeOrDimension= '". $_POST['dimension']."' and QtyPerUnit=" .$_POST['qtyperunit']. " and PackingUnit= '". $_POST['packingunit']."' and 
    Code= '". $_POST['codeno']."' and ProductMst.RecStatus=true";
    
    $getProductID = mysqli_query($conn,$queryPid);
    $dataToBeSent = array();

    if($getProductID){
        if($getProductID->num_rows > 0){
            $flag = array('FLAG' => 'OKK');
            $dataToBeSent[] = $flag;
            while($row = $getProductID->fetch_assoc()){
                $product_id = $row['ProductID'];

                $obj = array('productid' => $product_id);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }else{
            $obj = array('FLAG' => 'RECORDNOTFOUND');
            $dataToBeSent[] = $obj;
            echo json_encode($dataToBeSent);
        }
    }else{
        $obj = array('FLAG' => 'ERRORINEXECUTINGQUERY');
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }
?>