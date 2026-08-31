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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('birth_place')->nullable(); // Tempat Lahir
            $table->date('birth_date')->nullable();    // Tanggal Lahir Lengkap
            $table->integer('birth_year');             // Tahun Lahir (untuk otomatisasi kategori)
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('photo')->nullable();       // Foto Siswa
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status Aktif/Nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
