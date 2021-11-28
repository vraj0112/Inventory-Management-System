<?php

include('./config.php');

$subcategoryid = $_POST['subcategoryid'];
$brandid = $_POST['brandid'];

$cheackalreadyMapped = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM BrandMapp Where BrandId = ".$brandid." and SubcategoryId= ".$subcategoryid);
if($cheackalreadyMapped)
{
    $row = $cheackalreadyMapped -> fetch_assoc();

    if($row['noofrecord'] == 0)
    {
        mysqli_autocommit($conn, false);
        $mapgradewithsubcategory = mysqli_query($conn, "INSERT INTO BrandMapp (SubcategoryId, BrandId) values (".$subcategoryid.", ".$brandid.")");
        if($mapgradewithsubcategory)
        {
            if(mysqli_commit($conn))
            {
                mysqli_autocommit($conn, true);
                echo "1";  // 1=>success
            }
            else
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die("-1"); // -1 ==> Commit Failuier
            }
        }
        else
        {
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            die("-2"); // -2 ==> Error While Mapping SubcategoryId With Brand
        }
    }
    else if($row['noofrecord'] == 1)
    {
        die("-3"); // -3 => Brand Already Mapped With Subcategory
    }
    else
    {
        die('-4'); // -4 => More Then One Record Found
    }
}
else
{
    die('-5'); // -5 ==> Error In Cheacking Query
}

?>
