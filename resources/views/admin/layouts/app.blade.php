<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Panel') - Milenia Group</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('admin-assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @php
            $user = Auth::user();
        @endphp
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="#" class="d-flex justify-content-center mx-auto mb-4">
                    <img src="{{ asset('assets/img/logo.png') }}" width="150" alt="">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('admin-assets/img/user-dummy-img.jpg') }}"
                            alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $user->name ?? 'Guest' }}</h6>
                        <span>{{ $user->username ?? 'Guest' }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>

                    <a href="{{ route('admin.spare-parts.index') }}"
                        class="nav-item nav-link {{ request()->routeIs('admin.spare-parts.*') ? 'active' : '' }}">
                        <i class="fa fa-list-alt me-2"></i>Master Spareparts
                    </a>

                    @php
                        $isServiceActive = request()->routeIs('admin.service.category');
                    @endphp
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ $isServiceActive ? 'active show' : '' }}"
                            data-bs-toggle="dropdown"><i class="fa fa-tools me-2"></i>Services
                        </a>

                        <div class="dropdown-menu bg-transparent border-0 {{ $isServiceActive ? 'show' : '' }}">
                            @foreach ($serviceCategories as $cat)
                                @php
                                    $category = $cat->category;
                                    $image = match ($category) {
                                        'CTEK' => 'ctek9.png',
                                        'NOCO' => 'noco9.jpg',
                                        'RUPES' => 'rupes9.webp',
                                        default => 'default.jpg',
                                    };

                                    $isActiveSub = request()->is('admin/service/' . strtolower($category));
                                @endphp
                                <a href="{{ route('admin.service.category', ['category' => strtolower($category)]) }}"
                                    class="dropdown-item d-flex align-items-center {{ $isActiveSub ? 'active' : '' }}">
                                    <img src="{{ asset('assets/img/' . $image) }}" alt="{{ $category }}"
                                        style="width: 20px; height: 20px;" class="me-2">
                                    {{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                    <img src="{{ asset('assets/img/logo.png') }}" width="150" alt="">
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                            @if ($notifications->count() > 0)
                                <span class="badge bg-danger rounded-pill">{{ $notifications->count() }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            @forelse ($notifications as $notif)
                                @php
                                    $badgeClass = match (strtoupper($notif->category)) {
                                        'CTEK' => 'bg-dark',
                                        'RUPES' => 'bg-danger',
                                        'NOCO' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <a href="{{ route('admin.service.category', strtolower($notif->category)) }}"
                                    class="dropdown-item">
                                    <h6 class="fw-normal mb-0">
                                        Permintaan service oleh: {{ $notif->name_customer }} (s/n:
                                        {{ $notif->serial_number }})
                                    </h6>
                                    <p class="mb-0"><span
                                            class="badge {{ $badgeClass }}">{{ $notif->category }}</span></p>
                                    <small>{{ $notif->created_at->diffForHumans() }}</small>
                                </a>
                                <hr class="dropdown-divider">
                            @empty
                                <a href="#" class="dropdown-item text-center text-muted">Tidak ada notifikasi</a>
                            @endforelse
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2"
                                src="{{ asset('admin-assets/img/user-dummy-img.jpg') }}" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ $user->name ?? 'Guest' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            @yield('content')


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Service Center Milenia Group</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Developed By <a href="https://anandasatriaa.github.io/" target="_blank"
                                id="developer-link">IT
                                Milenia Group</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin-assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin-assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin-assets/js/main.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chart.js Data Labels Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Ananda Satria Ariyanto --}}
    <script>
        const devLink = document.getElementById('developer-link');

        devLink.addEventListener('mouseover', () => {
            devLink.textContent = 'Ananda Satria Ariyanto';
        });

        devLink.addEventListener('mouseout', () => {
            devLink.textContent = 'IT Milenia Group';
        });
    </script>

    @yield('scripts')
</body>

</html>
