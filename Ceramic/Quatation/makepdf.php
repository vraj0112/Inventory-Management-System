<?php

    require('./fpdf/fpdf.php');
    include('./config.php');

    class PDF extends FPDF
    {
        protected $name;
        protected $date;
        protected $qno;

        function __construct($name,$date,$qno)
        {
            parent::__construct();
            $this->name=$name;
            $this->date=$date;
            $this->qno=$qno;
        }

    // Page header
        function Header()
        {
            // Log
            
            $this->Image('./watermark.jpeg',30,100,150);
            $this->Image('./ceramic.png',8,8,60);
            
            $this->SetFont('Arial','B',15);
            $this->Cell(108 ,6,'',0,0);
            $this->SetFont('Arial','B',12);
            $this->Cell(80, 6, 'Address: 8, 9, 10, Ground Floor,',0,1,'L');
            $this->Cell(128 ,6,'',0,0);
            $this->Cell(80 ,6,'Astha Complex,',0,1,'L');
            $this->Cell(128 ,6,'',0,0);
            $this->Cell(80 ,6,'Vadtal-Bakrol Road,',0,1,'L');
            $this->Cell(128 ,6,'',0,0);
            $this->Cell(80 ,6,'Anand.',0,1,'L');
            $this->Cell(110 ,6,'',0,0);
            $this->Cell(80 ,6,'Email Id: ceramichub.anand@gmail.com',0,1,'C');

            $this->Ln(5);
            $this->SetFont('Times','B',18);
            $this->Cell(190,7,'Quotation',1,1,'C');
            //$pdf->Title('Challan');
            $this->SetFont('Times','',12);
            $this->SetFont('Times','B',12);
            $this->Cell(45,7, 'Customer Name    : ','L', 0, 'L');   
            $this->SetFont('Times','',12);
            $this->Cell(60,7, $this->name ,0, 0, 'L');
            $this->SetFont('Times','B',12);
            $this->Cell(45,7, 'Quotation No   :','L', 0, 'L');
            $this->SetFont('Times','',12);
            $this->Cell(40,7, $this->qno,'R',1, 'L');
            $this->SetFont('Times','B',12);
            $this->cell(105,7,'','L,B',0,'L');
            //$pdf->Cell(45,14, 'Address                  : ', 0, 0, 'L');
            //$pdf->SetFont('Times','',12);
            //$pdf->Cell(45,14, 'Opp. Charusat Hospital, changa road, petlad - 363001', 0, 0, 'L');
            $this->SetFont('Times','B',12);
            $this->Cell(45,7, 'Date                  : ', 'L,B', 0, 'L');
            $this->SetFont('Times','',12);
            $this->Cell(40,7, $this->date, 'R,B', 1, 'L');

            $this->SetFont('Times','B',12);
            //$this->Cell(15, 6, 'No.', 1, 0, 'C');
            $this->Cell(110, 6, 'Item Disc.', 1, 0, 'C');
            $this->Cell(15, 6, 'Qty', 1, 0, 'C');
            $this->Cell(25, 6, 'Rate', 1, 0, 'C');
            $this->Cell(10, 6, 'GST', 1, 0, 'C');
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
            $this->Cell(190, 5, '1. Not Responsible for Damages after the goods delivered from our godown', 0, 1, 'L');
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




    $qid = $_POST['quotationid'];

    $getMstDetails = "SELECT * FROM tblqutationmst WHERE QutationId = {$qid}";
    //echo $getMstDetails;
    $result_getMstDetails = mysqli_query($conn, $getMstDetails);
    if($result_getMstDetails)
    {
        $row = $result_getMstDetails->fetch_assoc();
        $name = $row['Name'];

        $qid = str_pad($qid,9,"0", STR_PAD_LEFT);

        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $today = $day."-".$month."-".$year;


        $pdf = new PDF($name,$today,$qid);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        //$pdf->Output();
        $getDetails = "SELECT * FROM tblqutationdetails WHERE QutationId = {$qid}";
        $result_getDetails = mysqli_query($conn, $getDetails);

        //echo $get
        $subtotal = 0;

        if($result_getDetails)
        {
            $globaltotalamount = 0;
            $globalgstamount = 0;
            $globalnetamount = 0;

            $n = $result_getDetails->num_rows;
            //echo $n;
            for($i=0; $i<$n; $i++)
            {
                if($i % 25 == 0 && $i != 0)
                {
                    $pdf->Cell(190, 0, '','T', 1, 'L');
                    $pdf->AddPage();
                }

                $r = $result_getDetails->fetch_assoc();

                $item_desc = $r['Discription'];
                $item_qty  = $r['Qty'];
                $item_rate = $r['Rate'];
                $item_gst  = $r['Gst'];
                
                $totalamount = $item_qty*$item_rate;
                $gstamount   = ($totalamount*$item_gst)/100;
                $netamount   = $totalamount + $gstamount;
                
                $globaltotalamount += $totalamount;
                $globalgstamount   += $gstamount;
                $globalnetamount   += $netamount;
            
                //$pdf->Cell(15, 6,($i+1), 'L', 0, 'C');
                $pdf->Cell(110, 6, $item_desc,'L', 0, 'L');
                $pdf->Cell(15, 6, $item_qty, 'L', 0, 'R');
                $pdf->Cell(25, 6, number_format((float) $item_rate, 2, '.', ''), 'L', 0, 'R');
                $pdf->Cell(10, 6, $item_gst, 'L', 0, 'R');
                $pdf->Cell(30, 6, number_format((float) $netamount, 2, '.', ''), 'L,R', 1, 'R');

            }

            $pdf->SetFont('Times','B',12);
            //$pdf->Cell(135, 6, 'Amount In Words : ', 'T', 0, 'L');
            $pdf->Cell(135, 6,'' , 'T', 0, 'L');
            $pdf->Cell(25, 6, 'Sub Total', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $globaltotalamount, 2, '.', ''), 1, 1, 'R');
            //$pdf->cal($globalnetamount);
            $pdf->Cell(135, 6,'' , '', 0, 'L');
            $pdf->Cell(25, 6, 'GST ', 1, 0, 'L');
            $pdf->Cell(30, 6, $globalgstamount, 1, 1, 'R');
            $pdf->Cell(135, 6, '', 0, 0, 'L');
            $pdf->Cell(25, 6, 'Net Amount', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $globalnetamount, 2, '.', ''), 1, 1, 'R');

            $pdf->Output();

            
        }
        else
        {
            echo "ERR";
        }
    
    
    }
    else
    {
        echo "Something Went Wrong";
    }

    
    //echo $challan_id;
    /*SELECT * FROM challandetails join stockdetails,systable,productmst, subcategories, brandnames WHERE challandetails.StockId = stockdetails.StockId  and stockdetails.SysId = systable.SysId and systable.ProductId=productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and challandetails.RecStatus = true and productmst.BrandId = brandnames.BrandId and   challandetails.ChallanId = 69*/
    
?>