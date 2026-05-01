<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->text('description')->nullable()->after('salary');
            $table->string('location')->nullable()->default('Rīga')->after('description');
            $table->string('job_type')->default('full-time')->after('location');
            $table->string('industry')->nullable()->after('job_type');
            $table->text('requirements')->nullable()->after('industry');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn(['description', 'location', 'job_type', 'industry', 'requirements']);
        });
    }
};
