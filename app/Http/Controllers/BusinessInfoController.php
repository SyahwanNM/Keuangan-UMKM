<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BusinessInfoController extends Controller
{
    /**
     * Display the business information page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('business-info.index', compact('user'));
    }

    /**
     * Show the form for editing business information.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('business-info.edit', compact('user'));
    }

    /**
     * Update the business information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'business_name' => ['required', 'string', 'max:255'],
            'business_type' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'business_address' => ['required', 'string'],
            'business_description' => ['nullable', 'string', 'max:1000'],
            'business_website' => ['nullable', 'url', 'max:255'],
            'business_established' => ['nullable', 'date', 'before:today'],
            'business_size' => ['nullable', 'string', 'max:50'],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Verify current password if changing password
        if ($request->filled('password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
        }

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'phone_number' => $request->phone_number,
            'business_address' => $request->business_address,
            'business_description' => $request->business_description,
            'business_website' => $request->business_website,
            'business_established' => $request->business_established,
            'business_size' => $request->business_size,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('business-info.index')
            ->with('success', 'Informasi usaha berhasil diperbarui!');
    }

    /**
     * Show business statistics.
     */
    public function statistics()
    {
        $user = Auth::user();
        
        // Calculate business statistics
        $totalTransactions = $user->transactions()->count();
        $totalIncome = $user->transactions()->where('type', 'income')->sum('amount');
        $totalExpense = $user->transactions()->where('type', 'expense')->sum('amount');
        $totalCapital = $user->capitals()->sum('initial_amount');
        $totalTaxes = $user->taxes()->sum('amount');
        $unpaidTaxes = $user->taxes()->where('status', 'unpaid')->sum('amount');
        
        // Monthly statistics
        $currentMonth = now()->startOfMonth();
        $monthlyIncome = $user->transactions()
            ->where('type', 'income')
            ->where('date', '>=', $currentMonth)
            ->sum('amount');
        $monthlyExpense = $user->transactions()
            ->where('type', 'expense')
            ->where('date', '>=', $currentMonth)
            ->sum('amount');
        
        // Recent activity
        $recentTransactions = $user->transactions()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        $upcomingTaxes = $user->taxes()
            ->where('status', 'unpaid')
            ->where('due_date', '>=', now())
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        return view('business-info.statistics', compact(
            'user',
            'totalTransactions',
            'totalIncome',
            'totalExpense',
            'totalCapital',
            'totalTaxes',
            'unpaidTaxes',
            'monthlyIncome',
            'monthlyExpense',
            'recentTransactions',
            'upcomingTaxes'
        ));
    }
}
