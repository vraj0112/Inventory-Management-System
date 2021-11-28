<?php

    include('./config.php');
    $subcategiryid = $_POST['scid'];
    $gst = $_POST['gst'];
    $hsncode = $_POST['hsncode'];

    if(($subcategiryid != '-1' || $subcategiryid !='') && $gst != "" && $hsncode != "" ){
        mysqli_autocommit($conn, false);
        $query = "UPDATE subcategories SET ProductHSNCode = '{$hsncode}' , ProductGST ='{$gst}'   WHERE  subcategory_id = {$subcategiryid} ";
        $result = mysqli_query($conn, $query);

        if($result){
            if(mysqli_commit($conn)){
                mysqli_autocommit($conn, true);
                echo '1'; // 1 => success
            }
            else{
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die('-2'); // -2 => commit fail
            }
        }
        else{
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die('-3'); // -3 => Error While Executing Query
        }
    }
    else{
        die('-1'); // -1 => parameter empty
    }
?>