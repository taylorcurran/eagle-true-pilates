<?php
session_start();

require_once "Dao.php";
$dao = new Dao();

$user_id = $_POST['user_id'];

$group_id = $dao->getGroupAdminId();
$dao->saveUserGroup($user_id, $group_id[0]);

header('Location: schedule.php');
exit;