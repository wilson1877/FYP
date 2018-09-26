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
  
  $sql = "DELETE FROM creditdebit WHERE ID = '$inputtedID'";
  $con -> query($sql);

  
  if (mysqli_affected_rows($con) > 0) {
		echo
		"<script>
		location.href='creditdebit.php';
		</script>";
	}
	else {
		echo
		"<script>
        alert('Something went boom-');
		location.href='creditdebit.php';
		</script>";
	}
  
  mysqli_close($con);
?>
