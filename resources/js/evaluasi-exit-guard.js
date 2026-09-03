/**
 * Pengaman keluar halaman saat mahasiswa sedang mengerjakan evaluasi.
 *
 * Integrasi minimal pada halaman evaluasi:
 *   const guard = createEvaluasiExitGuard();
 *   guard.start(); // setelah "Mulai Kuis"
 *   guard.stop();  // setelah submit berhasil / kuis selesai
 *
 * Untuk navigasi internal, panggil guard.confirmExit() sebelum berpindah.
 * beforeunload dipasang otomatis untuk refresh/close tab.
 */
export function createEvaluasiExitGuard(message = 'Yakin ingin keluar? Jawaban yang sedang dikerjakan belum dikirim. Jika keluar sekarang, progres percobaan ini dapat hilang.') {
    let active = false;

    const beforeUnload = (event) => {
        if (!active) return;
        event.preventDefault();
        event.returnValue = '';
    };

    const start = () => {
        if (active) return;
        active = true;
        window.addEventListener('beforeunload', beforeUnload);
    };

    const stop = () => {
        active = false;
        window.removeEventListener('beforeunload', beforeUnload);
    };

    const confirmExit = () => {
        if (!active) return true;
        return window.confirm(message);
    };

    return {
        start,
        stop,
        confirmExit,
        isActive: () => active,
    };
}
