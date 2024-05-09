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
        Schema::create('series_part_contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('series_part_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['text', 'code', 'image']);
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_part_contents');
    }
};
