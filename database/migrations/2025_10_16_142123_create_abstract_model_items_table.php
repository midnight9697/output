<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        // Schema::create('abstract_model_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('abstract_id')->constrained('abstract_models');
        //     $table->string('item_number');
        //     $table->string('quantity');
        //     $table->string('unit');
        //     $table->string('particulars');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('abstract_model_items');
    }
};
