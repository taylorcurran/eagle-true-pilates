<?php

$id = $_GET['id'];
require_once 'Dao.php';

$dao = new Dao();
$dao->deleteMessage($id);

header('Location: schedule.php');
exit;