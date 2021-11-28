<?php 
    include('./config.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);
    
    $custid = $mydata[0]['customerId'];
    $challandate = $mydata[0]['challandate'];
    $challandate = $challandate.' 00:00:00'; 
    $totalamt=$mydata[0]['totalamt'];
    $discount=$mydata[0]['discount'];
    $transport=$mydata[0]['transport'];
    $extracost=$mydata[0]['extracost'];
    $extracostdesc=$mydata[0]['extracostdesc'];
    $advancepayment=$mydata[0]['advancepayment'];

    $yyyymm = substr($challandate, 0, 7);
    $tempyyyymm = explode("-", $yyyymm);
    $yyyymm = $tempyyyymm[0].$tempyyyymm[1];
    $dataToBeSent = array();

    $getLastMonthId = "SELECT last_no as lastmonthid FROM challanno where month='{$yyyymm}'";
    $result_getLastMonthId = mysqli_query($conn, $getLastMonthId);

    if($result_getLastMonthId){
        if($result_getLastMonthId->num_rows > 0){
            $r = $result_getLastMonthId->fetch_assoc();
            $last_id_of_month = $r['lastmonthid'];
        }
        else{
            $insertNewMonth = "INSERT INTO challanno (month, last_no) VALUES ('{$yyyymm}', 1)";
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
        
        $challanno = str_pad($last_id_of_month,4,"0", STR_PAD_LEFT);
        $challanno = $yyyymm.$challanno;

        
        if($advancepayment == 0){
            $dueamount = 0;
        }
        else{
            $dueamount = floatval($totalamt) - floatval($discount) + floatval($transport) - floatval($advancepayment) + floatval($extracost);
        }
        //die($dueamount);
        $insertIntoChallanMst = "INSERT into challanmst (ChallanNo, ChallanDate, CustomerId, TotalAmount, Discount, TransportCost, ExtraCostDesc, ExtraCost, DueAmount, CreatedDate) value ('".$challanno."','".$challandate."',".$custid.", ".$totalamt.", ".$discount.", ".$transport.", '".$extracostdesc."', ".$extracost.",".$dueamount.", now())";
        $resultinsertIntoChallanMst = mysqli_query($conn,$insertIntoChallanMst);

        if($resultinsertIntoChallanMst){
            $last_Challan_id = mysqli_insert_id($conn);            
            $insertIntoChallanDetails="";
            $updateIntoStockMst="";
            $billingQty= " BillingQty = BillingQty - ";
            $otherQty= " OtherQty = OtherQty - ";
            for ($i=1; $i<$n ; $i++) { 
                $stockid=$mydata[$i]['stockid'];
                $billqty=$mydata[$i]['billqty'];
                $otherqty=$mydata[$i]['otherqty'];
                $sellprice=$mydata[$i]['sellprice'];
                $insertIntoChallanDetails = "INSERT into ChallanDetails (ChallanId, StockId, BillingQty, OtherQty, SellingPrice) value (".$last_Challan_id.", ".$stockid.", ".$billqty.", ".$otherqty.", ".$sellprice.")";
                $resultinsertIntoChallanDetails = mysqli_query($conn,$insertIntoChallanDetails);
                $updateIntoStockMst = "UPDATE StockDetails SET ".$billingQty." ".$billqty.", ".$otherQty." ".$otherqty." where StockId = ".$stockid." ;";
                $resultupdateIntoStockMst = mysqli_query($conn,$updateIntoStockMst);
                if(!$resultinsertIntoChallanDetails || !$resultupdateIntoStockMst)
                {
                    mysqli_rollback($conn);
                    mysqli_autocommit($conn,true);
                    $flag = array('FLAG' => 'MIDERR');
                    $dataToBeSent[] = $flag;
                    die (json_encode($dataToBeSent));
                }
                $insertIntoChallanDetails ="";
                $resultinsertIntoChallanDetails = null;
                $updateIntoStocksMst = "";
                $resultupdateIntoStocksMst = null;
            }

            $update_last_challan_of_month = "UPDATE challanno set last_no = last_no + 1 WHERE month='{$yyyymm}'";
            $result_update_last_challan_of_month = mysqli_query($conn, $update_last_challan_of_month);
            if(!$result_update_last_challan_of_month){
                $flag = array('FLAG' => 'ERRINULMID'); // ERRINULMID => Error In Updating Last Challan No Of Month
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }

            if($dueamount == 0){
                $status = "Complete";
            }else{
                $status = "Pending";
            }
            $insertIntoInwardPayment0 = "INSERT INTO tblinwardpayment (InwardId,PaymentDate,AmountPaid,AmountPending,Status,PaymentMode,RoundOffDade,StockMstSysId,ChallanId) value (0,'".$challandate."',".$advancepayment.",".$dueamount.",'".$status."','Customer',0,1,".$last_Challan_id.")";
            $resultinsertIntoInwardPayment0 = mysqli_query($conn,$insertIntoInwardPayment0);
            if(!$resultinsertIntoInwardPayment0){
                $flag = array('FLAG' => 'ERRINPAY0'); //ERRINPAY => Error in Payment Insertion
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }

            $insertIntoInwardPayment1 = "INSERT INTO tblinwardpayment (InwardId,PaymentDate,AmountPaid,AmountPending,Status,PaymentMode,RoundOffDade,StockMstSysId,ChallanId) value (0,'".$challandate."',".$advancepayment.",".$dueamount.",'".$status."','Customer',0,0,".$last_Challan_id.")";
            $resultinsertIntoInwardPayment1 = mysqli_query($conn,$insertIntoInwardPayment1);
            if(!$resultinsertIntoInwardPayment1){
                $flag = array('FLAG' => 'ERRINPAY1'); //ERRINPAY => Error in Payment Insertion 1
                $dataToBeSent[] = $flag;
                die (json_encode($dataToBeSent));
            }

            if(mysqli_commit($conn)){
                
                mysqli_autocommit($conn,true);
                $flag = array('FLAG' => 'SUCCESS');
                $dataToBeSent[] = $flag;
                $obj = array('CHALLANID' => $last_Challan_id);
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