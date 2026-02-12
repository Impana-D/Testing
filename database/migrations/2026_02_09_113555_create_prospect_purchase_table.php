<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prospect_purchase', function (Blueprint $table) {
            $table->id(); // int AUTO_INCREMENT PRIMARY KEY

            $table->unsignedBigInteger('prospect_id'); // Foreign key to prospect_personal (optional)
            
            $table->decimal('monthly_budget', 10, 2)->nullable();

            $table->enum('purchase_frequency', [
                'Once a month',
                'Once a week',
                'Several days a week',
                'Daily'
            ])->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Deleted'])->default('Active');

            $table->timestamps(); // created_at & updated_at

            // Optional foreign key if you want to link to prospect_personal table
            // $table->foreign('prospect_id')->references('id')->on('prospect_personal')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_purchase');
    }
};
