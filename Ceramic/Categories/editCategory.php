<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $c_id = $mydata['cid'];
    $category_name = $mydata['cname'];
    
    if($c_id != '' && $category_name != '')
    {
        $category_name = ucwords(strtolower($category_name));
        $category_name = trim(preg_replace('/\s+/',' ', $category_name));

        $checkForCategory = "SELECT COUNT(1) as noofrecord FROM categories WHERE category_name='{$category_name}'";
        $result_checkForCategory = mysqli_query($conn, $checkForCategory);

        if($result_checkForCategory)
        {
            $row = $result_checkForCategory->fetch_assoc();
            $noofrecord = $row['noofrecord'];

            if($noofrecord == 0){
                mysqli_autocommit($conn, false);
                $query = "UPDATE categories set category_name ='".$category_name."' WHERE category_id=".$c_id;
                $result = mysqli_query($conn, $query);

                if($result){
                    if(mysqli_commit($conn)){
                        mysqli_autocommit($conn, true);
                        echo "1"; // 1=>success
                    }
                    else{
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die('-1'); // -1=>commit fail
                    }
                }
                else{
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die('-2'); // -2=>err in update categories
                }
            }
            else if($noofrecord == 1){
                die('-3'); // -3=>record exists
            }
            else{
                die('-4'); // -4=>more then one record or err
            }

        }
        else{
            die('-5'); // -5=>err while cheacking category
        }
    }
    else
    {
        die('-6'); // -6=>parameter empty
    }
?>