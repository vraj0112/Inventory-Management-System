<?php
    include('./config.php');

    $query = "SELECT BrandName, BrandMapping, brandmapp.RecStatus as rs FROM brandmapp join brandnames, subcategories  where subcategories.subcategory_id = brandmapp.SubcategoryId and brandmapp.BrandId = brandnames.BrandId and subcategory_id=".$_POST['subcatid'];
    $result = mysqli_query($conn, $query);
    
    $dataToBeSent = array();
    
    if($result)
    {
        if($result->num_rows > 0)
        {
            $flag = array('FLAG' => 'OKK');
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc())
            {
                //$subcategoryid = $row['subcategory_id'];
                $brand_name = $row['BrandName'];
                $brand_map_id = $row['BrandMapping'];
                $recstatus = $row['rs'];

                $obj = array('brandname' => $brand_name, 'brandmapid' => $brand_map_id, 'recstatus' => $recstatus);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }
        else
        {
            $obj = array('FLAG' => 'RECORDNOTFOUND');
            $dataToBeSent[] = $obj;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $obj = array('FLAG' => 'ERRORINEXECUTINGQUERY');
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }

    /*SELECT * FROM subcategories join categories, brandnames, brandmapp where subcategories.category_id = categories.category_id and subcategories.subcategory_id = brandmapp.SubcategoryId and brandmapp.BrandId = brandnames.BrandId;*/
?>