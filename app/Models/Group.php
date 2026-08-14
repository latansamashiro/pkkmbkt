<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'mentor_id',
        'advisor_id',
        'koordinator_id',
        'max_member',
        'created_by_id',
        'updated_by_id',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function koordinator()
    {
        return $this->belongsTo(User::class, 'koordinator_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'group_id');
    }

    protected static function booted(): void
    {
        // Begitu kelompok baru dibuat (dari Kelola Kelompok, Data Master, atau
        // cara lain apapun), otomatis tarik masuk mahasiswa yang kode kelompoknya
        // (pending_group_code, biasanya dari hasil Import Excel/CSV) cocok dengan
        // kode kelompok ini — sebelumnya mereka "menunggu" karena kelompoknya
        // belum ada saat itu.
        static::created(function (self $group) {
            $group->tarikAnggotaPending();
        });

        // Kalau kode kelompok diubah lewat Edit, cek juga siapa tahu ada yang
        // "menunggu" kode barunya.
        static::updated(function (self $group) {
            if ($group->wasChanged('code')) {
                $group->tarikAnggotaPending();
            }
        });
    }

    /**
     * Cari User (role STUDENT) yang pending_group_code-nya cocok dengan kode
     * kelompok ini, lalu masukkan jadi anggota (sepanjang kelompok belum penuh
     * dan mahasiswanya belum tergabung di kelompok lain), lalu bersihkan
     * pending_group_code-nya.
     */
    public function tarikAnggotaPending(): int
    {
        $kandidat = User::where('role_name', 'STUDENT')
            ->where('pending_group_code', $this->code)
            ->get();

        if ($kandidat->isEmpty()) {
            return 0;
        }

        $sudahPunyaKelompok = Member::pluck('student_id')->all();
        $sisaKuota = $this->max_member - $this->members()->count();
        $ditambahkan = 0;

        foreach ($kandidat as $student) {
            // selalu bersihkan tanda "menunggu"-nya, sudah tidak relevan lagi
            // begitu kelompok dengan kode itu sudah ada (mau berhasil masuk atau tidak)
            $student->update(['pending_group_code' => null]);

            if (in_array($student->id, $sudahPunyaKelompok, true)) {
                continue; // keburu dimasukkan manual ke kelompok lain
            }
            if ($ditambahkan >= $sisaKuota) {
                continue; // kelompok penuh, sisanya biarkan tanpa kelompok
            }

            Member::create([
                'group_id' => $this->id,
                'student_id' => $student->id,
                'created_by_id' => $this->created_by_id,
                'updated_by_id' => $this->created_by_id,
            ]);
            $ditambahkan++;
        }

        return $ditambahkan;
    }
}
