<?php

    include('./config.php');

    $subcategoryid = $_POST['subcategoryid'];
    $gradeid = $_POST['gradeid'];

    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    $cheackalreadyMapped = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM GradeMapp Where GradeId = ".$gradeid." and Subcategory_id= ".$subcategoryid."  and  grademapp.RecStatus = true ");
    if($cheackalreadyMapped)
    {
        $row = $cheackalreadyMapped -> fetch_assoc();

        if($row['noofrecord'] == 0)
        {
            $mapgradewithsubcategory = mysqli_query($conn, "INSERT INTO GradeMapp (Subcategory_id, GradeId) values (".$subcategoryid.", ".$gradeid.")");
            if($mapgradewithsubcategory)
            {
                if(!mysqli_commit($conn))
                {
                    echo "-4"; // -4 ==> Commit Failuier
                }
                else
                {
                    echo "1";
                }
            }
            else
            {
                echo "-3"; // -3 ==> Error While Mapping SubcategoryId With Grade
            }
        }
        else if($row['noofrecord'] == 1)
        {
            echo "0"; // 0 ==> Grade Already Mapped With Subcategory
        }
        else
        {
            echo '-2'; // -2 ==> More Then One Record Found
        }
    }
    else
    {
        echo "-1"; // -1 ==> Error In Cheacking Query
    }
?>