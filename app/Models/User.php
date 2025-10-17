<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'business_name',
        'business_type',
        'phone_number',
        'business_address',
        'business_description',
        'business_website',
        'business_established',
        'business_size',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'business_established' => 'date',
        ];
    }

    /**
     * Get the transactions for the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the taxes for the user.
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * Get the capitals for the user.
     */
    public function capitals()
    {
        return $this->hasMany(Capital::class);
    }

    /**
     * Get the user preferences.
     */
    public function preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    /**
     * Get or create user preferences.
     */
    public function getPreferences()
    {
        try {
            if (!$this->preferences) {
                $this->preferences = $this->preferences()->create(UserPreference::getDefaults());
            }
            return $this->preferences;
        } catch (\Exception $e) {
            \Log::error('User preferences error: ' . $e->getMessage());
            // Return default preferences if creation fails
            return new UserPreference(UserPreference::getDefaults());
        }
    }
}