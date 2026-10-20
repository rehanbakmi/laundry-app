# Laundry App

Aplikasi manajemen usaha laundry berbasis web yang dibangun dengan Laravel. Aplikasi ini mencatat data pelanggan, pegawai, layanan, transaksi cucian, dan pembayaran.

## Fitur

- **Pelanggan**: kelola data pelanggan (nama, nomor telepon, alamat)
- **Pegawai**: kelola data pegawai (nama, nomor telepon, jabatan)
- **Layanan**: kelola jenis layanan beserta harga dan satuan (kg, pcs, set)
- **Transaksi**: catat cucian masuk, tanggal selesai, dan status pengerjaan (`diproses`, `selesai`, `diambil`)
- **Detail transaksi**: satu transaksi dapat berisi beberapa layanan dengan jumlah/berat dan subtotal
- **Pembayaran**: catat pembayaran dengan metode `tunai`, `transfer`, atau `qris`

Setiap modul mendukung operasi CRUD lengkap (lihat, tambah, ubah, hapus).

## Teknologi

- PHP 8.3 atau lebih baru
- Laravel 13
- MySQL
- Blade dan Bootstrap 5 (dimuat dari CDN)

## Struktur Database

| Tabel | Keterangan |
|---|---|
| `pelanggans` | Data pelanggan |
| `pegawais` | Data pegawai |
| `layanans` | Daftar layanan dan harga |
| `transaksis` | Transaksi cucian; terhubung ke pelanggan dan pegawai |
| `detail_transaksis` | Rincian layanan dalam satu transaksi |
| `pembayarans` | Pembayaran untuk transaksi |

Relasi utama:

- Satu pelanggan memiliki banyak transaksi
- Satu pegawai menangani banyak transaksi
- Satu transaksi memiliki banyak detail transaksi dan banyak pembayaran
- Satu layanan dapat muncul di banyak detail transaksi

## Instalasi

Prasyarat: PHP 8.3+, Composer, dan MySQL.

1. Clone repository dan masuk ke foldernya:

   ```bash
   git clone https://github.com/rehanbakmi/laundry-app.git
   cd laundry-app
   ```

2. Pasang dependensi:

   ```bash
   composer install
   ```

3. Salin file environment dan buat application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Buat database kosong di MySQL, misalnya `laundry_db`:

   ```sql
   CREATE DATABASE laundry_db;
   ```

5. Atur koneksi database di file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laundry_db
   DB_USERNAME=isi_username_anda
   DB_PASSWORD=isi_password_anda
   ```

6. Jalankan migrasi:

   ```bash
   php artisan migrate
   ```

7. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

Buka `http://localhost:8000/transaksi` di browser.

## Halaman yang Tersedia

| Modul | URL |
|---|---|
| Pelanggan | `/pelanggan` |
| Pegawai | `/pegawai` |
| Layanan | `/layanan` |
| Transaksi | `/transaksi` |
| Pembayaran | `/pembayaran` |

Setiap modul memiliki halaman daftar (`index`), tambah (`create`), detail (`show`), dan ubah (`edit`).

## Alur Penggunaan

1. Tambahkan data **layanan** (misalnya cuci kiloan) dan **pegawai**
2. Tambahkan **pelanggan**
3. Buat **transaksi** baru, pilih pelanggan, pegawai, dan layanan
4. Perbarui status transaksi seiring proses pengerjaan
5. Catat **pembayaran** saat pelanggan membayar

## Catatan

- Aplikasi belum memiliki sistem login, sehingga siapa pun yang dapat mengakses aplikasi dapat mengubah data. Tambahkan autentikasi sebelum digunakan di server publik.
- Jangan pernah meng-commit file `.env` ke repository. File ini berisi kredensial database.
- Untuk produksi, set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`.

## Pengujian

```bash
php artisan test
```

## Lisensi

Aplikasi ini dibangun di atas [Laravel](https://laravel.com) yang berlisensi [MIT](https://opensource.org/licenses/MIT).
