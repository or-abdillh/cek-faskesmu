# CekFaskesmu
CekFaskesmu adalah sebuah online platform pusat informasi fasilitas kesehatan di Indonesia yang memberikan solusi praktis dengan menyediakan informasi
transparan mengenai biaya fasilitas kesehatan dan obat-obatan resmi. 

Lihat postigan instagram saya mengenai proyek ini [Disini](https://www.instagram.com/p/CtLhV-zvYJQ/?utm_source=ig_web_copy_link&igshid=MzRlODBiNWFlZA==)

**Daftar Isi**
- [CekFaskesmu](#cekfaskesmu)
  - [Fitur Utama](#fitur-utama)
  - [Database](#database)
  - [Role Pengguna](#role-pengguna)
    - [User](#user)
    - [Provider](#provider)
  - [Requirments](#requirments)
  - [Instalasi](#instalasi)
  - [Stay Connect](#stay-connect)


## Fitur Utama
1. Landing Page
2. Pencarian Faskes berdasarkan jenis, kota, dan nama faskes
3. Detail Layanan Kesehatan dan Obatan yang tersedia
4. Rating dan Review Faskes, Layanan Kesehatan, dan Obatan
5. Perbandingan Harga Layanan Kesehatan da Obatan
6. Item Favorit
7. Dashboard Pengguna
8. Dashboard Admin Faskes

## Database
Sistem ini menggunakan MySQL sebagai *database management system*, berikut ini adalah rancangan database dari [CekFaskesmu](https://drawsql.app/teams/orabdillh/diagrams/io-fest-fti)

## Role Pengguna
Sistem ini memiliki beberapa tipe atau jenis pengguna yaitu :

### User
Tipe pengguna ini adalah pengguna biasa atau pengunjung website yang telah mendaftarkan akun pada website, memiliki akses ke dalam fitur pencarian faskes, detail faskes, perbandingan harga, item favorit dan akses ke dashboard user

### Provider
Tipe pengguna ini adalah pengguna yang memiliki akses sebagai administrator sebuah faskes, memiliki akses seperti pengguna biasa namun memiliki akses dashboard khusus untuk melakukan CRUD pada item layanan kesehatan, obatan, maupun data fasilitas

## Requirements
Sistem ini menggunakan framework Laravel versi 10 dan Vue JS versi 3 sebagai framework utama dibantu dengan Inertia JS sebagai penghubung aplikasi client dengan server

## Instalasi
Ikuti step by step berikut ini untuk melakukan instalasi ke dalam local komputer

Clone repository
```bash
git clone https://github.com/or-abdillh/cek-faskesmu && cd cek-faskesmu
```

Instalasi Composer Packages
```bash
composer install
```

Instalasi Node Modules
```bash
npm install
```

Persiapan Environment
```bash
cp .env.example .env
php artisan key:generate
```

Menjalankan Migrasi dan sample data, pastikan koneksi MySQL sudah aktif
```bash
php artisan migrate --seed
```

Menjalankan Server
```bash
php artisan serve
```

Menjalankan Vite JS mode Development
```bash
npm run dev
```

## Stay Connect
Hay, jika berkenan untuk saling terhubung di sosial media saya [Disini](https://linktr.ee/orabdillh)

----
Last edited 07/06/2023
