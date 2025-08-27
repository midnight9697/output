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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name');
            $table->string('fund_cluster');
            $table->string('office');
            $table->string('pr_number')->nullable();
            $table->string('responsibility_center_code');
            $table->string('purpose')->default('waived')->nullable();
            $table->timestamp('created_in')->nullable();
            $table->foreignId('created_by')->constrained('users')->default(1);
            $table->bigInteger('approval')->nullable();
            $table->enum('signed', [
                0, 1
            ])->default(0);
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
        Schema::dropIfExists('purchase_requests');
    }
};
