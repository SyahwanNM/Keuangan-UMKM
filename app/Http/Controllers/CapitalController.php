<?php

namespace App\Http\Controllers;

use App\Models\Capital;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capitals = Capital::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Calculate statistics
        $totalCapital = Capital::where('user_id', Auth::id())
            ->sum('initial_amount');

        $totalIncome = Transaction::where('user_id', Auth::id())
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', Auth::id())
            ->where('type', 'expense')
            ->sum('amount');

        $currentBalance = $totalCapital + $totalIncome - $totalExpense;
        $roi = $totalCapital > 0 ? (($currentBalance - $totalCapital) / $totalCapital) * 100 : 0;

        return view('capitals.index', compact(
            'capitals', 
            'totalCapital', 
            'totalIncome', 
            'totalExpense', 
            'currentBalance', 
            'roi'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('capitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'initial_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = Auth::id();

        Capital::create($validated);

        return redirect()->route('capitals.index')
            ->with('success', 'Modal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Capital $capital)
    {
        // Ensure user can only view their own capitals
        if ($capital->user_id !== Auth::id()) {
            abort(403);
        }

        return view('capitals.show', compact('capital'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capital $capital)
    {
        // Ensure user can only edit their own capitals
        if ($capital->user_id !== Auth::id()) {
            abort(403);
        }

        return view('capitals.edit', compact('capital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capital $capital)
    {
        // Ensure user can only update their own capitals
        if ($capital->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'initial_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        $capital->update($validated);

        return redirect()->route('capitals.index')
            ->with('success', 'Modal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capital $capital)
    {
        // Ensure user can only delete their own capitals
        if ($capital->user_id !== Auth::id()) {
            abort(403);
        }

        $capital->delete();

        return redirect()->route('capitals.index')
            ->with('success', 'Modal berhasil dihapus.');
    }
}
