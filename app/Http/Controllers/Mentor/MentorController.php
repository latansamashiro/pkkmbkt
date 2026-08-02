<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;

class MentorController extends Controller
{
    public function modul()
    {
        return view('role.mentor.modul');
    }

    public function leaderboard()
    {
        return view('role.mentor.leaderboard');
    }

    public function info()
    {
        return view('role.mentor.info');
    }

    public function profil()
    {
        return view('role.mentor.profil');
    }

    /**
     * Update nomor telepon & foto profil mentor yang sedang login.
     */
    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $validated = $request->validateWithBag('profileUpdate', [
            'phone_no' => ['nullable', 'string', 'max:20'],
            'avatar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [], [
            'phone_no' => 'nomor telepon',
            'avatar'   => 'foto profil',
        ]);

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            if ($user->profile_picture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
            }
            $validated['profile_picture'] = $request->file('avatar')->store('profile-photos', 'public');
        }

        $user->update([
            'phone_no' => $validated['phone_no'] ?? null,
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
        ]);

        return back()->with('profileStatus', 'Nomor telepon & foto profil berhasil diperbarui.');
    }

    /**
     * Ubah kata sandi akun mentor yang sedang login.
     */
    public function updatePassword(\Illuminate\Http\Request $request)
    {
        $validated = $request->validateWithBag('passwordUpdate', [
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ], [
            'old_password.current_password' => 'Kata sandi lama yang Anda masukkan salah.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak sama.',
            'new_password.different' => 'Kata sandi baru tidak boleh sama dengan kata sandi lama.',
        ]);

        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($validated['new_password']),
        ]);

        return back()->with('passwordStatus', 'Kata sandi berhasil diubah.');
    }

    public function jadwal()
    {
        return view('role.mentor.jadwal');
    }

    public function absensi()
    {
        return view('role.mentor.absensi');
    }

    public function evaluasi()
    {
        return view('role.mentor.evaluasi');
    }

    public function evaluasiDetail()
    {
        return view('role.mentor.evaluasi-detail');
    }

    public function keaktifan()
    {
        return view('role.mentor.keaktifan');
    }

    public function monitoringTugas()
    {
        return view('role.mentor.monitoring-tugas');
    }
}
