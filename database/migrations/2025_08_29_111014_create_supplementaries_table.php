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
        Schema::create('supplementaries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('filename');
            $table->string('origin');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::create('pr_supplemental', function (Blueprint $table) {
            $table->id();
            $table->string('supplemental_id');
            $table->foreignId('purchase_request_id')->constrained();
            $table->foreignId('transaction_id')->constrained();
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
        Schema::dropIfExists('supplementaries');
    }
};
