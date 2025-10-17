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
        Schema::table('taxes', function (Blueprint $table) {
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('taxes', 'type')) {
                $table->string('type')->after('user_id');
            }
            if (!Schema::hasColumn('taxes', 'rate')) {
                $table->decimal('rate', 5, 2)->after('amount');
            }
            if (!Schema::hasColumn('taxes', 'taxable_amount')) {
                $table->decimal('taxable_amount', 15, 2)->after('rate');
            }
            if (!Schema::hasColumn('taxes', 'description')) {
                $table->text('description')->nullable()->after('taxable_amount');
            }
            if (!Schema::hasColumn('taxes', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('taxes', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('paid_at');
            }
            if (!Schema::hasColumn('taxes', 'payment_reference')) {
                $table->string('payment_reference')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('taxes', 'notes')) {
                $table->text('notes')->nullable()->after('payment_reference');
            }
            
            // Update status enum untuk menambahkan 'overdue'
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'rate',
                'taxable_amount',
                'description',
                'paid_at',
                'payment_method',
                'payment_reference',
                'notes'
            ]);
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid')->change();
        });
    }
};
