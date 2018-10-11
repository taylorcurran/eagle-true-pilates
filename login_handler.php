<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

  $email = $_POST['email'];
  $password = $_POST['password'];

  $_SESSION['email'] = $email;

  $email = array();

  if (empty($dao->getUser($email))) {
      $_SESSION['logged_in'] = false;
      $_SESSION['login_message'] = "*Email or password invalid";
      header('Location: login.php');
      exit;
  }
  //Everything was validated
$_SESSION['logged_in'] = true;
header('Location:http://localhost:63342/PhpstormProjects/eagle-true-pilates/schedule.php');
exit;
