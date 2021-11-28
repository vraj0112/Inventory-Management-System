<?php

    include('./config.php');

    $grademapid = $_POST['grademapid'];
    $recstatus = $_POST['recstatus'];

    if($recstatus == 1){
        $recstatus = 0;
    }
    else{
        $recstatus = 1;
    }

    mysqli_autocommit($conn, false);

    $query = "UPDATE grademapp SET RecStatus = '{$recstatus}' WHERE GradeMappId = {$grademapid}";
    $result = mysqli_query($conn, $query);

    if($result){
        if(mysqli_commit($conn)){
            mysqli_autocommit($conn, true);
            echo '1'; // 1=>success
        }
        else{
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die('-1'); // -1=> commit fail
        }
    }
    else{
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die('-2'); // -1=> err in query
    }



?>