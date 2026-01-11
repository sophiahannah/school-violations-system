@extends('layouts.admin.app')

@section('navbar-title', 'Admin Dashboard')

@section('content')
<div class="container py-4">

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">

        {{-- Total Violations --}}
        <div class="col-md-3 col-6">
            <div class="card shadow border-0 ">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1">Total Violations</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-primary">{{ $summary['total_violations'] }}</h3>
                    </div>
                    <span class="bg-red-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-exclamation-circle text-primary fs-1 p-0" style=""></i>
                    </span>
                </div>
            </div>
        </div>

        {{-- Pending / In Progress --}}
        <div class="col-md-3 col-6">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1">Pending</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-info">{{ $summary['pending'] }}</h3>
                    </div>
                    <span class="bg-blue-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-check-circle-fill text-info fs-1 opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

        {{-- Under Review --}}
        <div class="col-md-3 col-6">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1">Under Review</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-warning">{{ $summary['under_review'] }}</h3>
                    </div>
                    <span class="bg-yellow-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-hourglass-split fs-1 text-warning opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

        {{-- Resolved Cases --}}
        <div class="col-md-3 col-6">
            <div class="card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1">Resolved Cases</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-success">{{ $summary['resolved'] }}</h3>
                    </div>
                    <span class="bg-green-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-check-circle-fill text-success fs-1 opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>


    <div class="row g-4">
        {{-- Left Column: Tables --}}
        <div class="col-lg-7">

            {{-- Recent Violations Table --}}
            <div class="card shadow border-0 mb-4">
                <div class="card-header d-flex justify-content-between bg-primary text-white ">
                    <div>
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        <span class="fw-bold">

                            Recent Violations
                        </span>
                    </div>
                    <div class="">
                        <a href="{{ route('violations-management.index') }}"
                            class="text-white icon-link icon-link-hover">
                            View All
                            <i class="bi bi-arrow-right d-flex align-items-center"></i>
                        </a>
                    </div>

                </div>
                <div class="card-body p-0">
                    <div class="table">
                        <table class="table table-hover  mb-0 align-middle ">
                            <thead class="table-light">
                                <tr>
                                    <th>Case ID</th>
                                    <th>Student</th>
                                    <th>Violation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentViolations as $record)
                                <tr>
                                    <td class="text-danger fw-bold">V-{{ date('Y') }}-{{ $record->id }}</td>
                                    <td class="text-truncate" style="max-width: 120px;">
                                        {{ $record->user->first_name.' '.$record->user->last_name }}
                                    </td>
                                    <td class="" style="max-width: 150px;">
                                        {{ $record->violationSanction->violation->violation_name }}
                                    </td>
                                    <td>
                                        <x-status-badge :status="$record->status->status_name" />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">No recent violations</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Recent Appeals Table --}}
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="bi bi-file-earmark-text me-1"></i> Recent Appeals
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th> Appeal ID</th>
                                    <th>Case ID</th>
                                    <th>Student</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentAppeals as $appeal)
                                <tr>
                                    <td>A-{{ $appeal->id }}</td>
                                    <td>V-{{ date('Y') }}-{{ $appeal->violationRecord->id }}</td>
                                    <td class="text-truncate" style="max-width: 140px;">
                                        {{ $appeal->violationRecord->user->first_name.'
                                        '.$appeal->violationRecord->user->last_name }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $appeal->is_accepted ? 'success' : 'warning' }}">
                                            {{ $appeal->is_accepted ? 'Resolved' : 'Pending' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">No recent appeals</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right Column: Smaller Chart --}}
        <div class="col-lg-5">
            <div class="card shadow ">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-bar-chart-fill me-1"></i> {{ $violationsChart->options['chart_title'] }}
                </div>
                <div class="card-body">
                    {!! $violationsChart->renderHtml() !!}
                    {!! $violationsChart->renderChartJsLibrary() !!}
                    {!! $violationsChart->renderJs() !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection