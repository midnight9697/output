<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use App\Models\PurchaseRequest;
use App\Models\User;
use Database\Factories\PRFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
       
        $this->call([
            DivisionSeeder::class,
            UserSeeeder::class
        ]);
        PurchaseRequest::factory(100)->create();
        $users = User::factory(100)->create();
        Profile::factory(200)->recycle($users)->create();
    }
}
