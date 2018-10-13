<?php
session_start();
session_destroy();
header('Location: schedule.php');
exit;