@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>🎓 Student Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <h5>📝 Submit New Work</h5>
            <p>Submit your thesis or project</p>
            <a href="/posts/create" class="btn btn-primary">Submit</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h5>📋 My Submissions</h5>
            <p>View your submitted work</p>
            <a href="/posts" class="btn btn-success">View</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <h5>📊 Submission Status</h5>
            <p>Track your submission progress</p>
            <a href="#" class="btn btn-info">Track</a>
        </div>
    </div>
</div>
@endsection