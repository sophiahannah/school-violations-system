<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Violation Dashboard</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <nav class="navbar navbar-dark mb-4 shadow-sm" style="background-color: #ffffffff; border-bottom: 6px solid #b22222;">
        <div class="container-fluid px-4">
            <span class="navbar-brand mb-0 h1 d-flex align-items-center fw-bold" Style="color: #b22222;">
                <img src="/student.png" alt="StudentLogo" class="me-2" style="width: 30px;">
                Student Portal
            </span>
            <div class="d-flex align-items-center">
                <div class="position-relative me-4" style="cursor: pointer;">
                    <img src="/bell.png"
                        alt="Notifications"
                        style="width: 24px; height: 24px; object-fit: contain;">
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <h2 class="mb-4 fw-bold">Hello, {{ $user->first_name }}! 👋</h2>

        <div class="row g-4">
            <div class="col-xl-3 col-lg-4">
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3 text-center" style="background-color: #800000;">Student Profile</div>
                    <div class="card-body text-center py-4">
                        <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}&background=800000&color=fff"
                            class="mb-3 shadow-sm border border-3 border-light rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <h4 class="fw-bold mb-1">{{ $user->first_name }} {{ $user->last_name}}</h4>
                        <p class="text-danger small fw-bold mb-3">{{ $user->school_id }}</p>
                        <div class="bg-light p-2 rounded-2 text-start">
                            <small class="text-muted d-block fw-bold" style="font-size: 10px;">EMAIL</small>
                            <span class="small text-truncate d-block">{{ $user->email}}</span>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-sm px-4 rounded-pill">
                                    <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3" style="background-color: #800000;">Quick Stats</div>
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0">
                            <span><img src="/violation.png" alt="violation-icon" style="width: 18px; height: 18px; cursor: pointer;" title="Violation Icon">
                                Total Violations
                            </span>
                            <span class="badge bg-danger rounded-pill px-3">{{ $violationCount }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0" style="background-color: #fff9e6;">
                            <span class="fw-bold" style="color: #2c3e50;">
                            <img src="/pending.png" alt="violation-icon" style="width: 18px; height: 18px; cursor: pointer;" title="Violation Icon"> Pending
                            </span>
                            <span class="fw-bold" style="color: #f1c40f; font-size: 18px;">
                                {{ $violationRecords->where('status.status_name', 'In progress')->count() }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0" style="background-color: #e6ffed;">
                            <span class="fw-bold" style="color: #2c3e50;">
                                <img src="/done.png" alt="violation-icon" style="width: 18px; height: 18px; cursor: pointer;" title="Violation Icon"> Resolved
                            </span>
                            <span class="fw-bold" style="color: #2ecc71; font-size: 18px;">
                                {{ $violationRecords->where('status.status_name', 'Resolved')->count() }}
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="card mt-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3" style="background-color: #800000;">
                        Recent Violations
                    </div>
                    <div class="card-body p-2">
                        @foreach($violationRecords->take(2) as $record)
                        <div class="border rounded p-2 mb-2 bg-light shadow-sm">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong class="small d-block" style="max-width: 70%;">
                                    {{ $record->violationSanction->violation->violation_name }}
                                </strong>
                                @if($record->status->status_name == 'In progress')
                                <span class="badge bg-info text-uppercase" style="font-size: 10px;">
                                    In Progress
                                </span>
                                @elseif($record->status->status_name == 'Under review')
                                <span class="badge bg-warning text-dark text-uppercase" style="font-size: 10px;">
                                    Under Review
                                </span>
                                @else
                                <span class="badge bg-success text-uppercase" style="font-size: 10px;">
                                    Resolved
                                </span>
                                @endif
                            </div>
                            <div class="mt-1">
                                <small class="text-muted" style="font-size: 10px;">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3" style="background-color: #800000;">Violation History</div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="d-flex align-items-center m-4 text-muted">
                                <i class="fas fa-filter me-2" style="font-size: 0.9rem;"></i>
                                <span class="small me-2">Filter by:</span>
                                <select class="form-select form-select-sm w-auto border-secondary-subtle rounded-3" style="font-size: 0.85rem; color: #4b5563;">
                                    <option value="all" selected>All status</option>
                                    <option value="in-progress">In progress</option>
                                    <option value="under-review">Under review</option>
                                    <option value="resolved">Resolved</option>
                                </select>
                            </div>
                            <div class="m-4">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr style="font-size: 13px;">
                                            <th class="ps-4 py-3 text-muted">CASE ID</th>
                                            <th class="py-3 text-muted">VIOLATION TYPE</th>
                                            <th class="py-3 text-muted">DATE</th>
                                            <th class="py-3 text-muted">RECORD</th>
                                            <th class="py-3 text-muted">STATUS</th>
                                            <th class="py-3 text-muted">SANCTION</th>
                                            <th class="text-center py-3 text-muted">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($violationRecords as $record)
                                        <tr>
                                            <td class="ps-4 text-danger fw-bold small">V-{{ $record->id }}</td>
                                            <td class="small fw-bold">{{ $record->violationSanction->violation->violation_name }}</td>
                                            <td class="small text-muted">{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}</td>
                                            <td class="small">
                                                @if($record->violationSanction->no_of_offense == 1)
                                                <span class="badge bg-info text-uppercase" style="font-size: 12px;">
                                                    First Offense
                                                </span>
                                                @elseif($record->violationSanction->no_of_offense == 2)
                                                <span class="badge bg-warning text-dark text-uppercase" style="font-size: 12px;">
                                                    Second Offense
                                                </span>
                                                @else
                                                <span class="badge bg-danger text-uppercase" style="font-size: 12px;">
                                                    Third Offense
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->status->status_name == 'In progress')
                                                <span class="badge bg-info text-uppercase" style="font-size: 12px;">
                                                    In Progress
                                                </span>
                                                @elseif($record->status->status_name == 'Under review')
                                                <span class="badge bg-warning text-dark text-uppercase" style="font-size: 12px;">
                                                    Under Review
                                                </span>
                                                @else
                                                <span class="badge bg-success text-uppercase" style="font-size: 12px;">
                                                    Resolved
                                                </span>
                                                @endif
                                            </td>
                                            <td class="small">{{ $record->violationSanction->sanction->sanction_name }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2 align-items-center">
                                                    <img src="/view.png" alt="appeal" style="width: 18px; height: 18px; cursor: pointer;" title="appeal">
                                                    <button class="btn btn-sm btn-danger px-3 rounded-2 fw-bold" style="font-size: 11px;">APPEAL</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">No records found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 py-3 ps-4">
                        <small id="showingCount" class="text-muted">
                            Showing {{ $violationRecords->count() }} of {{ $violationCount }} violations
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>