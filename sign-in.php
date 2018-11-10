<?php
  session_start();

  $errorMsg = "";
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";
  $con = new mysqli($servername, $username, $password, $dbname);

  if (isset($_POST['submit'])){
    $loginUsername = $_POST['emailAddress'];
    $loginPass = $_POST['password'];
    $sql = "SELECT * FROM User where emailAddress = '$loginUsername' AND password = '$loginPass'";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows == 1){

      $row = mysqli_fetch_assoc($result);
      $_SESSION['userID'] = $row['userID'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['fullname'] = $row['firstName']." ".$row['lastName'];
      $_SESSION['emailAddress'] = $row['emailAddress'];
      $_SESSION['contactNumber'] = $row['contactNumber'];
      $_SESSION['isDriver'] = $row['isDriver'];
      $_SESSION['is_login'] = 1;
      $_SESSION['firstName'] = $row['firstName'];

      $file = 'userlog.log';
      // The new person to add to the file
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully login.";
      // Write the contents to the file,
      // using the FILE_APPEND flag to append the content to the end of the file
      // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
      file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

      if ($_SESSION['isDriver'] == 1){
        header("location:driver.php");
      }
      else {
        header("location:dashboard.php");
      }

    }
    else{
        $file = 'userlog.log';
        // The new person to add to the file
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $log = "\n" . date("d-m-Y h:i:sa") . " - Anonymous user fail to login.";
        // Write the contents to the file,
        // using the FILE_APPEND flag to append the content to the end of the file
        // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
        file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

      echo
      "<script>
          alert('Invalid username or password');
          location.href='sign-in.html';
      </script>";
      exit();
    }

  }

  mysqli_close($con);
?>
