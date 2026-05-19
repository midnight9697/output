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
        Schema::dropIfExists('public_scopings');
        Schema::create('public_scopings', function (Blueprint $table) {
            $table->id();
            $table->string('tentative_date_and_time')->nullable();
            $table->string('public_scoping_location')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_proponent')->nullable();
            $table->string('project_location')->nullable();
            $table->string('project_description')->nullable();
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
        Schema::dropIfExists('public_scopings');
    }
};
