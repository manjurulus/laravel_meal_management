<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Show the manager dashboard with a list of members.
     */
    public function dashboard()
    {
        $members = User::where('role', 'member')->get();
        return view('manager.dashboard', compact('members'));
    }

    /**
     * Show the form to create a new user (any role).
     */
    public function createUser()
    {
        return view('manager.users.create');
    }

    /**
     * Store a newly created user with role assignment.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,manager,member,accountant,operations',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('manager.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display a list of all users.
     */
    public function index()
    {
        $users = User::all();
        return view('manager.users.index', compact('users'));
    }

    /**
     * Optional: Search members by name or email.
     */
    public function searchMembers(Request $request)
    {
        $query = $request->input('query');
        $members = User::where('role', 'member')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->get();

        return view('manager.dashboard', compact('members'));
    }
}
