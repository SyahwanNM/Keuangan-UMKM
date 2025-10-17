<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordResetToken;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password-custom');
    }

    /**
     * Send password reset email
     */
    public function sendResetEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar dalam sistem.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem.'])->withInput();
        }

        try {
            // Generate password reset token
            $resetToken = PasswordResetToken::generateToken($email);
            
            // Send email
            Mail::to($email)->send(new PasswordResetMail($resetToken->verification_code, $email));

            return redirect()->route('password.verify')->with([
                'success' => 'Kode verifikasi telah dikirim ke email Anda. Silakan cek inbox atau spam folder.',
                'email' => $email
            ]);

        } catch (\Exception $e) {
            \Log::error('Password reset email error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi.'])->withInput();
        }
    }

    /**
     * Show verification form
     */
    public function showVerification(Request $request)
    {
        $email = $request->get('email') ?? session('email');
        
        if (!$email) {
            return redirect()->route('password.forgot')->withErrors(['email' => 'Email tidak ditemukan. Silakan masukkan email lagi.']);
        }

        // Store email in session for persistence
        session(['email' => $email]);

        return view('auth.verify-email-custom', [
            'email' => $email
        ]);
    }

    /**
     * Verify the code
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => 'required|string|size:6',
            'email' => 'required|email'
        ], [
            'verification_code.required' => 'Kode verifikasi harus diisi.',
            'verification_code.size' => 'Kode verifikasi harus 6 digit.',
            'email.required' => 'Email harus diisi.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $code = $request->verification_code;

        // Ensure email is in session
        session(['email' => $email]);

        $resetToken = PasswordResetToken::where('email', $email)
            ->where('verification_code', $code)
            ->first();

        if (!$resetToken) {
            return back()->withErrors(['verification_code' => 'Kode verifikasi tidak valid.'])->withInput();
        }

        if ($resetToken->expires_at < Carbon::now()) {
            return back()->withErrors(['verification_code' => 'Kode verifikasi telah kedaluwarsa. Silakan minta kode baru.'])->withInput();
        }

        if ($resetToken->verifyCode($code)) {
            // Store email in session for reset form
            session(['email' => $email]);
            
            return redirect()->route('password.reset', ['token' => $resetToken->token])->with([
                'success' => 'Kode verifikasi berhasil. Silakan buat password baru.',
                'email' => $email
            ]);
        }

        return back()->withErrors(['verification_code' => 'Kode verifikasi tidak valid.'])->withInput();
    }

    /**
     * Show reset password form
     */
    public function showResetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->get('email') ?? session('email');

        if (!$token || !$email) {
            return redirect()->route('password.forgot')->withErrors(['token' => 'Token atau email tidak valid. Silakan mulai dari awal.']);
        }

        // Ensure email is in session
        session(['email' => $email]);

        $resetToken = PasswordResetToken::where('token', $token)
            ->where('email', $email)
            ->first();

        if (!$resetToken) {
            return redirect()->route('password.forgot')->withErrors(['token' => 'Token tidak valid. Silakan mulai dari awal.']);
        }

        if (!$resetToken->isValid()) {
            return redirect()->route('password.forgot')->withErrors(['token' => 'Token telah kedaluwarsa atau belum diverifikasi. Silakan minta kode baru.']);
        }

        return view('auth.reset-password-custom', [
            'token' => $token,
            'email' => $email
        ]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $token = $request->token;
        $email = $request->email;
        $password = $request->password;

        $resetToken = PasswordResetToken::where('token', $token)
            ->where('email', $email)
            ->first();

        if (!$resetToken) {
            return redirect()->route('password.forgot')->withErrors(['token' => 'Token tidak valid. Silakan mulai dari awal.']);
        }

        if (!$resetToken->isValid()) {
            return redirect()->route('password.forgot')->withErrors(['token' => 'Token telah kedaluwarsa atau belum diverifikasi. Silakan minta kode baru.']);
        }

        try {
            // Update user password
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->route('password.forgot')->withErrors(['email' => 'User tidak ditemukan.']);
            }

            $user->update([
                'password' => Hash::make($password)
            ]);

            // Delete the reset token
            $resetToken->delete();

            // Clear session
            session()->forget('email');

            return redirect()->route('login.custom')->with([
                'success' => 'Password berhasil direset. Silakan login dengan password baru.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Password reset error: ' . $e->getMessage());
            return back()->withErrors(['password' => 'Gagal mereset password. Silakan coba lagi.'])->withInput();
        }
    }

    /**
     * Resend verification code
     */
    public function resendCode(Request $request)
    {
        $email = $request->email ?? session('email');

        if (!$email) {
            return redirect()->route('password.forgot')->withErrors(['email' => 'Email tidak ditemukan. Silakan masukkan email lagi.']);
        }

        // Ensure email is in session
        session(['email' => $email]);

        try {
            // Generate new token
            $resetToken = PasswordResetToken::generateToken($email);
            
            // Send email
            Mail::to($email)->send(new PasswordResetMail($resetToken->verification_code, $email));

            return back()->with([
                'success' => 'Kode verifikasi baru telah dikirim ke email Anda.',
                'email' => $email
            ]);

        } catch (\Exception $e) {
            \Log::error('Resend verification code error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim kode verifikasi. Silakan coba lagi.'])->withInput();
        }
    }
}