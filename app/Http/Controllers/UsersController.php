<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('authentication.login');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // for register
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => "required",
        ]);
        User::create([
            'name' => $request->first_name . ' ' .$request->last_name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('authentication.login')->with('success','Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('authentication.register');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
