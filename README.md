# Aplikasi TiketPesawat

Aplikasi TiketPesawat adalah sistem pemesanan tiket pesawat berbasis web yang dibangun menggunakan framework Laravel. Aplikasi ini memungkinkan pengguna untuk melakukan pemesanan tiket pesawat secara online dengan mudah dan aman.

## Fitur Utama

### Untuk Pengguna (Customer)
1. **Pencarian dan Pemesanan Tiket Pesawat**
   - Pencarian penerbangan berdasarkan kota asal dan tujuan
   - Filter berdasarkan tanggal keberangkatan
   - Pemilihan kelas penerbangan (Ekonomi, Bisnis, First Class)
   - Informasi detail harga dan waktu penerbangan
   - Pemilihan kursi penumpang
   - Form pemesanan yang user-friendly

2. **Manajemen Profil Pengguna**
   - Edit informasi pribadi
   - Update foto profil
   - Ubah password
   - Riwayat aktivitas akun

3. **Riwayat Pemesanan Tiket**
   - Daftar semua pemesanan tiket
   - Status pemesanan (Pending, Dibayar, Dibatalkan)
   - Detail setiap pemesanan
   - Filter berdasarkan status dan tanggal

4. **Sistem Pembayaran**
   - Multiple metode pembayaran
   - Konfirmasi pembayaran otomatis
   - Invoice digital
   - Riwayat pembayaran

5. **Cetak Tiket Elektronik**
   - Generate e-ticket dalam format PDF
   - Barcode/QR Code tiket
   - Detail penerbangan lengkap
   - Informasi penumpang

6. **Manajemen Data Penumpang**
   - Tambah/edit data penumpang
   - Simpan data penumpang untuk pemesanan berikutnya
   - Validasi data penumpang
   - Upload dokumen pendukung

### Untuk Admin
1. **Dashboard Admin menggunakan Filament**
   - Overview statistik pemesanan
   - Grafik pendapatan
   - Monitoring aktivitas user
   - Notifikasi real-time

2. **Manajemen Data Penerbangan**
   - Tambah/edit/hapus jadwal penerbangan
   - Atur harga tiket
   - Kelola rute penerbangan
   - Atur ketersediaan kursi
   - Manajemen maskapai

3. **Manajemen Data Pemesanan**
   - Lihat semua pemesanan
   - Filter dan pencarian pemesanan
   - Update status pemesanan
   - Pembatalan pemesanan
   - Detail transaksi

4. **Laporan Pemesanan**
   - Generate laporan dalam berbagai format (PDF, Excel)
   - Laporan pendapatan harian/bulanan/tahunan
   - Statistik pemesanan
   - Analisis tren pemesanan
   - Export data pemesanan

5. **Manajemen Pengguna**
   - Kelola akun customer
   - Kelola akun admin
   - Reset password
   - Blokir/aktivasi akun
   - Log aktivitas pengguna

6. **Konfigurasi Sistem**
   - Pengaturan aplikasi
   - Manajemen role dan permission
   - Konfigurasi email
   - Pengaturan pembayaran
   - Backup database

## Teknologi yang Digunakan

- Laravel 10
- MySQL
- Tailwind CSS
- Filament Admin Panel
- Node.js & NPM
- Composer

## Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Web Server (Apache/Nginx)

## Cara Instalasi

1. Clone repository ini
```bash
git clone [URL_REPOSITORY]
cd TiketPesawat
```

2. Install dependensi PHP menggunakan Composer
```bash
composer install
```

3. Install dependensi JavaScript menggunakan NPM
```bash
npm install
```

4. Salin file .env.example menjadi .env
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Konfigurasi database di file .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiket_pesawat
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database
```bash
php artisan migrate
```

8. Jalankan seeder (opsional)
```bash
php artisan db:seed
```

9. Compile assets
```bash
npm run dev
```

10. Jalankan server development
```bash
php artisan serve
```

## Penggunaan

1. Akses aplikasi melalui browser di `http://localhost:8000`
2. Login sebagai admin:
   - Email: admin@admin.com
   - Password: password

3. Login sebagai customer:
   - Buat akun baru melalui halaman registrasi


## Struktur Folder

- `app/` - Berisi logika utama aplikasi
- `config/` - File konfigurasi
- `database/` - Migrasi dan seeder
- `public/` - Asset publik
- `resources/` - Views, asset mentah, dan translasi
- `routes/` - Definisi route
- `storage/` - File yang di-upload, cache, dan log
- `tests/` - Unit dan feature tests

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan:
1. Fork repository
2. Buat branch baru
3. Commit perubahan Anda
4. Push ke branch
5. Buat Pull Request

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
