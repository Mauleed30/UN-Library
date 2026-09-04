<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username', 'name', 'email', 'password', 'role_id',
        'program', 'student_id', 'department', 'year_of_study',
        'staff_id', 'title', 'section'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Find user by username (for login)
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship with Submissions
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Check user roles
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function isStudent()
    {
        return $this->role_id === 1;
    }

    public function isFaculty()
    {
        return $this->role_id === 2;
    }

    public function isLibrarian()
    {
        return $this->role_id === 3;
    }

    public function isAdmin()
    {
        return $this->role_id === 4;
    }
}
