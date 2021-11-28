<?php

    include('./config.php');

    $subcategoryid = $_POST['subcategoryid'];
    $gradeid = $_POST['gradeid'];

    
    $cheackalreadyMapped = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM GradeMapp Where GradeId = ".$gradeid." and Subcategory_id= ".$subcategoryid."  and  grademapp.RecStatus = true ");
    if($cheackalreadyMapped)
    {
        $row = $cheackalreadyMapped -> fetch_assoc();

        if($row['noofrecord'] == 0)
        {
            mysqli_autocommit($conn, false);
            $mapgradewithsubcategory = mysqli_query($conn, "INSERT INTO GradeMapp (Subcategory_id, GradeId) values (".$subcategoryid.", ".$gradeid.")");
            if($mapgradewithsubcategory)
            {
                if(!mysqli_commit($conn))
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die("-4"); // -4 ==> Commit Failuier
                }
                else
                {
                    mysqli_autocommit($conn, true);
                    echo "1";
                }
            }
            else
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-3"); // -3 ==> Error While Mapping SubcategoryId With Grade
            }
        }
        else if($row['noofrecord'] == 1)
        {
            die("0"); // 0 ==> Grade Already Mapped With Subcategory
        }
        else
        {
            die('-2'); // -2 ==> More Then One Record Found
        }
    }
    else
    {
        die("-1"); // -1 ==> Error In Cheacking Query
    }
?>