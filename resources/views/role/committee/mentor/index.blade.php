@extends('layouts.committee.main')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false } // jangan reset style global, biar tidak bentrok dengan CSS halaman lain
        }
    </script>

    @php
        // Import cuma ditampilkan kalau route-nya memang sudah didaftarkan
        // untuk konteks ini (role + admin/panitia) — supaya aman dipakai ulang
        // oleh halaman lain yang belum/tidak perlu fitur import.
        $importBase = \Illuminate\Support\Str::beforeLast(request()->route()->getName(), '.index');
        $showImport = \Illuminate\Support\Facades\Route::has("{$importBase}.import") && \Illuminate\Support\Facades\Route::has("{$importBase}.import-template");
    @endphp

    <div class="flex items-center justify-between flex-wrap gap-3 mb-5">
        <div>
            <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 m-0">Kelola Data</p>
            <h2 class="text-2xl font-extrabold text-slate-800 m-0">{{ $data['title'] }}</h2>
        </div>
        <div class="flex items-center gap-2 flex-wrap w-full sm:w-auto">
            @if ($showImport)
                <button id="btnImport"
                    class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="upload" class="w-4 h-4"></i>Import Excel/CSV
                </button>
                <button id="btnExportHasil"
                    class="inline-flex items-center gap-2 bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i data-lucide="download" class="w-4 h-4"></i>Riwayat Import
                </button>
            @endif
            <button id="btnTambah"
                class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">
                <i data-lucide="user-plus" class="w-4 h-4"></i>Tambah {{ $roleLabel }}
            </button>
        </div>
    </div>

    @if ($showImport)
        <!-- ===== MODAL IMPORT EXCEL/CSV ===== -->
        <div id="modalImport" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[85vh] overflow-y-auto p-6">
                <div class="flex items-start justify-between gap-4 mb-1">
                    <h3 class="text-lg font-extrabold text-slate-800 m-0">Import {{ $roleLabel }} dari Excel/CSV</h3>
                    <button id="btnCloseImport" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <p class="text-xs text-slate-400 mt-1 mb-4">
                    1) Download dulu templatenya, isi di Excel, simpan sebagai <b>CSV</b> (File &rarr; Save As &rarr; CSV UTF-8), lalu upload di sini.
                    Baris yang bermasalah (email dobel, dll.) akan dilewati dan dilaporkan, tidak menggagalkan baris lain.
                </p>

                <a href="{{ route("{$importBase}.import-template") }}"
                    class="inline-flex items-center gap-2 text-teal-600 font-bold text-sm mb-4 hover:underline">
                    <i data-lucide="download" class="w-4 h-4"></i>Download Template CSV
                </a>

                <form id="formImport">
                    <div id="importError" class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3"></div>
                    <input type="file" id="inputFileImport" accept=".csv,.txt" required
                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-500 cursor-pointer focus:outline-none focus:border-teal-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-teal-600 file:text-white file:font-bold file:text-xs file:cursor-pointer hover:file:bg-teal-700" />
                    <div class="flex items-center justify-end gap-3 mt-5">
                        <button type="button" id="btnBatalImport" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                        <button type="submit" id="btnProsesImport" class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Proses Import</button>
                    </div>
                </form>

                <div id="importResult" class="hidden mt-5 pt-4 border-t border-slate-100">
                    <p id="importSummary" class="text-sm font-bold text-slate-800 mb-3"></p>
                    <div id="importBerhasilWrap" class="hidden mb-4">
                        <div class="flex items-center justify-between mb-1.5">
                            <p class="text-xs font-bold text-teal-600 m-0">Akun berhasil dibuat:</p>
                            <button type="button" id="btnDownloadHasil"
                                class="inline-flex items-center gap-1.5 bg-teal-50 hover:bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                <i data-lucide="download" class="w-3.5 h-3.5"></i>Download Hasil (CSV)
                            </button>
                        </div>
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <div class="max-h-52 overflow-y-auto overflow-x-auto">
                                <table class="w-full text-xs border-collapse">
                                    <thead class="sticky top-0 z-10">
                                        <tr class="bg-slate-100">
                                            <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Nama</th>
                                            <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Email</th>
                                            <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Password</th>
                                            <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Kelompok</th>
                                        </tr>
                                    </thead>
                                    <tbody id="importBerhasilList"></tbody>
                                </table>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1.5">Geser tabel ke samping kalau kepotong di layar kecil. Catat/kirim password ini ke mahasiswa &mdash; tidak ditampilkan lagi setelah modal ditutup. Kalau lupa, klik "Download Hasil (CSV)" dulu sebelum menutup ini, atau gunakan tombol "Riwayat Import" di halaman utama kapan saja.</p>
                    </div>
                    <div id="importGagalWrap" class="hidden">
                        <p class="text-xs font-bold text-rose-500 mb-1.5">Baris bermasalah:</p>
                        <ul id="importGagalList" class="text-xs text-rose-600 list-disc pl-4 space-y-1"></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== MODAL RIWAYAT IMPORT (dengan filter) ===== -->
        <div id="modalExport" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl w-full max-w-lg max-h-[85vh] overflow-y-auto p-6">
                <div class="flex items-start justify-between gap-4 mb-1">
                    <h3 class="text-lg font-extrabold text-slate-800 m-0">Riwayat Import</h3>
                    <button id="btnCloseExport" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <p class="text-xs text-slate-400 mt-1 mb-4">
                    Berisi akun yang <b>dibuat lewat Import Excel/CSV</b> di halaman ini (nama, email, password{{ $showGroup ? ', kelompok' : '' }}{{ $showAcademic ? ', prodi' : '' }}).
                    Kosongkan filter untuk export semua. Data ini tersimpan di browser ini saja &mdash; mahasiswa yang dibuat manual lewat tombol "Tambah" atau yang sudah ada sebelum fitur ini dipasang <b>tidak akan muncul di sini</b>, karena passwordnya sudah tidak bisa diambil lagi setelah tersimpan di database.
                </p>
                <div class="grid grid-cols-1 gap-4">
                    @if ($showAcademic)
                        <div>
                            <label for="exportFilterProdi" class="block text-xs font-bold text-slate-500 mb-1.5">Program Studi</label>
                            <select id="exportFilterProdi"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Semua Program Studi</option>
                            </select>
                        </div>
                    @endif
                    @if ($showGroup)
                        <div>
                            <label for="exportFilterKelompok" class="block text-xs font-bold text-slate-500 mb-1.5">Kode Kelompok</label>
                            <select id="exportFilterKelompok"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Semua Kelompok</option>
                            </select>
                        </div>
                    @endif
                </div>

                <p id="exportInfo" class="text-xs text-slate-400 mt-3 mb-1.5">0 akun ditemukan.</p>
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <div class="max-h-64 overflow-y-auto overflow-x-auto">
                        <table class="w-full text-xs border-collapse">
                            <thead class="sticky top-0 z-10">
                                <tr class="bg-slate-100">
                                    <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Nama</th>
                                    <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Email</th>
                                    <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Password</th>
                                    @if ($showGroup)
                                        <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Kelompok</th>
                                    @endif
                                    @if ($showAcademic)
                                        <th class="text-left px-3 py-2 font-bold text-slate-500 whitespace-nowrap">Prodi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="exportRiwayatList"></tbody>
                        </table>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5">Geser tabel ke samping kalau kepotong di layar kecil.</p>

                <div class="flex items-center justify-between gap-3 mt-6">
                    <button type="button" id="btnHapusRiwayatExport"
                        class="text-rose-500 hover:underline text-xs font-bold">Hapus riwayat</button>
                    <div class="flex items-center gap-3">
                        <button type="button" id="btnBatalExport"
                            class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                        <button type="button" id="btnProsesExport"
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition">Export CSV</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
        <div class="flex items-center gap-2.5 p-4 border-b border-slate-200 flex-wrap">
            <select id="filterStatus"
                class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
               @if ($showAcademic)
            <select id="filterProdi"
                class="text-sm font-semibold text-slate-800 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 cursor-pointer focus:outline-none focus:border-teal-600">
                <option value="">Semua Program Studi</option>
                @foreach ($faculties as $f)
                    @foreach ($f->programStudies as $p)
                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                    @endforeach
                @endforeach
            </select>
            @endif

            <div
                class="flex-1 min-w-[200px] flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                <input type="text" id="searchPengguna" placeholder="Cari nama atau email..."
                    class="border-none bg-transparent text-sm text-slate-800 w-full focus:outline-none" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            No</th>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Nama</th>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Email</th>
                        @if ($showAcademic)
                            <th
                                class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                                No. HP</th>
                            <th
                                class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                                Prodi</th>
                        @endif
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Status</th>
                        <th
                            class="text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-400 px-3.5 py-3 bg-slate-100 whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelPengguna"></tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-4 flex-wrap gap-3">
            <p id="paginationInfo" class="text-xs font-semibold text-slate-400 m-0">Showing 0 of 0</p>
            <div id="paginationBtns" class="flex items-center gap-1.5"></div>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH / EDIT PENGGUNA ===== -->
    <div id="modalForm" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto p-6">
            <div class="flex items-start justify-between gap-4 mb-1">
                <div>
                    <h3 id="modalFormTitle" class="text-lg font-extrabold text-slate-800 m-0">Tambah {{ $roleLabel }}</h3>
                    <p class="text-xs text-slate-400 m-0 mt-1">Buat akun {{ strtolower($roleLabel) }} baru untuk sistem
                        PKKMB-KT.</p>
                </div>
                <button id="btnCloseForm" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="formPengguna" class="mt-4">
                <p id="formError"
                    class="hidden text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg px-3 py-2 mb-3">
                </p>
                <div class="grid grid-cols-1 gap-4">
                    @if ($showNpm)
                        <div>
                            <label for="inputNpm" class="block text-xs font-bold text-slate-500 mb-1.5">NPM</label>
                            <input type="text" id="inputNpm" placeholder="Contoh: 525241019"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                        </div>
                    @endif

                    <div>
                        <label for="inputNama" class="block text-xs font-bold text-slate-500 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="inputNama" placeholder="CONTOH: DENI SAPUTRA" required
                            oninput="this.value = this.value.toUpperCase()"
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                    </div>
                    <div>
                        <label for="inputEmail" class="block text-xs font-bold text-slate-500 mb-1.5">Email</label>
                        <input type="email" id="inputEmail" placeholder="nama@pkkmb.ac.id" required
                            class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                    </div>
                    <div>
                        <label for="inputPassword" class="block text-xs font-bold text-slate-500 mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" id="inputPassword" placeholder="Minimal 8 karakter"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 pr-10 focus:outline-none focus:border-teal-600" />
                            <button type="button" id="btnTogglePw"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <p id="hintPassword" class="text-xs text-slate-400 mt-1.5">Kosongkan saat edit jika tidak ingin
                            mengubah password.</p>
                    </div>

                    @if ($showAcademic)
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="inputPhone" class="block text-xs font-bold text-slate-500 mb-1.5">No. HP</label>
                                <input type="text" id="inputPhone" placeholder="08xxxxxxxxxx" required
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:outline-none focus:border-teal-600" />
                            </div>
                            <div>
                                <label for="inputGender" class="block text-xs font-bold text-slate-500 mb-1.5">Jenis
                                    Kelamin</label>
                                <select id="inputGender" required
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="inputFakultas" class="block text-xs font-bold text-slate-500 mb-1.5">Fakultas</label>
                            <select id="inputFakultas" required
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Pilih Fakultas</option>
                                @foreach ($faculties as $f)
                                    <option value="{{ $f->name }}">{{ $f->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="inputProdi" class="block text-xs font-bold text-slate-500 mb-1.5">Program Studi</label>
                            <select id="inputProdi" required disabled
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600 disabled:bg-slate-50">
                                <option value="">Pilih Fakultas dahulu</option>
                            </select>
                        </div>
                    @endif
                    @if ($showGroup)
                        <div>
                            <label for="inputKelompok" class="block text-xs font-bold text-slate-500 mb-1.5">Kelompok</label>
                            <select id="inputKelompok"
                                class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 cursor-pointer focus:outline-none focus:border-teal-600">
                                <option value="">Belum ada kelompok</option>
                                @foreach ($groups as $g)
                                    <option value="{{ $g->id }}">{{ $g->code }} &mdash; {{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">Status</label>
                        <div class="flex items-center gap-3 h-[42px]">
                            <label class="inline-flex items-center gap-1.5 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="statusPengguna" value="aktif" checked class="accent-teal-600" />
                                Aktif
                            </label>
                            <label class="inline-flex items-center gap-1.5 text-sm text-slate-700 cursor-pointer">
                                <input type="radio" name="statusPengguna" value="nonaktif" class="accent-teal-600" />
                                Nonaktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" id="btnBatalForm"
                        class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSimpanForm"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm px-4 py-2.5 rounded-xl transition disabled:opacity-60">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL DETAIL PENGGUNA ===== -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black/50 items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl w-full max-w-md p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <h3 class="text-lg font-extrabold text-slate-800 m-0">Detail {{ $roleLabel }}</h3>
                <button id="btnCloseDetail" aria-label="Tutup" class="text-slate-400 hover:text-slate-700 shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <div class="divide-y divide-slate-100">
                @if ($showNpm)
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">NPM</span><span id="detailNpm"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                @endif
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Nama</span><span id="detailNama"
                        class="text-sm font-semibold text-slate-800">-</span></div>
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Email</span><span id="detailEmail"
                        class="text-sm font-semibold text-slate-800">-</span></div>
                @if ($showAcademic)
                    <div class="flex items-center justify-between py-2.5"><span class="text-xs font-bold text-slate-400">No.
                            HP</span><span id="detailPhone" class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span class="text-xs font-bold text-slate-400">Jenis
                            Kelamin</span><span id="detailGender" class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">Fakultas</span><span id="detailFakultas"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">Prodi</span><span id="detailProdi"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                @endif
                @if ($showGroup)
                    <div class="flex items-center justify-between py-2.5"><span
                            class="text-xs font-bold text-slate-400">Kelompok</span><span id="detailKelompok"
                            class="text-sm font-semibold text-slate-800">-</span></div>
                @endif
                <div class="flex items-center justify-between py-2.5"><span
                        class="text-xs font-bold text-slate-400">Status</span><span id="detailStatus"
                        class="text-sm font-semibold text-slate-800">-</span></div>
            </div>
            <div class="flex items-center justify-end mt-6">
                <button type="button" id="btnEditDariDetail"
                    class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-sm px-4 py-2.5 rounded-xl transition">Edit</button>
            </div>
        </div>
    </div>
@endsection

@php
    $penggunaListJson = $users->map(fn($u) => [
        'id' => $u->id,
        'nama' => $u->name,
        'email' => $u->email,
        'status' => $u->status,
        'phone_no' => $u->phone_no,
        'faculty_name' => $u->faculty_name,
        'program_study_name' => $u->program_study_name,
        'gender' => $u->gender,
        'npm' => $u->npm,
        'group_id' => $u->group_id ?? null,
    ]);
@endphp

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {

            // ===== Data asli dari database (dikirim server saat halaman dimuat) =====
            let penggunaList = @json($penggunaListJson);
            const SHOW_ACADEMIC = @json($showAcademic);
            const SHOW_GROUP = @json($showGroup);
            const SHOW_NPM = @json($showNpm);
            const GROUPS_MAP = @json($groups instanceof \Illuminate\Support\Collection ? $groups->mapWithKeys(fn($g) => [$g->id => $g->code . ' — ' . $g->name]) : []);
            const FACULTIES = @json($faculties); // [{id, name, program_studies: [{id, name}, ...]}]
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Base URL sama untuk index/store, tinggal tambah /{id} untuk update & delete.
            // Otomatis mengikuti halaman mana pun ini dipanggil (kelola-mahasiswa, kelola-mentor, dst).
            const URL_BASE = "{{ url()->current() }}";

            const PER_PAGE = 25;
            let currentPage = 1;
            let editingId = null;

            // Normalisasi teks prodi sebelum dibandingkan -- data lama hasil Import
            // Excel/CSV kadang nyimpen teks apa adanya dari file (mis. "S1 AKUNTANSI"),
            // beda format sama master Program Studi yang dipakai buat isi dropdown
            // filter (mis. "S-1 AKUNTANSI"). Tanpa ini, filter prodi gagal nemuin
            // data yang sebenarnya ada (perbandingan string exact-match gagal
            // gara-gara beda tanda hubung/spasi/huruf besar-kecil doang).
            function normalisasiProdi(teks) {
                return (teks || "").toUpperCase().replace(/[^A-Z0-9]/g, "");
            }

            function filteredData() {
            const status = $("#filterStatus").val();
            const q = $("#searchPengguna").val().trim().toLowerCase();
            const prodi = $("#filterProdi").val(); // tambahan

            return penggunaList.filter((p) =>
                (!status || p.status === status) &&
                (!prodi || normalisasiProdi(p.program_study_name) === normalisasiProdi(prodi)) && // tambahan
                (!q || p.nama.toLowerCase().includes(q) || p.email.toLowerCase().includes(q))
            );
        }

            function badgeClass(status) {
                return status === "aktif" ? "bg-teal-50 text-teal-600" : "bg-rose-50 text-rose-500";
            }

            function genderLabel(g) {
                return g === "L" ? "Laki-laki" : g === "P" ? "Perempuan" : "-";
            }

            // Isi ulang dropdown Program Studi sesuai Fakultas yang dipilih.
            // Kalau selectedProdiName cocok dengan salah satu opsi, otomatis ke-pilih (dipakai saat bukaForm edit).
            function isiOpsiProdi(facultyName, selectedProdiName) {
                const faculty = FACULTIES.find((f) => f.name === facultyName);
                const programs = faculty ? faculty.program_studies : [];
                const opts = programs
                    .map((p) => `<option value="${p.name}" ${selectedProdiName === p.name ? "selected" : ""}>${p.name}</option>`)
                    .join("");
                $("#inputProdi")
                    .html(`<option value="">${programs.length ? "Pilih Program Studi" : "Pilih Fakultas dahulu"}</option>${opts}`)
                    .prop("disabled", programs.length === 0);
            }

            $("#inputFakultas").on("change", function () {
                isiOpsiProdi($(this).val(), null);
            });

            function renderTabel() {
                const data = filteredData();
                const totalData = data.length;
                const totalPage = Math.max(1, Math.ceil(totalData / PER_PAGE));
                if (currentPage > totalPage) currentPage = totalPage;
                const start = (currentPage - 1) * PER_PAGE;
                const pageData = data.slice(start, start + PER_PAGE);
                const totalCols = SHOW_ACADEMIC ? 7 : 5;

                let html;
                if (pageData.length === 0) {
                    html = `<tr><td colspan="${totalCols}" class="text-center py-6 text-slate-400 text-sm">Tidak ada data ditemukan.</td></tr>`;
                } else {
                    html = pageData.map((p, idx) => `
                            <tr class="hover:bg-slate-50">
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${start + idx + 1}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200 font-semibold">${p.nama}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.email}</td>
                                ${SHOW_ACADEMIC ? `
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.phone_no ?? "-"}</td>
                                <td class="px-3.5 py-3 text-sm text-slate-800 border-b border-slate-200">${p.program_study_name ?? "-"}</td>
                                ` : ""}
                                <td class="px-3.5 py-3 border-b border-slate-200">
                                    <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-full ${badgeClass(p.status)}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>${p.status === "aktif" ? "Aktif" : "Nonaktif"}
                                    </span>
                                </td>
                                <td class="px-3.5 py-3 border-b border-slate-200">
                                    <div class="flex items-center gap-1">
                                        <button data-aksi="lihat" data-id="${p.id}" aria-label="Detail" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="eye" class="w-4 h-4"></i></button>
                                        <button data-aksi="edit" data-id="${p.id}" aria-label="Edit" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                                        <button data-aksi="hapus" data-id="${p.id}" aria-label="Hapus" class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>`).join("");
                }
                $("#tabelPengguna").html(html);
                $("#paginationInfo").text(
                    totalData === 0 ? "Showing 0 of 0" : `Showing ${start + 1}-${Math.min(start + PER_PAGE, totalData)} of ${totalData}`
                );
                renderPaginationBtns(totalPage);
                lucide.createIcons();
                pasangEventAksiBaris();
            }

            function renderPaginationBtns(totalPage) {
                const btnBase = "w-8 h-8 flex items-center justify-center rounded-lg border text-sm font-semibold transition";
                let html = `<button id="pgPrev" aria-label="Sebelumnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>`;
                for (let p = 1; p <= totalPage; p++) {
                    const active = p === currentPage ? "bg-teal-600 text-white border-teal-600" : "border-slate-200 text-slate-600 hover:bg-slate-50";
                    html += `<button data-page="${p}" class="${btnBase} ${active}">${p}</button>`;
                }
                html += `<button id="pgNext" aria-label="Berikutnya" class="${btnBase} border-slate-200 text-slate-500 hover:bg-slate-50"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>`;
                $("#paginationBtns").html(html);
                lucide.createIcons();
                $("[data-page]").on("click", function () { currentPage = Number($(this).data("page")); renderTabel(); });
                $("#pgPrev").on("click", () => { if (currentPage > 1) { currentPage--; renderTabel(); } });
                $("#pgNext").on("click", () => { if (currentPage < totalPage) { currentPage++; renderTabel(); } });
            }

            function pasangEventAksiBaris() {
                $('[data-aksi="lihat"]').on("click", function () { bukaDetail(Number($(this).data("id"))); });
                $('[data-aksi="edit"]').on("click", function () { bukaForm(Number($(this).data("id"))); });
                $('[data-aksi="hapus"]').on("click", function () { hapusPengguna(Number($(this).data("id"))); });
            }

            $("#filterStatus").on("change", () => { currentPage = 1; renderTabel(); });
            $("#searchPengguna").on("keyup", () => { currentPage = 1; renderTabel(); });
            $("#filterProdi").on("change", () => { currentPage = 1; renderTabel(); });

            const $modalForm = $("#modalForm");
            const $modalDetail = $("#modalDetail");
            const $formError = $("#formError");

            function bukaForm(id) {
                editingId = id || null;
                $formError.addClass("hidden");
                const data = id ? penggunaList.find((p) => p.id === id) : null;
                $("#modalFormTitle").text(id ? "Edit {{ $roleLabel }}" : "Tambah {{ $roleLabel }}");
                $("#inputNama").val(data ? data.nama : "");
                $("#inputEmail").val(data ? data.email : "");
                $("#inputPassword").val("").prop("required", !id);
                $("#hintPassword").toggle(!!id);

                if (SHOW_ACADEMIC) {
                    $("#inputPhone").val(data ? data.phone_no : "");
                    $("#inputGender").val(data ? data.gender : "");
                    $("#inputFakultas").val(data ? data.faculty_name : "");
                    isiOpsiProdi(data ? data.faculty_name : "", data ? data.program_study_name : null);
                }

                if (SHOW_NPM) {
                    $("#inputNpm").val(data ? (data.npm || "") : "");
                }

                if (SHOW_GROUP) {
                    $("#inputKelompok").val(data && data.group_id ? data.group_id : "");
                }

                $('input[name="statusPengguna"]').each(function () { this.checked = this.value === (data ? data.status : "aktif"); });
                $modalForm.removeClass("hidden").addClass("flex");
            }
            function tutupForm() { $modalForm.addClass("hidden").removeClass("flex"); editingId = null; $("#formPengguna")[0].reset(); }

            $("#btnTambah").on("click", () => bukaForm(null));

            @if ($showImport)
            // ================== IMPORT EXCEL/CSV + EXPORT HASIL (dengan filter & riwayat) ==================
            const $modalImport = $("#modalImport");

            if ($modalImport.length) {

                // Riwayat semua hasil import sekarang disimpan di SERVER (dulu di
                // localStorage browser, makanya cuma keliatan di browser/akun yang
                // ngimport doang). Dengan ini, semua admin/panitia bisa lihat riwayat
                // yang sama, dari akun manapun.
                let riwayatCache = [];

                function muatRiwayatDariServer(callback) {
                    $.get("{{ route(\"{$importBase}.import-history\") }}")
                        .done(function (result) {
                            riwayatCache = result.riwayat || [];
                            if (callback) callback();
                        })
                        .fail(function () {
                            riwayatCache = [];
                            if (callback) callback();
                        });
                }
                // Cegah CSV/Formula Injection: kalau nilai diawali =, +, -, @, atau
                // tab/CR, Excel/Sheets akan menganggapnya sebagai FORMULA saat file
                // dibuka, bukan teks biasa. Nama mentor diisi bebas oleh user,
                // jadi harus dinetralkan sebelum masuk CSV.
                function netralkanFormula(v) {
                    const s = String(v);
                    return /^[=+\-@\t\r]/.test(s) ? "'" + s : s;
                }
                function unduhCSV(list, namaFile) {
                if (!list || !list.length) return;
                const header = ["Nama", "Email", "Password"];
                if (SHOW_GROUP) header.push("Kelompok");
                if (SHOW_ACADEMIC) header.push("Program Studi");
                const baris = [header];
                list.forEach((b) => {
                    const row = [b.nama, b.email, b.password];
                    if (SHOW_GROUP) row.push(b.kelompok || "-");
                    if (SHOW_ACADEMIC) row.push(b.prodi || "-");
                    baris.push(row);
                });
                const csv = "\uFEFF" + "sep=,\r\n" + baris
                    .map((r) => r.map((v) => `"${netralkanFormula(v).replace(/"/g, '""')}"`).join(","))
                    .join("\r\n");

                const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
                const url = URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = namaFile;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                }
                   
                let lastImportBerhasil = [];

                function bukaImport() {
                    $("#importError").addClass("hidden");
                    $("#importResult").addClass("hidden");
                    $("#formImport")[0].reset();
                    $modalImport.removeClass("hidden").addClass("flex");
                }
                function tutupImport() { $modalImport.addClass("hidden").removeClass("flex"); }

                $("#btnImport").on("click", bukaImport);
                $("#btnCloseImport").on("click", tutupImport);
                $("#btnBatalImport").on("click", tutupImport);
                $modalImport.on("click", function (e) { if (e.target === this) tutupImport(); });

                $("#formImport").on("submit", function (e) {
                    e.preventDefault();
                    const file = document.getElementById("inputFileImport").files[0];
                    if (!file) return;

                    const fd = new FormData();
                    fd.append("file", file);

                    const $btn = $("#btnProsesImport");
                    $btn.prop("disabled", true);
                    $("#importError").addClass("hidden");
                    $("#importResult").addClass("hidden");

                    $.ajax({
                        url: "{{ route("{$importBase}.import") }}",
                        method: "POST",
                        data: fd,
                        processData: false,
                        contentType: false,
                        headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    }).done(function (result) {
                        lastImportBerhasil = result.berhasil || [];

                        // masukkan akun baru ke tabel tanpa reload halaman
                        (result.berhasil || []).forEach((b) => {
                            penggunaList.push({
                                id: b.id, nama: b.nama, email: b.email, status: "aktif",
                                phone_no: null, faculty_name: null, program_study_name: b.prodi || null,
                                gender: null,
                            });
                        });
                        if (typeof renderTabel === "function") renderTabel();

                        $("#importSummary").text(result.message);
                        $("#importBerhasilWrap").toggleClass("hidden", !(result.berhasil && result.berhasil.length));
                        const $bList = $("#importBerhasilList").empty();
                        (result.berhasil || []).forEach((b) => {
                            $bList.append(`<tr class="border-t border-slate-100 hover:bg-slate-50"><td class="px-3 py-2 whitespace-nowrap font-semibold text-slate-700">${b.nama}</td><td class="px-3 py-2 whitespace-nowrap text-slate-500">${b.email}</td><td class="px-3 py-2 whitespace-nowrap"><span class="font-mono bg-amber-50 text-amber-700 px-2 py-0.5 rounded">${b.password}</span></td><td class="px-3 py-2 whitespace-nowrap text-slate-500">${b.kelompok || "-"}</td></tr>`);
                        });
                        $("#importGagalWrap").toggleClass("hidden", !(result.gagal && result.gagal.length));
                        const $gList = $("#importGagalList").empty();
                        (result.gagal || []).forEach((g) => $gList.append(`<li>${g}</li>`));

                        $("#importResult").removeClass("hidden");
                        $("#formImport")[0].reset();
                        tampilkanToast(result.message);
                    }).fail(function (xhr) {
                        const result = xhr.responseJSON || {};
                        $("#importError").text(result.message || "Gagal memproses file.").removeClass("hidden");
                    }).always(function () {
                        $btn.prop("disabled", false);
                    });
                });

                $("#btnDownloadHasil").on("click", function () {
                    unduhCSV(lastImportBerhasil, `hasil_import_{{ \Illuminate\Support\Str::slug($roleLabel) }}_${new Date().toISOString().slice(0, 10)}.csv`);
                });

                // ===== EXPORT DENGAN FILTER (riwayat semua sesi import, dari server) =====
                const $modalExport = $("#modalExport");
                if ($modalExport.length) {
                    function isiOpsiFilterExport() {
                        const data = riwayatCache;
                        if (SHOW_ACADEMIC) {
                            const prodiSet = [...new Set(data.map((d) => d.prodi).filter(Boolean))].sort();
                            $("#exportFilterProdi").html(`<option value="">Semua Program Studi</option>` + prodiSet.map((p) => `<option value="${p}">${p}</option>`).join(""));
                        }
                        if (SHOW_GROUP) {
                            const kelompokSet = [...new Set(data.map((d) => d.kelompok).filter(Boolean))].sort();
                            $("#exportFilterKelompok").html(`<option value="">Semua Kelompok</option>` + kelompokSet.map((k) => `<option value="${k}">${k}</option>`).join(""));
                        }
                        perbaruiInfoExport();
                    }

                    function dataTerfilterExport() {
                        const prodi = $("#exportFilterProdi").val() || "";
                        const kelompok = $("#exportFilterKelompok").val() || "";
                        return riwayatCache.filter((d) =>
                            (!prodi || normalisasiProdi(d.prodi) === normalisasiProdi(prodi)) && (!kelompok || d.kelompok === kelompok)
                        );
                    }

                    function perbaruiInfoExport() {
                        const data = dataTerfilterExport();
                        $("#exportInfo").text(`${data.length} akun ditemukan.`);

                        const $list = $("#exportRiwayatList").empty();
                        if (!data.length) {
                            const kolom = 3 + (SHOW_GROUP ? 1 : 0) + (SHOW_ACADEMIC ? 1 : 0);
                            $list.append(`<tr><td colspan="${kolom}" class="text-center text-slate-400 py-4">Tidak ada data.</td></tr>`);
                            return;
                        }
                        data.forEach((b) => {
                            const kolomKelompok = SHOW_GROUP ? `<td class="px-3 py-2 whitespace-nowrap text-slate-500">${b.kelompok || "-"}</td>` : "";
                            const kolomProdi = SHOW_ACADEMIC ? `<td class="px-3 py-2 whitespace-nowrap text-slate-500">${b.prodi || "-"}</td>` : "";
                            $list.append(`<tr class="border-t border-slate-100 hover:bg-slate-50"><td class="px-3 py-2 whitespace-nowrap font-semibold text-slate-700">${b.nama}</td><td class="px-3 py-2 whitespace-nowrap text-slate-500">${b.email}</td><td class="px-3 py-2 whitespace-nowrap"><span class="font-mono bg-amber-50 text-amber-700 px-2 py-0.5 rounded">${b.password}</span></td>${kolomKelompok}${kolomProdi}</tr>`);
                        });
                    }

                    $("#exportFilterProdi, #exportFilterKelompok").on("change", perbaruiInfoExport);

                    $("#btnExportHasil").on("click", function () {
                        muatRiwayatDariServer(function () {
                            isiOpsiFilterExport();
                            $modalExport.removeClass("hidden").addClass("flex");
                        });
                    });
                    $("#btnCloseExport, #btnBatalExport").on("click", () => $modalExport.addClass("hidden").removeClass("flex"));
                    $modalExport.on("click", function (e) { if (e.target === this) $modalExport.addClass("hidden").removeClass("flex"); });

                    $("#btnProsesExport").on("click", function () {
                        const data = dataTerfilterExport();
                        if (!data.length) { alert("Tidak ada data untuk kriteria ini."); return; }
                        unduhCSV(data, `export_akun_{{ \Illuminate\Support\Str::slug($roleLabel) }}_${new Date().toISOString().slice(0, 10)}.csv`);
                    });

                    $("#btnHapusRiwayatExport").on("click", function () {
                        if (!confirm("Hapus semua riwayat password hasil import ini untuk SEMUA admin/panitia?\n\nAkun yang sudah dibuat tidak akan terhapus, hanya catatan password ini.")) return;
                        $.ajax({
                            url: "{{ route(\"{$importBase}.import-history.clear\") }}",
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": CSRF_TOKEN },
                        }).always(function () {
                            muatRiwayatDariServer(isiOpsiFilterExport);
                        });
                    });
                }
            }
            @endif
            $("#btnCloseForm").on("click", tutupForm);
            $("#btnBatalForm").on("click", tutupForm);
            $modalForm.on("click", function (e) { if (e.target === this) tutupForm(); });
            $("#btnTogglePw").on("click", () => {
                const $inp = $("#inputPassword");
                $inp.attr("type", $inp.attr("type") === "password" ? "text" : "password");
            });

            $("#formPengguna").on("submit", function (e) {
                e.preventDefault();
                $formError.addClass("hidden");

                const statusVal = $('input[name="statusPengguna"]:checked').val() || "aktif";
                const payload = {
                    name: $("#inputNama").val().trim().toUpperCase(),
                    email: $("#inputEmail").val().trim(),
                    password: $("#inputPassword").val(),
                    status: statusVal,
                };

                if (SHOW_ACADEMIC) {
                    payload.phone_no = $("#inputPhone").val().trim();
                    payload.gender = $("#inputGender").val();
                    payload.faculty_name = $("#inputFakultas").val().trim();
                    payload.program_study_name = $("#inputProdi").val().trim();
                }

                if (SHOW_NPM) {
                    payload.npm = $("#inputNpm").val().trim();
                }

                if (SHOW_GROUP) {
                    payload.group_id = $("#inputKelompok").val() || null;
                }

                const $btnSimpan = $("#btnSimpanForm");
                $btnSimpan.prop("disabled", true);

                const url = editingId ? `${URL_BASE}/${editingId}` : URL_BASE;
                const method = editingId ? "PUT" : "POST";

                $.ajax({
                    url, method,
                    contentType: "application/json",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                    data: JSON.stringify(payload),
                }).done(function (result) {
                    const savedUser = {
                        id: result.user.id,
                        nama: result.user.name,
                        email: result.user.email,
                        status: result.user.status,
                        phone_no: result.user.phone_no,
                        faculty_name: result.user.faculty_name,
                        program_study_name: result.user.program_study_name,
                        gender: result.user.gender,
                        npm: result.user.npm,
                        group_id: result.user.group_id,
                    };
                    if (editingId) {
                        const idx = penggunaList.findIndex((p) => p.id === editingId);
                        if (idx > -1) penggunaList[idx] = savedUser;
                    } else {
                        penggunaList.push(savedUser);
                    }
                    tampilkanToast(result.message);
                    tutupForm();
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    if (result.errors) {
                        $formError.text(Object.values(result.errors).flat().join(" "));
                    } else if (xhr.status === 404) {
                        $formError.text("Data ini sudah tidak ditemukan (mungkin sudah dihapus/berubah). Silakan tutup form ini dan refresh halaman.");
                    } else {
                        $formError.text(result.message || "Terjadi kesalahan, silakan coba lagi.");
                    }
                    $formError.removeClass("hidden");
                }).always(function () {
                    $btnSimpan.prop("disabled", false);
                });
            });

            let detailActiveId = null;
            function bukaDetail(id) {
                const p = penggunaList.find((x) => x.id === id);
                if (!p) return;
                detailActiveId = id;
                $("#detailNama").text(p.nama);
                $("#detailEmail").text(p.email);
                if (SHOW_NPM) {
                    $("#detailNpm").text(p.npm || "-");
                }
                if (SHOW_ACADEMIC) {
                    $("#detailPhone").text(p.phone_no || "-");
                    $("#detailGender").text(genderLabel(p.gender));
                    $("#detailFakultas").text(p.faculty_name || "-");
                    $("#detailProdi").text(p.program_study_name || "-");
                }
                if (SHOW_GROUP) {
                    $("#detailKelompok").text(p.group_id ? (GROUPS_MAP[p.group_id] || "-") : "Belum ada kelompok");
                }
                $("#detailStatus").text(p.status === "aktif" ? "Aktif" : "Nonaktif");
                $modalDetail.removeClass("hidden").addClass("flex");
            }
            $("#btnCloseDetail").on("click", () => $modalDetail.addClass("hidden").removeClass("flex"));
            $modalDetail.on("click", function (e) { if (e.target === this) $modalDetail.addClass("hidden").removeClass("flex"); });
            $("#btnEditDariDetail").on("click", () => {
                const id = detailActiveId;
                $modalDetail.addClass("hidden").removeClass("flex");
                bukaForm(id);
            });

            function hapusPengguna(id) {
                const p = penggunaList.find((x) => x.id === id);
                if (!p) return;
                if (!confirm(`Hapus "${p.nama}"?`)) return;

                $.ajax({
                    url: `${URL_BASE}/${id}`,
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CSRF_TOKEN, "Accept": "application/json" },
                }).done(function (result) {
                    penggunaList = penggunaList.filter((x) => x.id !== id);
                    tampilkanToast(result.message);
                    renderTabel();
                }).fail(function (xhr) {
                    const result = xhr.responseJSON || {};
                    tampilkanToast(result.message || "Gagal menghapus data.");
                });
            }

            renderTabel();
        });
    </script>
@endpush