<?php
// Isi lewat .env. Kosong = tidak ditampilkan (tidak ada kontak palsu).
return [
    'wa' => env('HOMECAKE_WA'), // format 628xxxxxxxxxx
    'address' => env('HOMECAKE_ADDRESS', 'Alamat belum diatur'),
    'hours' => env('HOMECAKE_HOURS', 'Jam operasional belum diatur'),
    'min_days' => (int) env('HOMECAKE_MIN_DAYS', 2), // pesan minimal H-n (0 = boleh hari ini)
];
