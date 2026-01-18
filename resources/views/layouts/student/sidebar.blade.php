<!-- Sidebar -->
<div id="sidebar" class="offcanvas offcanvas-start bg-primary text-white vh-100" tabindex="-1"
    aria-labelledby="sidebarLabel">
    <!-- Header -->
    <div class="offcanvas-header d-flex justify-content-between align-items-start">
        <div>
            <h5 class="fw-bold mb-0">IsKorrections</h5>
            <small class="text-white-50">Violations & Sanctions</small>
        </div>
        <button type="button" class="border-0 bg-primary" data-bs-dismiss="offcanvas">
            <i class="bi bi-layout-sidebar text-white fs-5"></i>
        </button>
    </div>

    <!-- Navigation -->
    <div class="offcanvas-body d-flex flex-column px-3 pt-2">
        <small class="text-uppercase text-white-50 fw-bold mb-3 px-3 menu-label">Main Menu</small>

        <nav class="nav flex-column flex-grow-1">
            <a href="{{ route('student.dashboard.index') }}"
                class="text-white d-flex align-items-center py-3 px-4 {{ request()->routeIs('student.dashboard.index') ? 'active' : '' }}">
                <i class="bi bi-grid-fill me-3 fs-5"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('student.handbook.index') }}"
                class="text-white d-flex align-items-center py-3 px-4 {{ request()->routeIs('student.handbook.index') ? 'active' : '' }}">
                <i class="bi bi-book-fill me-3 fs-5"></i>
                <span>Handbook</span>
            </a>

            <a href="{{ route('student.faqs.index') }}"
                class="text-white d-flex align-items-center py-3 px-4 {{ request()->routeIs('student.faqs.index') ? 'active' : '' }}">
                <i class="bi bi-question-circle-fill me-3 fs-5"></i>
                <span>FAQs</span>
            </a>
        </nav>
    </div>
</div>