<?php

include('./config.php');

$subcategoryid = $_POST['subcategoryid'];
$brandid = $_POST['brandid'];

mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
$cheackalreadyMapped = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM BrandMapp Where BrandId = ".$brandid." and SubcategoryId= ".$subcategoryid ."  and   brandmapp.RecStatus = true");
if($cheackalreadyMapped)
{
    $row = $cheackalreadyMapped -> fetch_assoc();

    if($row['noofrecord'] == 0)
    {
        $mapgradewithsubcategory = mysqli_query($conn, "INSERT INTO BrandMapp (SubcategoryId, BrandId) values (".$subcategoryid.", ".$brandid.")");
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
            echo "-3"; // -3 ==> Error While Mapping SubcategoryId With Brand
        }
    }
    else if($row['noofrecord'] == 1)
    {
        echo "0"; // 0 ==> Brand Already Mapped With Subcategory
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
