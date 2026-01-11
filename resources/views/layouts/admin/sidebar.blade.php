<!-- Sidebar -->
<div id="sidebar" class="offcanvas offcanvas-start bg-primary text-white vh-100" tabindex="-1"
    aria-labelledby="sidebarLabel" style="width: 260px;">
    <!-- Header -->
    <div class="offcanvas-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-bold mb-0">PUP GABAY</h5>
            <small class="text-white-50">Violations & Sanctions</small>
        </div>
        <button type="button" class="border-0 bg-primary" data-bs-dismiss="offcanvas">
            <i class="bi bi-layout-sidebar text-white fs-5"></i>
        </button>
    </div>

    <!-- Navigation -->
    <div class="offcanvas-body d-flex flex-column p-0">
        <nav class="nav flex-column mt-3">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link text-white d-flex align-items-center py-2 px-4 mx-3 rounded-pill 
            {{ request()->routeIs('admin.dashboard.index') ? 'active bg-red fw-bold' : '' }}">
                <i class="bi bi-house-door me-3 fs-5"></i> Home
            </a>

            <a href="{{ route('violations-management.index') }}" class="nav-link text-white  d-flex align-items-center py-2 px-4 mx-3 rounded-pill
                 {{ request()->routeIs('violations-management.index') ? 'active bg-red fw-bold' : '' }}">
                <i class="bi bi-file-text me-3 fs-5"></i> Violations
            </a>

            <a href="{{ route('admin.sanction') }}" class="nav-link text-white d-flex align-items-center py-2 px-4 mx-3 rounded-pill
                 {{ request()->routeIs('admin.sanction') ? 'active bg-red fw-bold' : '' }}">
                <i class="bi bi-award me-3 fs-5"></i> Sanctions
            </a>
        </nav>
    </div>
</div>