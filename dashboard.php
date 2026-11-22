<?php
require_once 'config/app.php';
require_login();
$role=user()['role'];
if($role==='admin')redirect('admin/dashboard.php');
if($role==='donor')redirect('donor/dashboard.php');
redirect('recipient/dashboard.php');
?>
