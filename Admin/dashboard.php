<?php
require_once '../config/app.php';
require_role('admin');
$pageTitle='Dashboard Admin';
$stats=[];
foreach(["users"=>"SELECT COUNT(*) FROM users","donations"=>"SELECT COUNT(*) FROM food_donations","pending"=>"SELECT COUNT(*) FROM food_donations WHERE status='pending'","requests"=>"SELECT COUNT(*) FROM food_requests"] as $k=>$sql)$stats[$k]=$pdo->query($sql)->fetchColumn();
require '../includes/header.php';
?>
<div class="section-head">
<div>
<h1>Dashboard Admin</h1>
<p class="muted">Pantau aktivitas FoodBridge.</p>
</div>
</div>
<div class="grid">
<div class="card">Total pengguna<div class="stat">
<?=$stats['users']?>
</div>
</div>
<div class="card">Total donasi<div class="stat">
<?=$stats['donations']?>
</div>
</div>
<div class="card">Menunggu verifikasi<div class="stat">
<?=$stats['pending']?>
</div>
</div>
<div class="card">Total permintaan<div class="stat">
<?=$stats['requests']?>
</div>
</div>
</div>
<div class="section-head">
<h2>Menu pengelolaan</h2>
</div>
<div class="grid">
<a class="card link" href="verification.php">
<h3>Verifikasi donasi →</h3>
<p class="muted">Setujui atau tolak donasi.</p>
</a>
<a class="card link" href="requests.php">
<h3>Permintaan makanan →</h3>
<p class="muted">Kelola permintaan penerima.</p>
</a>
<a class="card link" href="users.php">
<h3>Manajemen pengguna →</h3>
<p class="muted">Lihat data pengguna.</p>
</a>
<a class="card link" href="distribution.php">
<h3>Distribusi →</h3>
<p class="muted">Perbarui status penyaluran makanan.</p>
</a>
<a class="card link" href="reports.php">
<h3>Laporan →</h3>
<p class="muted">Ringkasan donasi dan distribusi.</p>
</a>
</div>
<?php
require '../includes/footer.php';
?>
