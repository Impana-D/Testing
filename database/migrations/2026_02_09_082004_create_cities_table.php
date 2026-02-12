<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->foreignId('state_id')
                  ->constrained('states')
                  ->cascadeOnDelete();

            $table->string('name', 100);

            $table->enum('status', ['Active', 'Inactive', 'Deleted'])
                  ->default('Active');

            $table->timestamps();

            $table->unique(['state_id', 'name']); // optional but recommended
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
