<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ✅ ONDOA METHOD YA USERNAME - TUMIA EMAIL DEFAULTE
    // public function username()
    // {
    //     return 'username';
    // }

    protected function authenticated(Request $request, $user)
    {
        // ✅ REDIRECT KULINGANA NA ROLE
        if ($user->role_id == 1) {
            return redirect()->route('student.dashboard');
        } elseif ($user->role_id == 2) {
            return redirect()->route('faculty.dashboard');
        } elseif ($user->role_id == 3) {
            return redirect()->route('librarian.dashboard');
        } elseif ($user->role_id == 4) {
            return redirect()->route('admin.dashboard');
        }

        return redirect('/');
    }
}
