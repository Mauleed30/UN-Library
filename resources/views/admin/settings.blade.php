@extends('layouts.admin')

@section('title', 'Settings')
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>System Settings</h4>
        <span class="text-muted" style="font-size: 0.85rem;">
            <i class="far fa-calendar-alt me-1"></i> {{ now()->format('l, d M Y') }}
        </span>
    </div>

    <div class="card">
        <div class="card-header">
            <strong><i class="fas fa-info-circle me-2"></i> System Information</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Application Name</th>
                        <td><span class="fw-bold">{{ config('app.name') }}</span></td>
                    </tr>
                    <tr>
                        <th>Environment</th>
                        <td>
                            @if(config('app.env') == 'local')
                                <span class="badge bg-warning">Local</span>
                            @elseif(config('app.env') == 'production')
                                <span class="badge bg-success">Production</span>
                            @else
                                <span class="badge bg-secondary">{{ config('app.env') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Debug Mode</th>
                        <td>
                            @if(config('app.debug'))
                                <span class="badge bg-success">Enabled</span>
                            @else
                                <span class="badge bg-secondary">Disabled</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Application URL</th>
                        <td>{{ config('app.url') }}</td>
                    </tr>
                    <tr>
                        <th>Time Zone</th>
                        <td>{{ config('app.timezone') }}</td>
                    </tr>
                    <tr>
                        <th>Laravel Version</th>
                        <td><span class="fw-bold">{{ app()->version() }}</span></td>
                    </tr>
                    <tr>
                        <th>PHP Version</th>
                        <td><span class="fw-bold">{{ phpversion() }}</span></td>
                    </tr>
                    <tr>
                        <th>Database</th>
                        <td>{{ config('database.default') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
