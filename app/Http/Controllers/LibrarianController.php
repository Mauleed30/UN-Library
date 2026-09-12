<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibrarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:librarian');
    }

    public function dashboard()
    {
        return view('librarian.dashboard');
    }

    public function submissions(Request $request)
    {
        $status = $request->query('status');
        $query = Submission::query();

        if ($status && in_array($status, ['pending', 'reviewed', 'approved', 'rejected', 'published'])) {
            $query->where('status', $status);
        } else {
            $query->whereIn('status', ['reviewed', 'approved', 'rejected', 'published']);
        }

        $submissions = $query->latest()->paginate(15);
        return view('librarian.submissions', compact('submissions', 'status'));
    }

    public function review($id)
    {
        $submission = Submission::with(['user', 'category', 'supervisor'])->findOrFail($id);
        return view('librarian.review', compact('submission'));
    }

    public function approve(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = 'approved';
        $submission->reviewed_by = Auth::id();
        $submission->review_notes = $request->review_notes;
        $submission->reviewed_at = now();
        $submission->save();

        return redirect()->route('librarian.submissions')->with('success', '✅ Submission approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = 'rejected';
        $submission->reviewed_by = Auth::id();
        $submission->review_notes = $request->review_notes;
        $submission->reviewed_at = now();
        $submission->save();

        return redirect()->route('librarian.submissions')->with('error', '❌ Submission rejected.');
    }

    public function publish($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = 'published';
        $submission->published_at = now();
        $submission->save();

        return redirect()->route('librarian.submissions')->with('success', '📚 Submission published successfully!');
    }

    public function editMetadata($id)
    {
        $submission = Submission::findOrFail($id);
        $categories = Category::all();
        return view('librarian.edit-metadata', compact('submission', 'categories'));
    }

    public function updateMetadata(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $submission->update([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'is_open_source' => $request->has('is_open_source'),
        ]);

        return redirect()->route('librarian.submissions')->with('success', '✅ Metadata updated!');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('librarian.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);
        return redirect()->route('librarian.categories')->with('success', '✅ Category created!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('librarian.categories')->with('success', '✅ Category deleted!');
    }

    public function setAccessLevel(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->is_open_source = $request->is_open_source;
        $submission->save();
        return redirect()->back()->with('success', '✅ Access level updated!');
    }

    public function stats()
    {
        return view('librarian.stats');
    }

    public function quick()
    {
        return view('librarian.quick');
    }

    public function access()
    {
        $submissions = Submission::where('status', 'approved')->orWhere('status', 'published')->get();
        return view('librarian.access', compact('submissions'));
    }

    public function activity()
    {
        $activities = Submission::whereNotNull('reviewed_at')->latest('reviewed_at')->paginate(15);
        return view('librarian.activity', compact('activities'));
    }
}