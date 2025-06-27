# Katalog Toko Kue Bolu (Nambolu)

Ini adalah proyek akhir untuk mata kuliah Pemrograman Web, yaitu sebuah website e-commerce sederhana untuk toko kue fiktif bernama Nambolu. Website ini dibangun untuk menampilkan produk, dan akan dikembangkan untuk memiliki fitur pemesanan.

## Teknologi yang Digunakan
- **Backend:** Laravel 11
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** MySQL

## Cara Menjalankan Proyek Secara Lokal
1. Clone repositori ini.
2. Jalankan `composer install`.
3. Salin file `.env.example` menjadi `.env`.
4. Jalankan `php artisan key:generate`.
5. Atur koneksi database Anda di file `.env`.
6. Jalankan `php artisan migrate --seed` untuk membuat tabel dan mengisi data awal.
7. Jalankan `npm install`.
8. Jalankan `npm run dev` (untuk development) atau `npm run build` (untuk produksi).
9. Jalankan `php artisan serve`.
