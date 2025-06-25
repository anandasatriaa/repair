<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin - Milenia Group</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('admin-assets/img/favicon.png') }}" rel="icon">

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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="#" class="">
                                <img src="{{ asset('assets/img/logo.png') }}" width="150" alt="">
                            </a>
                            <h3>Sign In</h3>
                        </div>

                        @if ($errors->has('login'))
                            <div class="alert alert-danger">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" value="{{ old('username') }}" required autofocus>
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                            <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor:pointer;"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                <label class="form-check-label" for="rememberMe">Check me out</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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

    {{-- Remember Me & Icon Eye --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const usernameInput = document.getElementById('floatingInput');
            const passwordInput = document.getElementById('floatingPassword');
            const rememberCheckbox = document.getElementById('rememberMe');
            const togglePasswordIcon = document.getElementById('togglePassword');
    
            // Load saved credentials
            if (localStorage.getItem('remember') === 'true') {
                usernameInput.value = localStorage.getItem('username') || '';
                passwordInput.value = localStorage.getItem('password') || '';
                rememberCheckbox.checked = true;
            }
    
            // Save to localStorage when checkbox changes
            rememberCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    localStorage.setItem('username', usernameInput.value);
                    localStorage.setItem('password', passwordInput.value);
                    localStorage.setItem('remember', true);
                } else {
                    localStorage.removeItem('username');
                    localStorage.removeItem('password');
                    localStorage.removeItem('remember');
                }
            });
    
            // Save updated values if user types
            usernameInput.addEventListener('input', function () {
                if (rememberCheckbox.checked) {
                    localStorage.setItem('username', this.value);
                }
            });
    
            passwordInput.addEventListener('input', function () {
                if (rememberCheckbox.checked) {
                    localStorage.setItem('password', this.value);
                }
            });
    
            // Toggle password visibility
            togglePasswordIcon.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>
