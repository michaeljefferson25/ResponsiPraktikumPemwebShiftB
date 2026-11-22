<?php
require_once 'config/app.php';
 if(user()) redirect('dashboard.php');
 $pageTitle='Masuk';
 $error='';
 if($_SERVER['REQUEST_METHOD']==='POST'){
     $stmt=$pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([trim($_POST['email'])]);
    $u=$stmt->fetch();
    if($u && password_verify($_POST['password'],$u['password'])){
        $_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']];
        redirect('dashboard.php');
    }else $error='Email atau password salah.';
} require 'includes/header.php';
?>

<div class="form-card">
<h1>Masuk ke FoodBridge</h1>
<p class="muted">Gunakan akun donatur, penerima, atau admin.</p>
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
<label>Email</label>
<input type="email" name="email" required>
</div>
<div class="field">
<label>Password</label>
<input type="password" name="password" required>
</div>
<button class="btn">Masuk</button>
</form>
<p class="muted">Belum punya akun? <a class="link" href="register.php">Daftar sekarang</a>
</p>
<p class="small muted">Akun admin awal: admin@foodbridge.test / password: password</p>
</div>
<?php
require 'includes/footer.php';
?>
