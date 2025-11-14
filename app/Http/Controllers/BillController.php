<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('users')->latest()->get();
        return view('manager.bills.index', compact('bills'));
    }

    public function createFromMeals()
    {
        $members = User::where('role', 'member')->get();
        return view('manager.bills.create', compact('members'));
    }

    public function storeFromMeals(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'rate' => 'required|numeric|min:0',
        ]);

        $mealCount = Meal::where('user_id', $request->user_id)
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->sum('quantity');

        $amount = $mealCount * $request->rate;
        $member = User::find($request->user_id);

        $bill = Bill::create([
            'title' => "{$member->name}'s Bill ({$mealCount} meals × ৳{$request->rate})",
            'amount' => $amount,
            'due_date' => now()->addDays(7),
        ]);

        $bill->users()->attach($request->user_id, [
            'paid_amount' => 0,
            'payment_date' => null,
        ]);

        return redirect()->route('bills.index')->with('success', 'Bill created from meals.');
    }

    public function memberDues()
    {
        $userId = auth()->id();

        $userBills = \App\Models\UserBill::with('bill')
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

        $payments = \App\Models\Payment::where('user_id', $userId)
            ->latest()
            ->get();

        return view('member.dues.index', [
            'bills' => $userBills,
            'payments' => $payments,
        ]);
    }
}
