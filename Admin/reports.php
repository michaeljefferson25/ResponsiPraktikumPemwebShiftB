<?php
require_once '../config/app.php';
require_role('admin');
$pageTitle='Laporan';
$don=$pdo->query("SELECT COUNT(*) total,COALESCE(SUM(quantity),0) stock FROM food_donations WHERE status='approved'")->fetch();
$req=$pdo->query("SELECT COUNT(*) total FROM food_requests WHERE status='approved'")->fetchColumn();
$dist=$pdo->query("SELECT COUNT(*) total FROM distributions WHERE status='completed'")->fetchColumn();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Laporan FoodBridge</h1>
</div>
<div class="grid">
<div class="card">Donasi disetujui<div class="stat">
<?=$don['total']?>
</div>
</div>
<div class="card">Total porsi tersisa<div class="stat">
<?=$don['stock']?>
</div>
</div>
<div class="card">Permintaan disetujui<div class="stat">
<?=$req?>
</div>
</div>
<div class="card">Distribusi selesai<div class="stat">
<?=$dist?>
</div>
</div>
</div>
<p class="muted small">Angka dihitung langsung dari data transaksi di database.</p>
<?php
require '../includes/footer.php';
?>
