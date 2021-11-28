<?php

    include('./config.php');

    $brandmapid = $_POST['brandmapid'];
    $recstatus  = $_POST['recstatus'];

    mysqli_autocommit($conn, false);

    if($recstatus == 1){
        $recstatus = 0;
    }   
    else{
        $recstatus = 1;
    }

    $changeRecStatus = "UPDATE brandmapp SET RecStatus = {$recstatus}  WHERE BrandMapping = {$brandmapid}";
    $result_changeRecStatus = mysqli_query($conn, $changeRecStatus);

    if($result_changeRecStatus)
    {
        if(mysqli_commit($conn)){
            mysqli_autocommit($conn, true);
            echo '1'; // 1=>success
        }
        else{
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die('-1'); // -1=>commit fail
        }
    }
    else
    {
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die('-2'); // -2=>err in update query
    }
?>