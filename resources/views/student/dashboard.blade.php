<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | Violation Dashboard</title>
    
    <link rel="icon" type="image/png" href="{{ asset('PUPLogo 1 Login.png') }}">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <nav class="navbar navbar-dark mb-4 shadow-sm navbar-pup">
        
        <div class="container-fluid px-3 px-lg-4 d-flex justify-content-between align-items-center">
            
            <span class="navbar-brand mb-0 h1 d-flex align-items-center fw-bold" style="color: #b22222;">
                <img src="{{ asset('student.png') }}" alt="StudentLogo" class="me-2" style="width: 30px;">
                <span class="d-none d-sm-inline">Student Portal</span> 
                <span class="d-inline d-sm-none">Portal</span>
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-flex m-0">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm px-3 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> 
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="container-fluid px-3 px-lg-4 pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0 fs-3 fs-md-2">Hello, {{ $user->first_name }}! 👋</h2>
        </div>

        <div class="row g-4">
            
            <div class="col-12 col-lg-4 col-xl-3">
                
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3 text-center bg-primary">
                        Student Profile
                    </div>
                    <div class="card-body text-center py-4">
                        <img src="https://ui-avatars.com/api/?name={{ $user->first_name }}&background=800000&color=fff"
                            class="mb-3 shadow-sm border-3 border-light rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        
                        <h4 class="fw-bold mb-1 fs-5">{{ $user->first_name }} {{ $user->last_name}}</h4>
                        <p class="text-danger small fw-bold mb-3">{{ $user->school_id }}</p>
                        
                        <div class="bg-light p-2 rounded-2 text-start mx-auto" style="max-width: 100%;">
                            <small class="text-muted d-block fw-bold" style="font-size: 10px;">EMAIL</small>
                            <span class="small text-truncate d-block">{{ $user->email}}</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3 bg-primary">
                        Quick Stats
                    </div>
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0">
                            <span class="d-flex align-items-center">
                                <img src="{{ asset('violation.png') }}" alt="icon" class="me-2" style="width: 18px; height: 18px;">
                                Total Violations
                            </span>
                            <span class="badge bg-danger rounded-pill px-3">{{ $violationCount }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0"
                            style="background-color: #fff9e6;">
                            <span class="fw-bold d-flex align-items-center" style="color: #2c3e50;">
                                <img src="{{ asset('pending.png') }}" alt="icon" class="me-2" style="width: 18px; height: 18px;">
                                Pending
                            </span>
                            <span class="fw-bold" style="color: #f1c40f; font-size: 18px;">
                                {{ $violationRecords->where('status.status_name', 'In progress')->count() }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center m-1 border-0"
                            style="background-color: #e6ffed;">
                            <span class="fw-bold d-flex align-items-center" style="color: #2c3e50;">
                                <img src="{{ asset('done.png') }}" alt="icon" class="me-2" style="width: 18px; height: 18px;">
                                Resolved
                            </span>
                            <span class="fw-bold" style="color: #2ecc71; font-size: 18px;">
                                {{ $violationRecords->where('status.status_name', 'Resolved')->count() }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3 bg-primary">
                        Recent Violations
                    </div>
                    <div class="card-body p-2">
                        @foreach($violationRecords->take(2) as $record)
                        <div class="border rounded p-2 mb-2 bg-light shadow-sm">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong class="small d-block text-truncate" style="max-width: 65%;">
                                    {{ $record->violationSanction->violation->violation_name }}
                                </strong>
                                <x-status-badge :status="$record->status->status_name" />
                            </div>
                            <div class="mt-1">
                                <small class="text-muted" style="font-size: 10px;">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                        @if($violationRecords->isEmpty())
                            <p class="text-center text-muted small my-2">No recent records.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-xl-9">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header border-0 text-white fw-bold py-3 bg-primary">
                        Violation History
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="p-3 border-bottom bg-light">
                            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
                                <div class="d-flex align-items-center text-muted mb-2 mb-sm-0">
                                    <i class="bi bi-funnel-fill me-2"></i>
                                    <span class="small me-2">Filter by:</span>
                                    <form action="{{ route('student.dashboard.index') }}" method="get" class="d-inline-block">
                                        <select class="form-select form-select-sm border-secondary-subtle rounded-3"
                                            style="font-size: 0.85rem; color: #4b5563; min-width: 120px;" name="status"
                                            onchange="this.form.submit()">
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
                        </div>

                        <div class="mx-3 mt-3">
                            <div class="alert alert-warning d-flex align-items-start p-2" role="alert">
                                <i class="bi bi-info-circle-fill me-2 mt-1"></i>
                                <div>
                                    <span class="small fw-bold">Note:</span>
                                    <span class="small">Appeals unavailable 3 days after report creation.</span>
                                </div>
                            </div>

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show p-2 my-2 small" role="alert">
                                    {{ $error }}
                                    <button type="button" class="btn-close small" data-bs-dismiss="alert"></button>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                                <thead class="table-light">
                                    <tr style="font-size: 13px;">
                                        <th class="ps-4 py-3 text-muted text-nowrap">CASE ID</th>
                                        <th class="py-3 text-muted text-nowrap">VIOLATION TYPE</th>
                                        <th class="py-3 text-muted text-nowrap">DATE</th>
                                        <th class="py-3 text-muted text-nowrap">RECORD</th>
                                        <th class="py-3 text-muted text-nowrap">STATUS</th>
                                        <th class="py-3 text-muted text-nowrap">SANCTION</th>
                                        <th class="text-center py-3 text-muted text-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($violationRecords as $record)
                                    <tr>
                                        <td class="ps-4 text-danger fw-bold small text-nowrap">V-{{ $record->id }}</td>
                                        
                                        <td class="small fw-bold text-wrap" style="max-width: 250px;">
                                            {{ $record->violationSanction->violation->violation_name }}
                                        </td>
                                        
                                        <td class="small text-muted text-nowrap">
                                            {{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}
                                        </td>
                                        
                                        <td class="small">
                                            <x-offense-badge :offense="$record->violationSanction->no_of_offense" />
                                        </td>
                                        
                                        <td>
                                            <x-status-badge :status="$record->status->status_name" />
                                        </td>
                                        
                                        <td class="small text-wrap" style="max-width: 200px;">
                                            {{ $record->violationSanction->sanction->sanction_name }}
                                        </td>
                                        
                                        <td class="text-center text-nowrap">
                                            @if ($record->canBeAppealed())
                                            <button class="btn btn-sm btn-danger px-3 rounded-2 fw-bold"
                                                style="font-size: 11px;" data-bs-toggle="modal"
                                                data-bs-target="#appealModal-{{ $record->id }}">
                                                APPEAL
                                            </button>
                                            @endif
                                            
                                            <x-appeal-status-badge :record="$record" />
                                        </td>
                                    </tr>
                                    <x-modals.request-appeal :violation="$record" :id="'appealModal-'.$record->id" />
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">No records found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> </div>
                    
                    <div class="card-footer bg-white border-0 py-3">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-auto mb-2 mb-sm-0 text-center text-sm-start">
                                <small class="text-muted">
                                    Showing {{ $violationRecords->count() }} of {{ $violationCount }} violations
                                </small>
                            </div>
                            <div class="col-12 col-sm-auto ms-auto d-flex justify-content-center justify-content-sm-end">
                                {{-- {{ $violationRecords->links() }} --}} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>