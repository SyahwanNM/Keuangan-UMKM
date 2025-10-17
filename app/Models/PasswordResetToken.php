<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetToken extends Model
{
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'token',
        'verification_code',
        'is_verified',
        'expires_at'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Generate a new password reset token
     */
    public static function generateToken($email)
    {
        // Delete any existing tokens for this email
        self::where('email', $email)->delete();

        // Generate new token
        $token = Str::random(64);
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        return self::create([
            'email' => $email,
            'token' => $token,
            'verification_code' => $verificationCode,
            'expires_at' => Carbon::now()->addMinutes(15), // 15 minutes expiry
        ]);
    }

    /**
     * Verify the verification code
     */
    public function verifyCode($code)
    {
        if ($this->verification_code === $code && $this->expires_at > Carbon::now()) {
            $this->update(['is_verified' => true]);
            return true;
        }
        return false;
    }

    /**
     * Check if token is valid and verified
     */
    public function isValid()
    {
        return $this->is_verified && $this->expires_at > Carbon::now();
    }

    /**
     * Clean up expired tokens
     */
    public static function cleanupExpired()
    {
        self::where('expires_at', '<', Carbon::now())->delete();
    }
}