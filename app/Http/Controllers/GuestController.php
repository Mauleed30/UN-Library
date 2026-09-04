<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function catalogue(Request $request)
    {
        $query = Submission::where('status', 'published');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('abstract', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%");
            });
        }

        $submissions = $query->latest()->paginate(12);

        return view('guest.catalogue', compact('submissions'));
    }

    public function view($id)
    {
        $submission = Submission::where('status', 'published')->findOrFail($id);
        return view('guest.view', compact('submission'));
    }

    public function download($id)
    {
        $submission = Submission::where('status', 'published')->findOrFail($id);

        if (!$submission->is_open_source) {
            abort(403, 'This item is not open source.');
        }

        $filePath = storage_path('app/public/' . $submission->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $submission->title . '.pdf');
    }
}
