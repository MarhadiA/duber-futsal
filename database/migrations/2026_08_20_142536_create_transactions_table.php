<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']); // Pemasukan atau Pengeluaran
            $table->string('category');                  // Kategori transaksi
            $table->string('name')->nullable();          // Nama pihak terkait (bebas ketik/kosongkan)
            $table->decimal('amount', 12, 2);            // Nominal uang
            $table->date('date');                        // Tanggal transaksi
            $table->text('description')->nullable();     // Keterangan / catatan
            $table->string('recorded_by')->nullable();   // Admin yang mencatat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
