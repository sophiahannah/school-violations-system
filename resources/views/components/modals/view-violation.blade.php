<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header bg-info">
                <h5 class="modal-title fw-bold text-white">Violation Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">

                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            CASE ID
                        </small>
                        <div class="text-danger fw-bold fs-5" id="view_case_id">
                            V-{{ date('Y') }}-{{ $record->id }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            STATUS
                        </small>
                        <div>
                            <x-status-badge :status="$record->status->status_name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            STUDENT ID
                        </small>
                        <div class="fw-bold fs-5">
                            {{ $record->user->id}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            STUDENT NAME
                        </small>
                        <div class="fw-bold fs-5">
                            {{ $record->user->first_name.' '.$record->user->last_name}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            VIOLATION TYPE
                        </small>
                        <div class="fs-5">
                            {{ $record->violationSanction->violation->violation_name}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            DATE
                        </small>
                        <div id="view_date">
                            {{ $record->created_at->format('M/d/Y') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            RECORD
                        </small>
                        <div id="view_offense">
                            <x-offense-badge :offense="$record->violationSanction->no_of_offense" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            SANCTION
                        </small>
                        <div id="view_sanction">
                            {{ $record->violationSanction->sanction->sanction_name}}

                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-muted fw-bold" style="font-size: 0.75rem;">
                            DESCRIPTION
                        </small>
                        <div class="p-3 bg-light rounded border text-muted" id="view_description">
                            ...
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn text-white px-4" style="background-color: #800000;"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>