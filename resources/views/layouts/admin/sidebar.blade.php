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
    <div class="offcanvas-body d-flex flex-column px-3 pt-2">

        <small class="text-uppercase text-white-50 fw-bold mb-3 px-3" style="font-size: 0.7rem;">Main Menu</small>

        <nav class="nav flex-column flex-grow-1">
            <a href="{{ route('admin.dashboard.index') }}"
                class="text-white d-flex align-items-center py-3 px-4"
                style="position: relative; transition: all 0.3s ease; border-radius: 50rem; overflow: hidden; font-weight: 500; letter-spacing: 0.3px; margin-bottom: 0.5rem; text-decoration: none; {{ request()->routeIs('admin.dashboard.index') ? 'background-color: rgba(255, 255, 255, 0.2); font-weight: 700; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); border-left: 4px solid #ffca28;' : '' }}">
                <i class="bi bi-grid-fill me-3 fs-5" style="transition: transform 0.3s ease;"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.violations-management.index') }}"
                class="text-white d-flex align-items-center py-3 px-4"
                style="position: relative; transition: all 0.3s ease; border-radius: 50rem; overflow: hidden; font-weight: 500; letter-spacing: 0.3px; margin-bottom: 0.5rem; text-decoration: none; {{ request()->routeIs('admin.violations-management.index') ? 'background-color: rgba(255, 255, 255, 0.2); font-weight: 700; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); border-left: 4px solid #ffca28;' : '' }}">
                <i class="bi bi-file-earmark-text-fill me-3 fs-5" style="transition: transform 0.3s ease;"></i>
                <span>Violations</span>
            </a>

            <a href="{{ route('admin.sanction') }}"
                class="text-white d-flex align-items-center py-3 px-4"
                style="position: relative; transition: all 0.3s ease; border-radius: 50rem; overflow: hidden; font-weight: 500; letter-spacing: 0.3px; margin-bottom: 0.5rem; text-decoration: none; {{ request()->routeIs('admin.sanction') ? 'background-color: rgba(255, 255, 255, 0.2); font-weight: 700; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); border-left: 4px solid #ffca28;' : '' }}">
                <i class="bi bi-award me-3 fs-5" style="transition: transform 0.3s ease;"></i>
                <span>Sanctions</span>
            </a>

            <a href="{{ route('admin.appeals.index') }}"
                class="text-white d-flex align-items-center py-3 px-4"
                style="position: relative; transition: all 0.3s ease; border-radius: 50rem; overflow: hidden; font-weight: 500; letter-spacing: 0.3px; margin-bottom: 0.5rem; text-decoration: none; {{ request()->routeIs('admin.appeals.*') ? 'background-color: rgba(255, 255, 255, 0.2); font-weight: 700; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); border-left: 4px solid #ffca28;' : '' }}">
                <i class="bi bi-envelope-paper-fill me-3 fs-5" style="transition: transform 0.3s ease;"></i>
                Appeals    
            </a>
        </nav>

    </div>
</div>