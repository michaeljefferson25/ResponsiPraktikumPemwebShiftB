<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$scriptDir = str_replace('\\\\', '/', dirname($_SERVER['SCRIPT_NAME']));

$basePath = preg_replace('~/(admin|donor|recipient)$~', '', $scriptDir);

define('BASE_URL', rtrim($basePath, '/'));

require_once __DIR__ . '/database.php';

function e($value) {
     return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function redirect($url) {
     header("Location: $url");
     exit;
}
function user() {
     return $_SESSION['user'] ?? null;
}
function require_login() {
     if (!user()) redirect('login.php');
}
function require_role($role) {
    
    require_login();
    
    if (user()['role'] !== $role) {
         http_response_code(403);
         exit('Akses ditolak.');
    }
}
function flash($message, $type='success') {
     $_SESSION['flash'] = [$message, $type];
}
function show_flash() {
    
    if (!empty($_SESSION['flash'])) {
        
        [$message, $type] = $_SESSION['flash'];
         unset($_SESSION['flash']);
        
        echo '<div class="alert '.e($type).'">'.e($message).'</div>';
    }
}
function upload_image($field='photo') {
    
    if (empty($_FILES[$field]['name'])) return null;
    
    $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
    
    $mime = mime_content_type($_FILES[$field]['tmp_name']);
    
    if (!isset($allowed[$mime]) || $_FILES[$field]['size'] > 3*1024*1024) {
        
        throw new Exception('Foto harus JPG, PNG, atau WEBP dan maksimal 3 MB.');
    }
    $name = bin2hex(random_bytes(12)).'.'.$allowed[$mime];
    
    $dir = __DIR__.'/../uploads';
    
    if (!is_dir($dir)) mkdir($dir, 0775, true);
    
    if (!move_uploaded_file($_FILES[$field]['tmp_name'], $dir.'/'.$name)) throw new Exception('Gagal mengunggah foto.');
    
    return $name;
}
