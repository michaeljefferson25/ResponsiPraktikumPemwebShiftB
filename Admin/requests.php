<?php
require_once '../config/app.php';
require_role('admin');
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=(int)$_POST['id'];
    $status=$_POST['status'];
    if(in_array($status,['approved','rejected'],true)){
        $q=$pdo->prepare("SELECT r.*,d.quantity stock,d.status donation_status FROM food_requests r JOIN food_donations d ON d.id=r.donation_id WHERE r.id=?");
        $q->execute([$id]);
        $r=$q->fetch();
        if($r&&$r['status']==='pending'&&$status==='approved'&&$r['donation_status']==='approved'&&$r['quantity']<=$r['stock']){
            $pdo->beginTransaction();
            $pdo->prepare("UPDATE food_donations SET quantity=quantity-? WHERE id=?")->execute([$r['quantity'],$r['donation_id']]);
            $pdo->prepare("UPDATE food_requests SET status='approved' WHERE id=?")->execute([$id]);
            $pdo->prepare("INSERT INTO distributions(request_id,status) VALUES(?,'pending')")->execute([$id]);
            $pdo->commit();
            flash('Permintaan disetujui dan distribusi dibuat.');
        }elseif($r&&$r['status']==='pending'&&$status==='rejected'){
            $pdo->prepare("UPDATE food_requests SET status='rejected' WHERE id=?")->execute([$id]);
            flash('Permintaan ditolak.');
        }else flash('Permintaan tidak dapat diproses.','error');
    }redirect('requests.php');
}$pageTitle='Permintaan Makanan';
$items=$pdo->query("SELECT r.*,d.food_name,u.name recipient FROM food_requests r JOIN food_donations d ON d.id=r.donation_id JOIN users u ON u.id=r.recipient_id ORDER BY r.created_at DESC")->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Permintaan makanan</h1>
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
<button class="btn btn-secondary">Tolak</button>
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
