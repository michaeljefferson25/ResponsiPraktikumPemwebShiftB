<?php
require_once '../config/app.php';
require_role('admin');
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=(int)$_POST['id'];
    $status=$_POST['status'];
    if(in_array($status,['approved','rejected'],true)){
        $q=$pdo->prepare("UPDATE food_donations SET status=? WHERE id=? AND status='pending'");
        $q->execute([$status,$id]);
        flash('Status donasi diperbarui.');
    }redirect('verification.php');
}$pageTitle='Verifikasi Donasi';
$items=$pdo->query("SELECT d.*,u.name donor FROM food_donations d JOIN users u ON u.id=d.donor_id ORDER BY d.created_at DESC")->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Verifikasi donasi</h1>
</div>
<div class="table-wrap">
<table>
<tr>
<th>Donatur</th>
<th>Makanan</th>
<th>Jumlah</th>
<th>Batas konsumsi</th>
<th>Status</th>
<th>Aksi</th>
</tr>
<?php
foreach($items as $it):?>
<tr>
<td>
<?=e($it['donor'])?>
</td>
<td>
<?=e($it['food_name'])?>
</td>
<td>
<?=e($it['quantity'])?>
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
<td>
<?php
if($it['status']==='pending'):?>
<form class="inline-form" method="post">
<input type="hidden" name="id" value="<?=$it['id']?>
">
<input type="hidden" name="status" value="approved">
<button class="btn">Setujui</button>
</form> <form class="inline-form" method="post">
<input type="hidden" name="id" value="<?=$it['id']?>
">
<input type="hidden" name="status" value="rejected">
<button class="btn btn-secondary" data-confirm="Tolak donasi ini?">Tolak</button>
</form>
<?php
else:?>
-<?php
endif;
?>
</td>
</tr>
<?php
endforeach;
?>
</table>
</div>
<?php
require '../includes/footer.php';
?>
