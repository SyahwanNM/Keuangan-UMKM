<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'amount',
        'rate',
        'taxable_amount',
        'description',
        'due_date',
        'status',
        'paid_at',
        'payment_method',
        'payment_reference',
        'notes',
        'is_auto_calculated',
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'rate' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'is_auto_calculated' => 'boolean',
    ];

    /**
     * Get the user that owns the tax.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include unpaid taxes.
     */
    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }

    /**
     * Scope a query to only include paid taxes.
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope a query to filter overdue taxes.
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'unpaid')
                    ->where('due_date', '<', now());
    }

    /**
     * Scope a query to only include auto calculated taxes.
     */
    public function scopeAutoCalculated($query)
    {
        return $query->where('is_auto_calculated', true);
    }
}
