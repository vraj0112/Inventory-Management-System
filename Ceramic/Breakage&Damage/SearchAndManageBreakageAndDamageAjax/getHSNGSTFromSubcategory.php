<?php
    include('./config.php');
    $gethsnfromsubcategory = mysqli_query($conn, "SELECT ProductHSNCode,ProductGST FROM subcategories where subcategories.subcategory_id=".$_POST['subcatid']." and active_status=true");
    $dataToBeSent = array();

    if($gethsnfromsubcategory){
        if($gethsnfromsubcategory->num_rows > 0){
            $flag = array('FLAG' => 'OKK');
            $dataToBeSent[] = $flag;
            while($row = $gethsnfromsubcategory->fetch_assoc())
            {
                $hsn_num = $row['ProductHSNCode'];
                $gst_num = $row['ProductGST'];
                $obj = array('hsnnum' => $hsn_num, 'gstnum' => $gst_num);
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