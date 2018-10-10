<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['presets']['first_name'] = $first_name;
$_SESSION['presets']['last_name'] = $last_name;
$_SESSION['presets']['email'] = $email;
$_SESSION['presets']['password'] = $password;

$signup_message = array();
$presets = array();
$bad_input = false;

if (empty($first_name)) {
    $_SESSION['signup_message'][] = "*First name is required.";
    $bad_input = true;
}

if (empty($last_name)) {
    $_SESSION['signup_message'][] = "*Last name is required.";
    $bad_input = true;
}

if (empty($email)) {
    $_SESSION['signup_message'][] = "*Email is required.";
    $bad_input = true;
}

if (empty($password)) {
    $_SESSION['signup_message'][] = "*Password is required.";
    $bad_input = true;
}

if ($bad_input) {
    header('Location: login.php');
    $_SESSION['validated'] = 'bad';
    exit;
}

//Everything was validated
$_SESSION['validated'] = 'good';

unset($_SESSION['presets']);

$dao->saveUser($first_name, $last_name, $email, $password);

header('Location: schedule.php');
exit;
