<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => $request->route('title') ?? 'Profil',
        ];
        $user = auth()->user();
        $view = $request->route('view') ?? 'role.admin.profil.index';

        return view($view, compact('data', 'user'));
    }

    /**
     * Update nomor telepon & foto profil (nama/email dikunci, sama seperti
     * halaman profil Mahasiswa/Mentor).
     */
    public function updateProfile(Request $request)
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
                Storage::disk('public')->delete($user->profile_picture);
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
     * Ubah kata sandi akun yang sedang login.
     */
    public function updatePassword(Request $request)
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
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('passwordStatus', 'Kata sandi berhasil diubah.');
    }
}
