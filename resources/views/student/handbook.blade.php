@extends('layouts.student.app')

@section('navbar-title', 'Student Handbook')

@section('content')
<div class="container-fluid bg-light min-vh-100 py-4">
    <div class="container">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="h3 fw-bold text-dark mb-1">Student Handbook</h1>
            <p class="text-muted small mb-0">Violations and Corresponding Sanctions</p>
        </div>

        <!-- Violations List -->
        @if($violations->count() > 0)
        <div class="violations-container">
            @foreach($violations as $violationId => $violationGroup)
            @php
            $firstItem = $violationGroup->first();
            @endphp
            <div class="card mb-3 border-0 shadow-sm violation-item">
                <!-- Violation Header -->
                <div class="card-header bg-white border-1 p-0">
                    <button class="btn w-100 text-start d-flex justify-content-between align-items-center py-3 px-4 violation-toggle collapsed border-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $violationId }}"
                        aria-expanded="false"
                        aria-controls="collapse-{{ $violationId }}">
                        <span class="fw-semibold" style="color: #800000">{{ $firstItem->violation_name }}</span>
                        <i class="bi bi-chevron-down chevron-icon" style="color: #800000"></i>
                    </button>
                </div>

                <!-- Sanctions Content -->
                <div id="collapse-{{ $violationId }}" class="collapse">
                    <div class="card-body bg-light border-top px-4 py-3">
                        <h6 class="text-dark fw-semibold small mb-3">Sanctions</h6>
                        <ul class="list-unstyled mb-0 text-muted small">
                            @foreach($violationGroup as $item)
                            @php
                            $offenseNum = $item->no_of_offense;
                            $suffix = 'th';
                            if ($offenseNum % 100 < 11 || $offenseNum % 100> 13) {
                                switch ($offenseNum % 10) {
                                case 1: $suffix = 'st'; break;
                                case 2: $suffix = 'nd'; break;
                                case 3: $suffix = 'rd'; break;
                                }
                                }
                                @endphp
                                <li class="mb-2">• {{ $offenseNum }}{{ $suffix }} offense: {{ $item->sanction_name }}</li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <svg class="mx-auto mb-3" width="64" height="64" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: #cbd5e0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="h5 fw-semibold text-secondary mb-2">No Violations Found</h3>
                <p class="text-muted mb-0">The handbook is currently empty.</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection