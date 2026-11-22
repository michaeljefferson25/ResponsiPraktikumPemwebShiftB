<?php
$pageTitle = $pageTitle ?? 'FoodBridge';
 $role = user()['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#087f73">
<title>
<?= e($pageTitle)?>
 - FoodBridge</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL?>
/assets/css/style.css">
</head>
<body>
<header class="topbar">
<div class="topbar-inner">
<a class="brand" href="<?= BASE_URL?>
/index.php">
<span class="brand-mark">f<span>c</span>
</span>
<span>foodbridge<span class="brand-dot">.</span>
<small>SHARE MORE, WASTE LESS</small>
</span>
</a>
<nav class="main-nav">
<?php
if ($role):?>

<a href="<?= BASE_URL?>
/dashboard.php">Dashboard</a>
<?php
if ($role === 'admin'):?>
<a href="<?= BASE_URL?>
/admin/verification.php">Verifikasi</a>
<a href="<?= BASE_URL?>
/admin/requests.php">Permintaan</a>
<a href="<?= BASE_URL?>
/admin/distribution.php">Distribusi</a>
<a href="<?= BASE_URL?>
/admin/users.php">Pengguna</a>
<a href="<?= BASE_URL?>
/admin/reports.php">Laporan</a>
<?php
elseif ($role === 'donor'):?>
<a href="<?= BASE_URL?>
/donor/add_donation.php">Buat Donasi</a>
<a href="<?= BASE_URL?>
/donor/my_donations.php">Donasi Saya</a>
<?php
else:?>
<a href="<?= BASE_URL?>
/recipient/catalog.php">Cari Makanan</a>
<a href="<?= BASE_URL?>
/recipient/history.php">Riwayat</a>
<?php
endif;
?>

<span class="nav-user">
<?= e(user()['name'])?>
</span>
<a class="nav-cta" href="<?= BASE_URL?>
/logout.php">Keluar</a>
<?php
else:?>
<a href="<?= BASE_URL?>
/index.php#tentang">Tentang</a>
<a href="<?= BASE_URL?>
/index.php#cara-kerja">Cara Kerja</a>
<a href="<?= BASE_URL?>
/login.php">Masuk</a>
<a class="nav-cta" href="<?= BASE_URL?>
/register.php">Mulai Berbagi <span>↗</span>
</a>
<?php
endif;
?>

</nav>
<button class="menu-toggle" aria-label="Buka menu" onclick="document.querySelector('.main-nav').classList.toggle('open')">☰</button>
</div>
</header>
<main class="container">
<?php
show_flash();
?>

