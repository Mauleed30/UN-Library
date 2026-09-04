<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Submission;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalSubmissions = Submission::count();
        $pendingSubmissions = Submission::where('status', 'pending')->count();
        $publishedSubmissions = Submission::where('status', 'published')->count();
        $totalCategories = Category::count();
        $recentSubmissions = Submission::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalSubmissions', 'pendingSubmissions',
            'publishedSubmissions', 'totalCategories', 'recentSubmissions'
        ));
    }

    // ==================== USERS ====================
    public function users()
    {
        $users = User::with('role')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.create-user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.edit-user', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        if ($id == Auth::id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete yourself!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    // ==================== SUBMISSIONS ====================
    public function submissions()
    {
        $submissions = Submission::latest()->paginate(15);
        return view('admin.submissions', compact('submissions'));
    }

    // ==================== CATEGORIES ====================
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    // ==================== ANALYTICS ====================
    public function analytics()
    {
        return view('admin.analytics');
    }

    // ==================== BACKUPS ====================
    public function backups()
    {
        $backups = [];
        $backupPath = storage_path('app/backups');

        if (is_dir($backupPath)) {
            $files = scandir($backupPath);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $backups[] = [
                        'name' => $file,
                        'size' => number_format(filesize($backupPath . '/' . $file) / 1024, 2) . ' KB',
                        'date' => date('d M Y, H:i', filemtime($backupPath . '/' . $file)),
                    ];
                }
            }
            rsort($backups);
        }

        return view('admin.backups', compact('backups'));
    }

    public function createBackup()
    {
        $backupPath = storage_path('app/backups');
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $filepath = $backupPath . '/' . $filename;

        $db = config('database.connections.mysql');
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            escapeshellarg($db['username']),
            escapeshellarg($db['password']),
            escapeshellarg($db['host']),
            escapeshellarg($db['database']),
            escapeshellarg($filepath)
        );

        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            return redirect()->route('admin.backups')->with('success', 'Backup created successfully!');
        }

        return redirect()->route('admin.backups')->with('error', 'Backup creation failed!');
    }

    public function downloadBackup($filename)
    {
        $filepath = storage_path('app/backups/' . $filename);
        if (!file_exists($filepath)) {
            return redirect()->route('admin.backups')->with('error', 'File not found!');
        }
        return response()->download($filepath, $filename);
    }

    public function deleteBackup($filename)
    {
        $filepath = storage_path('app/backups/' . $filename);
        if (file_exists($filepath)) {
            unlink($filepath);
            return redirect()->route('admin.backups')->with('success', 'Backup deleted successfully!');
        }
        return redirect()->route('admin.backups')->with('error', 'File not found!');
    }

    // ==================== SETTINGS ====================
    public function settings()
    {
        return view('admin.settings');
    }
}
