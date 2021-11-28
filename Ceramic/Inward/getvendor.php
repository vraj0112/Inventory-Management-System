<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $scn = $mydata['scn'];
    //echo $c_id;
    //echo $c_id;
    //$c_id = 1;

    //echo $scn;
    $dataToBeSent = array();

    $query = "select *from tblvendormst";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        $flag = array('FLAG' => 'OK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $ven_id = $row['VendorId'];
            $ven_name = $row['VendorName'];
            $ven_name .= $row['MobileNo'];
            //$active_status = $row['active_status'];


            $obj = array('sci' => $ven_id, 'scn' => $ven_name);
            $dataToBeSent[] = $obj;

            //echo $subcategory_id;
            //echo $subcategory_name;
        }

        echo json_encode($dataToBeSent);
        //echo "OKKK";
    }
    else
    {
        $flag = array('FLAG' => 'OK');
        $dataToBeSent[] = $flag;
        
        echo json_encode($dataToBeSent);
        //echo 'NOT OKKKK';
    }
?>