<?php
require_once 'config/app.php';
session_destroy();
header('Location: index.php');
exit;
?>
