<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$instructor_id = $_POST['instructor_id'];
$class_name = $_POST['class_name'];
$date = $_POST['date'];
$time = $_POST['start_time'];
$length = $_POST['length'];
$max_occupancy = $_POST['max_occupancy'];

$_SESSION['presets']['class_name'] = $class_name;
$_SESSION['presets']['date'] = $date;
$_SESSION['presets']['time'] = $time;
$_SESSION['presets']['length'] = $length;
$_SESSION['presets']['max_occupancy'] = $max_occupancy;


$schedule_message = array();
$presets = array();
$bad_input = false;

if (empty($class_name)) {
    $_SESSION['schedule_message'][] = "*Class name is required.";
    $bad_input = true;
}

if (empty($date)) {
    $_SESSION['schedule_message'][] = "*Date is required.";
    $bad_input = true;
}

if (empty($time)) {
    $_SESSION['schedule_message'][] = "*Start time is required.";
    $bad_input = true;
}

if (empty($length)) {
    $_SESSION['schedule_message'][] = "*Length is required.";
    $bad_input = true;
}

if ($bad_input) {
    header('Location: schedule.php');
    exit;
}

//Everything was validated
$_SESSION['validated'] = 'validated';
$_SESSION['schedule_message'][] = "Your message was successfully sent!";

$combined_date_and_time = $date . ' ' . $time;
$start_time = strtotime($combined_date_and_time);
$end_time = date_add($start_time, date_interval_create_from_date_string($length));

$dao->saveClass($instructor_id, $class_name, $start_time, $end_time, $max_occupancy);


header('Location: schedule.php');
exit;