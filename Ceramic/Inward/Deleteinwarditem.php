<?php
	include("config.php");
	$iid = $_GET['iid'];
	$ino = $_GET['ino'];
	$sysid = $_GET['id'];
	$type = $_GET['type'];
	$sql1 = "SELECT * FROM tblinwardbillmst WHERE InwardId='$iid'";
	$sql2 = "SELECT * FROM tblinwarddetails WHERE InwardNo='$ino'";
	$res2 = mysqli_query($conn, $sql2) or die("wrong query1");
     while ($row2 = mysqli_fetch_assoc($res2)) {   
        $qty = $row2['Qty'];
        $tbill = $row2['TotalCost'];
        $cgst = $row2['CGST'];
        $sgst = $row2['SGST'];

     }
    $gst = $cgst + $sgst;
    $updatestock = "DELETE from stockdetails WHERE InwardId='$iid' and Sysid='$sysid'";
    mysqli_query($conn, $updatestock) or die("wrong query for update in stock");
    $updateitem = "UPDATE tblinwarddetails set RecStatus='0' WHERE InwardNo = '$ino'";
    mysqli_query($conn, $updateitem) or die("wrong query for update in item");
    $updateinward = "UPDATE tblinwardbillmst set TotalAmount = TotalAmount - $tbill, TotalGST = TotalGST - $gst WHERE InwardId = $iid";
    mysqli_query($conn, $updateinward) or die("wrong query for update inward");
    header("Location:updateinward.php?id=$iid&type=$type");

?>