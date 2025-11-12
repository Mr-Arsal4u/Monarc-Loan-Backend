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
        Schema::create('loan_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_application_id')->constrained()->onDelete('cascade')->index();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('note');
            $table->string('visibility')->default('internal');
            $table->json('meta')->nullable(); // For additional metadata
            $table->timestamps();

            $table->index(['loan_application_id', 'created_at']);
            $table->index('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_notes');
    }
};
