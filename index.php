<?php
require_once 'config/app.php';
 if (user()) redirect('dashboard.php');
 $pageTitle='Beranda';
 require 'includes/header.php';
?>

<section class="hero">
<div class="hero-content">
<div class="eyebrow">#BerbagiLebihBermakna</div>
<h1>Bagikan ke banyak orang, lebih sedikit yang terbuang.</h1>
<p>FoodBridge menghubungkan makanan berlebih yang masih layak konsumsi dengan orang-orang yang membutuhkan. Satu donasi kecil bisa membawa banyak kebaikan.</p>
<div class="hero-actions">
<a class="btn" href="register.php">Mulai berdonasi <span>↗</span>
</a>
<a class="btn btn-outline" href="register.php">Cari makanan</a>
</div>
<div class="hero-note">Bersama, kita wujudkan #ZeroFoodWaste dan #ZeroHunger.</div>
</div>
</section>
<section class="stats-strip">
<div class="stat-item">
<div class="stat-number">Berbagi</div>
<div class="stat-label">Makanan berlebih jadi manfaat</div>
</div>
<div class="stat-item">
<div class="stat-number">Peduli</div>
<div class="stat-label">Membantu sesama di sekitar kita</div>
</div>
<div class="stat-item">
<div class="stat-number">Berkelanjutan</div>
<div class="stat-label">Mengurangi pemborosan pangan</div>
</div>
</section>
<section class="section" id="tentang">
<div class="section-heading">
<div class="section-kicker">Tentang FoodBridge</div>
<h2 class="section-title">Makanan baik seharusnya tidak berakhir menjadi limbah.</h2>
<p class="section-intro">Kami percaya setiap makanan memiliki nilai. FoodBridge hadir sebagai jembatan antara donatur yang memiliki makanan berlebih dan penerima yang membutuhkan.</p>
</div>
</section>
<section class="section" id="cara-kerja">
<div class="section-heading">
<div class="section-kicker">Mudah dan berdampak</div>
<h2 class="section-title">Bagaimana FoodBridge bekerja?</h2>
<p class="section-intro">Proses berbagi makanan dibuat sederhana, transparan, dan terpantau.</p>
</div>
<div class="steps-grid">
<article class="step-card">
<div class="step-no">01</div>
<h3>Donasikan makanan</h3>
<p>Donatur mendaftarkan makanan berlebih, jumlah, kondisi, batas konsumsi, dan lokasi pengambilan.</p>
</article>
<article class="step-card">
<div class="step-no">02</div>
<h3>Verifikasi kelayakan</h3>
<p>Admin memeriksa informasi donasi agar makanan yang ditawarkan sesuai dan masih layak konsumsi.</p>
</article>
<article class="step-card">
<div class="step-no">03</div>
<h3>Salurkan kebaikan</h3>
<p>Penerima mengajukan permintaan. Setelah disetujui, proses distribusi dapat dipantau hingga selesai.</p>
</article>
</div>
</section>
<section class="section">
<div class="impact-banner">
<div>
<div class="section-kicker">Sekarang giliran kamu</div>
<h2>Yuk, jadi bagian dari perubahan.</h2>
<p>Mulai dari satu makanan yang kamu bagikan, kita bisa membantu lebih banyak orang sekaligus mengurangi makanan terbuang.</p>
</div>
<a class="btn" href="register.php">Gabung FoodBridge <span>↗</span>
</a>
</div>
</section>
<?php
require 'includes/footer.php';
?>
