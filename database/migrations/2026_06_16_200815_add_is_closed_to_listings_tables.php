<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->boolean('is_closed')->default(false)->after('longitude');
        });

        Schema::table('internships', function (Blueprint $table) {
            $table->boolean('is_closed')->default(false)->after('longitude');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn('is_closed');
        });

        Schema::table('internships', function (Blueprint $table) {
            $table->dropColumn('is_closed');
        });
    }
};
