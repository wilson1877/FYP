<?php
session_start();
if(isset($_SESSION["userID"]) && !empty($_SESSION["userID"])) {
    $userid=$_SESSION['userID'];
    $usernamedisplay=$_SESSION['username'];
    $firstName=$_SESSION['firstName'];
    $isDriver = $_SESSION['isDriver'];
    $firstname = $_SESSION['firstName'];
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = new mysqli($servername, $username, $password, $dbname);
?>