<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\ProgramStudy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "faculty_code" => "FEB",
                "faculty_name" => "FAKULTAS EKONOMI DAN BISNIS",
                "program_studies" => [
                    ["program_study_code" => "115", "program_study_name" => "S-1 MANAJEMEN"],
                    ["program_study_code" => "117", "program_study_name" => "S-2 MAGISTER MANAJEMEN"],
                    ["program_study_code" => "125", "program_study_name" => "S-1 AKUNTANSI"],
                ]
            ],
            [
                "faculty_code" => "FKES",
                "faculty_name" => "FAKULTAS KESEHATAN",
                "program_studies" => [
                    ["program_study_code" => "313", "program_study_name" => "D-3 KEBIDANAN"],
                    ["program_study_code" => "325", "program_study_name" => "S-1 GIZI"],
                ]
            ],
            [
                "faculty_code" => "FKIP",
                "faculty_name" => "FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN",
                "program_studies" => [
                    ["program_study_code" => "415", "program_study_name" => "S-1 PENDIDIKAN MATEMATIKA"],
                    ["program_study_code" => "425", "program_study_name" => "S-1 PENDIDIKAN BIOLOGI"],
                    ["program_study_code" => "435", "program_study_name" => "S-1 PENDIDIKAN BAHASA INGGRIS"],
                ]
            ],
            [
                "faculty_code" => "FTI",
                "faculty_name" => "FAKULTAS TEKNOLOGI INFORMASI",
                "program_studies" => [
                    ["program_study_code" => "515", "program_study_name" => "S-1 SISTEM INFORMASI"],
                    ["program_study_code" => "525", "program_study_name" => "S-1 INFORMATIKA"],
                ]
            ],
            [
                "faculty_code" => "STAI",
                "faculty_name" => "SEKOLAH TINGGI AGAMA ISLAM",
                "program_studies" => [
                    ["program_study_code" => "215", "program_study_name" => "S-1 PENDIDIKAN AGAMA ISLAM"],
                    ["program_study_code" => "225", "program_study_name" => "S-1 EKONOMI SYARIAH"],
                    ["program_study_code" => "235", "program_study_name" => "S-1 PENDIDIKAN ISLAM ANAK USIA DINI"],
                ]
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($datas as $faculty) {
                $data = [
                    "code" => $faculty["faculty_code"],
                    "name" => $faculty["faculty_name"],
                ];
                $f = Faculty::create($data);
                foreach ($faculty["program_studies"] as $programStudy) {
                    $data_prodi = [
                        "faculty_id" => $f->id,
                        "code" => $programStudy["program_study_code"],
                        "name" => $programStudy["program_study_name"],
                    ];
                    ProgramStudy::create($data_prodi);
                }
            }
            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();
        }
    }
}
