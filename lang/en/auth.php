<?php

// Override pesan bawaan Laravel/Fortify buat proses login -- locale app-nya
// tetep "en" (biar gak nyenggol string lain yang belum diaudit), tapi ISI
// pesan-pesan ini sengaja diganti ke Bahasa Indonesia karena inilah yang
// user asli lihat pas login gagal.

return [

    'failed' => 'Email/NIM-NPM atau kata sandi yang Anda masukkan salah.',

    'password' => 'Kata sandi yang Anda masukkan salah.',

    'throttle' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam :seconds detik.',

];
