<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Laporan Absensi — {{ $group->name ?? '-' }} — {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d M Y') }}</title>
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
        table.data td.nama { text-align: left; }
        table.data td.center { text-align: center; }

        .keterangan { font-size: 11px; margin-bottom: 40px; }

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

    <h3 class="judul">Laporan Absensi Kelompok</h3>
    <p class="subjudul">Dicetak sebagai arsip resmi hasil presensi yang telah disubmit</p>

    <table class="meta">
        <tr><td class="label">Kelompok</td><td>: {{ $group->name ?? '-' }}</td></tr>
        <tr><td class="label">Mentor</td><td>: {{ $group->mentor->name ?? '-' }}</td></tr>
        <tr><td class="label">Tanggal</td><td>: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td></tr>
        <tr><td class="label">Jumlah Sesi</td><td>: {{ $sesiList->count() }} sesi</td></tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width:28px">No</th>
                <th style="text-align:left">Nama Mahasiswa</th>
                @foreach ($sesiList as $i => $sesi)
                    <th style="width:60px">Sesi {{ $i + 1 }}<br><span style="font-weight:normal">{{ $sesi->template->session_name ?? '-' }}</span></th>
                @endforeach
                <th style="width:70px">Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matrix as $idx => $m)
                <tr>
                    <td class="center">{{ $idx + 1 }}</td>
                    <td class="nama">{{ $m['nama'] }}</td>
                    @foreach ($m['sesi'] as $status)
                        @php
                            $huruf = match($status) {
                                'hadir' => 'H', 'izin' => 'I', 'sakit' => 'S', 'alfa' => 'A', default => '-',
                            };
                        @endphp
                        <td class="center">{{ $huruf }}</td>
                    @endforeach
                    <td class="center">{{ $m['persen'] }}%</td>
                </tr>
            @empty
                <tr><td colspan="{{ $sesiList->count() + 3 }}" class="center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p class="keterangan">Keterangan: H = Hadir &nbsp; I = Izin &nbsp; S = Sakit &nbsp; A = Alfa</p>

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
