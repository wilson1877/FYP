<?php
  session_start();
  //$erremail = $errpass = $errmobileNo = "";
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";
  $con = new mysqli($servername, $username, $password, $dbname);
  // SQL Query to check for email
  $sql = "SELECT * FROM User";
  $result = mysqli_query($con, $sql);
  // Initialising variables
  $passed = true;

  if (isset($_POST['submit'])){
    $email = $_POST['emailAddress'];
    $mobileNo = $_POST['contactNumber'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];

    if ($_POST['isDriver'] == "employee") {
      $isDriver = 0;
    }
    else {
      $isDriver = 1;
    }

    /*$test = $mobileNo;

    if (!$result){
      if ($pass != $cpass && $pass < 8){
        $errpass = "*Passwords don't match and is below 8 characters.";
        $passed = false;
      }
      else if ($pass != $cpass){
        $errpass = "*Passwords do not match!";
        $passed = false;
      }
      else if ($pass < 8){
        $errpass = "*Password do not meet minimum 8 characters.";
        $passed = false;
      }
      if (!preg_match("/\d{3}-\d{7}/", $mobileNo)){
        $errmobileNo = "*Mobile number must have 000-0000000 pattern.";
        $passed = false;
      }
    }
    else{
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['email'] == $email){
            $erremail = "*Email address has been taken by someone else.";
            $passed = false;
          }
        }
      }
      if ($pass != $cpass && strlen($pass) < 8){
        $errpass = "*Passwords don't match and is below 8 characters.";
        $passed = false;
      }
      else if ($pass != $cpass){
        $errpass = "*Passwords do not match!";
        $passed = false;
      }
      else if (strlen($pass) < 8){
        $errpass = "*Password do not meet minimum 8 characters.";
        $passed = false;
      }
      if (!preg_match("/\d{3}-\d{7}/", $mobileNo)){
        $errmobileNo = "*Mobile number must have 000-0000000 pattern.";
        $passed = false;
      }
    }*/

    if ($passed){
      $sql2 = "INSERT INTO User (userID, emailAddress, contactNumber, username, password, firstName, lastName, isDriver) VALUES('0000', '$email', '$mobileNo', '$username', '$pass', '$fname', '$lname', '$isDriver')";
      if (mysqli_query($con, $sql2)){
        header("location: sign-in.html");
      } else {
        echo "Cannot perform query";
      }
    }
  } else {
    echo "Fail";
  }

  mysqli_close($con);
?>
