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
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('synonyms');
            $table->timestamps();
        });

        $productsToInsert = [
            ['id' => 1, 'synonyms' => 'no comment'],
            ['id' => 2, 'synonyms' => 'for consideration'],
            ['id' => 3, 'synonyms' => 'for inclusion'],
            ['id' => 4, 'synonyms' => 'requesting suggestions'],
            ['id' => 5, 'synonyms' => 'for approval'],
            ['id' => 6, 'synonyms' => 'approved for excecution'],
            ['id' => 7, 'synonyms' => 'Dismissed and not to be followed through'],
            ['id' => 8, 'synonyms' => 'Incomplete attachment'],
            ['id' => 9, 'synonyms' => 'Incomplete attachment'],
            ['id' => 10, 'synonyms' => 'For immediate action'],
            ['id' => 11, 'synonyms' => 'Signed'],
        ];
        
        DB::table('alternatives')->insert($productsToInsert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternatives');
    }
};
