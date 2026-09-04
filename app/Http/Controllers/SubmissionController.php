<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::latest()->paginate(10);
        return view('submissions.index', compact('submissions'));
    }

    public function show($id)
    {
        $submission = Submission::with(['user', 'category', 'supervisor'])
            ->findOrFail($id);
        return view('submissions.show', compact('submission'));
    }
}
