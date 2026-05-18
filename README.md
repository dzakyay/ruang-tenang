# Ruang Tenang

Website personal mental health yang memberikan ruang sederhana, aman, dan nyaman untuk refleksi diri. Ruang Tenang membantu pengguna melacak emosi harian, menulis jurnal pikiran, dan memahami perasaan yang dialami melalui fitur ensiklopedia.

## 🌟 Fitur Utama

- **Autentikasi Aman:** Sistem pendaftaran, login, dan manajemen sesi yang aman menggunakan Laravel Breeze.
- **Journaling:** Ruang privat bagi pengguna untuk mencurahkan pikiran, dengan kemampuan untuk menambah, mengedit, melihat, dan menghapus jurnal. Termasuk dukungan untuk gambar (rich-text editor Tiptap).
- **Emotion Tracking:** Fitur pelacakan mood/emosi harian yang sederhana menggunakan skala likert (1-5) dengan visual emoji yang intuitif.
- **Ensiklopedia Perasaan:** Kumpulan informasi yang membantu pengguna mengenali, memahami, dan memvalidasi emosi yang sedang dirasakan, dilengkapi dengan tips penanganan.
- **Dashboard Analitik:** Menampilkan ringkasan dan statistik pola perasaan pengguna dalam periode tertentu (mis. 7 hari terakhir) agar pengguna lebih memahami kondisi mental mereka.
- **Profil Pengguna:** Manajemen profil akun, termasuk verifikasi email dan pengaturan kata sandi.

## 🛠️ Teknologi yang Digunakan

Aplikasi ini menggunakan pendekatan **Monolithic Architecture** tanpa pemisahan frontend-backend API yang ketat (berbasis server-rendered).

- **Backend Framework:** Laravel (PHP)
- **Frontend / Templating:** Blade Template Engine
- **Styling:** Tailwind CSS (dengan utilitas dan komponen Blade)
- **Database:** MySQL (dengan Eloquent ORM)
- **Autentikasi:** Laravel Breeze

## 🏗️ Struktur Arsitektur & Pola Alur (Data Flow)

Pola pengembangan utama:
**Route → Controller → Service → Model → View (Blade)**

Menerapkan prinsip:
- **Thin Controllers, Fat Services:** Logika bisnis diletakkan pada Service atau Action Classes, bukan pada Controller.
- **S.O.L.I.D & D.R.Y:** Kode dibuat modular, menghindari perulangan (ekstraksi komponen).
- **Form Request Validation:** Memisahkan validasi input dari logika controller.
- **Blade Components:** Ekstraksi elemen UI (seperti _buttons_, _cards_, dan formulir) untuk digunakan ulang.

## 🚀 Panduan Instalasi (Development Setup)

Ikuti langkah-langkah di bawah ini untuk menjalankan project ini di komputer lokal (_local environment_):

1. **Clone repository ini**
   ```bash
   git clone <URL_REPO_ANDA>
   cd ruang-tenang
   ```

2. **Install dependency PHP (Composer)**
   ```bash
   composer install
   ```

3. **Install dependency Node/Frontend (NPM)**
   ```bash
   npm install
   ```

4. **Siapkan file Environment**
   Salin `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi Database dan Seeder**
   Buat struktur database dan masukkan data awal sistem (termasuk data ensiklopedia).
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan local server**
   Jalankan server PHP dan compiler aset frontend secara bersamaan (buka di terminal terpisah):
   
   *Terminal 1 (Backend):*
   ```bash
   php artisan serve
   ```
   
   *Terminal 2 (Frontend - Vite):*
   ```bash
   npm run dev
   ```

8. **Akses Aplikasi**
   Buka web browser dan akses aplikasi melalui `http://localhost:8000`.

## 🛡️ Standar Keamanan & Performa (Guardrails)

- **Password Hashing:** Menggunakan standar *bcrypt* bawaan Laravel.
- **CSRF Protection:** Setiap interaksi form dilindungi oleh token wajib.
- **XSS Prevention:** Validasi input yang ketat dan escaping secara default menggunakan Blade `{{ }}`.
- **Authorization:** Pembatasan hak akses berbasis otorisasi pemilik data; pengguna hanya dapat memanipulasi datanya sendiri melalui *Laravel Gates & Policies*.
- **Database Query:** Optimalisasi kueri dengan mencegah *N+1 query* (`Model::preventLazyLoading()`) dan pembuatan indeks pada kolom pencarian yang sering dipakai.

## AKUN ADMIN
- Email: admin@ruangtenang.test
- Password: password

---
*Dibuat dengan sepenuh hati untuk membantu menjaga ketenangan pikiran Anda.*
