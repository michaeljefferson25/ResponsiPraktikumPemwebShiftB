<?php
require_once '../config/app.php';
require_role('donor');
$pageTitle='Tambah Donasi';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    try{
        $photo=upload_image();
        $stmt=$pdo->prepare("INSERT INTO food_donations(donor_id,food_name,description,quantity,category,expiry_date,pickup_location,photo) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->execute([user()['id'],trim($_POST['food_name']),trim($_POST['description']),max(1,(int)$_POST['quantity']),trim($_POST['category']),$_POST['expiry_date'],trim($_POST['pickup_location']),$photo]);
        flash('Donasi berhasil didaftarkan dan menunggu verifikasi admin.');
        redirect('my_donations.php');
    }catch(Throwable $e){
        $error=$e->getMessage();
    }
}require '../includes/header.php';
?>

<div class="form-card">
<h1>Tambah donasi makanan</h1>
<p class="muted">Isi informasi dengan jujur agar makanan aman diterima.</p>
<?php
if($error):?>
<div class="alert error">
<?=e($error)?>
</div>
<?php
endif;
?>
<form method="post" enctype="multipart/form-data">
<div class="field">
<label>Nama makanan</label>
<input name="food_name" required>
</div>
<div class="field">
<label>Kategori</label>
<select name="category">
<option> makanan siap saji</option>
<option>Bahan makanan</option>
<option>Roti dan kue</option>
<option>Buah dan sayur</option>
<option>Lainnya</option>
</select>
</div>
<div class="field">
<label>Deskripsi dan kondisi makanan</label>
<textarea name="description" required>
</textarea>
</div>
<div class="field">
<label>Jumlah (porsi/unit)</label>
<input type="number" name="quantity" min="1" required>
</div>
<div class="field">
<label>Tanggal kedaluwarsa / batas konsumsi</label>
<input type="date" name="expiry_date" min="<?=date('Y-m-d')?>
" required>
</div>
<div class="field">
<label>Lokasi pengambilan</label>
<textarea name="pickup_location" required>
</textarea>
</div>
<div class="field">
<label>Foto makanan (opsional, maks. 3 MB)</label>
<input type="file" name="photo" accept="image/png,image/jpeg,image/webp">
</div>
<button class="btn">Kirim donasi</button> <a class="btn btn-secondary" href="dashboard.php">Batal</a>
</form>
</div>
<?php
require '../includes/footer.php';
?>
