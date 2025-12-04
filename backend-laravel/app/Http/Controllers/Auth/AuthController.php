<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin' // optional if you want role selection during registration
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user', // default to 'user'
        ]);

        return redirect()->route('login.view')->with('success','Registered successfully');
    }

    public function login(Request $request) {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

           
            // Redirect based on role
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } else {
            return redirect()->route('user.dashboard')->with('success', 'Welcome User!');
        }
        }

        return redirect()->back()->with('error','Invalid credentials');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.view')->with('success','Logout Successfully');
    }
}
