<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    /**
     * Display a listing of the meals.
     */
    public function index()
    {
        $meals = Meal::where('user_id', Auth::id())->latest()->get();
        return view('member.meals.index', compact('meals'));

    }

    /**
     * Show the form for creating a new meal.
     */
    public function create()
    {
        return view('member.meals.create');
    }

    /**
     * Store a newly created meal in storage.
     */
    // MealController.php
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        Meal::create([
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        return back()->with('success', 'Meal recorded.');
    }
}
