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
        Schema::create('contact_queries', function (Blueprint $table) {
            $table->id();
            
            // Contact Information
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            
            // Status tracking
            $table->string('status')->default('new')->index(); // new, read, replied, archived
            $table->boolean('is_read')->default(false)->index();
            $table->timestamp('read_at')->nullable();
            $table->foreignId('read_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Reply tracking
            $table->timestamp('replied_at')->nullable();
            $table->foreignId('replied_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('reply_message')->nullable();
            
            // Internal notes
            $table->text('internal_notes')->nullable();
            
            // Additional metadata
            $table->json('metadata')->nullable(); // IP address, user agent, etc.
            
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['is_read', 'created_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_queries');
    }
};
