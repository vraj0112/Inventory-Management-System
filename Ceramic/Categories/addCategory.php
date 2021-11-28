<?php
    include('./config.php');
    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    $category_name = $mydata['cname'];

  

    if($category_name != '')
    {
        $category_name = ucwords(strtolower($category_name));
        $category_name = trim(preg_replace('/\s+/',' ', $category_name));

        $checkForCategory = "SELECT COUNT(1) as noofrecord FROM categories WHERE category_name = '{$category_name}'";
        $result_checkForCategory = mysqli_query($conn, $checkForCategory);

        if($result_checkForCategory)
        {
            $row = $result_checkForCategory->fetch_assoc();
            $noofrecord = $row['noofrecord'];
            if($noofrecord == 0)
            {
                mysqli_autocommit($conn, false);
                $transflag = false;

                $query = "INSERT INTO CATEGORIES (category_name) VALUES ('".$category_name."')";
                $result = mysqli_query($conn, $query);

                if($result)
                {
                    $transflag = true;

                    if($transflag)
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
                            die('-1'); // -1=>commit fail
                        }
                    }
                    else
                    {
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die('-2'); // -2=>transflag err
                    }
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die('-3'); // -3=>err in insert query
                }
            }
            else if($noofrecord == 1)
            {
                die('-4'); // -4=>record exists
            }
            else
            {   
                die('-5'); // -5=>MORE THen one record or No record found
            }
        }
        else
        {
            die('-6'); // -6=>err in checking query
        }
    }
    else
    {
        die('-7'); // -7=>categoryname empty
    }
?>