<?php
  session_start();

  include "config.php";

  $file = 'userlog.log';
  // The new person to add to the file
  date_default_timezone_set("Asia/Kuala_Lumpur");
  $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully logout.";
  // Write the contents to the file,
  // using the FILE_APPEND flag to append the content to the end of the file
  // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
  file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
  session_destroy();
  header("location: sign-in.html");
 ?>
