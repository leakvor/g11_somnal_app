<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id'); // Add this line
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('date_work');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories'); // Add this line
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};