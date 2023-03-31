<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="google-site-verification" content="l4yf_aoFnToBUVvV7JFnDrOB0YPcOyGBBV_m14AlrgM" />

    <title>
        mikrotikbot - Remot VPN mikrotik server mikhmon online dan mikbotam
    </title>
    <meta
        content="Tunnel Remot mikrotik jarak jauh,Hosting mikrotik online untuk management hotspot menggunakan mikhmon - mikbotam"
        name="description" />
    <meta content="vpn remote,mikhmon online, mikbotam online, vpn mikrotik" name="keywords" />

    <!-- Favicons -->
    <link href={{ asset('assets-home/img/favicon.png') }} rel="icon" />
    <link href={{ asset('assets-home/img/apple-touch-icon.png') }} rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href={{ asset('assets-home/vendor/aos/aos.css') }} rel="stylesheet" />
    <link href={{ asset('assets-home/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet" />
    <link href={{ asset('assets-home/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet" />
    <link href={{ asset('assets-home/vendor/boxicons/css/boxicons.min.css') }} rel="stylesheet" />
    <link href={{ asset('assets-home/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet" />
    <link href={{ asset('assets-home/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href={{ asset('assets-home/css/style.css') }} rel="stylesheet" />


</head>

<body>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <h1>
                <Link href={{ route('home') }}><img src={{ asset('android-chrome-96x96.png') }}
                                                 class="img-fluid" alt="">TunnelMikrotikBot</Link>
            </h1>
        </div>


        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <Link class="nav-link scrollto active" href="#hero">Home</Link>
                </li>
                <li>
                    <Link class="nav-link scrollto" href="#pricing">Harga</Link>
                </li>
                <li>
                    <Link class="getstarted" href={{ url('register') }}>Registrasi</Link>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1"
                 data-aos="fade-up">
                <div>
                    <h1>Buat Tunnel Remot Mikrotik Sendiri</h1>
                    <h2>
                        Tunnel remote mikrotik berkualitas untuk akses mikrotik dari luar jaringan lokal, <br>atau
                        managed hotspot dengan
                        <span class="btn btn-sm btn-primary">mikhmon</span> online atau <span
                            class="btn btn-sm btn-info">mikbotam </span> online, anda bisa
                        menggunakan layanan Tunnel Remot API, WINBOX ataupun WEBFIG dari kami.
                    </h2>
                    <Link href={{ route('register') }} class="download-btn"><i class='bx bxs-user-plus'></i>Registrasi
                        Sekarang
                    </Link>
                    <Link href={{ route('login') }} class="download-btn"><i class='bx bxs-id-card'></i>
                    Login
                    </Link>
                </div>
            </div>
            <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img"
                 data-aos="fade-up">
                <img src={{ asset('hero.png') }} class="img-fluid" alt="" />
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->

<main id="main">
    <!-- ======= App Features Section ======= -->
    {{-- <section id="features" class="features">
        <div class="container">
            <div class="section-title">
                <h2>Features</h2>
                <p>
                    Anda belum mempunyai IP Public, silahkan gunakan Tunnel Remot agar bisa dengan mudah monitoring
                    ROUTERBOARD dari mana pun.
                </p>
            </div>

            <div class="row no-gutters">
                <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
                    <div class="content d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-6 icon-box" data-aos="fade-up">
                                <i class="bx bx-receipt"></i>
                                <h4>Corporis voluptates sit</h4>
                                <p>
                                    Consequuntur sunt aut quasi enim
                                    aliquam quae harum pariatur laboris
                                    nisi ut aliquip
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-cube-alt"></i>
                                <h4>Ullamco laboris nisi</h4>
                                <p>
                                    Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui
                                    officia deserunt
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-images"></i>
                                <h4>Labore consequatur</h4>
                                <p>
                                    Aut suscipit aut cum nemo deleniti
                                    aut omnis. Doloribus ut maiores
                                    omnis facere
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-shield"></i>
                                <h4>Beatae veritatis</h4>
                                <p>
                                    Expedita veritatis consequuntur
                                    nihil tempore laudantium vitae denat
                                    pacta
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                <i class="bx bx-atom"></i>
                                <h4>Molestiae dolor</h4>
                                <p>
                                    Et fuga et deserunt et enim. Dolorem
                                    architecto ratione tensa raptor
                                    marte
                                </p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                                <i class="bx bx-id-card"></i>
                                <h4>Explicabo consectetur</h4>
                                <p>
                                    Est autem dicta beatae suscipit.
                                    Sint veritatis et sit quasi ab aut
                                    inventore
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2"
                    data-aos="fade-left" data-aos-delay="100">
                    <img src="assets/img/features.svg" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section> --}}
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-title">
                <h2>Harga</h2>
                <p>
                    Jika anda ingin menggunakan tunnel mikrotikbot silahkan pilih harga sewa yang ingin anda
                    kehendaki, untuk nominal <span class="badge bg-success"> Rp. 5.000</span> anda sudah bisa akses
                    mikrotik dari luar jaringan tanpa harus
                    berada pada jaringan lokal network anda.
                </p>
            </div>

            <div class="row no-gutters">
                <div class="col-lg-4 box" data-aos="fade-right">
                    <h3>Hemat Lengkap</h3>
                    <h4>Rp. 5.000<span>Per Bulan</span></h4>
                    <ul>
                        <li>
                            <i class="bx bx-check"></i>Masa Aktif 1 Bulan
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Mendapatkan 3 Port Akses
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Port Api
                        </li>
                        <li>
                            <i class="bx bx-check"></i>
                            <span>Port Winbox</span>
                        </li>
                        <li>
                            <i class="bx bx-check"></i>
                            <span>Webfig/Userman</span>
                        </li>
                    </ul>
                    <Link href={{ route('register') }} class="get-started-btn">Order Sekarang</Link>
                </div>

                <div class="col-lg-4 box featured" data-aos="fade-up">
                    <h3>Dobel Lengkap</h3>
                    <h4>Rp. 15.000<span>Per Bulan</span></h4>
                    <ul>
                        <li>
                            <i class="bx bx-check"></i> Aktif 1 Bulan + Hosting Mikrotik
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Port Api, Winbox, Web
                        </li>
                    </ul>
                    <Link href={{ route('register') }} class="get-started-btn">Order Sekarang</Link>
                </div>

                <div class="col-lg-4 box" data-aos="fade-left">
                    <h3>3XXXL </h3>
                    <h4>Rp. 25.000<span>Per Bulan</span></h4>
                    <ul>
                        <li>
                            <i class="bx bx-check"></i> Aktif 1 Bulan + Hosting Mikrotik
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Port Api, Winbox, Web
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Mikhmon Online
                        </li>
                        <li>
                            <i class="bx bx-check"></i> Mikbotam
                        </li>
                    </ul>
                    <Link href={{ route('register') }} class="get-started-btn">Order Sekarang</Link>
                </div>
            </div>
        </div>
    </section>
</main>

<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{ config('app.name', 'MikrotikBot') }}</h3>
                    <p>
                        Indonesia <br /><br />
                        <strong>Phone:</strong> +62 8515 7000 387<br />
                        <strong>Email:</strong> csmikrotikbot@gmail.com<br />
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ config('app.name', 'MikrotikBot') }}</span></strong>. All Rights
            Reserved
        </div>
    </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src={{ asset('assets-home/vendor/aos/aos.js') }}></script>
<script src={{ asset('assets-home/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('assets-home/vendor/glightbox/js/glightbox.min.js') }}></script>
<script src={{ asset('assets-home/vendor/swiper/swiper-bundle.min.js') }}></script>
<script src={{ asset('assets-home/vendor/php-email-form/validate.js') }}></script>

<!-- Template Main JS File -->
<script src={{ asset('assets-home/js/main.js') }}></script>
</body>

</html>
