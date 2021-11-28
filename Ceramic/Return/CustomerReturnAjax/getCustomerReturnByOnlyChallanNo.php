<?php
    include('./config.php');

    $challanno = $_POST['challanno'];
    $query = "SELECT ChallanId, ChallanDate, CustomerName, challanmst.RecStatus as RecStatus FROM challanmst JOIN tblcustomermst WHERE challanmst.CustomerId = tblcustomermst.CustomerId and challanno='{$challanno}'";
    $result = mysqli_query($conn, $query);
    $dataToBeSent = array();

    if($result){
        $no_of_results = $result->num_rows;
        if($no_of_results == 1){
            $flag = array('FLAG' => 'OKK'); // 
            $dataToBeSent[] = $flag; 

            $row = $result->fetch_assoc();
            $challandate = $row['ChallanDate'];
            $challandate = substr($challandate, 0, 10);
            $challandate = explode("-", $challandate);
            $challandate = $challandate[2]."-".$challandate[1]."-".$challandate[0];
            $customername = $row['CustomerName'];
            $challanid = $row['ChallanId'];
            $recstatus = $row['RecStatus'];

            $obj = array('challanid'=>$challanid, 'challandate'=>$challandate, 'customername'=>$customername, 'recstatus'=>$recstatus);
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