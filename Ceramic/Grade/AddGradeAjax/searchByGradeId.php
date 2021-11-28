<?php

    include('./config.php');

    $gradeid = $_POST['gradeid'];
    $dataToBeSent = array();

    if($gradeid != "")
    {
        $searchByGradeId = mysqli_query($conn, "SELECT * FROM Grades Where GradeId=".$gradeid);
        if($searchByGradeId)
        {
            if($searchByGradeId->num_rows > 0)
            {
                $flag = array('FLAG' => 'OKK' );
                $dataToBeSent[] = $flag;

                $row = $searchByGradeId->fetch_assoc();
                $gradeid = $row['GradeId'];
                $gradetext = $row['GradeText'];
                $recstatus = $row['RecStatus'];

                $obj = array('gradeid' => $gradeid, 'gradetext' => $gradetext, 'recstatus' => $recstatus );
                $dataToBeSent[] = $obj;
                echo json_encode($dataToBeSent);
            }
            else
            {
                $flag = array('FLAG' => 'NRFFGI' ); //  ESBGIQ ==> No Record Found For Grade Id
                $dataToBeSent[] = $flag;
                echo json_encode($dataToBeSent); 
            }
        }
        else
        {
            $flag = array('FLAG' => 'ESBGIQ' ); //  ESBGIQ ==> Error In Search By Grade Id Query
            $dataToBeSent[] = $flag;
            echo json_encode($dataToBeSent); 
        }
    }
    else
    {
        $flag = array('FLAG' => 'GRADEIDNOTFOUND' );
        $dataToBeSent[] = $flag;
        echo json_encode($dataToBeSent);
    }
?>