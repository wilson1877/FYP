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
      $file = 'userlog.log';
      // The new person to add to the file
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully delete customer ". $customerName . ".";
      // Write the contents to the file,
      // using the FILE_APPEND flag to append the content to the end of the file
      // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
      file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

    echo
    "<script>
        alert('Successfully delete customer');
        location.href='customerData.php';
    </script>";
    exit();
  }
  else {
      $file = 'userlog.log';
      // The new person to add to the file
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " fail to delete customer " . $customerName . ".";
      // Write the contents to the file,
      // using the FILE_APPEND flag to append the content to the end of the file
      // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
      file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

    echo
    "<script>
        alert('Delete unsuccessful as the customer have invoice record');
        location.href='customerData.php';
    </script>";
    exit();
  }

  mysqli_close($con);
?>
