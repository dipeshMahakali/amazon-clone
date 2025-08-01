<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($credential)) {
            return redirect('/admin-dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function create()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:50',
            'userEmail' => 'required|email',
            'pasword' => 'required|min:6',
            'confirmPasword' => 'required|same:pasword|min:6',
        ]);
        $password = Hash::make($request->pasword);
        User::create([
            'name' => $request->username,
            'email' => $request->userEmail,
            'password' => $password,
        ]);
        return redirect('/login')->with('success', 'User Registered Successfully.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidates the user's session

        $request->session()->regenerateToken();
        return redirect('/login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
