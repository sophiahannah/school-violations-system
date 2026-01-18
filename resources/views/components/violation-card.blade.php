<div class="card shadow-lg border-0 h-100">
    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <span class="fw-bold" style="color: #800000; font-size: 0.9rem;">
                {{ $record->formatCaseId() }}
            </span>
            <x-status-badge :status="$record->status->status_name" />
        </div>

        <h6 class="mb-1">
            <span class="fw-bold text-primary">
                {{ $record->user->last_name }},
            </span>
            <span class="text-dark">{{ $record->user->first_name }}</span>
        </h6>
        <p class="text-muted small mb-2">
            <i class="bi bi-person-badge me-1"></i>{{ $record->user->school_id }}
        </p>

        <span class="d-block fw-semibold text-dark mb-1 pb-1" style="font-size: 14px;">
            {{ $record->violationSanction->violation->violation_name }}
        </span>

        <div class="m-2 pb-2 border-bottom mt-auto">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted" style="font-size: 12px;">
                    <i class="bi bi-calendar3 me-1"></i>{{ $record->created_at->format('M d, Y') }}
                </small>
                <x-offense-badge :offense="$record->violationSanction->no_of_offense" />
            </div>
        </div>

        <div class="">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm flex-fill bg-red text-white border p-1" data-bs-toggle="modal"
                    data-bs-target="#viewViolationModal-{{ $record->id }}">
                    <i class="bi bi-eye me-1"></i> View
                </button>

                <div class="btn-group justify-content-end d-flex" role="group" aria-label="Violation actions">
                    @if ($record->status_id === 2)
                    <button type="button" class="btn btn-sm btn-outline-primary action-resolve-btn"
                        title="Mark as resolved">
                        <i class="bi bi-check2-square"></i>
                    </button>
                    @endif

                    <button type="button" class="btn btn-sm btn-outline-primary action-edit-btn" title="Edit violation"
                        data-bs-toggle="modal" data-bs-target="#editViolationModal-{{ $record->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-primary action-delete-btn"
                        title="Delete violation" data-bs-toggle="modal"
                        data-bs-target="#deleteViolationModal-{{ $record->id }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>