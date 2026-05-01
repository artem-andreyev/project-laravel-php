<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('listing_type');
            $table->unsignedBigInteger('listing_id');
            $table->timestamps();

            $table->unique(['user_id', 'listing_type', 'listing_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_listings');
    }
};
