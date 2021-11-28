<?php
    include("./config.php");

    $query = $_POST['query'];
    //echo $query;
    //echo var_dump($_POST['query']);
    //echo var_dump($query);
    $resultquery = mysqli_query($conn, $query);
    $dataToBeSent = array();

    if($resultquery)
    {
        if(mysqli_num_rows($resultquery) > 0 )
        {
            $obj = array('FLAG' => 'RECORDFOUND' );
            $dataToBeSent[] = $obj;

            while($row = $resultquery->fetch_assoc())
            {

                $type = $row['category_name'];
                $subtype = $row['subcategory_name'];
                $hsn = $row['ProductHSNCode'];
                $typeorcolor = $row['ProductTypeColor'];
                $brandname = $row['BrandName'];
                $dimension = $row['SizeOrDimension'];
                $qtyperunit = $row['QtyPerUnit'];
                $packingunit = $row['PackingUnit'];
                $gradetext = $row['GradeText'];
                $code = $row['Code'];
                $gst = $row['ProductGST'];
                $productid = $row['ProductID'];
                $recstatus = $row['recordstatus'];

                $obj = array(
                    'type' => $type,
                    'subtype' => $subtype,
                    'hsn' => $hsn,
                    'typeorcolor' => $typeorcolor,
                    'brandname' => $brandname,
                    'dimension' => $dimension,
                    'qtyperunit' => $qtyperunit,
                    'packingunit' => $packingunit,
                    'gradetext' => $gradetext,
                    'code' => $code,
                    'gst' => $gst,
                    'productid' => $productid,
                    'recstatus' => $recstatus
                );

                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);
        }
        else
        {
            $obj = array('FLAG' => 'NORECORDFOUND' );
            $dataToBeSent[] = $obj;
            echo json_encode($dataToBeSent);
        }
    }
    else
    {
        $obj = array('FLAG' => 'ERRORINQUERY' );
        $dataToBeSent[] = $obj;
        echo json_encode($dataToBeSent);
    }
    
?>