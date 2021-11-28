<?php

require('./fpdf/fpdf.php');
require"config.php";
$watermark = 'watermark.png';
$company_no = 1;

$last_insert_id = $_POST['quid'];
class PDF extends FPDF{

    protected $company_no;
    function Header()
    {
    
            $conn =mysqli_connect('localhost', 'root', '','imsfinal');
            $result=mysqli_query($conn,"select * from tblqutationmst where QutationId = {$last_insert_id}");
            $rows = mysqli_fetch_assoc($result);
            $this->Image('watermark.png',30,100,150);
            $this->Image('./logo.png',5,5,40);
            $company_name = 'Ceramic Hub';
        
    
        $this->SetFont('Arial','B',15);
        $this->Cell(110 ,6,'',0,0);
        $this->SetFont('Arial','B',12);
        $this->Cell(80, 6, $company_name,0,1,'C');
        $this->Cell(110 ,6,'',0,0);
        $this->Cell(80 ,6,'Address',0,1,'C');
        $this->Cell(110 ,6,'',0,0);
        $this->Cell(80 ,6,'Adress',0,1,'C');
        $this->Cell(110 ,6,'',0,0);
        $this->Cell(80 ,6,'Contact',0,1,'C');
        
        $this->Ln(5);
        $this->SetFont('Times','B',18);
        $this->Cell(190,7,'Quotation',1,1,'C');
//$pdf->Title('Challan');
        $this->SetFont('Times','',12);
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Customer Name    : ','L', 0, 'L');   
        $this->SetFont('Times','',12);
        $this->Cell(60,7, $rows['Name'] ,0, 0, 'L');
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Challan ID    :','L', 0, 'L');
        $this->SetFont('Times','',12);
        $this->Cell(40,7, $rows['QutationId'],'R',1, 'L');
        $this->SetFont('Times','B',12);
        $this->cell(105,7,'','L,B',0,'L');
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Date               : ', 'L,B', 0, 'L');
        $this->SetFont('Times','',12);
        $this->Cell(40,7, $rows['ModifiedDate'], 'R,B', 1, 'L');

        $this->SetFont('Times','B',12);
        $this->Cell(30, 6, 'SR No.', 1, 0, 'C');
        $this->Cell(75, 6, 'Item Name', 1, 0, 'C');
        $this->Cell(30, 6, 'Quentity', 1, 0, 'C');
        $this->Cell(25, 6, 'Rate', 1, 0, 'C');
        $this->Cell(30, 6, 'Total', 1, 1, 'C');

    }

    // Page footer
    function Footer()
    {
        $this->SetY(-62);
        $this->SetFont('Times','',12);
        $this->Ln(5);
        $this->Cell(190, 5, 'Terms and Condition:-', 0, 1, 'L');
        $this->Cell(190, 5, '1. Not Responsible for Demages after the goods delivered from our godown', 0, 1, 'L');
        $this->Cell(190, 5, '2. Goods once supplied will not be taken back or exchanged.', 0, 1, 'L');
        $this->Cell(190, 5, '3. 18% interest will charged if this not paid in 7 days.', 0, 1, 'L');
        $this->Cell(190, 5, '4. Subject to Anand jurisdiction.', 0, 1, 'L');
        $this->Ln(15);
        $this->Cell(70, 0, "", 'T', 0, 'C');
        $this->Cell(50, 0, "", 0, 0, 'C');
        $this->Cell(70, 0, "", 'T', 1, 'C');
        $this->Ln(5);
        $this->Cell(70, 3, "Reciever's Sign.", 0, 0, 'C');
        $this->Cell(50, 3, "", 0, 0, 'C');
        $this->Cell(70, 3, "Authorise's Sign.", 0, 1, 'C');
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');


    }
    function Title($label)
    {
    // Arial 12
        $this->SetFont('Times','B',18);
    // Background color
        $this->SetFillColor(160, 163, 161);
    // Title
        $this->Cell(190,7,"$label",0,1,'C',true);
    // Line break
        $this->Ln(4);
    }


    function cal($amt) {
	    $Amount = $amt;
	    $main = $Amount;
	    $No_0 = floor($Amount);
	    $Paise = round($Amount - $No_0, 2) * 100;
	    $No_1 = strlen($No_0);
	    $No = 0;

        $Array = array();
	    $Value = array ('',
		    'Hundred',
		    'Thousand',
		    'Lakh',
		    'Caror'
        );


        $Trans = array('',
		    'One',		'Two',		'Three',		'Four',		'Five',		'Six',		'Seven',		'Eight',		'Nine',		'Ten',
		    'Eleven',		'Twelve',		'Thirteen',		'Fourteen',		'Fifteen',	'Sixteen',		'Seventeen',		'Eighteen',		'Nineteen',		'Twenty',
		    'Twenty One',		'Twenty Two',		'Twenty Three',		'Twenty Four',		'Twenty Five',	'Twenty Six',		'Twenty Seven',		'Twenty Eight',		'Twenty Nine',		'Thirty',
		    'Thirty One',		'Thirty Two',		'Thirty Three',		'Thirty Four',		'Thirty Five',	'Thirty Six',		'Thirty Seven',		'Thirty Eight',		'Thirty Nine',		'Forty',
		    'Forty One',		'Forty Two',		'Forty Three',		'Forty Four',		'Forty Five',	'Forty Six',		'Forty Seven',		'Forty Eight',		'Forty Nine',		'Fifty',
		    'Fifty One',		'Fifty Two',		'Fifty Three',		'Fifty Four',		'Fifty Five',	'Fifty Six',		'Fifty Seven',		'Fifty Eight',		'Fifty Nine',		'Sixty',
		    'Sixty One',		'Sixty Two',		'Sixty Three',		'Sixty Four',		'Sixty Five',	'Sixty Six',		'Sixty Seven',		'Sixty Eight',		'Sixty Nine',		'Seventy',
		    'Seventy One',		'Seventy Two',		'Seventy Three',	'Seventy Four',		'Seventy Five',	'Seventy Six',		'Seventy Seven',	'Seventy Eight',	'Seventy Nine',		'Eighty',
		    'Eighty One',		'Eighty Two',		'Eighty Three',		'Eighty Four',		'Eighty Five',	'Eighty Six',		'Eighty Seven',		'Eighty Eight',		'Eighty Nine',		'Ninety',
		    'Ninety One',		'Ninety Two',		'Ninety Three',		'Ninety Four',		'Ninety Five',	'Ninety Six',		'Ninety Seven',		'Ninety Eight',		'Ninety Nine'
        );


    while($No < $No_1){
	    $No_1 = ($No == 2) ? 10 : 100;
	    $No_2 = floor($No_0 % $No_1);
	    $No_0 = floor($No_0 / $No_1);
	    $No += 	($No_1 == 10) ? : 2;
	    if($No_2) {
	        $No_3 = (($Count = count($Array)) && $No_2 > 9) ? '' : null;
	        $No_4 = ($Count == 1 &&  $Array[0]) ? '' : null;
	    
            $Array [] = ($No_2 < 21) ? $Trans[$No_2].
	            ' '.$Value[$Count].$No_3.
	            ' '.$No_4 : $Trans[floor($No_2 / 10) * 10].
	            ' '.$Trans[$No_2 % 10].
	            ' '.$Value[$Count].$No_3.
	            ' '.$No_4;
        }
        else $Array[] = null;
    }


	$Rupees = array_reverse($Array);
	$Rupees = implode('', $Rupees);
	$Paise = $Trans[$Paise];
    $this->Cell(135,6,$Rupees.'Rupees only',0,0,'L');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$discount = 1.5;
$amount = 0;
$conn =mysqli_connect('localhost', 'root', '','imsfinal');
$result1=mysqli_query($conn,"select * from tblqutationdetails where QutationId = {$last_insert_id}");
$rows1 = mysqli_fetch_assoc($result1);
$pdf->SetFont('Times','',10);
$total_of_row = $rows1['Amount'];
$result4=mysqli_query($conn,"select sum(Amount) as sum from tblqutationdetails where QutationId = {$last_insert_id}");
$rows5 = mysqli_fetch_assoc($result4);
$sum_of_sub_total = $rows5['sum'];

 $conn =mysqli_connect('localhost', 'root', '','imsfinal');

echo 'console.log("Database connected!")';
$select="select * from tblqutationdetails where QutationId = {$last_insert_id}";


foreach($dbo->query($select) as $row2) {
    $i=0;
    $pdf->Cell(30, 6,($i+1), 'L', 0, 'C');
    $pdf->Cell(75, 6, $row2['Discription'],'L', 0, 'L');
    $pdf->Cell(30, 6, $row2['Qty'], 'L', 0, 'R');
    $pdf->Cell(25, 6, $row2['Rate'], 'L', 0, 'R');
    $pdf->Cell(30, 6, $total_of_row, 'L,R', 1, 'R');
}

$amount = (float)$sum_of_sub_total-(((float)$sum_of_sub_total*$discount)/100);

$pdf->SetFont('Times','B',12);
$pdf->Cell(135, 6, 'Amount In Words : ', 'T', 0, 'L');
$pdf->Cell(25, 6, 'Sub Total', 1, 0, 'L');
$pdf->Cell(30, 6, number_format((float) $sum_of_sub_total, 2, '.', ''), 1, 1, 'R');
$pdf->cal($amount);
$pdf->Cell(25, 6, 'Discount', 1, 0, 'L');
$pdf->Cell(30, 6, $discount, 1, 1, 'R');
$pdf->Cell(135, 6, '', 0, 0, 'L');
$pdf->Cell(25, 6, 'Amount', 1, 0, 'L');
$pdf->Cell(30, 6, number_format((float) $amount, 2, '.', ''), 1, 1, 'R');

ob_end_clean();

$pdf->Output();
?>
