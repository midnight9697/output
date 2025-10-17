<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // DB::table("users")->insert([
        //     // "name" => "Marco C. Pantonial",
        //     "email" => "marco_pantonial@emb.gov.ph",
        //     "password" => '$2a$12$ApuszupbbDQAo8CGYzwLjeIGpAR2vv9/cw1uNdRRa.kvwJ0wFWpJO',
        // ]);
        $user = User::create([
            // "name" => "Marco C. Pantonial",
            "email" => "marco_pantonial@emb.gov.ph",
            "password" => '$2a$12$ApuszupbbDQAo8CGYzwLjeIGpAR2vv9/cw1uNdRRa.kvwJ0wFWpJO',
            "permit" => json_encode(['users' => ['c','r','u','d']]),
            'role' => 'superadmin'
        ]);
        $user = User::create([
            "email" => "vincent_morastil@emb.gov.ph",
            "password" => '$2a$12$ApuszupbbDQAo8CGYzwLjeIGpAR2vv9/cw1uNdRRa.kvwJ0wFWpJO',
            "permit" => json_encode(['users' => ['c','r','u','d']]),
            'role' => 'superadmin'
        ]);

        DB::table('profiles')->insert([
            'firstname' => "Marco",
            'middlename' => 'waived',
            'lastname' => "Pantonial",
            'suffix' => null,
            'division_id' => '1',
            'section_id' => '2',
            'user_id' => 1,
            'position' => "Computer Programmer II",
            'status' => 'active',
        ]);
        DB::table('profiles')->insert([
            'firstname' => "Vincent",
            'middlename' => 'waived',
            'lastname' => "Morastil",
            'suffix' => null,
            'division_id' => '1',
            'section_id' => '2',
            'user_id' => 2,
            'position' => "Computer Programmer 0",
            'status' => 'active',
        ]);
    }
}
