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
        Schema::create('p_r_signatories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained();
            $table->foreignId('approver_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->default(0); // User Id
            $table->foreignId('requester_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->default(0); // User Id
            $table->foreignId('for_approver_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->default(0); // User Id
            $table->foreignId('for_requester_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->default(0); // User Id
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
        Schema::dropIfExists('p_r_signatories');
    }
};
