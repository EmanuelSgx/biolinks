<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\hash;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $user = User::query()
            ->where('email', '=', $request->input('email'))
            ->first();
        if ($user) {
            dd(Hash::check($request->input('password'), $user->password));
            // Login successful
            return redirect()->route('dashboard');
        } else {
            // Login failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }
}
