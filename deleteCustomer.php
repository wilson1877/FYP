<?php
  session_start();
	if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
		$userid=$_SESSION['userID'];
		$usernamedisplay=$_SESSION['username'];
		$firstName=$_SESSION['firstName'];
		$isDriver = $_SESSION['isDriver'];
		$firstname = $_SESSION['firstName'];
		$inputtedID = $_SESSION['INPUTTEDID'];
}

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";

  // Create connection
  $con = new mysqli($servername, $username, $password, $dbname);
  
  $sql = "DELETE FROM customer WHERE customerID = '$inputtedID'";
  $con -> query($sql);
  header('location: viewCustomerData.php');

  mysqli_close($con);
?>
