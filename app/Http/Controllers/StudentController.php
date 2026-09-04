<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student');
    }

    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function submissions()
    {
        $submissions = Auth::user()->submissions()->latest()->paginate(10);
        return view('student.submissions', compact('submissions'));
    }

    public function create()
    {
        $categories = Category::all();
        $supervisors = User::where('role_id', 2)->get();
        return view('student.create', compact('categories', 'supervisors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'supervisor_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['author'] = Auth::user()->name;
        $data['status'] = 'pending';
        $data['submitted_at'] = now();
        $data['is_open_source'] = $request->has('is_open_source');

        if ($request->has('supervisor_id') && !empty($request->supervisor_id)) {
            $data['supervisor_id'] = $request->supervisor_id;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('submissions', $filename, 'public');
            $data['file_path'] = $path;
        }

        Submission::create($data);

        return redirect()->route('student.submissions')
            ->with('success', '✅ Submission submitted successfully!');
    }

    public function track($id)
    {
        $submission = Submission::where('user_id', Auth::id())->findOrFail($id);
        return view('student.track', compact('submission'));
    }

    public function search(Request $request)
    {
        $query = Submission::where('status', 'published');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('abstract', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%");
            });
        }

        $submissions = $query->paginate(12);
        return view('student.search', compact('submissions'));
    }

    public function quick()
    {
        return view('student.quick');
    }
}
