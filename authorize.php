<?php
include_once "loggedin.php";
session_start();
if(!isset($_SESSION['email'])){
          echo "Please login.";
          header("Location: signon.php");
  }
?>