# Sistem Informasi Inventaris IT & Penilaian Kondisi Perangkat
### Metode Analytic Hierarchy Process (AHP) - IMUX Corp

Sistem ini dikembangkan untuk mengelola aset IT pada IMUX Corp sekaligus melakukan penilaian kondisi perangkat secara objektif menggunakan metode **Analytic Hierarchy Process (AHP)**. Sistem ini membantu administrator dalam menentukan prioritas pemeliharaan atau pembaharuan perangkat berdasarkan kriteria yang telah ditentukan.

---

## 🚀 Fitur Utama
* **Dashboard Informatif**: Ringkasan jumlah aset, kategori, dan status perangkat.
* **Manajemen User**: Pengaturan hak akses pengguna (Admin & Staff).
* **Master Data Lengkap**: Pengelolaan Vendor, Lokasi, Kategori, dan Status Perangkat.
* **Metode AHP**:
    * Manajemen Kriteria Penilaian.
    * Pengaturan Bobot/Sub-Kriteria.
    * *Upcoming:* Perhitungan Perbandingan Berpasangan & Ranking Kondisi.
* **Antarmuka Modern**: Dibangun dengan Bootstrap 5 dan notifikasi interaktif menggunakan SweetAlert2.

---

## 🛠️ Spesifikasi Teknologi
* **Framework**: Laravel 11 / 12
* **Bahasa Pemrograman**: PHP 8.2+
* **Database**: MySQL 8.x
* **Lingkungan Pengembangan**: Laravel Sail (Docker)
* **Sistem Operasi Pengembangan**: Linux Mint
* **Frontend**: Bootstrap 5, Bi-Icons, SweetAlert2, jQuery.

---

## 📦 Langkah Instalasi (Development Mode)

Pastikan Anda sudah menginstal **Docker** dan **Docker Compose** di sistem Anda.

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/inventaris-it-imux.git](https://github.com/username/inventaris-it-imux.git)
    cd inventaris-it-imux
    ```

2.  **Instal Dependency**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:
    ```bash
    cp .env.example .env
    ```
    *Jika menggunakan Sail, pastikan `DB_HOST=mysql` dan port sesuai dengan pemetaan Docker.*

4.  **Menjalankan Laravel Sail**
    ```bash
    ./vendor/bin/sail up -d
    ```

5.  **Generate App Key**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6.  **Migrasi Database & Seeder**
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

7.  **Akses Aplikasi**
    Buka browser dan akses [http://localhost](http://localhost).

---

## 📊 Struktur Database (AHP)
Sistem penilaian menggunakan dua tabel utama yang saling berelasi:
* **Criterias**: Menyimpan kriteria utama penilaian (misal: Usia, Kerusakan, Nilai Aset).
* **Sub-Criterias**: Menyimpan bobot nilai dari setiap kriteria untuk proses kalkulasi.

---

## 📝 Informasi Pengembang
* **Nama**: Siti Nasekha
* **Instansi**: UNIVERSITAS PAMULANG
* **Tujuan**: Undergraduate Thesis (Skripsi)
* **Kontak**: 221011403357@unpam.ac.id

---

© 2026 - IMUX Corp Inventaris IT System
