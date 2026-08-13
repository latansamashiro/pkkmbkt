@php
    $layoutDipakai = request()->routeIs('committee.*')
        ? 'layouts.committee.main'
        : (request()->routeIs('role.advisor.*') ? 'layouts.advisor.main' : 'layouts.admin.main');
@endphp
@extends($layoutDipakai)
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    gold: { 500: '#d4a017', tint: '#fdf6e3' },
                    bronze: { 500: '#a9743a' },
                    navy: { 900: '#152159', 700: '#1e3a8f', tint: '#e6e9f6' },
                    teal: { 600: '#0f8a8c', 500: '#16a0a1' },
                    ink: { 900: '#1b2238', 600: '#5b6175', 400: '#8d92a6' },
                    border: '#e1e5f1',
                    bg: '#f2f4fa',
                },
            },
        },
        corePlugins: { preflight: false }
    }
</script>
<script src="https://unpkg.com/lucide@latest"></script>
<style>
    @keyframes crownFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
    .crown-float { animation: crownFloat 2.2s ease-in-out infinite; }

    @keyframes confettiFall {
        0% { transform: translateY(-10px) rotate(0deg); opacity: 1; }
        100% { transform: translateY(220px) rotate(360deg); opacity: 0; }
    }
    .confetti-piece { position: absolute; top: 0; width: 7px; height: 12px; pointer-events: none; animation: confettiFall 1.6s ease-in forwards; }

    @keyframes podiumIn {
        from { opacity: 0; transform: translateY(10px) scale(.96); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .podium-in { animation: podiumIn .45s ease both; }
</style>

<div id="confettiLayer" style="position:fixed;inset:0 0 auto 0;height:0;overflow:visible;pointer-events:none;z-index:70;"></div>

<div class="flex items-center justify-between flex-wrap gap-3 mb-5">
    <div>
        <p class="text-[11px] font-extrabold uppercase tracking-wider text-ink-400 m-0">Monitoring</p>
        <h2 class="text-2xl font-extrabold text-navy-900 m-0">Leaderboard</h2>
    </div>
</div>

<div class="bg-white border border-border rounded-2xl overflow-hidden">
    <div class="p-4 border-b border-border">
        <div class="grid grid-cols-3 gap-1.5 bg-bg border border-border p-[5px] rounded-[13px] max-w-md">
            <button id="tab-all" data-kategori="ALL" class="board-tab text-center text-[12px] font-bold text-ink-600 py-2 px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900 active [&.active]:bg-navy-900 [&.active]:text-white">Leaderboard</button>
            <button id="tab-male" data-kategori="L" class="board-tab text-center text-[12px] font-bold text-ink-600 py-2 px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900 [&.active]:bg-navy-900 [&.active]:text-white">Best Male</button>
            <button id="tab-female" data-kategori="P" class="board-tab text-center text-[12px] font-bold text-ink-600 py-2 px-2 rounded-[10px] border-none bg-transparent cursor-pointer transition-colors hover:text-navy-900 [&.active]:bg-navy-900 [&.active]:text-white">Best Female</button>
        </div>
    </div>

    <div class="p-5">
        <div id="podium-container"></div>

        <p class="text-[11px] font-extrabold uppercase tracking-wider text-ink-400 mt-8 mb-3">Peringkat Selanjutnya</p>
        <div id="leaderboard-list" class="flex flex-col gap-2"></div>

        <button id="btnLoadMore" class="w-full items-center justify-center gap-2 text-[12.5px] font-bold text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-xl mt-3 transition-colors" style="display:none; padding: 12px;">
            <span id="text-btn-load">Lihat Semua Peringkat</span>
        </button>

        <p id="emptyState" class="hidden text-center text-sm text-ink-400 py-10">Belum ada data mahasiswa.</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(function() {
        const dataMahasiswa = @json($dataMahasiswa);
        let kategoriAktif = "ALL";
        let statusLimit = true;

        const $podiumContainer = $("#podium-container");
        const $listContainer = $("#leaderboard-list");
        const $btnLoad = $("#btnLoadMore");

        function renderLeaderboard() {
            let dataFilter = [...dataMahasiswa].sort((a, b) => b.skor - a.skor);
            if (kategoriAktif !== "ALL") {
                dataFilter = dataFilter.filter((m) => m.gender === kategoriAktif);
            }

            if (dataFilter.length === 0) {
                $podiumContainer.html("");
                $listContainer.html("");
                $btnLoad.hide();
                $("#emptyState").removeClass("hidden");
                return;
            }
            $("#emptyState").addClass("hidden");

            const juara1 = dataFilter[0] || { nama: "-", skor: 0, gender: "L" };
            const juara2 = dataFilter[1] || { nama: "-", skor: 0, gender: "L" };
            const juara3 = dataFilter[2] || { nama: "-", skor: 0, gender: "L" };

            function avatarHtml(mhs, fallback) {
                if (mhs.foto) {
                    return `<img src="${mhs.foto}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" class="w-full h-full object-cover" alt="${mhs.nama}"><span style="display:none;align-items:center;justify-content:center;width:100%;height:100%;">${fallback}</span>`;
                }
                return fallback;
            }

            $podiumContainer.html(`
                <div class="flex justify-center items-end gap-3 sm:gap-6 text-center max-w-2xl mx-auto podium-in">
                  <div class="flex-1 flex flex-col items-center">
                    <div class="relative mb-2">
                      <div class="w-14 h-14 sm:w-[76px] sm:h-[76px] rounded-full bg-white border-2 border-border p-0.5 flex items-center justify-center overflow-hidden">
                        <div class="w-full h-full rounded-full bg-navy-tint flex items-center justify-center overflow-hidden">${avatarHtml(juara2, juara2.gender === "L" ? "👦" : "👧")}</div>
                      </div>
                      <span class="absolute -bottom-[3px] -right-[3px] w-5 h-5 text-[10px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-ink-400">2</span>
                    </div>
                    <p class="text-[12px] sm:text-[13px] font-bold text-navy-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[100px] sm:max-w-[140px]">${juara2.nama}</p>
                    <p class="hidden sm:block text-[10.5px] text-ink-400 mt-0.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-[140px]">${juara2.prodi || "&nbsp;"}</p>
                    <p class="text-[12px] sm:text-[13px] font-extrabold mt-0.5 text-teal-600">${juara2.skor}</p>
                    <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-14 sm:h-20 bg-gradient-to-t from-bg to-white border-t border-border"><span class="font-bold text-2xl sm:text-3xl text-ink-400">2</span></div>
                  </div>

                  <div class="flex-1 flex flex-col items-center z-[1] -translate-y-2">
                    <i data-lucide="crown" class="text-gold-500 mb-0.5 crown-float"></i>
                    <div class="relative mb-2">
                      <div class="w-[76px] h-[76px] sm:w-[100px] sm:h-[100px] rounded-full bg-white border-[3px] border-gold-500 p-0.5 flex items-center justify-center overflow-hidden shadow-[0_10px_24px_rgba(21,33,89,0.16)]">
                        <div class="w-full h-full rounded-full bg-gold-tint flex items-center justify-center overflow-hidden">${avatarHtml(juara1, juara1.gender === "L" ? "👑" : "👸")}</div>
                      </div>
                      <span class="absolute -bottom-[3px] -right-[3px] w-6 h-6 text-[11px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-gold-500">1</span>
                    </div>
                    <p class="text-[12.5px] sm:text-[15px] font-extrabold text-navy-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[115px] sm:max-w-[170px]">${juara1.nama}</p>
                    <p class="hidden sm:block text-[11px] text-ink-400 mt-0.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-[170px]">${juara1.prodi || "&nbsp;"}</p>
                    <p class="text-[13px] sm:text-[15.5px] font-extrabold mt-0.5 text-gold-500">${juara1.skor}</p>
                    <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-[92px] sm:h-[124px]" style="background: linear-gradient(to top, #fdf6e3, #fffdf5); border-top: 2px solid rgba(212,160,23,.35);"><span class="font-bold text-[40px] sm:text-[50px]" style="color: rgba(212,160,23,.55);">1</span></div>
                  </div>

                  <div class="flex-1 flex flex-col items-center">
                    <div class="relative mb-2">
                      <div class="w-14 h-14 sm:w-[76px] sm:h-[76px] rounded-full bg-white p-0.5 flex items-center justify-center overflow-hidden" style="border:2px solid rgba(169,116,58,.4);">
                        <div class="w-full h-full rounded-full flex items-center justify-center overflow-hidden" style="background: rgba(169,116,58,.08);">${avatarHtml(juara3, juara3.gender === "L" ? "👦" : "👧")}</div>
                      </div>
                      <span class="absolute -bottom-[3px] -right-[3px] w-5 h-5 text-[10px] text-white rounded-full flex items-center justify-center font-extrabold border-2 border-white bg-bronze-500">3</span>
                    </div>
                    <p class="text-[12px] sm:text-[13px] font-bold text-navy-900 leading-[1.3] whitespace-nowrap overflow-hidden text-ellipsis max-w-[100px] sm:max-w-[140px]">${juara3.nama}</p>
                    <p class="hidden sm:block text-[10.5px] text-ink-400 mt-0.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-[140px]">${juara3.prodi || "&nbsp;"}</p>
                    <p class="text-[12px] sm:text-[13px] font-extrabold mt-0.5 text-teal-600">${juara3.skor}</p>
                    <div class="w-full mt-2.5 rounded-t-xl flex items-center justify-center h-10 sm:h-14 bg-gradient-to-t from-bg to-white border-t border-border"><span class="font-bold text-xl sm:text-2xl text-ink-400">3</span></div>
                  </div>
                </div>
            `);
            if (window.lucide) lucide.createIcons();

            $listContainer.empty();
            const sisaData = dataFilter.slice(3);
            sisaData.forEach((mhs, indeks) => {
                const nomor = indeks + 4;
                const inisial = mhs.nama.split(" ").map((n) => n[0]).join("").substring(0, 2).toUpperCase();
                const sembunyikan = statusLimit && indeks >= 4;
                const $row = $(`
                    <div class="board-row flex items-center justify-between px-3.5 py-3 bg-bg border border-border rounded-[13px] transition-colors hover:border-teal-500 ${sembunyikan ? "hidden" : ""}">
                      <div class="flex items-center gap-2.5">
                        <span class="w-[18px] text-center text-[11px] font-bold text-ink-400">${nomor}</span>
                        <div class="w-[30px] h-[30px] rounded-full bg-navy-tint text-navy-900 text-[10.5px] font-extrabold flex items-center justify-center overflow-hidden">${avatarHtml(mhs, inisial)}</div>
                        <span class="text-[12.5px] font-bold text-navy-900">${mhs.nama}</span>
                      </div>
                      <span class="text-[12.5px] font-extrabold text-teal-600">${mhs.skor}</span>
                    </div>
                `);
                $listContainer.append($row);
            });

            if (!statusLimit || sisaData.length <= 4) {
                $btnLoad.hide();
            } else {
                $btnLoad.css("display", "flex");
                $("#text-btn-load").text(`Lihat Semua Peringkat (${dataFilter.length})`);
            }
        }

        $(".board-tab").on("click", function() {
            kategoriAktif = $(this).data("kategori");
            statusLimit = true;
            $(".board-tab").removeClass("active");
            $(this).addClass("active");
            renderLeaderboard();
        });

        $btnLoad.on("click", function() {
            statusLimit = false;
            renderLeaderboard();
        });

        function tampilkanConfetti() {
            const warna = ["#d4a017", "#0f8a8c", "#a9c73b", "#152159", "#a9743a"];
            const $layer = $("#confettiLayer");
            for (let i = 0; i < 26; i++) {
                const kiri = 10 + Math.random() * 80;
                $layer.append($("<span>").addClass("confetti-piece").css({
                    left: kiri + "%",
                    background: warna[i % warna.length],
                    animationDelay: (Math.random() * 0.3) + "s",
                    borderRadius: Math.random() > 0.5 ? "50%" : "2px",
                }));
            }
            setTimeout(() => $layer.empty(), 2000);
        }

        renderLeaderboard();
        tampilkanConfetti();
    });
</script>
@endpush
