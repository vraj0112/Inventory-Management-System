<?php

    include('./config.php');

    $brandid = $_POST['brandid'];
    $recstatus = $_POST['recstatus'];

    if($recstatus == 1){
        $recstatus = 0;
    }
    else{
        $recstatus = 1;
    }

    mysqli_autocommit($conn, false);

    $updateRecStatus = "UPDATE brandnames SET RecStatus = {$recstatus} WHERE BrandId={$brandid}";
    //echo $updateRecStatus;
    $result_updateRecStatus = mysqli_query($conn, $updateRecStatus);

    if($result_updateRecStatus)
    {
        if(mysqli_commit($conn)){
            mysqli_autocommit($conn, true);
            echo "1";  //  1=> success
        }
        else{
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die('-1'); // -1=>Commit fail
        }
    }
    else
    {
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die('-2'); // -2=>err in update query
    }
?>