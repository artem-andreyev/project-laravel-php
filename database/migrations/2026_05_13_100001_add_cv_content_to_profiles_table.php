<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->longText('cv_content')->nullable()->after('cv_path');
            $table->timestamp('cv_generated_at')->nullable()->after('cv_content');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['cv_content', 'cv_generated_at']);
        });
    }
};
