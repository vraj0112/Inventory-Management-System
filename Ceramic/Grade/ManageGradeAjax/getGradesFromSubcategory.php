<?php
    include('./config.php');

    $getgradefromsubcategory = mysqli_query($conn, "SELECT GradeText, GradeMappId, grademapp.RecStatus as recstatus FROM grademapp JOIN grades WHERE grades.GradeId = grademapp.GradeId and grademapp.Subcategory_id = " . $_POST['subcatid']);
    
    $dataToBeSent = array();
    
    if($getgradefromsubcategory)
    {
        if($getgradefromsubcategory->num_rows > 0)
        {
            $flag = array('FLAG' => 'OKK');
            $dataToBeSent[] = $flag;

            while($row = $getgradefromsubcategory->fetch_assoc())
            {
                //$subcategoryid = $row['subcategory_id'];
                $grade_name = $row['GradeText'];
                $grade_map_id = $row['GradeMappId'];
                $recstatus = $row['recstatus'];

                $obj = array('gradetext' => $grade_name, 'grademapid' => $grade_map_id, 'recstatus' => $recstatus);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }
        else
        {
            $obj = array('FLAG' => 'RECORDNOTFOUND');
            $dataToBeSent[] = $obj;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $obj = array('FLAG' => 'ERRORINEXECUTINGQUERY');
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }

    /*SELECT * FROM subcategories join categories, brandnames, brandmapp where subcategories.category_id = categories.category_id and subcategories.subcategory_id = brandmapp.SubcategoryId and brandmapp.BrandId = brandnames.BrandId;*/
?>