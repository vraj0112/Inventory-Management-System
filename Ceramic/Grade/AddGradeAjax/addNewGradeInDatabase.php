<?php
    include('./config.php');

    $gradetext = $_POST['gradetext'];

    

    $gradetext = ucwords(strtolower($gradetext));
    $gradetext = trim(preg_replace('/\s+/',' ', $gradetext));

    $findIfRecordExists = mysqli_query($conn, "SELECT COUNT(1) AS noofrecord from Grades where GradeText = '".$gradetext."'");

    if($findIfRecordExists)
    {
        $row = $findIfRecordExists->fetch_assoc();
        $noofrecord = $row['noofrecord'];

        if($noofrecord == 1 )
        {
            die('-1'); // -1 ==> Record Exists For Given Grade Text
        }
        else if($noofrecord == 0)
        {

            mysqli_autocommit($conn, false);

            $insertIntoGrades = mysqli_query($conn, "INSERT INTO Grades (GradeText) Values ('".$gradetext."')");
            if($insertIntoGrades)
            {
                if(mysqli_commit($conn))
                {
                    mysqli_autocommit($conn, true);
                    echo "1"; // 1 ==> Succesfully Inserted
                }
                else
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn, true);
                    die("-2"); // -2 ==> Commit Failuer
                }
            }
            else
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn, true);
                die('-3');//  -3 ==> Failes To Insert Into Grades
            }
        }
        else
        {
            die('-4'); // -4 ==> Other Then 0 and 1 Record found for GradeText
        }
    }
    else
    {
        die('-5'); // -5 ==> Error In finding grade text exists or not in Data base
    }

?>