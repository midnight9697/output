<?php

namespace Database\Seeders;

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
        DB::table("users")->insert([
            "name" => "Marco C. Pantonial",
            "email" => "marco_pantonial@emb.gov.ph",
            "password" => '$2a$12$ApuszupbbDQAo8CGYzwLjeIGpAR2vv9/cw1uNdRRa.kvwJ0wFWpJO',
        ]);
    }
}
