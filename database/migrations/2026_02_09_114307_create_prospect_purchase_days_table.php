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
        Schema::create('prospect_purchase_days', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment primary key

            $table->unsignedBigInteger('prospect_purchase_id');
            $table->tinyInteger('day')->unsigned();

            // Optional: add foreign key to prospect_purchase table
            // $table->foreign('prospect_purchase_id')
            //       ->references('id')
            //       ->on('prospect_purchase')
            //       ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospect_purchase_days');
    }
};
