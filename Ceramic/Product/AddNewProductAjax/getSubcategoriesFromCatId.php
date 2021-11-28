<?php
    include('./config.php');

    $catid = $_POST['catid'];
    $dataToBeSent = array();

    $query = "SELECT * FROM subcategories WHERE subcategories.category_id = ".$catid." and subcategories.active_status = true";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        if($result->num_rows  >  0)
        {
            $flag = array('FLAG' => "OKK");
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc())
            {
                $subcatid = $row['subcategory_id'];
                $subcatname = $row['subcategory_name'];

                $obj = array('subcatid' => $subcatid, 'subcatname' => $subcatname);
                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);
        }
        else
        {
            $flag = array('FLAG' => "NORECORDFOUND");
            $dataToBeSent[] = $flag;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $flag = array('FLAG' => "ERRORINEXECUTINGQUERY");
        $dataToBeSent[] = $flag;
        echo json_encode($dataToBeSent);
    }

?>
