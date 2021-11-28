<?php
    include('./config.php');

    $result = mysqli_query($conn, "SELECT GradeId, GradeText FROM Grades");

    $dataToBeSent = array();
    if($result)
    {
        if($result->num_rows > 0)
        {
            $flag = array('FLAG' => 'OKK' );
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc())
            {
                $gradeid = $row['GradeId'];
                $gradetext = $row['GradeText'];

                $obj = array('gradeid' => $gradeid, 'gradetext' => $gradetext );
                $dataToBeSent[] = $obj;
            }
            
            echo json_encode($dataToBeSent);
        }
        else
        {
            $flag = array('FLAG' => 'NORECORDFOUND' );
            $dataToBeSent[] = $flag;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $flag = array('FLAG' => 'ERRORINEXECUTINGQUERY' );
        $dataToBeSent[] = $flag;
        echo json_encode($dataToBeSent);
    }
?>