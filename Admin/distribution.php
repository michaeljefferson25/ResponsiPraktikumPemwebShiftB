<?php
require_once '../config/app.php';
require_role('admin');
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=(int)$_POST['id'];
    $status=$_POST['status'];
    if(in_array($status,['in_progress','completed'],true)){
        $pdo->prepare("UPDATE distributions SET status=? WHERE id=?")->execute([$status,$id]);
        flash('Status distribusi diperbarui.');
    }redirect('distribution.php');
}$pageTitle='Distribusi';
$items=$pdo->query("SELECT x.*,r.quantity,d.food_name,u.name recipient FROM distributions x JOIN food_requests r ON r.id=x.request_id JOIN food_donations d ON d.id=r.donation_id JOIN users u ON u.id=r.recipient_id ORDER BY x.created_at DESC")->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Distribusi makanan</h1>
</div>
<div class="table-wrap">
<table>
<tr>
<th>Penerima</th>
<th>Makanan</th>
<th>Jumlah</th>
<th>Status</th>
<th>Aksi</th>
</tr>
<?php
foreach($items as $it):?>
<tr>
<td>
<?=e($it['recipient'])?>
</td>
<td>
<?=e($it['food_name'])?>
</td>
<td>
<?=e($it['quantity'])?>
</td>
<td>
<span class="badge <?=e($it['status'])?>
">
<?=e($it['status'])?>
</span>
</td>
<td>
<?php
if($it['status']!=='completed'):?>
<form method="post">
<input type="hidden" name="id" value="<?=$it['id']?>
">
<select name="status">
<option value="in_progress">Dalam proses</option>
<option value="completed">Selesai</option>
</select> <button class="btn">Simpan</button>
</form>
<?php
else:?>
Selesai<?php
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
