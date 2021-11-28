<?php
    include('./config.php');
    
    //$cid = $_POST['cid'];
    //echo $c_id;
    //echo $c_id;
    //$c_id = 1;

    //echo $scn;
    $dataToBeSent = array();

    $query = "SELECT * FROM Subcategories Where active_status = true ORDER BY subcategory_name ASC";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        if($result->num_rows > 0)
        {
            $flag = array('FLAG' => 'OK');
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc())
            {
                $subcategory_id = $row['subcategory_id'];
                $subcategory_name = $row['subcategory_name'];

                $obj = array('sci' => $subcategory_id, 'scn' => $subcategory_name);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }
        else
        {
            $flag = array('FLAG' => 'NORECORDFOUND');
            $dataToBeSent[] = $flag;

            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $flag = array('FLAG' => 'NOTOK');
        $dataToBeSent[] = $flag;
        
        echo json_encode($dataToBeSent);
    }
?>