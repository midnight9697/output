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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("firstname")->nullable();
            $table->string("middlename")->default('waived');
            $table->string("lastname")->nullable();
            $table->string("suffix")->nullable();
            $table->integer('division_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('position')->nullable();
            $table->enum('status', [
                'active',
                'inactive',
            ])->default('active');
            $table->timestamps();
        });
        
        Schema::create('profile_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->string("path")->nullable();
            $table->string("name")->nullable();
            $table->string("original_name")->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
