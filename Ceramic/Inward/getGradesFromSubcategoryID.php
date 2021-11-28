<?php
    include('./config.php');
    
    $subcatname = $_POST['subcatname'];
  
        $cheakforSubcatid = "SELECT * FROM Subcategories Where SubCategory_name = '{$subcatname}'";
        $result_checkForSubcatid = mysqli_query($conn, $cheakforSubcatid);


        if($result_checkForSubcatid)
        {

            $row = $result_checkForSubcatid->fetch_assoc();
            $subcatid = $row['subcategory_id'];

            //echo $subcatid;

            $query = "SELECT * from grademapp JOIN grades WHERE grademapp.GradeId = grades.GradeId and grademapp.RecStatus=true and grademapp.Subcategory_id={$subcatid}";
            $dataToBeSent = array();

    
            $result = mysqli_query($conn, $query);

            if($result)
            {
                if($result->num_rows > 0)
                {
                    $flag = array('FLAG' => 'OK');
                    $dataToBeSent[] = $flag;

                    while($row = $result->fetch_assoc())
                    {
                        $gradeid = $row['GradeId'];
                        $gradetext = $row['GradeText'];

                        $obj = array('gradeid' => $gradeid, 'gradetext' => $gradetext);
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
                $flag = array('FLAG' => 'ERRINFINDINGGRADES');
                $dataToBeSent[] = $flag;
        
                echo json_encode($dataToBeSent);
            }
        }
        else
        {
            $flag = array('FLAG' => 'ERRFINDINGSUBCATID');
            $dataToBeSent[] = $flag;
    
            echo json_encode($dataToBeSent);
        }
?>