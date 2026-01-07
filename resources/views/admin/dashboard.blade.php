@extends('layouts.admin.app')

@section('navbar-title', 'Violation and Sanction Management')
@section('content')
<div class="container-fluid w-100">
    <div class="">Admin</div>
    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Violation Logs</h5>
            <button class="btn text-white" style="background-color: #800000;" data-bs-toggle="modal" data-bs-target="#logViolationModal">
                <i class="fas fa-plus me-1"></i> Log Violation
            </button>
        </div>
        <div class="card-body">
            <div class="row mb-3 g-2">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Search by student name or ID...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select text-muted" id="statusFilter" onchange="filterTable()">
                        <option value="all">All Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Resolved">Resolved</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Case ID</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Violation Type</th>
                            <th>Date</th>
                            <th>Record</th>
                            <th>Status</th>
                            <th>Sanction</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="violationTableBody">
                        @forelse($violationRecords as $record)
                            <tr>
                                <td class="fw-bold text-danger">V-{{ date('Y') }}-{{ $record->id }}</td>
                                
                                <td>{{ $record->user->student_number ?? 'N/A' }}</td>
                                <td class="fw-bold">{{ $record->user->name ?? 'Unknown Student' }}</td>
                                
                                <td>{{ $record->violationSanction->violation->name ?? 'N/A' }}</td>
                                <td>{{ $record->created_at->format('Y-m-d') }}</td>
                                
                                <td>
                                    @php $offense = $record->violationSanction->offense_level ?? 'N/A'; @endphp
                                    @if($offense == 'First Offense') <span class="badge badge-offense-1">FIRST OFFENSE</span>
                                    @elseif($offense == 'Second Offense') <span class="badge badge-offense-2">SECOND OFFENSE</span>
                                    @elseif($offense == 'Third Offense') <span class="badge badge-offense-3">THIRD OFFENSE</span>
                                    @else <span class="badge bg-secondary">{{ $offense }}</span>
                                    @endif
                                </td>

                                <td>
                                    @php 
                                        $status = $record->status->name ?? 'Unknown';
                                        $bg = 'bg-secondary';
                                        if(stripos($status, 'Pending') !== false) $bg = 'badge-pending';
                                        elseif(stripos($status, 'Review') !== false) $bg = 'badge-review';
                                        elseif(stripos($status, 'Resolved') !== false) $bg = 'badge-resolved';
                                    @endphp
                                    <span class="badge {{ $bg }}">{{ $status }}</span>
                                </td>

                                <td>{{ $record->violationSanction->sanction->name ?? 'N/A' }}</td>

                                <td class="text-center">
                                    <button class="btn-action-view" 
                                        onclick="viewCase(this)" 
                                        data-id="V-{{ date('Y') }}-{{ $record->id }}"
                                        data-student-id="{{ $record->user->student_number ?? 'N/A' }}"
                                        data-student-name="{{ $record->user->name ?? 'Unknown' }}"
                                        data-violation="{{ $record->violationSanction->violation->name ?? 'N/A' }}"
                                        data-date="{{ $record->created_at->format('Y-m-d') }}"
                                        data-offense="{{ $record->violationSanction->offense_level ?? 'N/A' }}"
                                        data-status="{{ $record->status->name ?? 'Unknown' }}"
                                        data-sanction="{{ $record->violationSanction->sanction->name ?? 'N/A' }}"
                                        data-description="{{ $record->description ?? 'No specific description provided.' }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button class="btn-action-edit" onclick="editCase('{{ $record->id }}')"><i class="fas fa-edit"></i></button>
                                    <button class="btn-action-delete" onclick="confirmDelete('{{ $record->id }}')"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted py-4">No violation records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <small class="text-muted" id="rowCounter">Showing {{ $violationRecordCount }} violations</small>
        </div>
    </div>

    <div class="modal fade" id="logViolationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header modal-header-maroon">
                    <h5 class="modal-title fw-bold">Log New Violation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form onsubmit="submitLog(event)">
                        <div class="mb-3"><label class="fw-bold">Student ID / User ID</label><input type="text" class="form-control" placeholder="e.g. 2021-12345-MN-0"></div>
                        
                        <div class="mb-3">
                            <label class="fw-bold">Violation Type</label>
                            <select class="form-select">
                                <option selected disabled>Select Violation Type</option>
                                <option>Non-Validated ID</option>
                                <option>Not wearing ID/No Registration Card/No Student's Entry Slip (SES)</option>
                                <option>Loss of ID/Registration Card</option>
                                <option>Fake ID/Another person's ID/Lending of ID</option>
                                <option>Failure to secure ID on time</option>
                                <option>Inappropriate attire</option>
                                <option>Overnight stay in university</option>
                                <option>Unauthorized use of university Name/Logo/Seal</option>
                                <option>Damage to university facilities</option>
                                <option>Unofficial or unauthorized participation in any off-campus activity</option>
                                <option>Unauthorized entry of visitors/guests invited by students/organizations</option>
                                <option>Illegal posting of bills, posters, tarpaulins, and the like</option>
                                <option>Littering</option>
                                <option>Smoking (including vape/e-cigarette)</option>
                                <option>Intoxicated while on campus/Bringing in intoxicating drinks</option>
                                <option>Gambling</option>
                                <option>Use of internet/IT facilities for gaming, pornography, cyberbullying, etc.</option>
                                <option>Theft</option>
                                <option>Vandalism</option>
                                <option>Destruction/Intentional damage to University/other person's property</option>
                                <option>Deliberate disruption of classes, academic function, or school activity</option>
                                <option>Gross acts of disrespect</option>
                                <option>Public and malicious accusation causing dishonor to University</option>
                                <option>Direct or indirect assault</option>
                                <option>Scandalous display of affection</option>
                                <option>Brawls on campus or at off-campus school functions</option>
                                <option>Tampering/Falsifying official documents</option>
                                <option>Dishonesty/Plagiarism</option>
                                <option>Carrying of deadly weapons</option>
                                <option>All forms of bullying and/or harassment, threat, and intimidation</option>
                                <option>Filing false application for initiation rite (not hazing)</option>
                                <option>Holding initiation rite without approval (not hazing)</option>
                                <option>Hazing</option>
                                <option>Sexual Harassment</option>
                                <option>Possession or use of prohibited drugs (LSD, marijuana, shabu, etc.)</option>
                                <option>Submission of falsified documents for admission</option>
                            </select>
                        </div>

                        <div class="mb-3"><label class="fw-bold">Sanction</label>
                            <select class="form-select">
                                <option selected disabled>Select Sanction</option>
                                <option>Written Warning</option>
                                <option>Failing grade in exam/quiz</option>
                                <option>Failing grade in course</option>
                                <option>One-week suspensio</option>
                                <option>One-month suspension</option>
                                <option>One-semester suspension</option>
                                <option>Dismissal</option>
                                <option>Expulsion</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="fw-bold">Offense</label>
                            <select class="form-select">
                                <option>First Offense</option>
                                <option>Second Offense</option>
                                <option>Third Offense</option>
                                <option>Fourth Offense</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="fw-bold">Notes</label><textarea class="form-control" rows="3"></textarea></div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white" style="background-color: #800000;">Log Violation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewViolationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header modal-header-teal">
                    <h5 class="modal-title fw-bold">Violation Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">CASE ID</small><div class="text-danger fw-bold fs-5" id="view_case_id">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">STATUS</small><div><span class="badge" id="view_status">...</span></div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">STUDENT ID</small><div class="fw-bold" id="view_student_id">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">STUDENT NAME</small><div class="fw-bold" id="view_student_name">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">VIOLATION TYPE</small><div id="view_violation">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">DATE</small><div id="view_date">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">RECORD</small><div id="view_offense">...</div></div>
                        <div class="col-md-6"><small class="text-muted fw-bold" style="font-size: 0.75rem;">SANCTION</small><div id="view_sanction">...</div></div>
                        <div class="col-12"><small class="text-muted fw-bold" style="font-size: 0.75rem;">DESCRIPTION</small><div class="p-3 bg-light rounded border text-muted" id="view_description">...</div></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-white px-4" style="background-color: #800000;" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editViolationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header modal-header-yellow">
                    <h5 class="modal-title fw-bold">Edit Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="mb-3"><label class="fw-bold">Student ID</label><input type="text" class="form-control" placeholder="e.g. 2021-12345-MN-0"></div>
                        <div class="mb-3"><label class="fw-bold">Student Name</label><input type="text" class="form-control" placeholder="e.g. John Doe"></div>
                        
                        <div class="mb-3">
                            <label class="fw-bold">Violation Type</label>
                            <select class="form-select">
                                <option selected disabled>Select Violation Type</option>
                                <option>Non-Validated ID</option>
                                <option>Not wearing ID/No Registration Card/No Student's Entry Slip (SES)</option>
                                <option>Loss of ID/Registration Card</option>
                                <option>Fake ID/Another person's ID/Lending of ID</option>
                                <option>Failure to secure ID on time</option>
                                <option>Inappropriate attire</option>
                                <option>Overnight stay in university</option>
                                <option>Unauthorized use of university Name/Logo/Seal</option>
                                <option>Damage to university facilities</option>
                                <option>Unofficial or unauthorized participation in any off-campus activity</option>
                                <option>Unauthorized entry of visitors/guests invited by students/organizations</option>
                                <option>Illegal posting of bills, posters, tarpaulins, and the like</option>
                                <option>Littering</option>
                                <option>Smoking (including vape/e-cigarette)</option>
                                <option>Intoxicated while on campus/Bringing in intoxicating drinks</option>
                                <option>Gambling</option>
                                <option>Use of internet/IT facilities for gaming, pornography, cyberbullying, etc.</option>
                                <option>Theft</option>
                                <option>Vandalism</option>
                                <option>Destruction/Intentional damage to University/other person's property</option>
                                <option>Deliberate disruption of classes, academic function, or school activity</option>
                                <option>Gross acts of disrespect</option>
                                <option>Public and malicious accusation causing dishonor to University</option>
                                <option>Direct or indirect assault</option>
                                <option>Scandalous display of affection</option>
                                <option>Brawls on campus or at off-campus school functions</option>
                                <option>Tampering/Falsifying official documents</option>
                                <option>Dishonesty/Plagiarism</option>
                                <option>Carrying of deadly weapons</option>
                                <option>All forms of bullying and/or harassment, threat, and intimidation</option>
                                <option>Filing false application for initiation rite (not hazing)</option>
                                <option>Holding initiation rite without approval (not hazing)</option>
                                <option>Hazing</option>
                                <option>Sexual Harassment</option>
                                <option>Possession or use of prohibited drugs (LSD, marijuana, shabu, etc.)</option>
                                <option>Submission of falsified documents for admission</option>
                            </select>
                        </div>

                        <div class="mb-3"><label class="fw-bold">Sanction</label>
                            <select class="form-select">
                                <option selected>Written Warning</option>
                                <option>Failing grade in exam/quiz</option>
                                <option>Failing grade in course</option>
                                <option>One-week suspensio</option>
                                <option>One-month suspension</option>
                                <option>One-semester suspension</option>
                                <option>Dismissal</option>
                                <option>Expulsion</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="fw-bold">Offense</label>
                            <select class="form-select">
                                <option>First Offense</option>
                                <option>Second Offense</option>
                                <option>Third Offense</option>
                                <option>Fourth Offense</option>
                            </select>
                        </div>

                        <div class="mb-3"><label class="fw-bold">Status</label>
                            <select class="form-select">
                                <option>Pending</option>
                                <option>Under Review</option>
                                <option>Resolved</option>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2 mt-4 border-top pt-3">
                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn text-white px-4" style="background-color: #800000;">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0"><h5 class="modal-title fw-bold">Confirm Delete</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center py-4"><p class="text-muted">Are you sure?</p><input type="hidden" id="delete_id_storage"></div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="executeDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection