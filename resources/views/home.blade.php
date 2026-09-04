@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @auth
                        @php
                            $redirect = '';
                            if(auth()->user()->role_id == 1) {
                                $redirect = route('student.dashboard');
                            } elseif(auth()->user()->role_id == 2) {
                                $redirect = route('faculty.dashboard');
                            } elseif(auth()->user()->role_id == 3) {
                                $redirect = route('librarian.dashboard');
                            } elseif(auth()->user()->role_id == 4) {
                                $redirect = route('admin.dashboard');
                            }
                        @endphp

                        @if($redirect)
                            <script>window.location.href = "{{ $redirect }}";</script>
                        @else
                            <h3>Welcome, {{ auth()->user()->name }}!</h3>
                            <p class="text-danger">⚠️ Role not assigned. Please contact administrator.</p>
                        @endif
                    @else
                        <h3>Welcome Guest!</h3>
                        <p>Please <a href="/login">Login</a> or <a href="/register">Register</a> to access the system.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
