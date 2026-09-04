<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'student', 'display_name' => 'Student', 'description' => 'Registered student who can submit academic work'],
            ['name' => 'faculty', 'display_name' => 'Faculty/Supervisor', 'description' => 'Lecturer who supervises students'],
            ['name' => 'librarian', 'display_name' => 'Librarian', 'description' => 'Curates the repository'],
            ['name' => 'admin', 'display_name' => 'System Administrator', 'description' => 'Manages the platform'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
