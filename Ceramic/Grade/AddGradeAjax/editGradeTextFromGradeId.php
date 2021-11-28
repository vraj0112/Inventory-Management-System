<?php
    include('./config.php');

    $gradeid = $_POST['gradeid'];
    $gradetext = $_POST['gradetext'];

    $gradetext = ucwords(strtolower($gradetext));
    $gradetext = trim(preg_replace('/\s+/',' ', $gradetext));

    if($gradeid != '' && $gradetext != '')
    {
        $cheackforgradetext = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord FROM Grades WHERE GradeText = '".$gradetext."'");
        if($cheackforgradetext)
        {
            $row = $cheackforgradetext->fetch_assoc();
            $noofrecord = $row['noofrecord'];

            if($noofrecord == 0)
            {
                mysqli_autocommit($conn, false);
                $editgradetext = mysqli_query($conn, "UPDATE Grades SET GradeText = '".$gradetext."' WHERE GradeId = ".$gradeid);
                if($editgradetext)
                {
                    if(mysqli_commit($conn))
                    {
                        mysqli_autocommit($conn, true);
                        echo "1";
                    }
                    else
                    {
                        mysqli_rollback($conn);
                        mysqli_autocommit($conn, true);
                        die("-4"); // -4 ==> Commit Failure
                    }
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die("-3"); // -3 ==> Error In Updating Grade Text
                }
            }
            else if($noofrecord == 1)
            {
                die('-5'); // -5 ==> Same Grade Text Available In Database
            }
            else
            {
                die('-6'); // -6 ==> Error In finding No Of Record
            }
        }
        else
        {
            die("-2"); // -2 ==> Error In Cheacking For Same value available in Database or not
        }
    }
    else
    {
        die('-1'); // -1 => Parameter Empty
    }
?>