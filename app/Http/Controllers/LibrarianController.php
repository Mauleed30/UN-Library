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
        $pendingReview = Submission::where('status', 'reviewed')->count();
        $approved = Submission::where('status', 'approved')->count();
        $rejected = Submission::where('status', 'rejected')->count();
        $published = Submission::where('status', 'published')->count();
        $total = Submission::count();
        $openAccess = Submission::where('is_open_source', true)->count();
        $restricted = Submission::where('is_open_source', false)->count();
        $submissions = Submission::where('status', 'reviewed')->latest()->take(5)->get();

        return view('librarian.dashboard', compact(
            'pendingReview', 'approved', 'rejected', 'published', 'total',
            'openAccess', 'restricted', 'submissions'
        ));
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

        return redirect()->route('librarian.dashboard')->with('success', '✅ Submission approved successfully!');
    }

    public function reject(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = 'rejected';
        $submission->reviewed_by = Auth::id();
        $submission->review_notes = $request->review_notes;
        $submission->reviewed_at = now();
        $submission->save();

        return redirect()->route('librarian.dashboard')->with('error', '❌ Submission rejected.');
    }

    public function publish($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->status = 'published';
        $submission->published_at = now();
        $submission->save();

        return redirect()->route('librarian.dashboard')->with('success', '📚 Submission published successfully!');
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

        return redirect()->route('librarian.dashboard')->with('success', '✅ Metadata updated successfully!');
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
        $total = Submission::count();
        $pendingReview = Submission::where('status', 'reviewed')->count();
        $approved = Submission::where('status', 'approved')->count();
        $rejected = Submission::where('status', 'rejected')->count();
        $published = Submission::where('status', 'published')->count();
        $openAccess = Submission::where('is_open_source', true)->count();
        $restricted = Submission::where('is_open_source', false)->count();
        $monthlyData = Submission::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')->orderBy('month', 'desc')->take(12)->get();

        return view('librarian.stats', compact('total', 'pendingReview', 'approved', 'rejected', 'published', 'openAccess', 'restricted', 'monthlyData'));
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
}
