<?php
require_once '../config/app.php';
require_role('recipient');
$pageTitle='Katalog Makanan';
$q=$pdo->query("SELECT d.*,u.name donor_name FROM food_donations d JOIN users u ON u.id=d.donor_id WHERE d.status='approved' AND d.quantity>0 AND d.expiry_date>=CURDATE() ORDER BY d.expiry_date ASC");
$items=$q->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<div>
<h1>Katalog makanan</h1>
<p class="muted">Pilih makanan yang tersedia dan masih layak konsumsi.</p>
</div>
</div>
<?php
if(!$items):?>
<div class="empty">Belum ada makanan tersedia saat ini.</div>
<?php
else:?>
<div class="food-grid">
<?php
foreach($items as $it):?>
<article class="food-card">
<?php
if($it['photo']):?>
<img src="../uploads/<?=e($it['photo'])?>
" alt="<?=e($it['food_name'])?>
">
<?php
else:?>
<div style="height:180px;background:#e8f4eb;display:grid;place-items:center;color:#278354;font-size:48px">♡</div>
<?php
endif;
?>
<div class="body">
<h3>
<?=e($it['food_name'])?>
</h3>
<p class="muted small">
<?=e($it['category'])?>
 · Donatur: <?=e($it['donor_name'])?>
</p>
<p>
<?=e($it['description'])?>
</p>
<p class="small">
<b>
<?=e($it['quantity'])?>
 porsi tersedia</b>
<br>Batas konsumsi: <?=e($it['expiry_date'])?>
<br>Lokasi: <?=e($it['pickup_location'])?>
</p>
<form method="post" action="request.php">
<input type="hidden" name="donation_id" value="<?=$it['id']?>
">
<div class="field">
<label>Jumlah yang diminta</label>
<input type="number" name="quantity" min="1" max="<?=$it['quantity']?>
" value="1" required>
</div>
<button class="btn">Ajukan permintaan</button>
</form>
</div>
</article>
<?php
endforeach;
?>
</div>
<?php
endif;
?>
<?php
require '../includes/footer.php';
?>
