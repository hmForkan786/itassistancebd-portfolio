<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category', 64)->nullable();
            $table->string('short_description', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('problem_statement')->nullable();
            $table->text('solution')->nullable();
            $table->text('implementation_details')->nullable();
            $table->text('results')->nullable();
            $table->string('client_name')->nullable();
            $table->boolean('client_visibility')->default(false);
            $table->string('status', 32)->default('planned');
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('duration', 64)->nullable();
            $table->string('live_url', 500)->nullable();
            $table->string('github_url', 500)->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->string('seo_description', 500)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            $table->index('featured');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};