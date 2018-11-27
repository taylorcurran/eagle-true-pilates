<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$instructor_id = $_POST['instructor_id'];
$class_name = $_POST['class_name'];
$date = $_POST['date'];
$time = $_POST['time'];
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
} elseif ($date < date("m/d/Y")) {
    $_SESSION['schedule_message'][] = "*Date must be on or after today.";
    $bad_input = true;
}

if (empty($time)) {
    $_SESSION['schedule_message'][] = "*Start time is required.";
    $bad_input = true;
} elseif ($time < "06:00 am" || $time > "9:00 pm") {
    $_SESSION['schedule_message'][] = "*Start time must be during business hours between 6:00 am and 9:00 pm.";
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
$_SESSION['schedule_message'][] = "Your class was successfully scheduled!";

$combined_date_and_time = $date . ' ' . $time;
$start_time = date('Y-m-d H:i:s', strtotime($combined_date_and_time));

if ($length == "60 mins") {
    $end_time = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($start_time)));
} elseif ($length == "40 mins") {
    $end_time = date('Y-m-d H:i:s',strtotime('+40 minutes',strtotime($start_time)));
} else {
    $end_time = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($start_time)));
}

if($max_occupancy == NULL) {
    $max_occupancy = 20;
}

$dao->saveClass($instructor_id, $class_name, $start_time, $end_time, $max_occupancy);

unset($presets);

header('Location: schedule.php');
exit;