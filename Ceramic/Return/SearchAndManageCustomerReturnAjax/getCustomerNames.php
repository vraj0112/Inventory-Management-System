<?php
    include('./config.php');

    $query = "SELECT CustomerId, CustomerName, MobileNo FROM tblcustomermst WHERE RecStatus = true";
    $result = mysqli_query($conn, $query);
    $dataToBeSent = array();

    if($result){
        if($result->num_rows > 0){

            $flag = array('FLAG' => 'OKK');
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc()){
                $customerid = $row['CustomerId'];
                $customername = $row['CustomerName'];
                $mobileno = $row['MobileNo'];

                $data = array('customerid' => $customerid, 'customername' => $customername, 'mobileno' => $mobileno);
                $dataToBeSent[] = $data;
            }

            echo json_encode($dataToBeSent);
        }
        else{
            $flag = array('FLAG' => 'NORECORDFOUND');
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