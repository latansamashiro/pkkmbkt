<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Rekapitulasi Absensi — {{ $sesi }}{{ $tanggal ? ' — ' . \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y') : '' }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #1a1a1a;
            margin: 0;
            padding: 32px 40px;
        }
        .no-print { text-align: right; margin-bottom: 20px; }
        .no-print button {
            background: #152159; color: #fff; border: none; padding: 10px 22px;
            border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer;
            font-family: 'Segoe UI', sans-serif;
        }
        .no-print button:hover { background: #1e3a8f; }

        /* ============ KOP SURAT ============ */
        .kop {
            display: flex; align-items: center; gap: 16px;
            border-bottom: 4px solid #152159; padding-bottom: 10px; margin-bottom: 3px;
        }
        .kop img { width: 78px; height: 78px; object-fit: contain; flex-shrink: 0; }
        .kop-text { flex: 1; text-align: left; }
        .kop-text .kop-sub { margin: 0; font-size: 13px; font-weight: bold; line-height: 1.25; text-transform: uppercase; }
        .kop-text h1 { margin: 1px 0 0; font-size: 19px; font-weight: bold; letter-spacing: 0.02em; text-transform: uppercase; }
        .kop-text p { margin: 3px 0 0; font-size: 10.5px; }
        .kop-line2 { border-bottom: 1.5px solid #152159; margin-bottom: 22px; }

        h3.judul {
            text-align: center; text-decoration: underline; font-size: 15px;
            margin: 0 0 4px; text-transform: uppercase;
        }
        .subjudul { text-align: center; font-size: 12.5px; margin: 0 0 24px; }

        .meta { width: 100%; font-size: 12.5px; margin-bottom: 18px; }
        .meta td { padding: 2px 6px 2px 0; vertical-align: top; }
        .meta td.label { width: 130px; }

        table.data { width: 100%; border-collapse: collapse; font-size: 11.5px; margin-bottom: 24px; }
        table.data th, table.data td { border: 1px solid #333; padding: 6px 8px; }
        table.data th { background: #eef0f6; text-align: center; font-weight: bold; }
        table.data td.label-cell { text-align: left; }
        table.data td.center { text-align: center; }

        .ttd { display: flex; justify-content: flex-end; font-size: 12.5px; margin-top: 40px; }
        .ttd-box { text-align: center; width: 240px; }
        .ttd-space { height: 70px; }

        @media print {
            .no-print { display: none; }
            body { padding: 0 24px; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Print / Simpan sebagai PDF</button>
    </div>

    <!-- ============================================================
         ►► KOP SURAT — format resmi Universitas La Tansa Mashiro (UNILAM),
            samain persis dengan kop surat panitia PKKMB-KT yang asli.
    ============================================================= -->
    <div class="kop">
        <img src="{{ asset('assets/unilam.png') }}" alt="Logo UNILAM" />
        <div class="kop-text">
            <p class="kop-sub">Pengenalan Kehidupan Kampus Bagi Mahasiswa Baru<br />Dan Khutbatut-Ta'aruf (PKKMBKT)</p>
            <h1>Universitas La Tansa Mashiro</h1>
            <p>Jl. Soekarno &ndash; Hatta, Pasirjati Rangkasbitung, Lebak, Banten 42317</p>
            <p>Web : <u>https://unilam.ac.id</u> - e-mail : <u>rektorat@unilam.ac.id</u></p>
        </div>
    </div>
    <div class="kop-line2">&nbsp;</div>

    <h3 class="judul">Rekapitulasi Absensi Seluruh Kelompok</h3>
    <p class="subjudul">Dicetak sebagai arsip resmi hasil presensi per sesi</p>

    <table class="meta">
        <tr><td class="label">Sesi</td><td>: {{ $sesi }}</td></tr>
        <tr><td class="label">Tanggal</td><td>: {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') : 'Semua tanggal' }}</td></tr>
        <tr><td class="label">Jumlah Kelompok</td><td>: {{ $laporan->count() }} kelompok</td></tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width:28px">No</th>
                <th style="text-align:left">Dibuat Oleh</th>
                <th style="width:100px">Tanggal</th>
                <th style="width:100px">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $idx => $l)
                <tr>
                    <td class="center">{{ $idx + 1 }}</td>
                    <td class="label-cell">{{ $l['oleh_label'] }}</td>
                    <td class="center">{{ \Carbon\Carbon::parse($l['tanggal'])->translatedFormat('d M Y') }}</td>
                    <td class="center">{{ $l['status'] }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Mengetahui,<br />Panitia PKKMB-KT</p>
            <div class="ttd-space"></div>
            <p>( _________________________ )</p>
        </div>
    </div>

    <script>
        // Bisa diaktifkan kalau mau langsung buka dialog print begitu halaman dibuka:
        // window.onload = () => window.print();
    </script>
</body>
</html>
