<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $scn = $mydata['scn'];
    //echo $c_id;
    //echo $c_id;
    //$c_id = 1;

    //echo $scn;
    $dataToBeSent = array();

    $query = "select subcategory_id, subcategory_name, subcategories.category_id, category_name from subcategories JOIN categories WHERE subcategories.category_id=categories.category_id and subcategories.active_status=1 and subcategories.active_status = true and categories.category_name='".$scn."' ORDER BY subcategories.subcategory_name ASC";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        $flag = array('FLAG' => 'OK');
        $dataToBeSent[] = $flag;

        while($row = $result->fetch_assoc())
        {
            $subcategory_id = $row['subcategory_id'];
            $subcategory_name = $row['subcategory_name'];
            //$active_status = $row['active_status'];


            $obj = array('sci' => $subcategory_id, 'scn' => $subcategory_name);
            $dataToBeSent[] = $obj;

            //echo $subcategory_id;
            //echo $subcategory_name;
        }

        echo json_encode($dataToBeSent);
        //echo "OKKK";
    }
    else
    {
        $flag = array('FLAG' => 'OK');
        $dataToBeSent[] = $flag;
        
        echo json_encode($dataToBeSent);
        //echo 'NOT OKKKK';
    }
?>