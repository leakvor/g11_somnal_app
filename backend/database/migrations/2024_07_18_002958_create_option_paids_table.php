<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
        {
            Schema::create('option_paids', function (Blueprint $table) {
                $table->id();
                $table->string('option_paid')->nullable();
                $table->integer('amount')->nullable();
                $table->string('description')->nullable();
                $table->string('type')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_paids');
    }
};
