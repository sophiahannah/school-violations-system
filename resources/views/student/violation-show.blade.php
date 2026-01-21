@extends('layouts.student.app')

@section('navbar-title', 'Violation Details')

@section('content')

<div class="container-fluid px-3 px-lg-4 pb-5">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fw-bold m-0 fs-3 fs-md-2">Violation Details</h2>
        <a href="{{ route('student.dashboard.index') }}" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
    </div>

    <div class="row g-4">

        @include('student.partials.student-info')

        <div class="col-12 col-lg-8 col-xl-9">
            <div class="card shadow-sm border-0 rounded-3">
                <div
                    class="card-header border-0 text-white fw-bold py-3 bg-primary d-flex justify-content-between align-items-center">
                    <span>Violation Timeline</span>
                    <span class="small">Case ID: {{ $record->formatCaseId() }}</span>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-1">{{ $record->violationSanction->violation->violation_name }}</h5>
                        <div class="d-flex flex-wrap align-items-center gap-2 small text-muted mb-2">
                            <span>Offense:
                                <x-offense-badge :offense="$record->violationSanction->no_of_offense" />
                            </span>
                            <span class="vr"></span>
                            <span>Status:
                                <x-status-badge :status="$record->status->status_name" />
                            </span>
                        </div>
                        <p class="small mb-0"><strong>Sanction:</strong> {{
                            $record->violationSanction->sanction->sanction_name }}</p>
                        @if($record->notes)
                        <p class="small text-muted mt-1 mb-0"><strong>Notes:</strong> {{ $record->notes }}</p>
                        @endif
                    </div>

                    <hr>

                    {{-- Appeal Summary if there is appeal --}}
                    @if($record->appeal)
                    <div class="p-2">
                        <h6 class="fw-bold mb-2">Appeal Summary</h6>
                        <p class="small mb-1">{{ $record->appeal->appeal_content }}</p>

                    </div>
                    <hr>
                    @endif

                    <!-- Timeline -->
                    <section class="p-2">
                        <h4 class="fw-bold mb-3">Record Timeline</h4>
                        <ul class="timeline ms-4">
                            @foreach($timeline as $event)
                            <li class="timeline-item mb-5">
                                <div class="">
                                    <div
                                        class="d-flex flex-wrap align-items-center gap-2 {{ $loop->iteration === 1 ? 'text-primary fs-5' : '' }}">
                                        <span class="fw-bold">{{ $event['title'] }}</span>
                                    </div>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($event['timestamp'])->format('M d, Y h:i A') }}
                                    </small>
                                    <p class="small mb-0 text-muted">{{ $event['description'] }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection