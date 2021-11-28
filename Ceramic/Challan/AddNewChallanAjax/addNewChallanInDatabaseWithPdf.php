<?php
    include('./config.php');
    require('./fpdf/fpdf.php');

    $data = file_get_contents("php://input");
    $mydata = json_decode($data, true);

class PDF extends FPDF
{
    protected $customer_name;
    protected $challan_date;
    protected $challan_no;
    protected $company_no;

    function __construct($customer_name,$challan_no,$challan_date,$company_no)
    {
        parent::__construct();
        $this->customer_name=$customer_name;
        $this->challan_date=$challan_date;
        $this->challan_no=$challan_no;
        $this->company_no = $company_no;
    }


    // Page header
    function Header()
    {
        // Log
        if($this->company_no == 1)
        {
            $this->Image('watermark.jpeg',30,100,150);
            $this->Image('./logo.png',5,5,40);
            $company_name = 'Ceramic Hub';
        }
        else
        {
            $this->Image('watermark2.png',30,100,150);
            $this->Image('./balajilogo.png',5,5,40);
            $company_name = 'Balaji Ceramic';
        }
    
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
        $this->Cell(190,7,'CHALLAN',1,1,'C');
        //$pdf->Title('Challan');
        $this->SetFont('Times','',12);
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Customer Name    : ','L', 0, 'L');   
        $this->SetFont('Times','',12);
        $this->Cell(60,7, $this->customer_name ,0, 0, 'L');
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Challan ID    :','L', 0, 'L');
        $this->SetFont('Times','',12);
        $this->Cell(40,7, $this->challan_no,'R',1, 'L');
        $this->SetFont('Times','B',12);
        $this->cell(105,7,'','L,B',0,'L');
        //$pdf->Cell(45,14, 'Address                  : ', 0, 0, 'L');
        //$pdf->SetFont('Times','',12);
        //$pdf->Cell(45,14, 'Opp. Charusat Hospital, changa road, petlad - 363001', 0, 0, 'L');
        $this->SetFont('Times','B',12);
        $this->Cell(45,7, 'Date               : ', 'L,B', 0, 'L');
        $this->SetFont('Times','',12);
        $this->Cell(40,7, $this->challan_date, 'R,B', 1, 'L');

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
        //$this->Cell(190, 0, '','T', 1, 'L');
        $this->SetFont('Times','',12);
        $this->Ln(5);
        $this->Cell(190, 5, 'Terms and Condition:-', 0, 1, 'L');
        //$pdf->SetX(3);
        $this->Cell(190, 5, '1. Not Responsible for Demages after the goods delivered from our godown', 0, 1, 'L');
        //$pdf->SetX(3);
        $this->Cell(190, 5, '2. Goods once supplied will not be taken back or exchanged.', 0, 1, 'L');
        //$pdf->SetX(3);
        $this->Cell(190, 5, '3. 18% interest will charged if this not paid in 7 days.', 0, 1, 'L');
        //$pdf->SetX(3);
        $this->Cell(190, 5, '4. Subject to Anand jurisdiction.', 0, 1, 'L');
        $this->Ln(15);
        $this->Cell(70, 0, "", 'T', 0, 'C');
        $this->Cell(50, 0, "", 0, 0, 'C');
        $this->Cell(70, 0, "", 'T', 1, 'C');
        $this->Ln(5);
        $this->Cell(70, 3, "Reciever's Sign.", 0, 0, 'C');
        $this->Cell(50, 3, "", 0, 0, 'C');
        $this->Cell(70, 3, "Authorise's Sign.", 0, 1, 'C');
        // Position at 1.5 cm from bottom
       
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
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

$pdf = new PDF($customer_name,$challan_no,$challan_date,$company_no);
$pdf->AliasNbPages();
$pdf->AddPage();



    $custid = $mydata[0]['customerId'];
    $totalamt=$mydata[0]['totalamt'];
    $discount=$mydata[0]['discount'];
    $transport=$mydata[0]['transport'];

    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    $pdf->Output();


?>