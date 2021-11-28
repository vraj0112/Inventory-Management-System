<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $sc_id = $mydata['scid'];
    
    $dataToBeSent = array();

    $query = "SELECT * FROM subcategories where subcategory_id=".$sc_id;
    $result = mysqli_query($conn, $query);

    if($result == true)
    {
        $row = $result->fetch_assoc();

        $flag = array('FLAG' => "RECORDFOUND" );
        $dataToBeSent[] = $flag;

        $subcategory_name = $row['subcategory_name'];
        $hsn_code = $row['ProductHSNCode'];
        $gst = $row['ProductGST'];

        $obj = array('subcategory_name' => $subcategory_name, 'hsncode' => $hsn_code, 'gst' => $gst);
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }
    else
    {
        $flag = array('FLAG' => "ERROR");
        $dataToBeSent[] = $flag;
        echo json_encode($dataToBeSent);     
    }
?>