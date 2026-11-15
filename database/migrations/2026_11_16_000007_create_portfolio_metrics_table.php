<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric_key', 64)->unique();
            $table->string('metric_label', 128);
            $table->decimal('metric_value', 12, 2)->nullable();
            $table->string('metric_unit', 32)->nullable();
            $table->string('source_type', 32)->default('manual'); // manual|derived
            $table->string('source_reference', 255)->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('enabled')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('enabled');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_metrics');
    }
};