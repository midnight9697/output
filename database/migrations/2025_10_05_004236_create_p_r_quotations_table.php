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
        // Schema::create('p_r_quotations', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('rfq_item_id')->constrained('quotation_items');
        //     $table->foreignId('purchase_request_item_id')->constrained('p_r_items');
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
        // Schema::dropIfExists('p_r_quotations');
    }
};
