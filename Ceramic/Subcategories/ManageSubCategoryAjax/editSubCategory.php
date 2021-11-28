<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $sc_id = $mydata['scid'];
    $subcategory_name = $mydata['scname'];
    $hsncode = $mydata['hsncode'];
    $gst = $mydata['gst'];
    
    //if(!empty($cid))
    
    //echo empty($c_id);

    if($sc_id != '' && $subcategory_name != '' && $hsncode != '' && $gst != '')
    {
        $subcategory_name = ucwords(strtolower($subcategory_name));
        $subcategory_name = trim(preg_replace('/\s+/',' ', $subcategory_name));

        $cheakforalreadyexists = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM subcategories where subcategory_name = '".$subcategory_name."'");
        if($cheakforalreadyexists)
        {
            
            $row = $cheakforalreadyexists->fetch_assoc();
            $noofrecord = $row['noofrecord'];

            if($noofrecord == 0)
            {
                mysqli_autocommit($conn, false);
                $query = "UPDATE subcategories set subcategory_name ='".$subcategory_name."', ProductHSNCode='".$hsncode."', ProductGST=".$gst."  WHERE subcategory_id=".$sc_id;
                $result = mysqli_query($conn, $query);

                if($result)
                {   
                    if(mysqli_commit($conn))
                    {
                        mysqli_autocommit($conn, true);
                        echo "1"; // 1=>success
                    }
                    else
                    {
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die("-1");  // -1=>commit fail
                    }
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die('-2'); // -2=>err in update query
                }
            }
            else if($noofrecord == 1)
            {
                die('-3'); // -3=>record found
            }
            else
            {
                die('-4'); // -4=>morethen one record or err
            }
        }
        else
        {
            die('-5'); // -5=>err in checking query
        }
    }
    else
    {
        die(-6); // -6=>parameter empty
    }
?>