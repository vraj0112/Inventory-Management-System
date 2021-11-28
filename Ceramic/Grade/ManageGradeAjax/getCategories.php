<?php
    include('./config.php');

    $query = "SELECT * from categories where active_status=true";
    $result = mysqli_query($conn, $query);

    $dataToBeSent = array();
    if($result)
    {
        $flag = array('FLAG' => 'OKK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $categoryid = $row['category_id'];
            $category_name = $row['category_name'];
            //$recstatus = $row['RecStatus'];

            $obj = array('categoryid' => $categoryid, 'category_name' => $category_name);
            $dataToBeSent[] = $obj;
        }
        echo json_encode($dataToBeSent);
    }
    else
    {
        $obj = array('FLAG' => 'ERRORINEXECUTINGQUERY');
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }
?>