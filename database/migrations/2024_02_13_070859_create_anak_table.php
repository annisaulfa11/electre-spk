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
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ortu');
            $table->foreign('id_ortu')->references('id')->on('users');
            $table->string('nama');
            $table->integer('umur');
            $table->foreignId('id_posyandu');
            $table->foreign('id_posyandu')->references('id')->on('posyandu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
