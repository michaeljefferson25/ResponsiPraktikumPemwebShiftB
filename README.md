# FoodBridge

**FoodBridge** adalah aplikasi web berbagi makanan yang membantu menghubungkan donatur makanan dengan penerima yang membutuhkan. Melalui aplikasi ini, donatur dapat mencatat makanan yang ingin disumbangkan, admin memverifikasi donasi dan mengelola permintaan, sedangkan penerima dapat melihat katalog makanan serta mengajukan permintaan. Alur tersebut ditujukan untuk membantu penyaluran makanan dan mengurangi makanan yang terbuang.

---

## 1. Nama dan Deskripsi Proyek

- **Nama aplikasi:** FoodBridge
- **Jenis aplikasi:** Aplikasi web berbagi dan penyaluran donasi makanan.
- **Deskripsi:** FoodBridge menyediakan alur pencatatan donasi makanan, verifikasi oleh admin, pengajuan permintaan oleh penerima, serta pengelolaan distribusi makanan.

Aplikasi memiliki tiga jenis peran pengguna:

1. **Admin** – mengelola pengguna, memverifikasi donasi, memproses permintaan makanan, memantau distribusi, dan melihat laporan.
2. **Donatur (Donor)** – menambahkan donasi makanan dan melihat daftar donasi miliknya.
3. **Penerima (Recipient)** – melihat katalog makanan yang tersedia, mengajukan permintaan, dan melihat riwayat permintaan.

## 2. Latar Belakang dan Tujuan

### Latar Belakang

Makanan yang masih layak konsumsi dapat tidak termanfaatkan dan berakhir menjadi limbah, sementara terdapat pihak yang membutuhkan bantuan pangan. Diperlukan sarana yang membantu proses berbagi makanan agar informasi donasi, pemeriksaan, permintaan, dan penyalurannya dapat dikelola dengan lebih teratur.

### Tujuan

FoodBridge dikembangkan dengan tujuan:

- Memudahkan donatur mencatat dan menawarkan makanan yang akan dibagikan.
- Membantu admin memeriksa kelayakan dan mengelola data donasi.
- Memudahkan penerima menemukan makanan yang tersedia dan mengajukan permintaan.
- Membantu pencatatan proses distribusi makanan.
- Menyediakan informasi riwayat dan laporan untuk mendukung pemantauan kegiatan.

## 3. Daftar Fitur atau Modul

### Fitur umum
- Registrasi akun pengguna.
- Login dan logout.
- Dashboard yang menyesuaikan peran pengguna.

### Modul Donatur
- Menambahkan donasi makanan.
- Mengisi nama makanan, deskripsi, jumlah, kategori, tanggal kedaluwarsa, dan lokasi pengambilan.
- Mengunggah foto makanan (JPG, PNG, atau WEBP dengan ukuran maksimal 3 MB).
- Melihat daftar donasi milik sendiri beserta statusnya.

### Modul Penerima
- Melihat katalog donasi yang telah disetujui admin, masih memiliki stok, dan belum melewati tanggal kedaluwarsa.
- Mengajukan permintaan makanan sesuai jumlah yang tersedia.
- Melihat riwayat permintaan beserta statusnya.

### Modul Admin
- Melihat ringkasan data pada dashboard admin.
- Memverifikasi donasi dengan status disetujui atau ditolak.
- Melihat dan memproses permintaan makanan.
- Mengelola status distribusi (menunggu, sedang diproses, dan selesai).
- Melihat daftar pengguna.
- Melihat laporan donasi, permintaan, dan distribusi.

### Alur utama aplikasi

1. Donatur mendaftarkan akun dan mengisi data donasi makanan.
2. Donasi masuk dengan status **Pending**.
3. Admin memeriksa donasi dan mengubah statusnya menjadi disetujui atau ditolak.
4. Donasi yang disetujui dan masih tersedia ditampilkan pada katalog penerima.
5. Penerima mengajukan permintaan makanan.
6. Admin memproses permintaan. Jika disetujui, jumlah stok donasi dikurangi dan data distribusi dibuat.
7. Admin memperbarui status distribusi sampai selesai.

## 4. Teknologi yang Digunakan

Teknologi yang digunakan berdasarkan source code proyek:

- **PHP Native** – logika aplikasi dan pemrosesan sisi server.
- **HTML** – struktur halaman web.
- **CSS** – pengaturan tampilan dan tata letak.
- **JavaScript** – interaksi pada halaman web.
- **MySQL** – penyimpanan data aplikasi.
- **PDO (PHP Data Objects)** – koneksi dan interaksi PHP dengan database.
- **Apache** – web server (dapat dijalankan melalui XAMPP).

## 5. Panduan Instalasi dan Konfigurasi

### Persiapan

Siapkan perangkat lunak berikut:

- XAMPP atau lingkungan server lokal sejenis yang menyediakan Apache, PHP, dan MySQL.
- Browser web.
- Editor kode, misalnya Visual Studio Code (opsional).

### Langkah instalasi

1. Unduh atau clone repository FoodBridge.
2. Jika mengunduh ZIP, ekstrak folder proyek `FoodBridge`.
3. Pindahkan folder `FoodBridge` ke direktori web server:
   - Windows (XAMPP): `C:\xampp\htdocs\FoodBridge`
4. Buka XAMPP Control Panel, lalu jalankan **Apache** dan **MySQL**.
5. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.
6. Pilih menu **Import**, kemudian pilih file `database.sql` dari folder proyek.
7. Jalankan proses import. File SQL akan membuat database `foodbridge`, tabel-tabel yang dibutuhkan, kategori makanan awal, dan satu akun admin awal.
8. Periksa konfigurasi database pada `config/database.php`. Konfigurasi bawaan:
   - Host: `localhost`
   - Database: `foodbridge`
   - Username: `root`
   - Password: kosong
   - Charset: `utf8mb4`
9. Jika konfigurasi MySQL di komputer berbeda, sesuaikan nilai `$host`, `$db`, `$user`, dan `$pass` pada file tersebut.
10. Pastikan folder `uploads` tersedia dan dapat ditulisi oleh web server agar foto donasi dapat disimpan.

> **Catatan:** Jika database `foodbridge` sudah berisi data proyek sebelumnya, lakukan backup terlebih dahulu. Jangan mengimpor ulang `database.sql` tanpa memahami dampaknya terhadap database yang sudah ada.

## 6. Panduan Menjalankan Aplikasi

1. Pastikan Apache dan MySQL sedang berjalan.
2. Buka browser.
3. Akses alamat `http://localhost/FoodBridge/`.
4. Daftarkan akun melalui menu **Mulai Berbagi**. Pilih peran donatur atau penerima sesuai kebutuhan.
5. Login menggunakan akun yang telah dibuat.
6. Gunakan menu sesuai peran:
   - **Donatur:** Dashboard, Buat Donasi, dan Donasi Saya.
   - **Penerima:** Dashboard, Cari Makanan, dan Riwayat.
   - **Admin:** Dashboard, Verifikasi, Permintaan, Distribusi, Pengguna, dan Laporan.

### Akun admin awal untuk pengujian lokal

File `database.sql` menyediakan akun admin awal berikut:

- **Email:** `admin@foodbridge.test`
- **Password:** `password`

Akun tersebut ditujukan untuk pengujian lokal. Ganti password bawaan dan jangan gunakan kredensial default untuk penerapan publik.

---

## Struktur Folder Proyek

```text
FoodBridge/
├── admin/
│   ├── dashboard.php
│   ├── distribution.php
│   ├── reports.php
│   ├── requests.php
│   ├── users.php
│   └── verification.php
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── config/
│   ├── app.php
│   └── database.php
├── donor/
│   ├── add_donation.php
│   ├── dashboard.php
│   └── my_donations.php
├── includes/
│   ├── footer.php
│   └── header.php
├── recipient/
│   ├── catalog.php
│   ├── dashboard.php
│   ├── history.php
│   └── request.php
├── uploads/
├── dashboard.php
├── database.sql
├── index.php
├── login.php
├── logout.php
├── register.php
└── README.md
```

## Struktur Database

Database `foodbridge` menggunakan tabel berikut:

| Tabel | Fungsi |
|---|---|
| `users` | Menyimpan data akun, kontak, dan peran pengguna. |
| `food_donations` | Menyimpan informasi donasi makanan dari donatur. |
| `food_requests` | Menyimpan permintaan makanan dari penerima. |
| `distributions` | Menyimpan dan memantau status distribusi permintaan yang disetujui. |
| `donation_history` | Menyediakan tabel pencatatan riwayat tindakan donasi. |
| `donation_verifications` | Menyimpan data verifikasi donasi oleh admin. |
| `food_categories` | Menyimpan kategori makanan. |

## Catatan Pengembangan

FoodBridge merupakan proyek pembelajaran praktikum. Sebelum aplikasi diterapkan pada lingkungan publik/produksi, lakukan penguatan keamanan, termasuk perlindungan CSRF, validasi dan pembatasan unggahan file, pengelolaan kredensial, serta pengujian hak akses setiap peran.

---

**FoodBridge — Share More, Waste Less.**
