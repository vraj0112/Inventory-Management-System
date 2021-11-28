<?php

    include('./config.php');

    $gradeid = $_POST['gradeid'];
    $recstatus = $_POST['recstatus'];

    if($recstatus == 1){
        $recstatus = 0;
    }
    else{
        $recstatus = 1;
    }

    mysqli_autocommit($conn, false);
    $query = "UPDATE grades SET RecStatus = {$recstatus} WHERE GradeId = {$gradeid}";
    $result_query = mysqli_query($conn, $query);

    if($result_query){
        if(mysqli_commit($conn)){
            mysqli_autocommit($conn, true);
            echo "1";
        }
        else{
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die('-1');  // -1=>Commit Fail
        }
    }
    else{
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        die('-2');  // -1=>err in update query
    }

?>