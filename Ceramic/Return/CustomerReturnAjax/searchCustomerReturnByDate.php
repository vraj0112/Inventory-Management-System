<?php
    include('./config.php');

    //$customerid = $_POST['customerid'];
    $fromdate = $_POST['fromdate']." 00:00:00";
    $todate = $_POST['todate']." 00:00:00";

    $query = "SELECT ChallanId, ChallanNo, CustomerName, ChallanDate, challanmst.RecStatus as RecStatus FROM challanmst JOIN tblcustomermst  WHERE challanmst.CustomerId = tblcustomermst.CustomerId and ChallanDate >= '{$fromdate}'and ChallanDate <= '{$todate}' ORDER BY ChallanDate  ";
    $result = mysqli_query($conn, $query);
    //echo $query;

    if($result){
        $no_of_results = $result->num_rows;
        if($no_of_results > 0){
            $flag = array('FLAG' => 'OKK'); // 
            $dataToBeSent[] = $flag; 

            while($row = $result->fetch_assoc()){
                $challanid = $row['ChallanId'];
                $challanno = $row['ChallanNo'];
                $challandate = $row['ChallanDate'];
                $challandate = substr($challandate, 0, 10);
                $challandate = explode("-", $challandate);
                $challandate = $challandate[2]."-".$challandate[1]."-".$challandate[0];
                $customername = $row['CustomerName'];
                $recstatus = $row['RecStatus'];

                $obj = array('challanid'=> $challanid, 'challanno'=> $challanno, 'challandate'=>$challandate, 'customername'=>$customername, 'recstatus'=>$recstatus);
                $dataToBeSent[] = $obj;
            }
            echo json_encode($dataToBeSent);
        }
        else if($no_of_results == 0){
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