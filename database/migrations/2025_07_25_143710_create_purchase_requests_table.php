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
            $table->string('pr_number');
            $table->string('date');
            $table->string('responsibility_center_code');
            $table->string('purpose');
            $table->timestamps();
        });

        // entity_name
        // fund_cluster
        // office
        // pr_number
        // date
        // responsibility_center_code
        // purpose
        // approver
        // requester
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
