<?php
include "config.php";

$invoices = "0"; //0 will never be an invoiceID, so it's safe
foreach ($_REQUEST["invoice"] as $order => $invoiceID) {
    $invoices .= ",$invoiceID";
}
$sqlDelivered = "UPDATE invoice SET delivered = 1 WHERE invoiceID IN($invoices)";
mysqli_query($con, $sqlDelivered);
header("location:delivery.php");
?>