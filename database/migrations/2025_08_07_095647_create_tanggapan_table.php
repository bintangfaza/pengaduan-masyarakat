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
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduan')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('tanggapan');
            $table->timestamp('tanggal_tanggapan')->useCurrent();
            $table->enum('status', ['ditanggapi', 'belum ditanggapi'])->default('belum ditanggapi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
