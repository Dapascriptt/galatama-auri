<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->string('category', 8)->nullable()->after('image');
            $table->string('rank', 8)->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->dropColumn(['category', 'rank']);
        });
    }
};
