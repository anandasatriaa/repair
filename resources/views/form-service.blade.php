<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Form Service Request - Milenia Group</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .topbar {
            background-color: #e3001c;
            padding: 2px 0;
            color: #ffffff;
            font-size: 14px;
        }

        .topbar-title {
            font-weight: 500;
            font-size: 14px;
        }

        .topbar a,
        .topbar i {
            color: #ffffff !important;
            text-decoration: none;
        }

        .topbar a:hover {
            text-decoration: underline;
            color: #ffffff;
        }

        .service-form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 50px;
            border-bottom: 5px solid #e3001c;
        }

        .form-section-header {
            background-color: #e3001c;
            color: white;
            padding: 15px 25px;
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-section {
            padding: 25px;
            border-bottom: 1px solid #eee;
        }

        .form-label {
            font-weight: 500;
            color: #212529;
        }

        .required:after {
            content: " *";
            color: #e3001c;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #e3001c;
            box-shadow: 0 0 0 0.25rem rgba(227, 0, 28, 0.25);
        }

        /* Samakan tampilan select2 dengan form-control */
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0px !important;
        }

        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            font-size: 1rem;
            line-height: 1.5;
            background-color: #fff;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single.select2-selection--focus {
            border-color: #e3001c !important;
            box-shadow: 0 0 0 0.25rem rgba(227, 0, 28, 0.25);
            outline: none;
        }

        /* Perlu juga agar seluruh container select2 terlihat seperti .form-control saat focus */
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #e3001c !important;
            box-shadow: 0 0 0 0.25rem rgba(227, 0, 28, 0.25);
        }

        /* Hover effect (opsional) */
        .select2-container--default .select2-selection--single:hover {
            border-color: #e3001c;
        }

        /* Hilangkan garis biru default Chrome */
        .select2-selection--single {
            outline: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
            top: 0;
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            display: block;
            width: 100%;
            /* max-width: 300px; */
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-upload-label {
            display: block;
            padding: 10px 15px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-label:hover {
            background-color: #e9ecef;
        }

        .file-name {
            margin-top: 8px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .file-preview {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;

            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            object-fit: contain;
        }

        .file-preview embed {
            width: 100%;
            height: 300px;
            border-radius: 5px;
        }

        .brand-logos {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }

        .logo-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            /* rounded edge */
        }

        .brand-logo {
            height: 100px;
            display: block;
            transition: all 0.4s ease;
            border-radius: 10px;
        }

        /* Shimmer overlay effect */
        .logo-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-20deg);
        }

        /* Animation on hover */
        .logo-wrapper:hover::before {
            animation: shimmer 1s forwards;
        }

        @keyframes shimmer {
            0% {
                left: -75%;
            }

            100% {
                left: 125%;
            }
        }

        .form-column {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .reservation-column {
            border-right: 1px dashed #ddd;
        }

        .btn-submit-custom {
            background-color: #e3001c;
            color: white;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-submit-custom:hover {
            background-color: #b90017;
            color: white;
        }

        .section-title {
            padding-bottom: 20px !important
        }

        .form-upload-input {
            display: none;
        }

        @media (max-width: 768px) {
            .brand-logos {
                flex-wrap: wrap;
                gap: 15px;
            }

            .brand-logo {
                height: 100px;
            }

            .reservation-column {
                border-right: none;
                border-bottom: 1px dashed #ddd;
                padding-bottom: 30px;
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body class="index-page">

    <!-- Top Bar -->
    <div class="topbar d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope me-1"></i><a href="mailto:info@ccas.co.id">info@ccas.co.id</a>
                <span class="d-none d-md-flex"><i class="bi bi-phone ms-4 me-1"></i>(021) 6311133</span>
                <i class="bi bi-instagram ms-4 me-1"></i><a href="https://www.instagram.com/rupesindonesia/"
                    target="_blank">@rupesindonesia</a>
                <span class="d-none d-md-flex"><i class="bi bi-instagram ms-4 me-1"></i><a
                        href="https://www.instagram.com/mileniagroup/" target="_blank">@mileniagroup</a></span>
            </div>

            <div class="social-links d-none d-lg-flex align-items-center">
                <div class="topbar-title text-white text-center">
                    Service Center Milenia Group
                </div>
            </div>
        </div>
    </div>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                {{-- <h1 class="sitename">eBusiness</h1> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/#hero') }}">Beranda</a></li>
                    <li><a href="{{ url('/#about') }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/#services') }}" class="active">Layanan</a></li>
                    <li><a href="{{ url('/#why-us') }}">Kenapa Kami</a></li>
                    <li><a href="{{ url('/#testimonials') }}">Testimoni</a></li>
                    <li><a href="{{ url('/#pricing') }}">Harga</a></li>
                    <li><a href="{{ url('/#contact') }}">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">
        <!-- Form Section -->
        <section id="form" class="mt-5">
            <div class="container">
                <!-- Section Title -->
                <div class="section-title text-center">
                    <h2><span style="color: #e3001c;">Permintaan</span> Service</h2>
                    <p>Lengkapi form di bawah ini untuk mengajukan permintaan layanan service produk Anda. Tim kami akan
                        segera menghubungi Anda setelah data diterima.</p>
                </div>

                <!-- Brand Logos -->
                <div class="brand-logos">
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/img/noco9.jpg') }}" alt="NOCO" class="brand-logo">
                    </div>
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/img/rupes9.webp') }}" alt="RUPES" class="brand-logo">
                    </div>
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/img/ctek9.png') }}" alt="CTEK" class="brand-logo">
                    </div>
                </div>

                <!-- Form Container -->
                <div class="service-form-container">
                    <form id="serviceRequestForm" enctype="multipart/form-data" method="POST"
                        action="{{ route('form-service.store') }}">
                        @csrf
                        <div class="row">
                            <!-- Kolom Kiri: Informasi Reservasi -->
                            <div class="col-md-6 reservation-column">
                                <h4 class="form-section-header">Informasi Reservasi</h4>
                                <div class="form-column">
                                    <!-- Brand Selection -->
                                    <div class="mb-3">
                                        <label for="brand" class="form-label required">Merek Produk</label>
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option value="" disabled selected hidden>Pilih Merek</option>
                                            <option value="rupes">RUPES</option>
                                            <option value="ctek">CTEK</option>
                                            <option value="noco">NOCO</option>
                                        </select>
                                    </div>
                                    <!-- Serial Number / Manual Input -->
                                    <div class="mb-3" id="serialSelectGroup">
                                        <label for="serialNumber" class="form-label">Serial Number (Opsional)</label>
                                        <select class="form-control" id="serialNumber" name="serial_number"
                                            style="width: 100%;">
                                            <option value="">Pilih Serial Number</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 d-none" id="serialManualGroup">
                                        <label for="serialManual" class="form-label">Serial Number
                                            (Opsional)</label>
                                        <input type="text" class="form-control" id="serialManual"
                                            name="serial_manual" placeholder="Masukkan serial number manual">
                                    </div>

                                    <!-- Product Type -->
                                    <div class="mb-3" id="productTypeGroup">
                                        <label for="productType" class="form-label required">Tipe Produk</label>
                                        <input type="text" class="form-control" id="productType"
                                            name="product_type" required
                                            placeholder="Contoh: LH 19 E/ STB ROTARY POLISHER">
                                    </div>

                                    <div class="mb-3">
                                        <label for="issueDescription" class="form-label required">Permasalahan
                                            Mesin</label>
                                        <textarea class="form-control" id="issueDescription" name="issue_description" rows="4" required
                                            placeholder="Jelaskan permasalahan yang dialami"></textarea>
                                        <div class="form-text">Jelaskan secara detail masalah yang Anda alami</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Informasi Pribadi -->
                            <div class="col-md-6">
                                <h4 class="form-section-header">Informasi Pribadi</h4>
                                <div class="form-column">
                                    <div class="mb-3">
                                        <label for="customerName" class="form-label required">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="customerName"
                                            name="customer_name" required placeholder="Masukkan nama lengkap">
                                    </div>

                                    <div class="mb-3">
                                        <label for="customerEmail" class="form-label required">Email Pelanggan</label>
                                        <input type="email" class="form-control" id="customerEmail"
                                            name="customer_email" required placeholder="contoh@email.com">
                                    </div>

                                    <div class="mb-3">
                                        <label for="customerPhone" class="form-label required">No Handphone</label>
                                        <input type="tel" class="form-control" id="customerPhone"
                                            name="customer_phone" required placeholder="08xxxxxxxxxx">
                                    </div>

                                    <div class="mb-3">
                                        <label for="purchaseProofInput" class="form-label">Bukti Nota
                                            (Optional)</label>
                                        <div class="file-upload">
                                            <label for="purchaseProofInput" class="file-upload-label">
                                                <i class="bi bi-upload me-2"></i>Unggah File
                                            </label>
                                            <input type="file" class="form-upload-input" id="purchaseProofInput"
                                                name="purchase_proof" accept="image/*,.pdf" max-file-size="10MB">
                                            <div id="fileName" class="form-text">Belum ada file dipilih</div>
                                        </div>
                                        <div class="form-text">Maks. ukuran file: 10 MB.</div>
                                        <div id="filePreview" class="file-preview mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-section text-center py-4">
                            <button type="submit" class="btn btn-submit-custom">
                                <i class="bi bi-send me-2"></i>Kirim Permintaan Service
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Additional Information -->
                <div class="alert alert-info">
                    <h5 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Informasi Penting</h5>
                    <ul class="mb-0">
                        <li>Pastikan semua informasi yang Anda berikan akurat dan valid</li>
                        <li>Tim kami akan menghubungi Anda dalam 1-2 hari kerja setelah pengajuan</li>
                        <li>Untuk pertanyaan darurat, silakan hubungi (021) 6311133</li>
                        <li>Jam operasional layanan: Senin-Jumat (08.30-17.30 WIB)</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer dark-background">

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit"
                                    value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="#">
                        <img src="{{ asset('assets/img/logo.png') }}" width="200" class="bg-white"
                            alt="">
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Pembangunan I No.1 3, RT.3/RW.1</p>
                        <p>Kota Jakarta Pusat, DKI Jakarta 10130</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>(021) 6311133</span></p>
                        <p><strong>Email:</strong> <span>info@ccas.co.id</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#home">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services">Layanan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#why-us">Kenapa Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#testimonial">Testimoni</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#pricing">Harga</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Servis Produk NOCO</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Servis Produk CTEK</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Servis Produk RUPES</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Konsultasi & Diagnosa</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Penjualan Aksesori</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Ikuti Kami</h4>
                    <p>Dapatkan informasi terbaru seputar layanan, promo, dan produk unggulan NOCO, CTEK, dan RUPES dari
                        kami melalui media sosial.</p>
                    <div class="social-links d-flex flex-column align-items-start gap-2">
                        {{-- <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a> --}}
                        <div class="d-flex align-items-center gap-2">
                            <a href="https://instagram.com/rupesindonesia" target="_blank" title="RUPES Indonesia">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <span>@rupesindonesia</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="https://instagram.com/mileniagroup" target="_blank" title="Milenia Group">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <span>@mileniagroup</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Milenia Group</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                Developed by <a href="https://anandasatriaa.github.io/" target="_blank" id="developer-link">IT
                    Milenia Group</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- jQuery & Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    {{-- Store & Mengambil Serial Number dan Tipe Produk ke Dropdown --}}
    <script>
        $(document).ready(function() {
            // Definisikan URL dari route Laravel
            const serialNumbersUrl = @json(route('serial-numbers'));
            const productDescriptionUrl = @json(route('product-description'));
            const storeUrl = @json(route('form-service.store'));

            // Inisialisasi Select2
            $('#serialNumber').select2({
                placeholder: 'Ketik untuk mencari serial number...',
                allowClear: true,
                ajax: {
                    url: serialNumbersUrl,
                    dataType: 'json',
                    delay: 250,
                    data: params => ({
                        q: params.term
                    }),
                    processResults: data => ({
                        results: data.results
                    }),
                    cache: true
                }
            });

            // Fungsi untuk mengatur tampilan input serial number
            function toggleMode() {
                const brand = $('#brand').val();
                if (brand === 'rupes') {
                    $('#serialSelectGroup').addClass('d-none');
                    $('#serialManualGroup').removeClass('d-none');
                } else {
                    $('#serialSelectGroup').removeClass('d-none');
                    $('#serialManualGroup').addClass('d-none');
                }
            }

            // Event handler saat brand diganti
            $('#brand').on('change', function() {
                toggleMode();
                // Reset field terkait saat brand diganti
                $('#serialNumber').val(null).trigger('change');
                $('#serialManual').val('');
                $('#productType').val('');
            });
            toggleMode(); // Panggil saat halaman pertama kali dimuat

            // Event handler saat serial number DIPILIH
            $('#serialNumber').on('select2:select', function(e) {
                const serial = e.params.data.id;
                if (!serial) return;

                $.get(productDescriptionUrl, {
                    serial: serial
                }, function(data) {
                    $('#productType').val(data.description || '');
                }).fail(function() {
                    console.error('Gagal mengambil deskripsi produk.');
                    $('#productType').val('');
                });
            });

            // Event handler saat pilihan serial number DIHAPUS
            $('#serialNumber').on('select2:unselect', function() {
                $('#productType').val('');
            });

            // Event handler untuk file preview (jika Anda membutuhkannya)
            $('#purchaseProofInput').on('change', function(e) {
                const file = e.target.files[0];
                const filePreview = $('#filePreview');
                const fileNameDisplay = $('#fileName');

                // Kosongkan preview sebelumnya
                filePreview.empty();

                // Jika tidak ada file yang dipilih, reset
                if (!file) {
                    fileNameDisplay.text('Belum ada file dipilih');
                    return;
                }

                // Tampilkan nama file
                fileNameDisplay.text(file.name);

                // Cek tipe file untuk preview
                if (file.type.startsWith('image/')) {
                    // Jika file adalah gambar
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = $('<img>', {
                            src: event.target.result,
                            alt: file.name,
                            css: {
                                maxWidth: '100%',
                                maxHeight: '200px',
                                objectFit: 'contain'
                            }
                        });
                        filePreview.append(img);
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    // Jika file adalah PDF
                    const embed = $('<embed>', {
                        src: URL.createObjectURL(file),
                        type: 'application/pdf',
                        width: '100%',
                        height: '300px'
                    });
                    filePreview.append(embed);
                } else {
                    // Jika tipe file lain
                    filePreview.html(
                        '<p class="text-muted">Preview tidak tersedia untuk tipe file ini.</p>');
                }
            });

            // AJAX submit form
            $('#serviceRequestForm').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const submitButton = $(this).find('button[type="submit"]');

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                submitButton.prop('disabled', true).html(
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengirim...`
                );

                $.ajax({
                    url: storeUrl,
                    method: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire('Berhasil!', response.message ||
                            'Permintaan service berhasil dikirim.', 'success');
                        form.reset();
                        $('#serialNumber').val(null).trigger('change');
                        $('#filePreview').empty();
                        $('#fileName').text('Belum ada file dipilih');
                        toggleMode();
                    },
                    error: function(xhr) {
                        let msg = 'Terjadi kesalahan. Coba lagi.';
                        if (xhr.responseJSON?.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire('Gagal', msg, 'error');
                    },
                    complete: function() {
                        submitButton.prop('disabled', false).html(
                            `<i class="bi bi-send me-2"></i>Kirim Permintaan Service`
                        );
                    }
                });
            });
        });
    </script>


</body>

</html>
