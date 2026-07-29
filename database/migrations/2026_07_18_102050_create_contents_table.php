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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('prev_slug')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->foreign('parent_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('contents')->onDelete('cascade');

            $table->string('body')->nullable();   // Main Description
            $table->string('body_2')->nullable(); // Secondary
            $table->string('body_3')->nullable(); // Features
            $table->string('body_4')->nullable(); // Extra

            $table->longText('description')->nullable();
            $table->longText('description_1')->nullable();
            $table->longText('description_2')->nullable();
            $table->longText('description_3')->nullable();
            $table->text('short')->nullable();

            $table->json('body_titles')->nullable();     // প্রতিটি সেকশনের কাস্টম টাইটেল
            $table->json('section_statuses')->nullable(); // প্রতিটি সেকশনের Active/Inactive অবস্থা

            $table->json('features')->nullable();
            $table->json('extra')->nullable();
            $table->string('url')->nullable();
            $table->string('location')->nullable();

            $table->string('img_path')->nullable();      // Featured Image
            $table->json('img_paths')->nullable();       // Multiple Gallery Images
            $table->string('video_path')->nullable();
            $table->json('video_paths')->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('trashed_at')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->integer('views')->default(0);
            $table->tinyInteger('status')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
