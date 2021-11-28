<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $c_id = $mydata['cid'];

    //echo $c_id;
    $dataToBeSent = array();

    $query = "SELECT * FROM subcategories WHERE category_id=".$c_id;
    $result = mysqli_query($conn, $query);

    if($result)
    {
        $flag = array('FLAG' => 'OK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $subcategory_id = $row['subcategory_id'];
            $subcategory_name = $row['subcategory_name'];
            $active_status = $row['active_status'];
            $hsncode = $row['ProductHSNCode'];
            $gst = $row['ProductGST'];

            $obj = array('sci' => $subcategory_id, 'scn' => $subcategory_name, 'as' => $active_status, 'hsncode' => $hsncode, 'gst' => $gst);
            $dataToBeSent[] = $obj;
        }

        echo json_encode($dataToBeSent);
        //echo "OKKK";
    }
    else
    {
        $flag = array('FLAG' => 'NOTOK');
        $dataToBeSent[] = $flag;
        
        echo json_encode($dataToBeSent);
        //echo 'NOT OKKKK';
    }
?>