<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('aspect'); // Contoh: Passing, Shooting, Kedisiplinan
            $table->integer('score'); // Nilai (misal: 1-100)
            $table->text('notes')->nullable(); // Catatan khusus per aspek atau umum
            $table->string('period'); // Contoh: Agustus 2026 / Semester 1
            $table->string('coach_name')->nullable(); // Nama pelatih yang menilai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
