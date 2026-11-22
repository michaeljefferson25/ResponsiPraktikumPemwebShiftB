<?php
require_once '../config/app.php';
require_role('recipient');
$pageTitle='Dashboard Penerima';
$q=$pdo->query("SELECT COUNT(*) FROM food_donations WHERE status='approved' AND quantity>0 AND expiry_date>=CURDATE()");
$available=$q->fetchColumn();
$q=$pdo->prepare("SELECT COUNT(*) FROM food_requests WHERE recipient_id=?");
$q->execute([user()['id']]);
$requests=$q->fetchColumn();
require '../includes/header.php';
?>
<div class="section-head">
<div>
<h1>Halo, <?=e(user()['name'])?>
!</h1>
<p class="muted">Temukan makanan yang tersedia di FoodBridge.</p>
</div>
<a class="btn" href="catalog.php">Lihat makanan</a>
</div>
<div class="grid">
<div class="card">Donasi tersedia<div class="stat">
<?=$available?>
</div>
</div>
<div class="card">Permintaan saya<div class="stat">
<?=$requests?>
</div>
</div>
<div class="card">Peran akun<div class="stat" style="font-size:22px">Penerima</div>
</div>
</div>
<div class="section-head">
<h2>Mulai mencari makanan</h2>
</div>
<div class="card">
<h3>Ambil sesuai kebutuhan</h3>
<p class="muted">Pilih makanan yang masih tersedia, baca lokasi dan batas konsumsinya, lalu ajukan permintaan. Tunggu persetujuan donatur atau admin.</p>
<a class="btn" href="catalog.php">Buka katalog makanan</a> <a class="btn btn-secondary" href="history.php">Riwayat permintaan</a>
</div>
<?php
require '../includes/footer.php';
?>
