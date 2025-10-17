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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('theme')->default('light'); // light, dark, auto
            $table->string('color_scheme')->default('blue'); // blue, green, purple, red, orange
            $table->string('font_size')->default('medium'); // small, medium, large
            $table->string('sidebar_style')->default('default'); // default, compact, expanded
            $table->boolean('show_animations')->default(true);
            $table->boolean('show_tooltips')->default(true);
            $table->string('dashboard_layout')->default('grid'); // grid, list, compact
            $table->string('chart_style')->default('modern'); // modern, classic, minimal
            $table->string('language')->default('id'); // id, en
            $table->string('date_format')->default('d-m-Y'); // d-m-Y, m/d/Y, Y-m-d
            $table->string('time_format')->default('24'); // 12, 24
            $table->string('number_format')->default('dot'); // dot, comma
            $table->json('custom_colors')->nullable(); // For custom color overrides
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};