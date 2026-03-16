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
        Schema::create('maintenance_reports', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->nullable();
            $table->foreignId('equipment_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', [0, 1])->default(0);
            $table->integer('year')->default(2025);
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
        Schema::dropIfExists('maintenance_reports');
    }
};
