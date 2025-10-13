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
            $table->string('ref')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::create('supplemental_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplemental_id')->nullable();
            $table->string('code')->nullable();
            $table->string('procurement_project')->nullable();
            $table->string('end_user')->nullable();
            $table->enum('early_procurement', [0, 1])->default(0);
            $table->string('mode_of_procurement')->nullable();
            // Schedule for Each Procurement Activity
            $table->timestamp('advertisement')->nullable();
            $table->timestamp('submission')->nullable();
            $table->timestamp('notice_of_award')->nullable();
            $table->timestamp('contract_signing')->nullable();
            
            $table->string('source_of_funds')->nullable();
            // Estimated Budget
            $table->string('total')->nullable();
            $table->string('mooe')->nullable();
            $table->string('co')->nullable();

            $table->string('remarks')->nullable();

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
