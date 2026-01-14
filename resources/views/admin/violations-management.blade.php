@extends('layouts.admin.app')

@section('navbar-title', 'Violation and Sanction Management')
@section('content')
<div class="container-fluid px-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Violation Logs</h5>
            <button class="btn text-white" style="background-color: #800000;" data-bs-toggle="modal"
                data-bs-target="#logViolationModal">
                <i class="fas fa-plus me-1"></i>
                Log Violation
            </button>
            <x-modals.log-violation :violations="$violations" />
        </div>
        <div class="card-body">
            <div class="row mb-3 g-2">
                <div class="col-md-8">
                    <form action="{{ route('admin.violations-management.index') }}" method="get" id="searchForm">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" name="search" id="searchInput"
                                value="{{ request('search') }}" placeholder="Search by student name or ID...">
                            @if(request('search'))
                            <button type="button" class="btn btn-outline-secondary" id="clearSearch">
                                <i class="bi bi-x"></i>
                            </button>
                            @endif
                        </div>
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.violations-management.index') }}" method="get">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select class="form-select" name="status" onchange="this.form.submit()">
                            <option value="all">All status</option>
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ request('status')==$status->id ? 'selected' : '' }}>
                                {{ $status->status_name }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr class="text-nowrap">
                            <th>Case ID</th>
                            {{-- <th class="text-center">Student ID</th> --}}
                            <th class="">Student Name</th>
                            <th class="">Violation Type</th>
                            <th class="">Date</th>
                            <th class="">Record</th>
                            <th class="">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="violationTableBody">
                        @forelse($violationRecords as $record)
                        <tr data-bs-toggle="modal" data-bs-target="#viewViolationModal-{{ $record->id }}" role="button">
                            <td class="text-nowrap fw-bold text-danger">
                               {{ $record->formatCaseId() }}
                            </td>
                            {{-- <td class="fw-bold text-nowrap text-center">
                                {{ $record->user->school_id}}
                            </td> --}}
                            <td class="text-nowrap pe-3">
                                <span
                                    class="d-flex justify-content-between align-items-center gap-1 fs-5 fw-bold text-primary">
                                    {{ $record->user->last_name}}
                                    <span class="fs-6 text-secondary fw-light">
                                       ({{ $record->user->school_id}})
                                    </span>

                                </span>
                                <span class="d-block fs-6 text-muted">
                                    {{ $record->user->first_name}}
                                </span>
                            </td>
                            <td class="">
                                {{ $record->violationSanction->violation->violation_name}}
                            </td>
                            <td class="text-nowrap">
                                {{ $record->created_at->format('Y-m-d') }}
                            </td>
                            <td>
                                <x-offense-badge :offense="$record->violationSanction->no_of_offense" />
                            </td>

                            <td>
                                <x-status-badge :status="$record->status->status_name" />
                            </td>

                            <td class="text-center text-nowrap">
                                <button class="border-0 bg-transparent p-2 me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editViolationModal-{{ $record->id }}"
                                    onclick="event.stopPropagation()"
                                    title="Edit violation"
                                    style="cursor: pointer; transition: all 0.3s ease; border-radius: 0.5rem;"
                                    onmouseover="this.style.backgroundColor='rgba(13, 110, 253, 0.1)'; this.style.transform='translateY(-2px)'"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)'">
                                    <i class="bi bi-pencil-square" style="font-size: 1.1rem; color: #0c0429;"></i>
                                </button>
                                <button class="border-0 bg-transparent p-2 ms-1 me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteViolationModal-{{ $record->id }}"
                                    onclick="event.stopPropagation()"
                                    title="Delete violation"
                                    style="cursor: pointer; transition: all 0.3s ease; border-radius: 0.5rem;"
                                    onmouseover="this.style.backgroundColor='rgba(220, 53, 69, 0.1)'; this.style.transform='translateY(-2px)'"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)'">
                                    <i class="bi bi-trash" style="font-size: 1.1rem; color: #dc3545;"></i>
                                </button>
                            </td>
                        </tr>

                        <x-modals.view-violation :record="$record" :id="'viewViolationModal-'.$record->id" />
                        <x-modals.edit-violation :record="$record" :id="'editViolationModal-'.$record->id"
                            :violations="$violations" />
                        <x-modals.delete-violation :id="'deleteViolationModal-'.$record->id" :record="$record" />
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No violation records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-column justify-content-end align-items-end mx-3">
                <small class="text-muted" id="rowCounter">Showing {{ $violationRecordCount }} violations</small>
                <span class="">{{ $violationRecords->links() }}</span>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/violations-search.js'])
@endsection