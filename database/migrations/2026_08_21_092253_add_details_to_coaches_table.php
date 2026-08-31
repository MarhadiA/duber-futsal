<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->string('education')->nullable()->after('phone');
            $table->string('profession')->nullable()->after('education');
            $table->text('experience')->nullable()->after('profession');
        });
    }

    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
            $table->dropColumn(['photo', 'education', 'profession', 'experience']);
        });
    }
};
