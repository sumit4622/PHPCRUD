<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   
use Illuminate\Support\Facades\Hash;

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
        if (User::where('email', $request['email'])->exists()){
            return redirect()->back()->withErrors(['email' => "Email already exist \n please use another email."]);
        } else{
            User::create([
            'name' => $request->first_name . ' ' .$request->last_name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('authentication.login')->with('success','Account created successfully.');
        }
        
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
    public function login(Request $request,)
    {
        $request -> validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('products.index');        
            }else{
            return redirect()->back()->withErrors(['email' => "account dosn't exist"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
