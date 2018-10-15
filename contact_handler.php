<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$country = $_POST['country'];
$message = $_POST['message'];

$_SESSION['presets']['first_name'] = $first_name;
$_SESSION['presets']['last_name'] = $last_name;
$_SESSION['presets']['country'] = $country;

$contact_message = array();
$presets = array();
$bad_input = false;

if (empty($first_name)) {
    $_SESSION['contact_message'][] = "*First name is required.";
    $bad_input = true;
}

if (empty($last_name)) {
    $_SESSION['contact_message'][] = "*Last name is required.";
    $bad_input = true;
}

if (empty($message)) {
    $_SESSION['contact_message'][] = "*Message is required.";
    $bad_input = true;
}

if ($bad_input) {
    header('Location: contact.php');
    exit;
}

//Everything was validated
$_SESSION['validated'] = 'validated';
$_SESSION['contact_message'][] = "Your message was successfully sent!";
unset($_SESSION['presets']);

$dao->saveMessage($first_name, $last_name, $country, $message);

header('Location: contact.php');
exit;
