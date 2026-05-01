<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('listing_type'); // 'job' or 'internship'
            $table->unsignedBigInteger('listing_id');
            $table->string('status')->default('pending'); // pending, reviewed, accepted, rejected
            $table->text('cover_letter')->nullable();
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->unique(['user_id', 'listing_type', 'listing_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
