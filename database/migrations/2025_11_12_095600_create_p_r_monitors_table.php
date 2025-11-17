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
        Schema::create('p_r_monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pr_id')->constrained('purchase_requests');
            $table->timestamp('canvass')->nullable();
            $table->timestamp('abstract')->nullable();
            $table->timestamp('opening')->nullable();
            $table->mediumText('winner')->nullable();
            $table->timestamp('award_date')->nullable();
            $table->timestamp('order_date')->nullable();
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
        Schema::dropIfExists('p_r_monitors');
    }
};
