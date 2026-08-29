# ============================================================
# Ganti semua referensi gambar di folder gambar/ (.jpg/.jpeg/.png)
# jadi .webp di seluruh file Blade -- folder assets/ TIDAK disentuh.
#
# CARA PAKAI:
# 1. Backup dulu / pastikan project ini sudah ke-commit di git
#    (jaga-jaga kalau ada yang meleset, gampang di-revert).
# 2. Buka PowerShell, masuk ke folder project:
#      cd C:\xampp\htdocs\pkkmbkt
# 3. Jalankan:
#      .\ganti-ke-webp.ps1
# ============================================================

$files = Get-ChildItem -Path "resources\views" -Recurse -Filter "*.blade.php"
$totalDiubah = 0

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    $original = $content

    # Pola umum: gambar/nama-file-biasa.jpg|jpeg|png -> .webp
    # (huruf, angka, garis miring buat subfolder kayak "Peta/Gerbang", strip, underscore)
    $content = [regex]::Replace($content, 'gambar/([\w\-/]+)\.(jpg|jpeg|png)', 'gambar/$1.webp', 'IgnoreCase')

    # 2 nama file yang ada spasinya -- diganti manual biar presisi,
    # gak ikut pola regex umum di atas (spasi gak match \w).
    $content = $content -replace 'gambar/Drs\. KH\. Ahmad Rifai Arief\.png', 'gambar/Drs. KH. Ahmad Rifai Arief.webp'
    $content = $content -replace 'gambar/Wisma Hall\.jpeg', 'gambar/Wisma Hall.webp'

    if ($content -ne $original) {
        Set-Content -Path $file.FullName -Value $content -Encoding UTF8 -NoNewline
        Write-Host "Diubah: $($file.FullName)" -ForegroundColor Green
        $totalDiubah++
    }
}

Write-Host ""
Write-Host "Selesai. Total $totalDiubah file diubah." -ForegroundColor Cyan
Write-Host "Folder assets/ (logo di halaman Login, sidebar Admin/Advisor/Panitia, cetak absensi) TIDAK disentuh." -ForegroundColor Yellow
