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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->string('origin')->nullable();
            $table->string('filetype')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('transaction_id')->nullable();
            $table->enum('for', [
                'pr', 'po'
            ])->default('pr');
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
        Schema::dropIfExists('attachments');
    }
};
