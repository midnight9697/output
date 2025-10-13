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
            ['id' => 1, 'name' => 'Leyte Paper World', 'address' => 'Tacloban City'],
            ['id' => 2, 'name' => 'Joebz Computer Sales and Services', 'address' => 'Tacloban City'],
            ['id' => 3, 'name' => 'Freq IT Solutions', 'address' => 'Tacloban City'],
            ['id' => 4, 'name' => 'EDS (Electronic Data Systems)', 'address' => 'Tacloban City'],
            ['id' => 5, 'name' => 'Electronics city & service center,INC', 'address' => 'Tacloban City'],
        ];
        Schema::dropIfExists('suppliers');
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
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