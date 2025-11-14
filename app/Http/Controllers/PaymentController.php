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
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|string',
        ]);

        $accountant = Auth::user();

        if ($accountant && $accountant->role === 'accountant') {
            // 1. Record payment
            Payment::create([
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'method' => $request->method,
                'payment_date' => now(),
            ]);

            // 2. Apply payment to earliest unpaid bill
            $user = \App\Models\User::find($request->user_id);

            $unpaidBill = $user->bills()
                ->withPivot('paid_amount')
                ->get()
                ->filter(fn ($bill) => $bill->pivot->paid_amount < $bill->amount)
                ->sortBy('due_date')
                ->first();

            if ($unpaidBill) {
                $currentPaid = $unpaidBill->pivot->paid_amount;
                $newPaid = $currentPaid + $request->amount;

                $user->bills()->updateExistingPivot($unpaidBill->id, [
                    'paid_amount' => $newPaid,
                    'payment_date' => now(),
                ]);
            }

            return back()->with('success', 'Payment recorded for member.');
        }

        return back()->withErrors('Only accountants can record payments.');
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
