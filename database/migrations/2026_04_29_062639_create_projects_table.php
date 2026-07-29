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
        Schema::create('projects', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->id();
            $table->string('concern')->comment('Bhaiya Housing, Bhaiya Hotel etc.');
            $table->string('title')->comment('Project Name Heading');
            $table->string('name')->unique()->comment('Slug');
            $table->string('logo')->nullable();
            $table->string('start_date')->nullable();
            $table->string('location')->nullable()->comment('e.g. Banani, Dhaka');
            $table->longText('body')->nullable();
            $table->longText('body_2')->nullable();
            $table->longText('body_3')->nullable();
            $table->longText('body_4')->nullable();
            $table->json('extra')->nullable()->comment('Project At a Glance (JSON)');
            $table->text('features')->nullable();
            $table->json('img_paths')->nullable()->comment('Multiple Project Images');
            $table->string('video_path')->nullable();
            $table->string('img_path')->nullable()->comment('Project PDF/File');
            $table->string('url')->nullable()->comment('Brochure/Link');
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
