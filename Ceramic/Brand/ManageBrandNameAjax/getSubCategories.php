<?php
    include('./config.php');

    $query = "SELECT * FROM subcategories  join categories where subcategories.category_id = categories.category_id and category_name='".$_POST['catname']."' and subcategories.active_status = true";
    $result = mysqli_query($conn, $query);

    $dataToBeSent = array();
    if($result)
    {
        $flag = array('FLAG' => 'OKK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $subcategoryid = $row['subcategory_id'];
            $subcategory_name = $row['subcategory_name'];
            //$recstatus = $row['RecStatus'];

            $obj = array('subcategoryid' => $subcategoryid, 'subcategory_name' => $subcategory_name);
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