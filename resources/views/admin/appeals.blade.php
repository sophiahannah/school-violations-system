@extends('layouts.admin.app')

@section('navbar-title', 'Appeal Management')

@section('content')
<div class="container py-4">

    {{-- Header with Back Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-envelope-exclamation me-2"></i>
            Appeal Management
        </h4>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">

        {{-- Pending Appeals --}}
        <div class="col-md-4 col-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1 text-muted">Pending</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-warning">{{ $summary['pending'] }}</h3>
                    </div>
                    <span class="bg-yellow-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-hourglass-split fs-1 text-warning opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

        {{-- Approved Appeals --}}
        <div class="col-md-4 col-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1 text-muted">Approved</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-success">{{ $summary['approved'] }}</h3>
                    </div>
                    <span class="bg-green-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-check-circle-fill fs-1 text-success opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

        {{-- Rejected Appeals --}}
        <div class="col-md-4 col-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase small mb-1 text-muted">Rejected</h6>
                        <h3 class="fw-bold fs-1 mb-0 text-danger">{{ $summary['rejected'] }}</h3>
                    </div>
                    <span class="bg-red-shade px-3 opacity-75 rounded-4">
                        <i class="bi bi-x-circle-fill fs-1 text-danger opacity-75"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- Search Bar --}}
    <div class="card border-0 mb-4">
        <div class="card-body shadow-sm">
            <form method="GET" action="{{ route('admin.appeals.index') }}" id="searchForm">
                <div class="position-relative">
                    <span class="position-absolute top-50 translate-middle-y ms-3" style="z-index: 10;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           class="form-control ps-5 {{ request('search') ? 'pe-5' : '' }}" 
                           placeholder="Search by student name, ID, or case ID..." 
                           name="search"
                           id="searchInput"
                           value="{{ request('search') }}"
                           style="height: 45px;">
                    @if(request('search'))
                        <button type="button" 
                                class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-0 border-0 bg-transparent" 
                                id="clearSearch"
                                style="width: 30px; height: 30px; z-index: 10;">
                            <i class="bi bi-x-circle-fill text-muted"></i>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Appeals List --}}
    <div class="row g-3" id="appealsList">
        @forelse ($appeals as $appeal)
            {{-- Appeal Card Component --}}
            <x-appeal-card :appeal="$appeal" />

            {{-- Appeal Modal Component --}}
            <x-modals.appeal-modal :appeal="$appeal" />
        @empty
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">No appeals found</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination Info --}}
    @if($appeals->count() > 0)
    <div class="text-center mt-4 text-muted small">
        Showing {{ $appeals->count() }} of {{ $appeals->count() }} Appeals
    </div>
    @endif

</div>

@vite(['resources/js/appeal-search.js'])
@endsection