# Fitur "Informasi Terbaru" — Dashboard Mahasiswa & Mentor

Ekstrak isi zip ini ke root project Laravel kamu (timpa file yang sudah ada).
Struktur folder di dalam zip ini SAMA PERSIS dengan struktur project kamu,
jadi tinggal drag & drop / extract-overwrite.

## File yang berubah (existing, ada penambahan)
- app/Http/Controllers/Student/StudentController.php
  -> dashboard() ditambah query $informasiTerbaru (5 informasi published
     terbaru, urut created_at DESC)
- app/Http/Controllers/Mentor/MentorController.php
  -> sama seperti di atas
- resources/views/role/student/dashboard.blade.php
  -> ditambah <x-informasi-carousel> setelah section Hero, sebelum Menu Utama
- resources/views/role/mentor/dashboard.blade.php
  -> sama seperti di atas

## File baru
- resources/views/components/informasi-carousel.blade.php
  -> Blade component reusable, dipakai di kedua dashboard.
     Berisi markup carousel, CSS, dan JS (auto-geser tiap 5 detik + dot
     indicator + swipe/scroll manual).

## Cara kerja "maksimal 5, terbaru duluan, otomatis geser & hilang"
Tidak ada logic penghapusan manual -- cukup query:
  Information::where('status', 'published')->orderByDesc('created_at')->take(5)

Begitu ada informasi baru dibuat (status published), otomatis masuk ke
urutan pertama saat query berikutnya jalan (refresh dashboard), dan item
ke-6 otomatis tidak ikut ke-query lagi (hilang dari carousel dashboard).
Informasi itu TETAP bisa dilihat lengkap di halaman "Info"
(role.student.info / role.mentor.info) karena method info() di kedua
controller sudah query tanpa limit -- tidak diubah sama sekali.

## Yang TIDAK diubah (dan kenapa)
- Migration tabel `informations` -- tidak disertakan, asumsi tabel sudah
  ada di project kamu (model Information & CRUD panitia sudah jalan).
- routes/web.php -- tidak perlu route baru, carousel reuse route Info yang
  sudah ada.
- method info() di StudentController & MentorController -- sudah benar,
  tidak disentuh.

## Catatan
Klik kartu di carousel mengarah ke halaman "Info" (bukan halaman detail
per-item), karena project ini belum punya route detail per-informasi.
Kalau nanti mau ada halaman detail sendiri, tinggal bilang.
