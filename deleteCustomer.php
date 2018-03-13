<?php
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";

  // Create connection
  $con = new mysqli($servername, $username, $password, $dbname);

  if (isset($_POST['submit'])) {
    $customerID = $_POST['customerID'];
    $sql = "DELETE FROM customer WHERE customerID = '$customerID'";
    header('location: viewCustomerData.php');
  }

  mysqli_close($con);
?>
