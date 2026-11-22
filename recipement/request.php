<?php
require_once '../config/app.php';
require_role('recipient');
if($_SERVER['REQUEST_METHOD']!=='POST')redirect('catalog.php');
try{
    $id=(int)$_POST['donation_id'];
    $qty=max(1,(int)$_POST['quantity']);
    $pdo->beginTransaction();
    $q=$pdo->prepare("SELECT * FROM food_donations WHERE id=? AND status='approved' AND expiry_date>=CURDATE() FOR UPDATE");
    $q->execute([$id]);
    $d=$q->fetch();
    if(!$d||$qty>$d['quantity'])throw new Exception('Makanan tidak tersedia atau jumlah melebihi stok.');
    $q=$pdo->prepare("INSERT INTO food_requests(donation_id,recipient_id,quantity) VALUES(?,?,?)");
    $q->execute([$id,user()['id'],$qty]);
    $pdo->commit();
    flash('Permintaan berhasil dikirim. Tunggu proses persetujuan.');
}catch(Throwable $e){
    if($pdo->inTransaction())$pdo->rollBack();
    flash($e->getMessage(),'error');
}redirect('history.php');
?>
