<?php

    include('./config.php');
    $productid = $_POST['productid'];
    $recstatus = $_POST['recstatus'];

    if($recstatus == 1){
        $recstatus = 0;
    }
    else{
        $recstatus = 1;
    }

    $query = "UPDATE productmst SET RecStatus = {$recstatus} WHERE ProductID = {$productid}";
    $result = mysqli_query($conn, $query);

    if($result){
        echo '1'; // 1=>success
    }
    else{
        die('-1'); // -1=>err in query
    }

?>