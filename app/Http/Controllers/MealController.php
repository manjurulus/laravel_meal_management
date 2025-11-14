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
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user) {
            Meal::create([
                'user_id' => $user->id,
                'date' => $request->date,
                'quantity' => $request->quantity,
            ]);

            return redirect()->route('meals.index')->with('success', 'Meal added successfully.');
        }

        return redirect()->back()->withErrors('User not authenticated.');
    }
}
