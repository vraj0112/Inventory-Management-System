<?php
    include('./config.php');

    $invoiceno = $_POST['invoiceno'];
    $query = "SELECT InvoiceId, InvoiceDate, CustomerName, invoicemst.RecStatus as RecStatus FROM invoicemst JOIN tblcustomermst WHERE invoicemst.CustomerId = tblcustomermst.CustomerId and InvoiceNo='{$invoiceno}'";
    $result = mysqli_query($conn, $query);
    $dataToBeSent = array();

    if($result){
        $no_of_results = $result->num_rows;
        if($no_of_results == 1){
            $flag = array('FLAG' => 'OKK'); // 
            $dataToBeSent[] = $flag; 

            $row = $result->fetch_assoc();
            $invoicedate = $row['InvoiceDate'];
            $invoicedate = substr($invoicedate, 0, 10);
            $invoicedate = explode("-", $invoicedate);
            $invoicedate = $invoicedate[2]."-".$invoicedate[1]."-".$invoicedate[0];
            $customername = $row['CustomerName'];
            $invoiceid = $row['InvoiceId'];
            $recstatus = $row['RecStatus'];

            $obj = array('invoiceid'=>$invoiceid, 'invoicedate'=>$invoicedate, 'customername'=>$customername, 'recstatus'=>$recstatus);
            $dataToBeSent[] = $obj;

            echo json_encode($dataToBeSent);
        }
        else if($no_of_results == 0){
            $flag = array('FLAG' => 'NORECORDFOUND'); // NORECORDFOUND => Challan No Not Found
            $dataToBeSent[] = $flag; 
            die(json_encode($dataToBeSent));
        }
        else{
            $flag = array('FLAG' => 'ERRMULRECORD'); // ERRMULRECORD => Multiple Row Found Or Err
            $dataToBeSent[] = $flag; 
            die(json_encode($dataToBeSent));
        }
           
    }
    else{
        $flag = array('FLAG' => 'ERRINQUERY');
        $dataToBeSent[] = $flag;
        die(json_encode($dataToBeSent));
    }
?>