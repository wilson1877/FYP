<?php
include "config.php";

  $days = $_POST['days'];
  $sql = "UPDATE settings SET predictionsetting = '$days' WHERE invoiceID = '1'";
  $con -> query($sql);

  mysqli_close($con);
?>
