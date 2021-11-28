<?php

    include('./config.php');

    $query = "SELECT CustomerId, CustomerName, MobileNo FROM tblcustomermst";
    $result = mysqli_query($conn, $query);

    $dataToBeSent = array();

    if($result)
    {
        if($result->num_rows > 0)
        {
            $flag = array('FLAG' => 'SUCCESS' );
            $dataToBeSent[] = $flag;

            while($row = $result->fetch_assoc())
            {
                $customerName = $row['CustomerName'];
                $customerId   = $row['CustomerId'];
                $customerNo = $row['MobileNo'];

                $obj = array('customerName' => $customerName, 'customerId' => $customerId, 'customerNo' => $customerNo);
                $dataToBeSent[] = $obj;
            }

            echo json_encode($dataToBeSent);
        }
        else
        {
            $flag = array('FLAG' => 'NORECORDFOUND' );
            $dataToBeSent[] = $flag;

            json_encode($dataToBeSent);
        }
    }
    else
    {
        $flag = array('FLAG' => 'ERRORINQUERYEXECUTION' );
        $dataToBeSent[] = $flag;

        json_encode($dataToBeSent);
    }
?>