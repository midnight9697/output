<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $productsToInsert = [
            ['id' => 1, 'name' => 'Leyte Paper World', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1', 'latitude' => '11.2447', 'longitude' => '125.005'],
            ['id' => 2, 'name' => 'Joebz Computer Sales and Services', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1', 'latitude' => '11.2298', 'longitude' => '125.001'],
            ['id' => 3, 'name' => 'Freq IT Solutions', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1', 'latitude' => '11.2478', 'longitude' => '124.978'],
            ['id' => 4, 'name' => 'EDS (Electronic Data Systems)', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1', 'latitude' => '11.2694', 'longitude' => '124.939'],
            ['id' => 5, 'name' => 'Electronics city & service center,INC', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1', 'latitude' => '11.2842', 'longitude' => '124.834'],
        ];
        Schema::dropIfExists('suppliers');
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });

        DB::table('suppliers')->insert($productsToInsert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
