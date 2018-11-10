<?php
include "config.php";

$creditAmt = mysqli_real_escape_string($con,$_POST['creditAmt']);
$notes = mysqli_real_escape_string($con,$_POST['notes']);
$inputtedID = mysqli_real_escape_string($con,$_POST['inputtedID']);

$currentDate = date("Y/m/d");

$sql_query = "INSERT INTO creditdebit(credit, date, notes, customerID) VALUES ('$creditAmt','$currentDate', '$notes', '$inputtedID')";
$con -> query($sql_query);
echo 1;

$file = 'userlog.log';
// The new person to add to the file
date_default_timezone_set("Asia/Kuala_Lumpur");
$log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully create debtor listing for customer " . $inputtedID . ".";
// Write the contents to the file,
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
?>
