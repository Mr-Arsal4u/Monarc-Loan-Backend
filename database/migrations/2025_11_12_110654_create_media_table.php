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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship
            $table->morphs('mediaable'); // mediaable_type, mediaable_id
            
            // File information
            $table->string('filename'); // Stored filename
            $table->string('original_filename'); // Original filename from upload
            $table->string('path'); // Full path to the file
            $table->string('disk')->default('public'); // Storage disk (public, s3, etc.)
            $table->string('mime_type')->nullable(); // MIME type (image/jpeg, application/pdf, etc.)
            $table->unsignedBigInteger('size')->nullable(); // File size in bytes
            
            // Media categorization
            $table->string('type')->nullable(); // image, document, video, audio, other
            $table->string('collection')->default('default'); // Collection name for organizing (e.g., 'profile', 'documents', 'gallery')
            
            // Ordering and organization
            $table->unsignedInteger('order')->default(0); // For sorting multiple media items
            
            // Additional metadata
            $table->json('metadata')->nullable(); // Additional file metadata (dimensions, duration, etc.)
            
            // Soft deletes
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes
            $table->index(['mediaable_type', 'mediaable_id', 'collection']);
            $table->index('type');
            $table->index('collection');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
