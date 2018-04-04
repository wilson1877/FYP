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
        $this->SetY(-15);
        $this->SetFont('helvetica', 'N', 6);
        $this->Cell(0, 
		5, 
		'THANK YOU!', 
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
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('iBuzz');
$pdf->SetTitle('Invoice Print');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('invoice');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' - Invoice', PDF_HEADER_STRING);

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

$titlevar = $resultArray["companyName"] . "- Invoice #" . $inputtedID;
$pdf->Write(0, $titlevar, '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 12);

// -----------------------------------------------------------------------------
$var = "test";

$tbl = <<<EOD
<p><b>{$resultArray["address"]}</b></p>
<p><b>Invoice Date:  </b> {$resultArray["date"]}</p>
<hr>
<p><b>Contact Person:  </b> {$resultArray["customerName"]}</p>
<p><b>Tel:</b> {$resultArray["contactNumber"]}</p>
<p><b>Purchase Order No:  </b> {$resultArray["purchaseOrderNo"]}</p>
<p><b>Delivery Order No:  </b> -</p>
<hr>
<table border="1" cellpadding="2"  nobr="true">
    <tr style="width:100%"> 
        <th width="10%"><b>No.</b></th>
		<th bgcolor="#d9d9d9" width="55%"><b>Item Description</b></th>
		<th width="15%"><b>Unit Price</b></th>
		<th bgcolor="#d9d9d9" width="10%"><b>Qty.</b></th>
		<th bgcolor="#d9d9d9" width="10%"><b>Amount</b></th>
	</tr>
    <tr>
    	<td width="10%">1</td>
		<td bgcolor="#d9d9d9" width="55%">Test</td>
		<td width="15%">Test</td>
		<td bgcolor="#d9d9d9" width="10%">Test</td>
		<td bgcolor="#d9d9d9" width="10%">Test</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');
}
//============================================================+
// END OF FILE
//============================================================+
?>