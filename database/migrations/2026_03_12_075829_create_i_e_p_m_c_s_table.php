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
        Schema::create('i_e_p_m_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->nullable();
            $table->string('property_number')->nullable();
            $table->string('issued_to')->nullable();
            $table->string('computer_name')->nullable();
            $table->string('brand_model')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('unit_location')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('monitor_brand_model')->nullable();
            $table->string('printer')->nullable();
            $table->string('printer_serial_number')->nullable();
            $table->string('ups_serial_number')->nullable();
            $table->string('monitor_serial_number')->nullable();
            $table->string('date_last_maintenance')->nullable();
            $table->string('date_maintenance')->nullable();
            $table->string('inspected_by')->nullable();
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
        Schema::dropIfExists('i_e_p_m_c_s');
    }
};
