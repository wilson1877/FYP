<?php
// FYP Declaration Stuff
session_start();
if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
    $userid=$_SESSION['userID'];
    $usernamedisplay=$_SESSION['username'];
    $firstName=$_SESSION['firstName'];
    $isDriver = $_SESSION['isDriver'];
    $firstname = $_SESSION['firstName'];
    $inputtedID = $_SESSION['inputtedID'];
}

//Getting data now
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = new mysqli($servername, $username, $password, $dbname);
				
$sql = "SELECT a.*, b.* FROM invoice a, customer b WHERE a.invoiceID = '$inputtedID' AND a.customerID = b.customerID";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0){
$resultArray = mysqli_fetch_assoc($result);
 
 
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class MYPDF extends TCPDF {
    public function Footer() {
        $this->SetY(-25);
        $this->SetFont('brushscript', 'N', 36);
        $this->Cell(0, 
		5, 
		'Thank you!', 
		0, 
		false, 
		'C', 
		0, 
		'', 
		0, 
		false, 
		'T', 
		'M');
		//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
		//http://www.fpdf.org/en/doc/cell.htm
    }
}
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('iBuzz');
$pdf->SetAuthor('iBuzz');
$pdf->SetTitle('Invoice Print');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('invoice');

// set default header data
$pdf->SetHeaderData('logo.png', 40, 'Invoice - IBuzz system', "No 2754, 2nd floor, Jalan Chain Ferry Taman Inderawasih");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$titlevar = $resultArray["companyName"];
$pdf->Write(0, $titlevar, '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 12);

$invoiceTitle = "<p>".$resultArray["companyName"]."</p>". createRightInvoiceTable($resultArray);
//$pdf->writeHTML(0, $invoiceTitle, true, false, false, false, '');
$txt = "<p>".nl2br($resultArray["address"])."</p><p><b>Contact:  </b>".$resultArray["customerName"]."<br /><b>Tel:  </b>".$resultArray["contactNumber"]."<br /><b>Fax:  </b>".$resultArray["faxNumber"]."<br /></p>";
$pdf->writeHTML($txt, true, false, false, false, '');
//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
$pdf->SetFillColor(255, 235, 235);

// Fit text on cell by reducing font size
//MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$txt = createRightInvoiceTable($resultArray);
$pdf->MultiCell(55, 1, $txt, 1, '', 0, 0, 140, 35, true, 0, true, true, 10, 'M', true);
//LN are empty lines in the PDF
$pdf->Ln(40);
// -----------------------------------------------------------------------------

$printableItemsTable = createItemsTableFromDatabase($con, $inputtedID);

$tbl = <<<EOD
<hr>
<table border="1" cellpadding="2"  nobr="true">
$printableItemsTable
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$txt = createPaymentMethod();
$pdf->MultiCell(55, 1, $txt, 0, '', 0, 0, 140, 225, true, 0, true, true, 10, 'M', true);

$txt = createSignatureField();
$pdf->MultiCell(55, 1, $txt, 0, '', 0, 0, 10, 225, true, 0, true, true, 10, 'M', true);

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('invoiceprint.php', 'I');
}
//============================================================+
// END OF FILE
//============================================================+

function createItemsTableFromDatabase($connection, $invoiceID){
	$returnedTable = "";
	
	$itemsRows = "\n";
	$grandTotal = 0;
	$sqlInvoiceItemsList = "SELECT iit.*, stockName, price FROM invoiceitemlist iit INNER JOIN stock ON iit.stockID=stock.stockID WHERE invoiceID = '$invoiceID'";
	$result = mysqli_query($connection, $sqlInvoiceItemsList);

	$rownum = 1;

	$returnedTable .= createItemTableHeader();

	while ($row = mysqli_fetch_assoc($result)){
		$returnedTable .= createItemRowsFromDatabaseRow($rownum, $row);
		$rownum += 1;
		$grandTotal += $row["price"] * $row["itemQty"];
	}
	
	while ($rownum <= 17){
		$returnedTable .= createEmptyRows($rownum, $row);
		$rownum += 1;
	}
	$returnedTable .= createItemTableGrandTotal($grandTotal);

	return $returnedTable;
}

function createItemTableHeader() {
	return <<<EOD
	<tr style="width:100%"> 
	<th width="10%"><b>No.</b></th>
	<th bgcolor="#d9d9d9" width="55%"><b>Item Description</b></th>
	<th width="15%"><b>Unit Price</b></th>
	<th bgcolor="#d9d9d9" width="10%"><b>Qty.</b></th>
	<th bgcolor="#d9d9d9" width="10%"><b>Amount</b></th>
	</tr>
EOD;
}

function createItemRowsFromDatabaseRow($rowNumber, $row){
	$amount = $row["price"] * $row["itemQty"];
	$amountDecimal = number_format($amount,2);
	return <<<EOD
	    <tr>
		<td width="10%">$rowNumber</td>
		<td bgcolor="#d9d9d9" width="55%">{$row["stockName"]}</td>
		<td width="15%">{$row["price"]}</td>
		<td bgcolor="#d9d9d9" width="10%">{$row["itemQty"]}</td>
		<td bgcolor="#d9d9d9" width="10%">{$amountDecimal}</td>
	</tr>
EOD;
}

function createEmptyRows($rowNumber, $row){
	return <<<EOD
	    <tr>
		<td width="10%"></td>
		<td bgcolor="#d9d9d9" width="55%"></td>
		<td width="15%"></td>
		<td bgcolor="#d9d9d9" width="10%"></td>
		<td bgcolor="#d9d9d9" width="10%"></td>
	</tr>
EOD;
}

function createItemTableGrandTotal($grandTotal) {
	$numberFormatTotal = number_format($grandTotal,2);
	$convertedNum = convert_number_to_words($grandTotal);
	$grandTotalText = strtoupper($convertedNum);
	
	return <<<EOD
	<tr>
	<td width="100%" align="right"><span style="font-size:23px;"> Grand Total: {$numberFormatTotal}</span><br />{$grandTotalText} ONLY</td>
	</tr>
EOD;
}


function createRightInvoiceTable($resultArray){
	return <<<EOD
	<table>
	<tr border="1" bgcolor="#d9d9d9"><th colspan="2" align="center"><b>INVOICE</b></th></tr>
	<tr align="right"><td>Inv. Number:</td><td align="center">{$resultArray["invoiceID"]}</td></tr>
	<tr align="right"><td>Inv. Date:</td><td align="center">{$resultArray["date"]}</td></tr>
	<tr align="right"><td>P/O No:</td><td align="center">{$resultArray["purchaseOrderNo"]}</td></tr>
	<tr align="right"><td>D/O No:</td><td align="center">{$resultArray["invoiceID"]}</td></tr>
	<tr align="right"><td>Payment:</td><td align="center">30 Days</td></tr>
	</table>
EOD;
}

function createPaymentMethod(){
	return <<<EOD
	<table border="none" cellspacing="0" cellpadding="0">
	<tr align="center"><td>Kindly Issue a Cheque to:</td></tr>
	<tr align="center"><td><b>IBUZZ SERVICES</b></td></tr>
	<tr align="center"><td><b>HLBB, 1310442123</b></td></tr>
	</table>
EOD;
}

function createSignatureField(){
	return <<<EOD
	<table border="none" cellspacing="0" cellpadding="0">
	<tr align="center"><td>..................................</td></tr>
	<tr align="center"><td><b>IBUZZ SERVICES</b></td></tr>
	</table>
EOD;
}

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>
<html>
<style>
.textleft {
	float: left;
}
.textright {
	float: right;
}
</style>
</html>