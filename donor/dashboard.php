<?php
require_once '../config/app.php';
require_role('donor');
$pageTitle='Dashboard Donatur';
$q=$pdo->prepare("SELECT COUNT(*) total, COALESCE(SUM(quantity),0) qty FROM food_donations WHERE donor_id=?");
$q->execute([user()['id']]);
$stats=$q->fetch();
$q=$pdo->prepare("SELECT * FROM food_donations WHERE donor_id=? ORDER BY created_at DESC LIMIT 6");
$q->execute([user()['id']]);
$items=$q->fetchAll();
require '../includes/header.php';
?>

<div class="section-head">
<div>
<h1>Halo, <?=e(user()['name'])?>
!</h1>
<p class="muted">Kelola donasi makanan yang kamu bagikan.</p>
</div>
<a class="btn" href="add_donation.php">+ Tambah Donasi</a>
</div>
<div class="grid">
<div class="card">Total donasi<div class="stat">
<?=$stats['total']?>
</div>
</div>
<div class="card">Total porsi didonasikan<div class="stat">
<?=$stats['qty']?>
</div>
</div>
<div class="card">Peran akun<div class="stat" style="font-size:22px">Donatur</div>
</div>
</div>
<div class="section-head">
<h2>Donasi terbaru</h2>
<a class="link" href="my_donations.php">Lihat semua</a>
</div>
<?php
if(!$items):?>
<div class="empty">Belum ada donasi. Mulai dengan menambahkan makanan.</div>
<?php
else:?>
<div class="table-wrap">
<table>
<tr>
<th>Makanan</th>
<th>Jumlah</th>
<th>Kedaluwarsa</th>
<th>Status</th>
</tr>
<?php
foreach($items as $it):?>
<tr>
<td>
<?=e($it['food_name'])?>
</td>
<td>
<?=e($it['quantity'])?>
 porsi</td>
<td>
<?=e($it['expiry_date'])?>
</td>
<td>
<span class="badge <?=e($it['status'])?>
">
<?=e($it['status'])?>
</span>
</td>
</tr>
<?php
endforeach;
?>
</table>
</div>
<?php
endif;
?>
<?php
require '../includes/footer.php';
?>
