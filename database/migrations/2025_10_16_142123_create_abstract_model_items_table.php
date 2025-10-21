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
    public function up() {
        Schema::create('abstract_model_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abstract_id')->constrained('abstract_models');
            $table->foreignId('rfq_id')->constrained('request_for_quotations');
            $table->foreignId('supplier_id')->constrained();
            $table->string('item_number');
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
        // Schema::dropIfExists('abstract_model_items');
    }
};
