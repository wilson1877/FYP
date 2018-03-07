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

      if ($_SESSION['isDriver'] == 1){
        header("location:driver.php");
      }
      else {
        header("location:dashboard.html");
      }

    }
    else{
      echo "Invalid username or password.";
      /*$errorMsg = "Invalid username or password.";*/
    }

  }

  mysqli_close($con);
?>
