<?php
    include('./config.php');

    $brandname = $_POST['brandname'];

    $brandname = ucwords(strtolower($brandname));
    $brandname = trim(preg_replace('/\s+/',' ', $brandname));

    $checkForRecord = "SELECT COUNT(1) AS noofrecord FROM brandnames where BrandName = '{$brandname}' ";
    $result_checkForRecord = mysqli_query($conn, $checkForRecord);

    if($result_checkForRecord)
    {
        $row = $result_checkForRecord->fetch_assoc();
        $noofrecord = $row['noofrecord'];

        if($noofrecord == 0)
        {
            mysqli_autocommit($conn, false);

            $query = "INSERT INTO brandnames (BrandName) value ('".$brandname."')";
            $result = mysqli_query($conn, $query);
        
            if($result)
            {
                if(mysqli_commit($conn))
                {
                    mysqli_autocommit($conn, true);
                    echo "1";  // 1 => Inserted Succesfully
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die("-1"); // -1 => Error In Commit
                }
            }
            else
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-2"); // -2 => Error In Insert Executing Query
            }
        }
        else if($noofrecord == 1)
        {
           die("-3");  // -3 => Record Already Exists
        }
        else
        {
            die("-4"); // -4 ==> More then one Row FOund
        }
    }
    else
    {
        die("-5"); // -5 ==> Error In Checking Record
    }
?>