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
        Schema::create('request_for_quotations', function (Blueprint $table) {
            $table->id();
            $table->string('project_purpose')->nullable();
            $table->string('rfq_number')->nullable();
            $table->string('attachment_one')->nullable();
            $table->string('aproved_budget')->nullable();
            $table->string('standard_unit')->nullable();
            $table->string('target_delivery_date')->nullable();
            $table->enum('classification', [
                'Goods',
                'Infrastructure Projects',
                'Consulting Services',
                'NP-53.10 Lease of Real Property and Venue',
                'Common-Use Supplies (CSE)',
                'NP-53.9 Small Value Procurement',
                'ICT Projects',
                'Framework Agreement',
            ])->nullable();
            $table->foreignId('creator')->constrained('users')->default(1);
            $table->json('remarks')->nullable();
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
        Schema::dropIfExists('r_f_q_s');
    }
};
