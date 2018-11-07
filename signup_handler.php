<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$verifyPassword = $_POST['verifyPassword'];

$_SESSION['presets']['first_name'] = $first_name;
$_SESSION['presets']['last_name'] = $last_name;
$_SESSION['presets']['email'] = $email;
$_SESSION['presets']['password'] = $password;
$_SESSION['presets']["verifyPassword"] = $verifyPassword;

$signup_message = array();
$presets = array();
$bad_input = false;

if (empty($first_name)) {
    $_SESSION['signup_message']['first_name'][] = "*First name is required.";
    $bad_input = true;
} elseif (!ctype_alpha($first_name)) {
    $_SESSION['signup_message']['first_name'][] = "*First name can only contain letters.";
    $bad_input = true;
}

if (empty($last_name)) {
    $_SESSION['signup_message']['last_name'][] = "*Last name is required.";
    $bad_input = true;
} elseif (!ctype_alpha($last_name)) {
    $_SESSION['signup_message']['last_name'][] = "*Last name can only contain letters.";
    $bad_input = true;
}

if (empty($email)) {
    $_SESSION['signup_message']['email'][] = "*Email is required.";
    $bad_input = true;
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) != $email) {
    $_SESSION['signup_message']['email'][] = "*Email is not valid.";
    $bad_input = true;
} else {
    $user = $dao->getUser($email);
    if (!is_null($user[0])) {
        $_SESSION['signup_message']['email'][] = "*Email is not valid.";
        $bad_input = true;
    }
}

if (empty($password)) {
    $_SESSION['signup_message']['password'][] = "*Password is required.";
    $bad_input = true;
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)
    || !preg_match('/[0-9]/', $password)) {
    $_SESSION['signup_message']['password'][] = "*Password must contain a number, upper and lower case letter.";
    $bad_input = true;
}

if (empty($verifyPassword)) {
    $_SESSION['signup_message']['verifyPassword'][] = "*Password must be verified.";
    $bad_input = true;
} elseif ($password != $verifyPassword) {
    $_SESSION['signup_message']['verifyPassword'][] = "*Passwords must match.";
    $bad_input = true;
}

if ($bad_input) {
    header('Location: login.php');
    $_SESSION['logged_in'] = 'false';
    exit;
}

//Everything was validated
$_SESSION['logged_in'] = 'true';

$dao->saveUser($first_name, $last_name, $email, $password);

$user_id = $dao->getUserId($email);
$group_id = $dao->getGroupMemberId();
$dao->saveUserGroup($user_id[0], $group_id[0]);

header('Location: schedule.php');
exit;
