<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adderss', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained(
                table: 'customers',
                indexName: 'customers_id'
            );
            $table->string('negara');
            $table->string('kabupaten');
            $table->string('kecamtan');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adderss');
    }
};
