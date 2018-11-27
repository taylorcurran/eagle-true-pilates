<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

  $email = $_POST['email'];
  $password = $_POST['password'];

  $_SESSION['presets']['email'] = $email;

  $presets = array();
  $user = $dao->getUser($email)[0];

  if ($user == null || !password_verify($password, $user['password'])) {
      $_SESSION['logged_in'] = 'false';
      $_SESSION['login_message'] = "*Email or password invalid";
      header('Location: login.php');
      exit;
  }

  //Everything was validated
$_SESSION['logged_in'] = 'true';
header('Location: schedule.php');
exit;
