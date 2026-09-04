<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    private function generateStudentId($program)
    {
        $lastStudent = User::where('program', $program)
            ->whereNotNull('student_id')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastStudent && $lastStudent->student_id) {
            $parts = explode('/', $lastStudent->student_id);
            $lastNumber = isset($parts[1]) ? intval($parts[1]) : 0;
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        $year = date('Y');
        return $program . '/' . $newNumber . '/' . $year;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ✅ FORCE ROLE_ID = 1 FOR ALL STUDENTS
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,  // ✅ MOJA KWA MOJA - STUDENT
        ];

        // Generate student ID
        $program = $request->program ?? 'BACH';
        $data['program'] = $program;
        $data['student_id'] = $this->generateStudentId($program);
        $data['department'] = $request->department;
        $data['year_of_study'] = $request->year_of_study;

        $user = User::create($data);

        event(new Registered($user));
        Auth::login($user);

        // ✅ REDIRECT DIRECT TO STUDENT DASHBOARD
        return redirect()->route('student.dashboard');
    }
}
