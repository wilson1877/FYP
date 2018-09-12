<?php
include "config.php";

$creditAmt = mysqli_real_escape_string($con,$_POST['creditAmt']);
$notes = mysqli_real_escape_string($con,$_POST['notes']);
$inputtedID = mysqli_real_escape_string($con,$_POST['inputtedID']);

$currentDate = date("Y/m/d");

$sql_query = "INSERT INTO creditdebit(credit, date, notes, customerID) VALUES ('$creditAmt','$currentDate', '$notes', '$inputtedID')";
$con -> query($sql_query);
echo 1;
?>