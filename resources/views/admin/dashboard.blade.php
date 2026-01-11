@extends('layouts.admin.app')

@section('navbar-title', 'Violation and Sanction Management')
@section('content')
<div class="container-fluid w-100">
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
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i
                                class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0"
                            placeholder="Search by student name or ID...">
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('admin.dashboard.index') }}" method="get">
                        <select class="form-select border-start-0" style="font-size: 0.85rem; color: #4b5563;"
                            name="status" onchange="this.form.submit()">

                            <option value="all">All status</option>

                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ request('status')==$status->id ? 'selected'
                                : '' }}>{{ $status->status_name }}</option>
                            @endforeach

                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-nowrap">
                            <th class="">Case ID</th>
                            <th class="text-center">Student ID</th>
                            <th class="">Student Name</th>
                            <th class="">Violation Type</th>
                            <th class="">Date</th>
                            <th class="">Record</th>
                            <th class="">Status</th>
                            {{-- <th class="">Sanction</th> --}}
                            <th class="" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="violationTableBody">
                        @forelse($violationRecords as $record)
                        <tr>
                            <td class="fw-bold text-danger text-nowrap">
                                V-{{ date('Y') }}-{{ $record->id }}
                            </td>
                            <td class="text-nowrap text-center">
                                {{ $record->user->id}}
                            </td>
                            <td class="text-nowrap" class="fw-bold">
                                {{ $record->user->first_name.' '.$record->user->last_name}}
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

                            {{-- <td>{{ $record->violationSanction->sanction->name ?? 'N/A' }}</td> --}}

                            <td class="text-center text-nowrap">
                                <button class="btn-action-view" data-bs-toggle="modal"
                                    data-bs-target="#viewViolationModal-{{ $record->id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button class="btn-action-view" data-bs-toggle="modal"
                                    data-bs-target="#editViolationModal-{{ $record->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn-action-delete" onclick="confirmDelete('{{ $record->id }}')">
                                    <i class="bi bi-trash text-red"></i>
                                </button>
                            </td>
                            <x-modals.view-violation :record="$record" :id="'viewViolationModal-'.$record->id" />
                            <x-modals.edit-violation :record="$record" :id="'editViolationModal-'.$record->id" :violations="$violations"/>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No violation records found.</td>
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

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Confirm Delete</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="text-muted">Are you sure?</p><input type="hidden" id="delete_id_storage">
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="executeDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection