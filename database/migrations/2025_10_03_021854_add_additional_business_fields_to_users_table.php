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
        Schema::table('users', function (Blueprint $table) {
            $table->text('business_description')->nullable()->after('business_address');
            $table->string('business_website')->nullable()->after('business_description');
            $table->date('business_established')->nullable()->after('business_website');
            $table->string('business_size')->nullable()->after('business_established');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'business_description',
                'business_website',
                'business_established',
                'business_size'
            ]);
        });
    }
};
