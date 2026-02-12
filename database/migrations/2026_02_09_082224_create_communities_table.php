<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')
                  ->constrained('cities')
                  ->cascadeOnDelete();

            $table->string('community_name', 150);

             $table->enum('status', ['Active', 'Inactive', 'Deleted'])
                  ->default('Active');

            $table->timestamps();

            $table->unique(['city_id', 'community_name']); // optional but recommended
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
