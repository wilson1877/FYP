<?php

session_start();

 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "HELPFit";
 $con = new mysqli($servername, $username, $password, $dbname);

//if the submit button is clicked, run this
if(isset($_POST['submit'])){
  //declaring the variables
  $newpassword=$_POST['newpassword'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  if (isset($_POST['level'])){$level=$_POST['level'];}
  if (isset($_POST['specialty'])){$specialty=$_POST['specialty'];}
  $type=$_SESSION['user']['type'];
  $oldemail = $_SESSION['user']['email'];
  $username = $_SESSION['user']['username'];
  if (empty($newpassword)){$newpassword = $_SESSION['user']['password'];}

//if the type is a member, update the user tables and display the new details in the text box
  if($type == "member"){
   $sql1 = "UPDATE  user SET fullname = '$fullname', password = '$newpassword',email = '$email'
          WHERE email = '$oldemail'";
           mysqli_query($con, $sql1);
           $sql2 = "UPDATE  member SET level='$level' WHERE username='$username'";
           mysqli_query($con, $sql2);
           unset($_SESSION['user']);
           unset($_SESSION['member']);
           $query2 = "SELECT * FROM user WHERE email='$email'";
           $res2=mysqli_query($con,$query2);
           $row2=mysqli_fetch_assoc($res2);
           $_SESSION['user'] = $row2;

           $query2 = "SELECT * FROM member WHERE username='$username'";
           $res2=mysqli_query($con,$query2);
           $row2=mysqli_fetch_assoc($res2);
           $_SESSION['member'] = $row2;
           header("location:settings.php");
         }
    //if the type is a trainer, update the user tables and display the new details in the text box
    if($type == "trainer"){
          $sql3 = "UPDATE  user SET fullname = '$fullname', password = '$newpassword',email = '$email'
                WHERE email = '$oldemail'";
                $sql4 = "UPDATE trainer SET specialty='$specialty' WHERE username='$username'";
                mysqli_query($con, $sql3);
                mysqli_query($con, $sql4);

                //unset the session so the most recent data can be displayed
                unset($_SESSION['trainer']);
                unset($_SESSION['user']);
                $query2 = "SELECT * FROM user WHERE email='$email'";
             	  $res2=mysqli_query($con,$query2);
                $row2=mysqli_fetch_assoc($res2);
                $_SESSION['user'] = $row2;

                $query2 = "SELECT * FROM trainer WHERE username='$username'";
            	  $res2=mysqli_query($con,$query2);
                $row2=mysqli_fetch_assoc($res2);
                $_SESSION['trainer'] = $row2;
                header("location:settings2.php");
       }
     }

 mysqli_close($con);
?>
