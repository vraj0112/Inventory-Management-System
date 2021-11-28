<?php
    include('./config.php');
    $data = file_get_contents("php://input");

    $name1 = ucwords(strtolower($_POST['name']));
    $name = trim(preg_replace('/\s+/',' ', $name1));
    $date = $_POST['date'];
    $tbl  = $_POST['datatable'];
 
    $totalamount = $_POST['totalamount'];
    $gstamount   = $_POST['gstamount'];
    $netamount   = $_POST['netamount'];
    $tbl  = json_decode($tbl, true);

    $dataToBeSent = array();

    // mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
    mysqli_autocommit($conn,false);


    $insertIntoQuotationMst =  "INSERT INTO TblQutationMst (Name, QDate, TotalPrice, TotalGST, TotalAmount) VALUES ('".$name."', '{$date}', {$totalamount}, {$gstamount}, {$netamount})";
    $result_insertIntoQuotationMst = mysqli_query($conn, $insertIntoQuotationMst);

    if($result_insertIntoQuotationMst)
    {
        $n = count($tbl);
        $last_insert_id = mysqli_insert_id($conn);
        $insertIntoQuotationDetails = "INSERT INTO tblqutationdetails (ItemNo, Discription, Qty, Rate, Gst, QutationId) VALUES ";
        for($i = 0; $i<$n; $i++)
        {
            $insertIntoQuotationDetails .=
            "({$i},'".$tbl[$i]['Description']."', {$tbl[$i]['Qty']}, {$tbl[$i]['Rate']}, {$tbl[$i]['GST']}, {$last_insert_id} ), ";
        }
        $insertIntoQuotationDetails = rtrim($insertIntoQuotationDetails, ", ");
        $insertIntoQuotationDetails .= ";";
        //echo $insertIntoQuotationDetails;
        $result_insertIntoQuotationDetails = mysqli_query($conn, $insertIntoQuotationDetails);

        if($result_insertIntoQuotationDetails)
        {
            if(!mysqli_commit($conn))
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn,true);
                $flag = array('FLAG' => 'COMMITFAIL');
                $dataToBeSent[] = $flag;

                die (json_encode($dataToBeSent));
            }
            else
            {
                mysqli_autocommit($conn,true);
                $flag = array('FLAG' => 'SUCCESS');
                $dataToBeSent[] = $flag;

                $quotationid = array('QID' => $last_insert_id);
                $dataToBeSent[] = $quotationid;

                die (json_encode($dataToBeSent));
            }
        }
        else
        {
            $flag = array('FLAG' => 'ERRINQUOTATIONDETAILS');
            $dataToBeSent[] = $flag;

            die (json_encode($dataToBeSent));
        }
    }
    else
    {
        $flag = array('FLAG' => 'ERRINQUOTATIONMST');
        $dataToBeSent[] = $flag;
         
        die (json_encode($dataToBeSent));
    }

?>