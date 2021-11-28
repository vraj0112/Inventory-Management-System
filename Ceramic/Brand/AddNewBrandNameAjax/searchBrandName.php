<?php
    include('./config.php');

    $query = "SELECT * FROM BRANDNAMES where BrandId=".$_POST['brandid'];
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
            $recstatus = $row['RecStatus'];

            $obj = array('brandid' => $brandid, 'brandname' => $brandname, 'recstatus' => $recstatus);
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