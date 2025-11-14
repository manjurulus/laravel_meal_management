<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the authenticated member's payments.
     */
    public function index()
    {
        $user = Auth::user();

        $payments = $user
            ? Payment::where('user_id', $user->id)->latest()->get()
            : collect(); // empty collection if not authenticated

        return view('member.payments.index', compact('payments'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|string',
        ]);

        $user = Auth::user();

        if ($user) {
            Payment::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'method' => $request->method,
                // 'created_at' is automatically handled by Laravel
            ]);

            return redirect()->route('payments.index')->with('success', 'Payment recorded.');
        }

        return redirect()->route('payments.index')->withErrors('User not authenticated.');
    }

    /**
     * Display all payments for accountants.
     */
    public function receive()
    {
        $payments = Payment::latest()->get();

        return view('accountant.payments.receive', compact('payments'));
    }
}
