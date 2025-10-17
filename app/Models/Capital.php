<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'initial_amount',
        'description',
    ];

    protected $casts = [
        'initial_amount' => 'decimal:2',
    ];

    /**
     * Get the user that owns the capital.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
