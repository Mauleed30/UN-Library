@extends('layouts.librarian')

@section('title', 'Access Level')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>🔓 Set Access Level</h4>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('librarian.set-access', 0) }}" id="accessForm">
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <label class="fw-bold">Select Submission</label>
                    <select name="submission_id" class="form-control" required>
                        <option value="">-- Select --</option>
                        @foreach($submissions as $sub)
                            <option value="{{ $sub->id }}">
                                {{ Str::limit($sub->title, 45) }}
                                @if($sub->is_open_source) 🔓 @else 🔒 @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">Access Level</label>
                    <select name="is_open_source" class="form-control" required>
                        <option value="1">🔓 Open Access</option>
                        <option value="0">🔒 Restricted</option>
                    </select>
                </div>
                <div class="col-md-3" style="padding-top: 22px;">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('accessForm').addEventListener('submit', function(e) {
        const id = this.querySelector('select[name="submission_id"]').value;
        if (!id) {
            e.preventDefault();
            alert('Please select a submission first.');
        } else {
            this.action = "{{ route('librarian.set-access', '') }}/" + id;
        }
    });
</script>
@endsection
