<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller
{
    public function index()
    {
        // get all data
        $data = DB::table('developers') -> get();

        // view return

        return view('devs.index', [
            "developers" => $data
        ]);
    }

    public function edit()
    {
        return view('devs.edit');
    }

    public function create()
    {
        return view('devs.create');
    }

    public function show($id)
    {
        // get single data
        $data = DB::table('developers') -> where('id', $id) -> first();
        return view('devs.show', [
            "dev" => $data
        ]);
    }

    public function store(Request $request)
    {
        // data validation
        $request -> validate([
            "name" => "required|min:5|max:10",
            "age" => "required",
            "location" => "required",
            "skill" => "required"
        ]);
        // send data to DB
        DB::table('developers') -> insert([
            "name" => $request -> name,
            "age" => $request -> age,
            "skill" => $request -> skill,
            "location" => $request -> location,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        // redirect back
        return redirect('/dev');
    }

    public function destroy($id)
    {
        // delete Data
        DB::table('developers') -> where('id', $id) -> delete();

        // return
        return back();
    }
}
