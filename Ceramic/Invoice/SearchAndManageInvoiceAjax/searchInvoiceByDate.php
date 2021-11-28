<?php
    include('./config.php');

    $fromdate = $_POST['fromdate']." 00:00:00";
    $todate = $_POST['todate']." 00:00:00";

    $query = "SELECT InvoiceId, InvoiceNo, CustomerName, InvoiceDate, invoicemst.RecStatus as RecStatus FROM invoicemst JOIN tblcustomermst  WHERE  invoicemst.CustomerId = tblcustomermst.CustomerId and InvoiceDate >= '{$fromdate}'and InvoiceDate <= '{$todate}' ORDER BY InvoiceDate DESC ";
    $result = mysqli_query($conn, $query);
    //echo $query;

    if($result){
        $no_of_results = $result->num_rows;
        if($no_of_results > 0){
            $flag = array('FLAG' => 'OKK'); // 
            $dataToBeSent[] = $flag; 

            while($row = $result->fetch_assoc()){
                $Invoiceid = $row['InvoiceId'];
                $Invoiceno = $row['InvoiceNo'];
                $InvoiceDate = $row['InvoiceDate'];
                $InvoiceDate = substr($InvoiceDate, 0, 10);
                $InvoiceDate = explode("-", $InvoiceDate);
                $InvoiceDate = $InvoiceDate[2]."-".$InvoiceDate[1]."-".$InvoiceDate[0];
                $customername = $row['CustomerName'];
                $recstatus = $row['RecStatus'];

                $obj = array('Invoiceid'=> $Invoiceid, 'Invoiceno'=> $Invoiceno, 'InvoiceDate'=>$InvoiceDate, 'customername'=>$customername, 'recstatus'=>$recstatus);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }else if($no_of_results == 0){
            $flag = array('FLAG' => 'NORECORDFOUND'); // NORECORDFOUND => Challan No Not Found
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