<?php 
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    
    $custid = $mydata[0]['customerId'];
    $invoicedate = $mydata[0]['invoicedate'];
    $invoicedate = $invoicedate.' 00:00:00'; 
    $totalamt=$mydata[0]['totalamt'];
    $discount=$mydata[0]['discount'];
    $transport=$mydata[0]['transport'];
  
    $yyyymm = substr($invoicedate, 0, 7);
    $tempyyyymm = explode("-", $yyyymm);
    $yyyymm = $tempyyyymm[0].$tempyyyymm[1];
    $dataToBeSent = array();

    $getLastMonthId = "SELECT last_no as lastmonthid FROM invoiceno where month='{$yyyymm}'";
    $result_getLastMonthId = mysqli_query($conn, $getLastMonthId);

    if($result_getLastMonthId){
        if($result_getLastMonthId->num_rows > 0){
            $r = $result_getLastMonthId->fetch_assoc();
            $last_id_of_month = $r['lastmonthid'];
        }
        else{
            $insertNewMonth = "INSERT INTO invoiceno (month, last_no) VALUES ('{$yyyymm}', 1)";
            $result_insertNewMonth = mysqli_query($conn, $insertNewMonth);
            if(!$result_insertNewMonth){
                $flag = array('FLAG' => 'ERRINM'); // ERRINM => Error In Inserting Month
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }
            else{
                $last_id_of_month = 1;
            }
        }
    }
    else{
        $flag = array('FLAG' => 'ERRINGLMID'); // ERRINGLMID => Error In Getting Last Month Id
        $dataToBeSent[] = $flag;
        die (json_encode($dataToBeSent));
    }
    
    if($custid!=""){
        $n=count($mydata);
        mysqli_autocommit($conn,false);
        
        $invoiceno = str_pad($last_id_of_month,4,"0", STR_PAD_LEFT);
        $invoiceno = $yyyymm.$invoiceno;
        //die($dueamount);
        $insertIntoinvoicemst = "INSERT into invoicemst (InvoiceNo, InvoiceDate, CustomerId, TotalAmount, Discount,  TransportationCost) value ('".$invoiceno."','".$invoicedate."',".$custid.", ".$totalamt.", ".$discount.", ".$transport.")";
        $resultinsertIntoinvoicemst = mysqli_query($conn,$insertIntoinvoicemst);

        if($resultinsertIntoinvoicemst){
            $last_Invoice_id = mysqli_insert_id($conn);            
            $insertIntoChallanDetails="";
            $updateIntoStockMst="";
            $billingQty= " VirtualQty = VirtualQty - ";
           // $otherQty= " OtherQty = OtherQty - ";
            for ($i=1; $i<$n ; $i++) { 
                $stockid=$mydata[$i]['stockid'];
                $billqty=$mydata[$i]['billqty'];
               // $otherqty=$mydata[$i]['otherqty'];
                $sellprice=$mydata[$i]['sellprice'];
                $insertIntoInvoiceDetails = "INSERT into invoicedetails (InvoiceId, StockId, Quantity, SellingPrice) value (".$last_Invoice_id.", ".$stockid.", ".$billqty.", ".$sellprice.")";
                $resultinsertIntoInvoiceDetails = mysqli_query($conn,$insertIntoInvoiceDetails);
                $updateIntoStockMst = "UPDATE StockDetails SET ".$billingQty." ".$billqty." where StockId = ".$stockid." ;";
                $resultupdateIntoStockMst = mysqli_query($conn,$updateIntoStockMst);
                if(!$resultinsertIntoInvoiceDetails || !$resultupdateIntoStockMst)
                {
                    $flag = array('FLAG' => 'MIDERR');
                    $dataToBeSent[] = $flag;
                    echo json_encode($dataToBeSent);
                }
                $insertIntoInvoiceDetails ="";
                $resultinsertIntoInvoiceDetails = null;
                $updateIntoStocksMst = "";
                $resultupdateIntoStocksMst = null;
            }

            $update_last_invoice_of_month = "UPDATE invoiceno set last_no = last_no + 1 WHERE month='{$yyyymm}'";
            $result_update_last_invoice_of_month = mysqli_query($conn, $update_last_invoice_of_month);
            if(!$result_update_last_invoice_of_month){
                $flag = array('FLAG' => 'ERRINULMID'); // ERRINULMID => Error In Updating Last Challan No Of Month
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }

            // if($dueamount == 0){
            //     $status = "Complete";
            // }else{
            //     $status = "Pending";
            // }
            // $insertIntoInwardPayment = "INSERT INTO tblinwardpayment (InwardId,PaymentDate,AmountPaid,AmountPending,Status,PaymentMode,RoundOffDade,StockMstSysId,ChallanId) value (0,'".$challandate."',".$advancepayment.",".$dueamount.",'".$status."','Customer',0,1,".$last_Challan_id.")";
            // $resultinsertIntoInwardPayment = mysqli_query($conn,$insertIntoInwardPayment);
            // if(!$resultinsertIntoInwardPayment){
            //     $flag = array('FLAG' => 'ERRINPAY'); //ERRINPAY => Error in Payment Insertion
            //     $dataToBeSent[] = $flag;
            //     die (json_encode($dataToBeSent));
            // }
            if(mysqli_commit($conn)){
                
                mysqli_autocommit($conn,true);
                $flag = array('FLAG' => 'SUCCESS');
                $dataToBeSent[] = $flag;
                $obj = array('InvoiceId' => $last_Invoice_id);
                $dataToBeSent[] = $obj;
                echo json_encode($dataToBeSent);
            }else{
                mysqli_rollback($conn);
                mysqli_autocommit($conn,true);
                $flag = array('FLAG' => 'ERRCOMMIT');
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }
        }else{
            $flag = array('FLAG' => 'ERRINSERTMST');
            $dataToBeSent[] = $flag;
            die (json_encode($dataToBeSent));
        }
    }
    else
    {
        $flag = array('FLAG' => 'PARAMEMPTY');
        $dataToBeSent[] = $flag;
        die (json_encode($dataToBeSent));   
    }
?>