<?php
require_once '../config/app.php';
require_role('admin');
$pageTitle='Pengguna';
$items=$pdo->query("SELECT id,name,email,role,phone,created_at FROM users ORDER BY created_at DESC")->fetchAll();
require '../includes/header.php';
?>
<div class="section-head">
<h1>Manajemen pengguna</h1>
</div>
<div class="table-wrap">
<table>
<tr>
<th>Nama</th>
<th>Email</th>
<th>Role</th>
<th>Telepon</th>
<th>Terdaftar</th>
</tr>
<?php
foreach($items as $it):?>
<tr>
<td>
<?=e($it['name'])?>
</td>
<td>
<?=e($it['email'])?>
</td>
<td>
<?=e($it['role'])?>
</td>
<td>
<?=e($it['phone'])?>
</td>
<td>
<?=e($it['created_at'])?>
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
