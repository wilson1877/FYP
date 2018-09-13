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

  $sql = "DELETE FROM customer WHERE customerID = '$inputtedID'";
  $con -> query($sql);

  if (mysqli_affected_rows($con) > 0) {
    echo
    "<script>
        alert('Successfully delete customer');
        location.href='customerData.php';
    </script>";
    exit();
  }
  else {
    echo
    "<script>
        alert('Delete unsuccessful as the customer have invoice record');
        location.href='customerData.php';
    </script>";
    exit();
  }

  mysqli_close($con);
?>
