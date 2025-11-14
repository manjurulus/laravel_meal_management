<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Payment;
use App\Models\Expense;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monthly($month = null)
    {
        $month = $month ?? now()->month;

        if (!is_numeric($month) || $month < 1 || $month > 12) {
            abort(404);
        }

        $month = (int) $month;
        $year = now()->year;

        $meals = Meal::with('user')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $payments = Payment::with('user')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $expenses = Expense::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return view('accountant.reports.monthly', compact('meals', 'payments', 'expenses', 'month'));
    }

    public function index()
    {
        $month = now()->format('Y-m');

        $meals = Meal::with('user')
            ->where('created_at', 'like', "$month%")
            ->get();

        $payments = Payment::with('user')
            ->where('created_at', 'like', "$month%")
            ->get();

        $expenses = Expense::where('created_at', 'like', "$month%")
            ->get();

        return view('manager.reports.index', compact('meals', 'payments', 'expenses'));
    }
}
