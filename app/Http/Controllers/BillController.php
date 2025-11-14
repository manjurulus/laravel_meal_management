<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\UserBill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('users')->latest()->get();
        return view('manager.bills.index', compact('bills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date'
        ]);

        Bill::create($request->all());
        return back()->with('success', 'Bill created');
    }

    public function assignToUser(Request $request, Bill $bill)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'paid_amount' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
        ]);

        $bill->users()->attach($request->user_id, [
            'paid_amount' => $request->paid_amount,
            'payment_date' => $request->payment_date,
        ]);

        return back()->with('success', 'Bill assigned to user.');
    }

    public function memberDues()
    {
        $userId = auth()->id();

        // Aggregated dues per bill
        $userBills = UserBill::with('bill')
            ->where('user_id', $userId)
            ->get()
            ->groupBy('bill_id')
            ->map(function ($entries) {
                $bill = $entries->first()->bill;
                $totalPaid = $entries->sum('paid_amount');
                $latestPaymentDate = $entries->max('payment_date');

                return [
                    'title' => $bill->title,
                    'total' => $bill->amount,
                    'paid' => $totalPaid,
                    'due' => $bill->amount - $totalPaid,
                    'payment_date' => $latestPaymentDate,
                ];
            });

        // Individual payment history
        $payments = Payment::where('user_id', $userId)
            ->latest()
            ->get();

        return view('member.dues.index', [
            'bills' => $userBills,
            'payments' => $payments,
        ]);
    }
}
