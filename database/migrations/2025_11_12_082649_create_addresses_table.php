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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable'); // addressable_id, addressable_type (polymorphic)
            $table->string('type')->index();
            $table->string('street')->nullable();
            $table->string('unit')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('country')->default('USA');
            $table->integer('years_at_address')->nullable();
            $table->integer('months_at_address')->nullable();
            $table->json('additional_data')->nullable();
            $table->timestamps();

            $table->index(['addressable_type', 'addressable_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
