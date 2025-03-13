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
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment ID)
            $table->string('title'); // Movie Title (Required)
            $table->text('description')->nullable(); // Movie Description (Optional)
            $table->string('poster')->nullable(); // Poster Image (Optional)
            $table->timestamps(); // created_at & updated_at (Auto-handled)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies'); // Drop table on rollback
    }
};
