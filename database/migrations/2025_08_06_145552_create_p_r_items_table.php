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
        Schema::create('p_r_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained();
            $table->string('stock_number')->nullable();
            $table->string('unit')->nullable();
            $table->string('item_description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_r_items');
    }
};
