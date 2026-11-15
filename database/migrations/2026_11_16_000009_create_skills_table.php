<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('category', 64);
            $table->string('proficiency_label', 64)->nullable();
            $table->string('icon', 128)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->index(['category', 'enabled']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};