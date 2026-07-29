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
        Schema::create('contacts', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_code')->default('+880');
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
              ->references('id')
              ->on('contents')
              ->onDelete('cascade');
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
