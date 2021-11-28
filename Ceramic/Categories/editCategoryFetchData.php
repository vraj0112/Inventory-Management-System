<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $c_id = $mydata['cid'];
    
    $query = "SELECT * FROM categories where category_id='".$c_id."'";
    $result = mysqli_query($conn, $query);

    if($result == true)
    {
        $row = $result->fetch_assoc();

        $category_name = $row['category_name'];

        echo $category_name;
    }
    else
    {
        echo false;     
    }
?>