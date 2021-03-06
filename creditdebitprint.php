<?php
// FYP Declaration Stuff
include "config.php";

$sql = "SELECT a.*, b.* FROM creditdebit a, customer b";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0){
$resultArray = mysqli_fetch_assoc($result);


// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf_include.php');

class MYPDF extends TCPDF {
    public function Footer() {
        $this->SetY(0);
    }
}
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('iBuzz');
$pdf->SetAuthor('iBuzz');
$pdf->SetTitle('Debt Record Print');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('invoice');

// set default header data
$pdf->SetHeaderData('logo.png', 40, 'Debt Record - IBuzz system', "No 2754, 2nd floor, Jalan Chain Ferry Taman Inderawasih\nTEL/FAX: 03-5422 1231 || HP: 017-2123 5963\nE-Mail: iBuzzServices@gmail.com");

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

$titlevar = 'Debtor List Overview';
$pdf->Write(0, $titlevar, '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 12);

//$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
$pdf->SetFillColor(255, 235, 235);
// -----------------------------------------------------------------------------

$printableItemsTable = createItemsTableFromDatabase($con);

$tbl = <<<EOD
<table border="1" cellpadding="2"  nobr="true">
$printableItemsTable
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('invoiceprint.php', 'I');
}
//============================================================+
// END OF FILE
//============================================================+

function createItemsTableFromDatabase($connection){
	$returnedTable = "";
	$oldCustomerID = "";
	
	$itemsRows = "\n";
	
	$sqlInvoiceItemsList = "SELECT * FROM creditdebit ORDER BY customerID DESC";
	$result = mysqli_query($connection, $sqlInvoiceItemsList);

	$rownum = 1;

	$returnedTable .= createItemTableHeader();

	$currentBalance = 0;

	while ($row = mysqli_fetch_assoc($result)){
		if ($oldCustomerID != $row["customerID"]){ //If the ID is different, run function
			$oldCustomerID = $row["customerID"]; //Puts the existing Customer ID in
		
			//Calculating Total Balance
			$grandtotal = 0.00;
			$cusID = $row["customerID"];
			$sql2 = "SELECT debit, credit FROM creditdebit WHERE customerID = '$cusID'";
			$result2 = mysqli_query($connection, $sql2);
			if ($result2->num_rows > 0) {
				while ($row2 = mysqli_fetch_assoc($result2)){
					if ($row2["debit"] > 0){
					$grandtotal += $row2["debit"];
					//$grandtotal += 0.01;
					}else{
						$grandtotal -= $row2["credit"];
					}
				}
			}
			
			//Retrieving Customer Details
			$sql3 = "SELECT customerName, companyName, contactNumber FROM customer WHERE customerID = '$cusID'";
			$result3 = mysqli_query($connection, $sql3);
			if ($result3->num_rows > 0) {
				while ($row3 = mysqli_fetch_assoc($result3)){
					$customerName = $row3["customerName"];
					$companyName = $row3["companyName"];
					$contactNumber = $row3["contactNumber"];
				}
			}
			
			$returnedTable .= createItemRowsFromDatabaseRow($rownum, $row, $customerName, $companyName, $contactNumber, $grandtotal);
			$rownum += 1;
		}
    }

	while ($rownum <= 30){
		$returnedTable .= createEmptyRows($rownum, $row);
		$rownum += 1;
	}
	//$returnedTable .= createItemTableGrandTotal($grandTotal);

	return $returnedTable;
}

function createItemTableHeader() {
	return <<<EOD
	<tr style="width:100%">
	<th align="center" bgcolor="#d9d9d9" width="10%"><b>No.</b></th>
	<th align="center" bgcolor="#d9d9d9" width="20%"><b>Customer Name</b></th>
	<th align="center" bgcolor="#d9d9d9" width="20%"><b>Company Name</b></th>
	<th align="center" bgcolor="#d9d9d9" width="20%"><b>Contact No.</b></th>
	<th align="center" bgcolor="#d9d9d9" width="30%"><b>Balance ($)</b></th>
	</tr>
EOD;
}

function createItemRowsFromDatabaseRow($rowNumber, $row, $customerName, $companyName, $contactNumber, $grandtotal){
	

	$grandtotal2 = number_format ((float)$grandtotal, 2, '.', '');

	return <<<EOD
	<tr style="width:100%">
		<th align="center" width="10%">{$rowNumber}</th>
		<th align="center" width="20%">{$customerName}</th>
		<th align="center" width="20%">{$companyName}</th>
		<th align="center" width="20%">{$contactNumber}</th>
		<th align="center" width="30%">{$grandtotal2}</th>
	</tr>
EOD;
}

function createEmptyRows($rowNumber, $row){
	return <<<EOD
	<tr style="width:100%">
		<th align="center" width="10%"></th>
		<th align="center" width="20%"></th>
		<th align="center" width="20%">	</th>
		<th align="center" width="20%"></th>
		<th align="center" width="30%"></th>
	</tr>
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
