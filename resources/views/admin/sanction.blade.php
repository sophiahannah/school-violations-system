@extends('layouts.admin.app')

@section('navbar-title', 'Manage Sanctions types and penalties')

@section('content')

<div class="container-fluid py-4">
    <div class="row g-0 justify-content-center">
        <div class="col-12 col-lg-10 mx-auto">

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">Available Sanctions</h4>
                            <p class="text-muted mb-0">Total Records: <span class="fw-bold text-primary">{{ $sanctionCount }}</span></p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4 text-secondary text-uppercase" style="width: 15%; font-size: 0.85rem; letter-spacing: 0.5px;">ID</th>
                                    <th class="py-3 text-secondary text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">Sanction Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sanctions as $sanction)
                                <tr>
                                    <td class="py-3 ps-4">
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            S-0{{ str_pad($sanction->id, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-3 fw-bold text-dark">
                                        {{ $sanction->sanction_name }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-5 text-muted">
                                        No sanctions found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
           <div class="mt-4">
                <h4 class="fw-bold text-dark mb-3">Sanction Matrix</h4>
                <p class="text-muted mb-4">Progressive disciplinary actions based on offense frequency.</p>

                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header text-center py-3 text-white fw-bold" style="background-color: #17a2b8;">
                                First Offense
                            </div>
                            <div class="card-body bg-white p-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-circle text-info me-2" style="font-size: 6px; vertical-align: middle;"></i>Written Warning</li>
                                    <li class="mb-2"><i class="fas fa-circle text-info me-2" style="font-size: 6px; vertical-align: middle;"></i>Grade Deduction</li>
                                    <li class="mb-0"><i class="fas fa-circle text-info me-2" style="font-size: 6px; vertical-align: middle;"></i>Parent Conference</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header text-center py-3 text-dark fw-bold" style="background-color: #ffc107;">
                                Second Offense
                            </div>
                            <div class="card-body bg-white p-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-circle text-warning me-2" style="font-size: 6px; vertical-align: middle;"></i>Community Service</li>
                                    <li class="mb-2"><i class="fas fa-circle text-warning me-2" style="font-size: 6px; vertical-align: middle;"></i>Academic Probation</li>
                                    <li class="mb-0"><i class="fas fa-circle text-warning me-2" style="font-size: 6px; vertical-align: middle;"></i>One Week Suspension</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header text-center py-3 text-white fw-bold" style="background-color: #dc3545;">
                                Third Offense
                            </div>
                            <div class="card-body bg-white p-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-circle text-danger me-2" style="font-size: 6px; vertical-align: middle;"></i>One Semester Suspension</li>
                                    <li class="mb-0"><i class="fas fa-circle text-danger me-2" style="font-size: 6px; vertical-align: middle;"></i>Expulsion</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div> 
    </div>
</div>

@endsection