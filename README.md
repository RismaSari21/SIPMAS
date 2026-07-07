# SIPMAS - Sistem Pengaduan Masyarakat

SIPMAS adalah aplikasi berbasis web yang dikembangkan untuk mempermudah masyarakat dalam menyampaikan pengaduan kepada instansi terkait secara cepat, mudah, dan transparan. Aplikasi ini juga membantu petugas dalam mengelola, memverifikasi, serta menindaklanjuti setiap laporan yang masuk.

## Fitur Utama

Masyarakat (User)

* Registrasi dan login akun.
* Mengirim pengaduan beserta deskripsi.
* Mengunggah foto sebagai bukti pendukung.
* Melihat status pengaduan secara real-time.
* Mengubah profil pengguna.
* Mengganti foto profil.

Admin

* Login sebagai administrator.
* Dashboard statistik pengaduan.
* Melihat seluruh data pengaduan.
* Memverifikasi pengaduan.
* Memberikan tanggapan terhadap pengaduan.
* Mengubah status pengaduan.
* Mengelola data pengguna.

## Teknologi yang Digunakan
* Laravel 12
* PHP 8.2+
* Bootstrap 5
* Vite
* PostgreSQL (Supabase)
* Railway (Deployment)
* Git & GitHub

## Struktur Hak Akses

### Admin

* Mengelola seluruh data pengguna.
* Mengelola seluruh pengaduan.
* Memberikan tanggapan.
* Memverifikasi laporan.
* Mengubah status pengaduan.

### User

* Membuat pengaduan.
* Mengunggah bukti foto.
* Melihat riwayat pengaduan.
* Mengelola profil pribadi.

## Instalasi

git clone https://github.com/RismaSari21/SIPMAS.git


composer install
npm install
```

cp .env.example .env
```
Generate APP_KEY

php artisan key:generate
```

Konfigurasi Database

Sesuaikan file `.env`.

Contoh menggunakan Supabase PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=YOUR_SUPABASE_HOST
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
DB_SSLMODE=require
```
Jalankan Migrasi

php artisan migrate
```

Jika menggunakan data awal:

```bash
php artisan db:seed
```

### 7. Build Asset

```bash
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser:

```
http://127.0.0.1:8000
```

---

## Deployment

Aplikasi dapat di-deploy menggunakan Railway.

Pastikan Environment Variables telah diatur, antara lain:

* APP_NAME
* APP_ENV
* APP_KEY
* APP_URL
* DB_CONNECTION
* DB_HOST
* DB_PORT
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD
* DB_SSLMODE

Build Command:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Start Command:

```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

## Struktur Folder

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
```

## Tampilan Sistem

Halaman yang tersedia pada aplikasi:

* Landing Page
* Login
* Register
* Dashboard Admin
* Dashboard User
* Form Pengaduan
* Detail Pengaduan
* Profil Pengguna

## Pengembang

Proyek ini dikembangkan sebagai tugas mata kuliah **Pemrograman Web** dengan tujuan membangun sistem pengaduan masyarakat berbasis web menggunakan Laravel.

## Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan pengembangan akademik.

