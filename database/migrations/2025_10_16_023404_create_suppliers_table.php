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
            ['id' => 1, 'name' => 'Leyte Paper World', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1'],
            ['id' => 2, 'name' => 'Joebz Computer Sales and Services', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1'],
            ['id' => 3, 'name' => 'Freq IT Solutions', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1'],
            ['id' => 4, 'name' => 'EDS (Electronic Data Systems)', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1'],
            ['id' => 5, 'name' => 'Electronics city & service center,INC', 'province' => 'Leyte', 'municipality' => 'Tacloban City', 'barangay' => '1'],
        ];
        Schema::dropIfExists('suppliers');
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
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
