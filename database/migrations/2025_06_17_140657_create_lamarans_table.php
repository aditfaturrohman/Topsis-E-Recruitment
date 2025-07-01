<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('lamarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lowongan_id')->constrained('lowongans')->onDelete('cascade');
        $table->string('nama');
        $table->date('ttl');
        $table->string('pendidikan');
        $table->integer('umur');
        $table->integer('pengalaman');
        $table->string('cv');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
