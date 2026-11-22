<?php
require_once 'config/app.php';
 if(user())redirect('dashboard.php');
$pageTitle='Daftar';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    try{
        $name=trim($_POST['name']);
        $email=trim($_POST['email']);
        $role=$_POST['role'];
        if(!in_array($role,['donor','recipient'],true))throw new Exception('Role tidak valid.');
        if(strlen($_POST['password'])<6)throw new Exception('Password minimal 6 karakter.');
        $stmt=$pdo->prepare("INSERT INTO users(name,email,password,role,phone,address) VALUES(?,?,?,?,?,?)");
        $stmt->execute([$name,$email,password_hash($_POST['password'],PASSWORD_DEFAULT),$role,trim($_POST['phone']),trim($_POST['address'])]);
        flash('Pendaftaran berhasil. Silakan login.');
        redirect('login.php');
    }catch(Throwable $e){
        $error=$e instanceof PDOException?'Email sudah digunakan atau data tidak valid.':$e->getMessage();
    }
}require 'includes/header.php';
?>

<div class="form-card">
<h1>Buat akun FoodBridge</h1>
<?php
if($error):?>
<div class="alert error">
<?=e($error)?>
</div>
<?php
endif;
?>
<form method="post">
<div class="field">
<label>Nama lengkap</label>
<input name="name" required>
</div>
<div class="field">
<label>Email</label>
<input type="email" name="email" required>
</div>
<div class="field">
<label>Password (minimal 6 karakter)</label>
<input type="password" name="password" minlength="6" required>
</div>
<div class="field">
<label>Daftar sebagai</label>
<select name="role">
<option value="recipient">Penerima makanan</option>
<option value="donor">Donatur makanan</option>
</select>
</div>
<div class="field">
<label>Nomor telepon</label>
<input name="phone">
</div>
<div class="field">
<label>Alamat</label>
<textarea name="address">
</textarea>
</div>
<button class="btn">Daftar</button>
</form>
</div>
<?php
require 'includes/footer.php';
?>
