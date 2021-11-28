<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $category_id = $mydata['cid'];
    $subcategory_name = $mydata['scname'];
    $hsncode = $mydata['hsncode'];
    $gst = $mydata['gst'];

    
    if($subcategory_name != '' && $category_id != '-1' && $hsncode != '' && $gst != '')
    {
        $subcategory_name = ucwords(strtolower($subcategory_name));
        $subcategory_name = trim(preg_replace('/\s+/',' ', $subcategory_name));
        
        $checkrecordalreadyexists = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM subcategories where subcategory_name = '".$subcategory_name."' and category_id = ".$category_id);
        //echo $checkrecordalreadyexists;
        if($checkrecordalreadyexists)
        {   
            $row = $checkrecordalreadyexists->fetch_assoc();
            
            if($row['noofrecord'] == 0)
            {
                mysqli_autocommit($conn, false);

                $query = "INSERT INTO subcategories (subcategory_name, category_id, ProductHSNCode, ProductGST) VALUES ('".$subcategory_name."','".$category_id."','".$hsncode."', ".$gst.")";
                $result = mysqli_query($conn, $query);

                if($result)
                {
                    if(mysqli_commit($conn))
                    {
                        mysqli_autocommit($conn, true);
                        echo '1'; // 1=>success
                    }
                    else
                    {   
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die('-1'); // -1=>commit fail
                    }
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die('-2'); // -2=>err in result
                }
            }
            else if($row['noofrecord'] == 1)
            {
                die('-3'); // -3=>record found
            }
            else
            {
                die('-4'); // -4=>more then one record or err
            }
        }
        else
        {
            die('-5'); // -5=>err while checking
        }
    }
    else
    {
        die('-6'); // -6=>parameter empty
    }

?>