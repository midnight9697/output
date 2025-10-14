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
        Schema::create('a_p_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->string('origin')->nullable();
            $table->string('filetype')->nullable();
            $table->foreignId('creator')->constrained('users');
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
        Schema::dropIfExists('a_p_p_s');
    }
};
