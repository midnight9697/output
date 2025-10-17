<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
use App\Models\PurchaseRequest;
use App\Models\RFQ;
use App\Models\RFQItem;
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
        // PurchaseRequest::factory(5000)->create();
        $users = User::factory(100)->create();
        Profile::factory(200)->recycle($users)->create();
        $users = User::all();

        // Loop through each user and create 100 items for them
        $count = 0;
        $users->each(function ($user) use($count) {
            $count = $count + 1;
            // Item::factory(100)->create(['user_id' => $user->id]);
            $rfq = RFQ::factory(rand(10, 200))
            ->has(RFQItem::factory()->count(rand(5, 10)))
            ->create(['creator' => $user->id]);
            // RFQItem::factory(rand(5, 20))->recycle($rfq)->create();
        });
        
    }
}
