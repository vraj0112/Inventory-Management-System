<?php
    include('./config.php');

    $query = "SELECT * FROM BRANDNAMES WHERE RecStatus = true";
    $result = mysqli_query($conn, $query);

    $dataToBeSent = array();
    if($result)
    {
        $flag = array('FLAG' => 'OKK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $brandid = $row['BrandId'];
            $brandname = $row['BrandName'];

            $obj = array('brandid' => $brandid, 'brandname' => $brandname);
            $dataToBeSent[] = $obj;
        }
        echo json_encode($dataToBeSent);
    }
    else
    {
        $obj = array('FLAG' => 'ERRORINEXECUTINGQUERY');
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }
?>