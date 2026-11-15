<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('email', 255);
            $table->string('phone', 64)->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('message');
            $table->string('source_page', 255)->nullable();
            $table->string('status', 32)->default('unread'); // unread|read|replied|archived
            $table->text('admin_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('submitted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};