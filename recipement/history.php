<?php
require_once '../config/app.php';
require_role('recipient');
$pageTitle='Riwayat Permintaan';
$q=$pdo->prepare("SELECT r.*,d.food_name,d.pickup_location FROM food_requests r JOIN food_donations d ON d.id=r.donation_id WHERE r.recipient_id=? ORDER BY r.created_at DESC");
$q->execute([user()['id']]);
$items=$q->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Riwayat permintaan</h1>
<a class="btn" href="catalog.php">Cari makanan</a>
</div>
<?php
if(!$items):?>
<div class="empty">Belum ada permintaan makanan.</div>
<?php
else:?>
<div class="table-wrap">
<table>
<tr>
<th>Makanan</th>
<th>Jumlah</th>
<th>Lokasi</th>
<th>Tanggal</th>
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
<?=e($it['created_at'])?>
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
