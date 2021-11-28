<?php

    require('../fpdf/fpdf.php');
    include('./config.php');

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
                $this->Image('../Images/watermark.jpeg',30,100,150);
                $this->Image('../Images/ceramic.png',8,8,60);
                $company_name = 'Ceramic Hub';
            }
            else
            {
                //$this->Image('watermark2.png',30,100,150);
                //$this->Image('./balajilogo.png',5,5,40);
                $company_name = 'Balaji Ceramic';
            }
        
            $this->SetFont('Times','B',15);
            $this->Cell(108 ,6,'',0,0);
            $this->SetFont('Times','B',12);
            $this->Cell(80, 6, '   Address: 8, 9, 10, Ground Floor,',0,1,'L');
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
            $this->Cell(190,7,'CHALLAN',1,1,'C');
            //$pdf->Title('Challan');
            $this->SetFont('Times','',12);
            $this->SetFont('Times','B',12);
            $this->Cell(45,7, 'Customer Name    : ','L', 0, 'L');   
            $this->SetFont('Times','',12);
            $this->Cell(60,7, $this->customer_name ,0, 0, 'L');
            $this->SetFont('Times','B',12);
            $this->Cell(45,7, 'Challan No   :','L', 0, 'L');
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
            $this->Cell(15, 6, 'No.', 1, 0, 'C');
            $this->Cell(90, 6, 'Item Disc.', 1, 0, 'C');
            $this->Cell(30, 6, 'Quantity', 1, 0, 'C');
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
        
            // Times italic 8
            $this->SetFont('Times','I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');


        }

        function Title($label)
        {
        // Times 12
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
                'Crore'
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




    $challan_id = $_POST['challanid'];

    $getCustomerDetails = "SELECT * from challanmst JOIN tblcustomermst where challanmst.RecStatus = true and challanmst.CustomerId = tblcustomermst.CustomerId and challanmst.ChallanId = {$challan_id}";
    echo $getCustomerDetails;
    $result_getCustomerDetails = mysqli_query($conn, $getCustomerDetails);
    if($result_getCustomerDetails)
    {
        $row = $result_getCustomerDetails->fetch_assoc();
        $customer_name = $row['CustomerName'];
        $challandate = $row['ChallanDate'];
        $challandate = explode(" ",$challandate);
        $challandate = $challandate[0];
        $challandate = explode("-",$challandate);
        $challandate = $challandate[2].'-'.$challandate[1].'-'.$challandate[0];
        $discount = $row['Discount'];
        $transportation_cost = $row['TransportCost'];
        $other_cost = $row['ExtraCost'];
        $challan_no = $row['ChallanNo'];

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $challan_no; ?></title>
        </head>
        <body>
            
        </body>
        </html>
        <?php

        /*$year = date('Y');
        $month = date('m');
        $day = date('d');
        $today = $day."-".$month."-".$year;*/

        $company_no = 1;

        $pdf = new PDF($customer_name,$challan_no,$challandate,$company_no);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $getChallanDetails = "SELECT *, challandetails.BillingQty as bill , challandetails.OtherQty as other FROM challandetails join stockdetails,systable,productmst, subcategories, brandnames WHERE challandetails.StockId = stockdetails.StockId  and stockdetails.SysId = systable.SysId and systable.ProductId=productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and challandetails.RecStatus = true and productmst.BrandId = brandnames.BrandId and   challandetails.ChallanId = {$challan_id}";
        $result_getChallanDetails = mysqli_query($conn, $getChallanDetails);

        //echo $get
        $subtotal = 0;

        if($result_getChallanDetails)
        {
            $n = $result_getChallanDetails->num_rows;
            //echo $n;
            for($i=0; $i<$n; $i++)
            {
                if($i % 22 == 0 && $i != 0)
                {
                    $pdf->Cell(190, 0, '','T', 1, 'L');
                    $pdf->AddPage();
                }

                $r = $result_getChallanDetails->fetch_assoc();

                $subcategory_name = $r['subcategory_name'];
                $sizeordimension = $r['SizeOrDimension'];
                $qtyperunit = $r['QtyPerUnit'];
                $packingunit = $r['PackingUnit'];
                $selling_price = $r['SellingPrice'];
                $billingqty = $r['bill'];
                $otherqty = $r['other'];
                $brandname = $r['BrandName'];
                $batchno = $r['BatchNo'];

                //echo $sizeordimension;
                //echo $qtyperunit;
                //echo $subcategory_name;
                if($sizeordimension == "N/A"){
                    $disc = $subcategory_name . ", " . $qtyperunit." ".$packingunit;
                }else{
                    $disc = $subcategory_name . ", " . $sizeordimension;
                }

                
                $qty  = $billingqty + $otherqty;
                $rowtotal = number_format((float) $qty * $selling_price, 2, '.', '');
                $selling_price = number_format((float) $selling_price, 2, '.', '');
                $subtotal = $subtotal + $rowtotal;

                $pdf->Cell(15, 6,($i+1), 'L', 0, 'C');
                $pdf->Cell(90, 6, $disc,'L', 0, 'L');
                $pdf->Cell(30, 6, $qty, 'L', 0, 'R');
                $pdf->Cell(25, 6, $selling_price, 'L', 0, 'R');
                $pdf->Cell(30, 6, $rowtotal, 'L,R', 1, 'R');

            }

            $amount = $subtotal-$discount+$transportation_cost+$other_cost;

            $pdf->SetFont('Times','B',12);
            $pdf->Cell(135, 6, 'Amount In Words : ', 'T', 0, 'L');
            $pdf->Cell(25, 6, 'Sub Total', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $subtotal, 2, '.', ''), 1, 1, 'R');
            $pdf->cal($amount);
            $pdf->Cell(25, 6, 'Transport', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $transportation_cost, 2, '.', ''), 1, 1, 'R');
            $pdf->Cell(135, 6, '', 0, 0, 'L');
            $pdf->Cell(25, 6, 'Other', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $other_cost, 2, '.', ''), 1, 1, 'R');
            $pdf->Cell(135, 6, '', 0, 0, 'L');
            $pdf->Cell(25, 6, 'Discount', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $discount, 2, '.', ''), 1, 1, 'R');
            $pdf->Cell(135, 6, '', 0, 0, 'L');
            $pdf->Cell(25, 6, 'Amount', 1, 0, 'L');
            $pdf->Cell(30, 6, number_format((float) $amount, 2, '.', ''), 1, 1, 'R');

            $pdf->Output($challan_no.".pdf", "D");
        }
        else
        {

        }
    
        
    }
    else
    {
        echo "Something Went Wrong";
    }

    
    //echo $challan_id;
    /*SELECT * FROM challandetails join stockdetails,systable,productmst, subcategories, brandnames WHERE challandetails.StockId = stockdetails.StockId  and stockdetails.SysId = systable.SysId and systable.ProductId=productmst.ProductID and productmst.ProductSubCategoryID = subcategories.subcategory_id and challandetails.RecStatus = true and productmst.BrandId = brandnames.BrandId and   challandetails.ChallanId = 69*/
    
?>