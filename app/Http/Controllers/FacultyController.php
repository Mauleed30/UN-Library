<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:faculty');
    }

    public function dashboard()
    {
        return view('faculty.dashboard');
    }

    // ✅ ONGEZA HII
    public function pending()
    {
        $submissions = Submission::where('status', 'pending')->latest()->paginate(10);
        return view('faculty.pending', compact('submissions'));
    }

    public function submissions()
    {
        $submissions = Submission::where('status', 'pending')->latest()->paginate(10);
        return view('faculty.submissions', compact('submissions'));
    }

    public function assigned()
    {
        $submissions = Submission::where('supervisor_id', Auth::id())->latest()->paginate(10);
        return view('faculty.assigned', compact('submissions'));
    }

    public function review($id)
    {
        $submission = Submission::with(['user', 'category'])->findOrFail($id);
        return view('faculty.review', compact('submission'));
    }

    public function endorse(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        
        $request->validate([
            'review_notes' => 'nullable|string|max:1000',
            'action' => 'required|in:endorse,reject,request_changes',
        ]);

        $action = $request->action;
        $reviewNotes = $request->review_notes;

        switch ($action) {
            case 'endorse':
                $submission->status = 'reviewed';
                $submission->supervisor_id = Auth::id();
                $submission->review_notes = $reviewNotes;
                $submission->reviewed_at = now();
                $submission->save();
                return redirect()->route('faculty.dashboard')
                    ->with('success', '✅ Submission endorsed successfully!');
            case 'reject':
                $submission->status = 'rejected';
                $submission->supervisor_id = Auth::id();
                $submission->review_notes = $reviewNotes;
                $submission->reviewed_at = now();
                $submission->save();
                return redirect()->route('faculty.dashboard')
                    ->with('error', '❌ Submission rejected.');
            case 'request_changes':
                $submission->status = 'pending';
                $submission->supervisor_id = Auth::id();
                $submission->review_notes = $reviewNotes;
                $submission->reviewed_at = now();
                $submission->save();
                return redirect()->route('faculty.dashboard')
                    ->with('warning', '🔄 Changes requested.');
            default:
                return back()->with('error', 'Invalid action.');
        }
    }

    public function track()
    {
        return view('faculty.track');
    }

    public function quick()
    {
        return view('faculty.quick');
    }
}