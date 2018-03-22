<?php
  session_start();
	if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
		$userid=$_SESSION['userID'];
		$usernamedisplay=$_SESSION['username'];
		$firstName=$_SESSION['firstName'];
		$isDriver = $_SESSION['isDriver'];
		$firstname = $_SESSION['firstName'];
		$inputtedID = $_REQUEST['selectedID'];
}

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";

  // Create connection
  $con = new mysqli($servername, $username, $password, $dbname);
  
  $sql = "DELETE FROM invoiceitemlist WHERE invoiceID = '$inputtedID'";
  $con -> query($sql);

  $sql2 = "DELETE FROM invoice WHERE invoiceID = '$inputtedID'";
  $con -> query($sql2);
  
  if (mysqli_affected_rows($con) > 0) {
		echo
		"<script>
        alert('Data successfully removed!');
		location.href='invoice.php';
		</script>";
	}
	else {
		echo
		"<script>
        alert('Something went boom-');
		location.href='invoice.php';
		</script>";
	}
  
  mysqli_close($con);
?>
