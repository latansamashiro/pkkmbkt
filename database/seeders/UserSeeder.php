<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "SUPER ADMINISTRATOR",
            "email" => "admin@example.com",
            "role_name" => "SUPER-ADMIN",
            "phone_no" => null,
            "faculty_name" => null,
            "program_study_name" => null,
            "certificate_link" => null,
            "profile_picture" => null,
            "created_by_id" => 1,
            "updated_by_id" => 1,
        ]);
    }
}
