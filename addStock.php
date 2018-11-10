<?php
  //Connect to Database
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fyp";
  $con = new mysqli($servername, $username, $password, $dbname);

  // $stockID = $_SESSION['stockID'];
  //$folderName = array('', 'stockUpload');

  $target_dir = "images/stockUpload/";
  $target_file = $target_dir . basename($_FILES["stockImage"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  if (isset($_POST['submit'])){
    $check = getimagesize($_FILES["stockImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["stockImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
&& $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["stockImage"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["stockImage"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $stockName = $_POST['stockName'];
    $price = $_POST['price'];
    $totalStock = $_POST['totalStock'];
    $image = $target_file;

    if ($uploadOk){
      $sql2 = "INSERT INTO Stock (stockID, stockImage, stockName, price, totalStock) VALUES('0000', '$image', '$stockName', '$price', '$totalStock')";
      if (mysqli_query($con, $sql2)){
          $file = 'userlog.log';
          // The new person to add to the file
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " successfully added stock " . $stockName . ".";
          // Write the contents to the file,
          // using the FILE_APPEND flag to append the content to the end of the file
          // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
          file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

        header("location: inventory.php");
      } else {
          $file = 'userlog.log';
          // The new person to add to the file
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " fail to add stock " . $stockName . ".";
          // Write the contents to the file,
          // using the FILE_APPEND flag to append the content to the end of the file
          // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
          file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

        echo "Cannot perform query";
      }
    }
  } else {
      $file = 'userlog.log';
      // The new person to add to the file
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $log = "\n" . date("d-m-Y h:i:sa") . " - User " . $_SESSION['username'] . " fail to add stock " . $stockName . ".";
      // Write the contents to the file,
      // using the FILE_APPEND flag to append the content to the end of the file
      // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
      file_put_contents($file, $log, FILE_APPEND | LOCK_EX);

    echo "Fail";
  }

  mysqli_close($con);

?>
