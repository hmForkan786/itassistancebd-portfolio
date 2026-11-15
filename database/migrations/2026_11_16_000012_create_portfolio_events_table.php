<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 64);
            $table->string('page_path', 255)->nullable();
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_hash', 64)->nullable(); // hashed, not raw IP
            $table->string('referrer_domain', 255)->nullable();
            $table->string('device_type', 32)->nullable();
            $table->timestamp('occurred_at');
            $table->timestamps();

            $table->index('event_name');
            $table->index('occurred_at');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_events');
    }
};