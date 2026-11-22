<?php
require_once '../config/app.php';
require_role('donor');
$pageTitle='Donasi Saya';
$q=$pdo->prepare("SELECT * FROM food_donations WHERE donor_id=? ORDER BY created_at DESC");
$q->execute([user()['id']]);
$items=$q->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Donasi Saya</h1>
<a class="btn" href="add_donation.php">+ Tambah Donasi</a>
</div>
<?php
if(!$items):?>
<div class="empty">Belum ada donasi.</div>
<?php
else:?>
<div class="table-wrap">
<table>
<tr>
<th>Makanan</th>
<th>Jumlah</th>
<th>Lokasi</th>
<th>Batas konsumsi</th>
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
</td>
<td>
<?=e($it['pickup_location'])?>
</td>
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
