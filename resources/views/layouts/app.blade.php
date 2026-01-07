<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PUP Gabay')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f4f6f9; overflow-x: hidden; }


        #wrapper { display: flex; width: 100%; align-items: stretch; transition: all 0.3s; }
        #sidebar { min-width: 250px; max-width: 250px; min-height: 100vh; background-color: #800000; color: white; transition: all 0.3s; margin-left: -250px; }
        #sidebar.active { margin-left: 0; }
        .sidebar-link { padding: 15px; display: block; color: white; text-decoration: none; border-radius: 0; transition: 0.2s; border-left: 4px solid transparent; }
        .sidebar-link:hover { background-color: rgba(255,255,255,0.1); }
        .sidebar-link.active-tab { background-color: rgba(255,255,255,0.2); font-weight: bold; border-left: 4px solid #ffc107; }


        #content { width: 100%; transition: all 0.3s; }
        @media (min-width: 768px) {
            #sidebar { margin-left: 0; }
            #sidebar.active { margin-left: -250px; }
        }

        
        .notification-dropdown { min-width: 350px; padding: 0; border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); }
        .notification-header { background-color: #800000; color: white; padding: 12px 15px; border-top-left-radius: 5px; border-top-right-radius: 5px; }
        .notif-item { border-left: 4px solid transparent; }
        .notif-item.unread-warning { border-left-color: #ffc107; background-color: #fff; }
        .notif-item.unread-success { border-left-color: #198754; background-color: #fff; }
        .notif-dot { height: 8px; width: 8px; background-color: #dc3545; border-radius: 50%; display: inline-block; }

        .modal-header-maroon { background-color: #800000; color: white; }
        .modal-header-teal { background-color: #17a2b8; color: white; }
        .modal-header-yellow { background-color: #ffc107; color: white; }
        .modal-header-yellow .btn-close { filter: brightness(0) invert(1); }
        
      
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-review { background-color: #0dcaf0; color: #fff; }
        .badge-resolved { background-color: #198754; color: #fff; }
        .badge-offense-1 { background-color: #0dcaf0; color: #fff; }
        .badge-offense-2 { background-color: #ffc107; color: #000; }
        .badge-offense-3 { background-color: #dc3545; color: #fff; }


        .btn-action-view { color: #0dcaf0; border: none; background: none; }
        .btn-action-edit { color: #ffc107; border: none; background: none; }
        .btn-action-delete { color: #dc3545; border: none; background: none; }
    </style>
</head>
<body>

    <div id="wrapper">

        <nav id="sidebar">
            <div class="p-3 border-bottom border-secondary">
                <h4 class="fw-bold mb-0">PUP GABAY</h4>
                <small style="opacity: 0.8;">Violations & Sanctions</small>
            </div>
            <ul class="list-unstyled p-0">
                <li><a href="{{ url('admin/dashboard') }}" class="sidebar-link {{ Request::is('admin/dashboard*') ? 'active-tab' : '' }}"><i class="fas fa-home me-2" style="width:20px;"></i> Home</a></li>
                <li><a href="{{ url('admin/violations-management') }}" class="sidebar-link {{ Request::is('admin/violations-management*') ? 'active-tab' : '' }}"><i class="fas fa-file-alt me-2" style="width:20px;"></i> Violations</a></li>
                <li><a href="{{ url('admin/sanctions') }}" class="sidebar-link {{ Request::is('admin/sanctions*') ? 'active-tab' : '' }}"><i class="fas fa-gavel me-2" style="width:20px;"></i> Sanctions</a></li>
    
            </ul>
        </nav>

        <div id="content">

            <nav class="navbar navbar-light bg-white shadow-sm px-3">
                <div class="d-flex align-items-center w-100">
                    <button type="button" id="sidebarCollapse" class="btn btn-link text-dark me-3"><i class="fas fa-bars fa-lg"></i></button>
                    <div>
                        <h5 class="mb-0 fw-bold" style="color: #800000;">@yield('page-title')</h5>
                        <small class="text-muted">Management System</small>
                    </div>
                    
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <div data-bs-toggle="dropdown" style="cursor: pointer; position: relative;">
                                <i class="fas fa-bell fa-lg text-secondary"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">2</span>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                                <li>
                                    <div class="notification-header d-flex justify-content-between align-items-center">
                                        <span class="fw-bold"><i class="fas fa-bell me-2"></i> Notifications</span>
                                    </div>
                                </li>
                                <li><a class="dropdown-item p-3 border-bottom notif-item unread-warning" href="#">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex">
                                            <div class="text-warning me-3"><i class="fas fa-exclamation-circle fa-lg"></i></div>
                                            <div>
                                                <div class="fw-bold text-dark">System Alert</div>
                                                <small class="text-muted">Welcome to the new dashboard.</small>
                                            </div>
                                        </div>
                                        <span class="notif-dot mt-2"></span>
                                    </div>
                                </a></li>
                            </ul>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="text-end d-none d-md-block" style="line-height: 1.2;">
                                <div class="fw-bold" style="font-size: 0.9rem;">Admin User</div>
                                <div class="text-muted" style="font-size: 0.75rem;">admin@pup.edu.ph</div>
                            </div>
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 38px; height: 38px;"><i class="fas fa-user"></i></div>
                        </div>

                        <button class="btn btn-dark btn-sm ms-2" onclick="logout()">
                            <i class="fas fa-sign-out-alt me-1"></i> Sign Out
                        </button>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sidebar Toggle
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('sidebarCollapse').addEventListener('click', function () {
                document.getElementById('sidebar').classList.toggle('active');
            });
        });

        function logout() {
            if(confirm("Are you sure you want to sign out?")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>

    @yield('scripts')

</body>
</html>