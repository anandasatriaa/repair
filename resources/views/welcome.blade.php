<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Repair - Milenia Group</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

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

        .card-hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .card-hover:hover {
            background-color: #e3001c;
            color: white;
        }

        .card-hover:hover i {
            color: white !important;
        }

        .card-hover:hover h4,
        .card-hover:hover p {
            color: white;
        }

        .card-hover:hover img {
            filter: brightness(0) invert(1);
        }

        /* Testimonial Section */
        .testimonial {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .testimonial-card::before {
            content: " ";
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 5rem;
            font-family: Georgia, serif;
            color: #f1f2f6;
            line-height: 1;
            z-index: 0;
        }

        .testimonial-content {
            position: relative;
            z-index: 1;
        }

        .testimonial-text {
            font-size: 1rem;
            line-height: 1.7;
            color: #2d3436;
            margin-bottom: 25px;
            font-style: italic;
        }

        .rating {
            margin-bottom: 20px;
            display: flex;
        }

        .rating i {
            color: #FFD700;
            font-size: 1.2rem;
            margin-right: 3px;
        }

        .customer-info {
            display: flex;
            align-items: center;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            background: #e3001c;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .customer-details h4 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 5px;
            margin-top: 15px;
        }

        .customer-details p {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .testimonial {
                padding: 60px 0;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .testimonial-carousel {
                padding: 0 20px;
            }

            .swiper-button-next2,
            .swiper-button-prev2 {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .section-title h2 {
                font-size: 1.8rem;
            }

            .section-title p {
                font-size: 0.95rem;
            }

            .testimonial-card {
                padding: 20px;
            }

            .testimonial-text {
                font-size: 0.95rem;
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
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#why-us">Kenapa Kami</a></li>
                    <li><a href="#testimonials">Testimoni</a></li>
                    <li><a href="#pricing">Harga</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/hero-carousel/slide1.jpg') }}" alt="">
                    <div class="carousel-container">
                        <h2>Servis Cepat & Efisien</h2>
                        <p>Kami memahami pentingnya waktu Anda. Dapatkan layanan perbaikan dan perawatan untuk produk
                            RUPES, NOCO, dan CTEK secara cepat tanpa mengurangi kualitas.</p>
                        <a href="#services" class="btn-get-started">Lihat Layanan</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="{{ asset('assets/img/hero-carousel/slide2.png') }}" alt="">
                    <div class="carousel-container">
                        <h2>Tenaga Profesional Berpengalaman</h2>
                        <p>Dukungan teknisi bersertifikat dan berpengalaman menjamin setiap unit Anda ditangani secara
                            tepat, sesuai standar resmi dari RUPES, NOCO, dan CTEK.</p>
                        <a href="#contact" class="btn-get-started">Hubungi Kami</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="{{ asset('assets/img/hero-carousel/slide3.jpg') }}" alt="">
                    <div class="carousel-container">
                        <h2>Layanan Handal & Terpercaya</h2>
                        <p>Milenia Group menghadirkan layanan resmi dengan jaminan mutu untuk setiap produk yang kami
                            tangani. Reservasi online kini lebih mudah dan cepat.</p>
                        <a href="{{ route('form-service') }}" class="btn-get-started">Reservasi Sekarang</a>
                    </div>
                </div><!-- End Carousel Item -->

                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

                <ol class="carousel-indicators"></ol>

            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2><span style="color: #e3001c;">Tentang</span> Kami</h2>
                <p>Kami adalah pusat layanan resmi untuk produk RUPES, NOCO, dan CTEK di Indonesia.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-3">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/about.jpg') }}" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="about-content ps-0 ps-lg-3">
                            <h3>Layanan Resmi, Profesional, dan Terpercaya</h3>
                            <p class="fst-italic">
                                Service Center Milenia Group menyediakan layanan perbaikan dan perawatan untuk berbagai
                                perangkat otomotif dan kelistrikan dari brand RUPES, NOCO, dan CTEK. Kami juga
                                menyediakan layanan purna jual seperti garansi, penggantian suku cadang, serta
                                konsultasi teknis untuk memastikan pelanggan mendapatkan pengalaman terbaik.
                            </p>
                            <ul>
                                <li>
                                    <i class="bi bi-gear-fill"></i>
                                    <div>
                                        <h4>Dukungan Teknis Resmi</h4>
                                        <p>Tim teknisi kami terlatih langsung oleh prinsipal brand dan siap memberikan
                                            solusi cepat dan tepat sesuai standar resmi.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-clock-history"></i>
                                    <div>
                                        <h4>Layanan Cepat dan Efisien</h4>
                                        <p>Proses pengecekan dan perbaikan dilakukan dengan sistem reservasi,
                                            meminimalkan waktu tunggu pelanggan.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-shield-check"></i>
                                    <div>
                                        <h4>Jaminan Mutu & Garansi</h4>
                                        <p>Setiap layanan dilengkapi jaminan kualitas dan garansi resmi agar Anda merasa
                                            aman dan nyaman.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        {{-- <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Services</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <i class="bi bi-activity icon"></i>
                            <div>
                                <h3>Nesciunt Mete</h3>
                                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus
                                    dolores iure perferendis tempore et consequatur.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <i class="bi bi-broadcast icon"></i>
                            <div>
                                <h3>Eosle Commodi</h3>
                                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque
                                    eum hic non ut nesciunt dolorem.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <i class="bi bi-easel icon"></i>
                            <div>
                                <h3>Ledo Markt</h3>
                                <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id
                                    voluptas adipisci eos earum corrupti.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item item-red position-relative">
                            <i class="bi bi-bounding-box-circles icon"></i>
                            <div>
                                <h3>Asperiores Commodi</h3>
                                <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea
                                    fuga sit provident adipisci neque.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item item-indigo position-relative">
                            <i class="bi bi-calendar4-week icon"></i>
                            <div>
                                <h3>Velit Doloremque.</h3>
                                <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut.
                                    Sed animi at autem alias eius labore.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item item-pink position-relative">
                            <i class="bi bi-chat-square-text icon"></i>
                            <div>
                                <h3>Dolori Architecto</h3>
                                <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure.
                                    Corrupti recusandae ducimus enim.</p>
                                <a href="service-details.html" class="read-more stretched-link">Learn More <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section --> --}}

        <!-- Services Section -->
        <section id="services" class="features section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2><span style="color: #e3001c;">Layanan</span> Service</h2>
                <p>Kami menyediakan layanan perbaikan resmi untuk berbagai produk unggulan dengan kualitas terpercaya.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <!-- Polishing Machine -->
                <div class="row mx-1 gy-4 justify-content-between features-item p-4 rounded shadow-sm"
                    style="background-color: #eaeaea; border-left: 5px solid #e3001c; border-bottom: 5px solid #e3001c;">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/rupes.png') }}" class="" style="width: 100%;"
                            alt="Polishing Machine">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="">
                            <h3 class="fw-bold" style="font-size: 2rem;">Polishing Machine</h3>
                            <p style="font-size: 1.2rem; text-align: justify;">
                                Mesin poles Rupes merupakan mesin yang digunakan untuk melakukan finishing agar
                                menghasilkan kilap yang sempurna dan dapat juga digunakan untuk memperbaiki clear coat
                                yang tidak sempurna.
                            </p>
                            <a href="{{ route('form-service') }}" class="btn"
                                style="background-color: #e3001c; color: white;">
                                Reservasi Perbaikan <i class="bi bi-arrow-up-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Features Item -->

                <!-- CTEK -->
                <div class="row mx-1 gy-4 justify-content-between features-item p-4 rounded shadow-sm"
                    style="background-color: #eaeaea; border-right: 5px solid #e3001c; border-bottom: 5px solid #e3001c;">
                    <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="">
                            <h3 class="fw-bold" style="font-size: 2rem;">CTEK</h3>
                            <p style="font-size: 1.2rem; text-align: justify;">
                                Mesin Ctek merupakan mesin pengisi daya dan perawat baterai yang dapat mengisi daya dan
                                merawat baterai kendaraan serta dapat menyesuaikan proses pengisian daya berdasarkan
                                kebutuhan baterai.
                            </p>
                            <a href="{{ route('form-service') }}" class="btn"
                                style="background-color: #e3001c; color: white;">
                                Reservasi Perbaikan <i class="bi bi-arrow-up-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('assets/img/ctek.png') }}" class="" style="width: 100%;"
                            alt="CTEK">
                    </div>
                </div><!-- End Features Item -->

                <!-- NOCO -->
                <div class="row mx-1 gy-4 justify-content-between features-item p-4 rounded shadow-sm"
                    style="background-color: #eaeaea; border-left: 5px solid #e3001c; border-bottom: 5px solid #e3001c;">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/noco.png') }}" class="" style="width: 100%;"
                            alt="NOCO">
                    </div>

                    <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="">
                            <h3 class="fw-bold" style="font-size: 2rem;">NOCO</h3>
                            <p style="font-size: 1.2rem; text-align: justify;">
                                Mesin Noco merupakan alat pemantik listrik portabel yang berfungsi untuk menghidupkan
                                kembali aki yang mati dan memiliki teknologi antipercikan dan perlindungan
                                polaritas terbalik.
                            </p>
                            <a href="{{ route('form-service') }}" class="btn"
                                style="background-color: #e3001c; color: white;">
                                Reservasi Perbaikan <i class="bi bi-arrow-up-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Features Item -->

            </div>

        </section><!-- /Services Section -->

        <!-- Why Us Section -->
        <section id="why-us" class="why-us section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2><span style="color: #e3001c;">Mengapa</span> Memilih Kami</h2>
                <p>Kami berkomitmen memberikan layanan terbaik untuk setiap pelanggan kami.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-item text-center p-4 card-hover">
                            <div class="mb-3">
                                <img src="{{ asset('assets/img/icon1.png') }}" alt="Layanan Cepat" height="80">
                            </div>
                            <h4 class="mb-2">Layanan Cepat</h4>
                            <p>Memberikan layanan yang cepat dan responsif untuk setiap jasa service.</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-item text-center p-4 card-hover">
                            <div class="mb-3">
                                <img src="{{ asset('assets/img/icon2.png') }}" alt="Layanan Cepat" height="80">
                            </div>
                            <h4 class="mb-2">Service Berkualitas</h4>
                            <p>Mengutamakan kualitas dan hasil terbaik untuk setiap dari jasa service kami.</p>
                        </div>
                    </div><!-- Card Item -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-item text-center p-4 card-hover">
                            <div class="mb-3">
                                <img src="{{ asset('assets/img/icon3.png') }}" alt="Layanan Cepat" height="80">
                            </div>
                            <h4 class="mb-2">Berpengalaman</h4>
                            <p>Teknisi yang berpengalaman, memberikan jasa pelayanan terbaik.</p>
                        </div>
                    </div><!-- Card Item -->

                </div>

            </div>

        </section><!-- /Why Us Section -->

        <!-- Testimonial Section -->
        <section id="testimonials" class="testimonial">
            <div class="container">
                <!-- Section Title -->
                <div class="section-title">
                    <h2><span style="color: #e3001c;">Testimoni</span> Pelanggan</h2>
                    <p>Simak pengalaman dan pendapat pelanggan kami mengenai kualitas layanan serta produk yang kami
                        tawarkan.</p>
                </div>

                <!-- Carousel Container -->
                <div class="testimonial-carousel">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Testimonial 1 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">"Saya membawa polisher RUPES saya untuk service di
                                            Milenia, dan hasilnya memuaskan. Tim teknisinya profesional dan
                                            penanganannya cepat. Sangat direkomendasikan!"</p>
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="customer-info">
                                            <div class="avatar">VH</div>
                                            <div class="customer-details">
                                                <h4>Vincent Halim</h4>
                                                <p>Servis RUPES • 2025</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">"Beli charger CTEK MXS 5.0 dari sini, pengiriman
                                            cepat dan dapat garansi resmi. Customer service-nya juga cepat tanggap kalau
                                            ada pertanyaan. Sukses terus Milenia!"</p>
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>
                                        <div class="customer-info">
                                            <div class="avatar">CL</div>
                                            <div class="customer-details">
                                                <h4>Catherine Limantara</h4>
                                                <p>Pembeli CTEK • 2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">"Saya pakai NOCO Boost untuk mobil saya, dan
                                            alatnya luar biasa! Terima kasih Milenia sudah bantu jelaskan cara
                                            penggunaannya dengan jelas. Pelayanan ramah dan profesional."</p>
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="customer-info">
                                            <div class="avatar">AS</div>
                                            <div class="customer-details">
                                                <h4>Adrian Santosa</h4>
                                                <p>Pembeli NOCO • 2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Testimonials -->
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">"Pengalaman belanja yang luar biasa! Produk asli
                                            dan berkualitas tinggi. Staf sangat membantu dan ramah. Pengiriman sangat
                                            cepat. Pasti akan berbelanja lagi di sini."</p>
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <div class="customer-info">
                                            <div class="avatar">DR</div>
                                            <div class="customer-details">
                                                <h4>Diana Ratnasari</h4>
                                                <p>Pembeli NOCO • 2023</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">"Saya sangat terkesan dengan layanan purna jual.
                                            Ketika ada masalah kecil dengan produk, tim support langsung merespons dan
                                            menyelesaikannya dengan profesional."</p>
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                        </div>
                                        <div class="customer-info">
                                            <div class="avatar">RS</div>
                                            <div class="customer-details">
                                                <h4>Rizky Setiawan</h4>
                                                <p>Servis RUPES • 2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        {{-- <div class="swiper-pagination2"></div> --}}

                        <!-- Navigation buttons -->
                        <div class="swiper-button-next2"></div>
                        <div class="swiper-button-prev2"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Product</li>
                        <li data-filter=".filter-branding">Branding</li>
                        <li data-filter=".filter-books">Books</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/app-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/app-1.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/product-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/product-1.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/branding-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/branding-1.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/books-1.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/books-1.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 1</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/app-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/app-2.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/product-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/product-2.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/branding-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/branding-2.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/books-2.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/books-2.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 2</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/app-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/app-3.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">App 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/product-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/product-3.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Product 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/branding-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/branding-3.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Branding 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <div class="portfolio-content h-100">
                                <a href="{{ asset('assets/img/portfolio/books-3.jpg') }}"
                                    data-gallery="portfolio-gallery-app" class="glightbox"><img
                                        src="{{ asset('assets/img/portfolio/books-3.jpg') }}" class="img-fluid"
                                        alt=""></a>
                                <div class="portfolio-info">
                                    <h4><a href="portfolio-details.html" title="More Details">Books 3</a></h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur</p>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section --> --}}

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <div class="container section-title" data-aos="fade-up">
                <h2><span style="color: #e3001c;">Harga</span> Layanan</h2>
                <p>Informasi harga kami disampaikan secara terbuka dan jelas, tanpa biaya tersembunyi. Harga tidak
                    termasuk biaya penggantian suku cadang.</p>
            </div>

            <div class="container">
                <div class="row gy-4">

                    <!-- Pengecekan -->
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pricing-item featured">
                            <h3>Pengecekan</h3>
                            <p class="description">Pemeriksaan menyeluruh untuk mendeteksi masalah tanpa dilakukan
                                perbaikan.</p>
                            <h4>Rp75.000</h4>
                            <a href="{{ route('form-service') }}" class="cta-btn">Reservasi Sekarang</a>
                            <p class="text-center small">Tidak termasuk service dan sparepart</p>
                            <ul>
                                <li><i class="bi bi-check"></i> Diagnosa kondisi alat</li>
                                <li><i class="bi bi-check"></i> Laporan hasil pengecekan</li>
                                <li class="na"><i class="bi bi-x"></i> Tidak termasuk penggantian sparepart</li>
                                <li class="na"><i class="bi bi-x"></i> Tidak termasuk perbaikan</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Service Ringan -->
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pricing-item featured">
                            <h3>Service Ringan</h3>
                            <p class="description">Perawatan ringan seperti pembersihan, pelumasan, dan perbaikan
                                minor.</p>
                            <h4>Rp100.000</h4>
                            <a href="{{ route('form-service') }}" class="cta-btn">Reservasi Sekarang</a>
                            <p class="text-center small">Tidak termasuk sparepart</p>
                            <ul>
                                <li><i class="bi bi-check"></i> Pengecekan & pembersihan</li>
                                <li><i class="bi bi-check"></i> Pelumasan komponen</li>
                                <li><i class="bi bi-check"></i> Perbaikan ringan</li>
                                <li class="na"><i class="bi bi-x"></i> Tidak termasuk sparepart</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Service Besar -->
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="pricing-item featured">
                            <h3>Service Besar</h3>
                            <p class="description">Penanganan menyeluruh untuk kerusakan sedang hingga berat.</p>
                            <h4>Rp250.000</h4>
                            <a href="{{ route('form-service') }}" class="cta-btn">Reservasi Sekarang</a>
                            <p class="text-center small">Tidak termasuk sparepart</p>
                            <ul>
                                <li><i class="bi bi-check"></i> Pemeriksaan menyeluruh</li>
                                <li><i class="bi bi-check"></i> Jasa Penggantian part</li>
                                <li><i class="bi bi-check"></i> Perbaikan menyeluruh</li>
                                <li class="na"><i class="bi bi-x"></i> Biaya sparepart ditagih terpisah</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- /Pricing Section -->

        {{-- <!-- Faq Section -->
        <section id="faq" class="faq section light-background">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="content px-xl-5">
                            <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                        <div class="faq-container">
                            <div class="faq-item faq-active">
                                <h3><span class="num">1.</span> <span>Non consectetur a erat nam at lectus urna
                                        duis?</span></h3>
                                <div class="faq-content">
                                    <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus
                                        laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor
                                        rhoncus dolor purus non.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">2.</span> <span>Feugiat scelerisque varius morbi enim nunc
                                        faucibus a pellentesque?</span></h3>
                                <div class="faq-content">
                                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                        interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                        scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                        Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">3.</span> <span>Dolor sit amet consectetur adipiscing elit
                                        pellentesque?</span></h3>
                                <div class="faq-content">
                                    <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.
                                        Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl
                                        suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis
                                        convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">4.</span> <span>Ac odio tempor orci dapibus. Aliquam eleifend
                                        mi in nulla?</span></h3>
                                <div class="faq-content">
                                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                        interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                        scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                        Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span class="num">5.</span> <span>Tempus quam pellentesque nec nam aliquam sem
                                        et tortor consequat?</span></h3>
                                <div class="faq-content">
                                    <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse
                                        in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                        suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Faq Section --> --}}

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2><span style="color: #e3001c;">Kontak</span> Kami</h2>
                <p>Silakan hubungi kami untuk informasi lebih lanjut, pertanyaan, atau kerja sama. Kami siap membantu
                    Anda.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Jl. Pembangunan I No.1 3, RT.3/RW.1</p>
                                    <p>Kota Jakarta Pusat, DKI Jakarta 10130</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Hubungi Kami</h3>
                                    <p>(021) 6311133</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Kami</h3>
                                    <p>info@ccas.co.id</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3>Jam Operasional</h3>
                                    <p>Senin - Jumat</p>
                                    <p>8:30AM - 05:30PM</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <!-- Embedded Google Map -->
                        <div class="map-responsive" style="border-radius: 10px; overflow: hidden;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.771353889314!2d106.81829309999999!3d-6.161369199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5b9263ef499%3A0x351fb0582becf193!2sPT.%20Milenia%20Mega%20Mandiri!5e0!3m2!1sid!2sid!4v1750142744280!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div><!-- End Google Map -->

                </div>

            </div>

        </section><!-- /Contact Section -->

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

    <!-- Include Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Carousel Testimoni --}}
    <script>
        // Initialize Swiper
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination2',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next2',
                prevEl: '.swiper-button-prev2',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>

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

    {{-- Navbar Menu Active --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll("#navmenu a");

            function onScroll() {
                let scrollPos = window.scrollY + 100; // buffer tinggi header

                sections.forEach((section) => {
                    if (
                        scrollPos >= section.offsetTop &&
                        scrollPos < section.offsetTop + section.offsetHeight
                    ) {
                        navLinks.forEach((link) => {
                            link.classList.remove("active");
                            if (link.getAttribute("href") === "#" + section.id) {
                                link.classList.add("active");
                            }
                        });
                    }
                });
            }

            window.addEventListener("scroll", onScroll);
        });
    </script>

</body>

</html>
