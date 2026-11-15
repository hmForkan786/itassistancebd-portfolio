<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_role', 128)->nullable();
            $table->string('company_name', 128)->nullable();
            $table->string('client_avatar', 500)->nullable();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->text('review_text');
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->date('review_date')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['approved', 'published']);
            $table->index('featured');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};