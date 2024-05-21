<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sarpras Bhamada</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/logo-bhamada-sm.png') }}" rel="icon">
    <link href="{{ asset('assets/logo-bhamada-sm.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('iportfolio/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('iportfolio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('iportfolio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('iportfolio/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('iportfolio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('iportfolio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('iportfolio/assets/css/style.css') }}" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile">
                <img src="{{ asset('assets/logo-bhamada-bg-white-lg.png') }}" alt="Logo Bhamada"
                    class="img-fluid rounded-circle">
                <h1 class="text-light">
                    <a href="index.html">Sarana Prasarana</a>
                </h1>
                <div class="social-links mt-3 text-center">
                    <a href="https://www.facebook.com/spmb.husada" class="facebook">
                        <i class="bx bxl-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/universitasbhamadaslawi/" class="instagram">
                        <i class="bx bxl-instagram"></i>
                    </a>
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul style="width: 100%">
                    <li>
                        <a href="#hero" class="nav-link scrollto active">
                            <i class="bx bx-home"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="nav-link scrollto">
                            <i class="bx bx-user"></i>
                            <span>Visi Misi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#portfolio" class="nav-link scrollto">
                            <i class="bx bx-book-content"></i>
                            <span>Pedoman & SOP</span>
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="nav-link scrollto">
                            <i class="bx bx-server"></i>
                            <span>Inventaris</span>
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="nav-link scrollto">
                            <i class="bx bx-envelope"></i>
                            <span>Kontak</span>
                        </a>
                    </li>
                    <li style="padding: 16px; width: 100%">
                        <a href="{{ url('login') }}" class="btn-peminjaman">
                            <span style="color: #ffffff; width: 100%;">
                                Login
                            </span>
                        </a>
                    </li>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center"
        style="background: url({{ asset('assets/bg-hero.jpg') }})">
        <div class="hero-container" data-aos="fade-in">
            <h1>Selamat Datang</h1>
            <p>
                <span class="typed"
                    data-typed-items="Sugeng Rawuh, Di halaman website sarana prasarana,Universitas Bhamada Slawi, Silahkan mengunjungi menu yang diinginkan"></span>
            </p>
        </div>
    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="padding-bottom: 30px">
            <div class="container">

                <div class="section-title">
                    <h2>Visi & Misi</h2>
                </div>

                <div class="row">
                    <div class="col-12 content" data-aos="fade-left">
                        <h3>Visi</h3>
                        <p>
                            Mewujudkan kelancaran dan kegiatan civitas Administrasi Akademik dalam bidang sarana dan
                            prasarana serta memperlancar pengelolaan, perbendaharaan, keteraturan dan ketepatan dalam
                            melaksanakan tugas agar lebih efisien dan efektif.
                        </p>
                        <h3>Misi</h3>
                        <div class="row">
                            <div class="col-12">
                                <ol style="padding-left: 16px">
                                    <li>
                                        <span>Membantu kelancaran bidang Administrasi Umum dalam penyelenggaraan urusan
                                            sarana prasarana Universitas Bhamada Slawi</span>
                                    </li>
                                    <li>
                                        <span>Membuat pendataan secara Administratif inventaris Universitas Bhamada
                                            Slawi</span>
                                    </li>
                                    <li>
                                        <span>Mengembangkan sistem dibidang Informatika dan Teknologi agar dapat
                                            memperlancar dalam pembelajaran</span>
                                    </li>
                                    <li>
                                        <span>Meningkatkan Kualitas kerja sarana prasarana dan menunjang kelancaran KBM
                                            maupun sarana prasarana Dosen dan Karyawan</span>
                                    </li>
                                    <li>
                                        <span>Evaluasi kegiatan dan laporan kegiatan guna meningkatkan prestasi,
                                            dedikasi dan loyalitas agar menuju orientasi ke depan lebih baik</span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Facts Section ======= -->
        <section id="facts" class="facts" style="padding-top: 0px">
            <div class="container">
                <div class="section-title">
                    <h2>Persentase</h2>
                    <p>Persentase program kerja Sarana dan prasarana Universitas Bhamada Slawi, proses realisasi hingga
                        program kerja yang dilaksanakan dapat dilihat dibawah ini</p>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>
                                <strong>Survei Kepuasan</strong>
                                <a href="">Klik disini</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>
                                <strong>Program Kerja</strong>
                                <a href="">Lihat</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="count-box">
                            <i class="bi bi-headset"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1453"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>
                                Realisasi
                                <a href="">Lihat</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>
                                On Progress
                                <a href="">Lihat</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Facts Section -->

        <!-- ======= Skills Section ======= -->
        <section id="skills" class="skills section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Ajuan</h2>
                    <p>Anda dapat mengajukan semua kebutuhan terkait sarana prasarana dari setiap unit/prodi, melalui
                        beberapa link dibawah ini :</p>
                </div>
                <div class="row skills-content">
                    <div class="col-lg-6" data-aos="fade-up">
                        <div class="progress">
                            <span class="skill">Kerusakan Kendaraan
                                <i class="val">3%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="3" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <span class="skill">Kerusakan Ruang Kelas
                                <i class="val">10%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <span class="skill">Kerusakan Gedung
                                <i class="val">5%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="5" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="progress">
                            <span class="skill">Kerusakan Elekronik & Barang
                                <i class="val">20%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <span class="skill">Pengadaan
                                <i class="val">20%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="progress">
                            <span class="skill">Perbaikan
                                <i class="val">40%</i>
                            </span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Skills Section -->

        <!-- ======= Resume Section ======= -->
        <section id="resume" class="resume">
            <div class="container">

                <div class="section-title">
                    <h2>Satuan Kerja</h2>
                    <p>Berikut ini halaman satuan kerja yang berada dibawah naungan sarana prasarana Universitas Bhamada
                        Slawi.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-up">
                        <h3 class="resume-title">Satuan Pengamanan</h3>
                        <div class="resume-item pb-0">
                            <h4>Security</h4>
                            <p>Satuan pengamanan universitas bhamada slawi bertugas Mengatur arus lalu lintas dan
                                menjaga keamanan kampus, Yang terbagi dalam tiga shift pagi siang malam.</p>
                            <p>Koordinator Satpam</p>
                            <ul>
                                <li>
                                    <span>Syarifudin</span>
                                    <a href="https://wa.me/6285624186099">Kontak</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="resume-title">Staf Sarana Prasarana</h3>
                        <div class="resume-item">
                            <h4>Koordinator Kendaraan Kampus</h4>
                            <p>Setiap peminjaman kendaraan kampus dapat mengisi form yang tersedia pada menu peminjaman,
                                keterangan lebih lanjut silahkan menghubungi kontak dibawah ini :</p>
                            <ul>
                                <li>
                                    <span>Ahadi</span>
                                    <a href="https://wa.me/6282324709753">Kontak</a>
                                </li>
                            </ul>
                        </div>
                        <div class="resume-item">
                            <h4>Koordinator Gedung, Ruangan dan CS </h4>
                            <p>Penggunaan gedung dan ruangan dapat mengisi form peminjaman yang tertera pada menu
                                peminjaman gedung dan ruangan, untuk keterangan lebih jelas dapat menghubungi:</p>
                            <ul>
                                <li>
                                    <span>Heri Purwoso</span>
                                    <a href="https://wa.me/6281286493375">Kontak</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="resume-title">Satuan Pengemudi Kampus</h3>
                        <div class="resume-item">
                            <h4>Driver</h4>
                            <p>Daftar pengemudi kampus</p>
                            <ul>
                                <li>
                                    <span>Heri Dwi Nanto</span>
                                    <a href="https://wa.me/6282313202906">Kontak</a>
                                </li>
                                <li>
                                    <span>Dakrowi</span>
                                    <a href="https://wa.me/6285842140195">Kontak</a>
                                </li>
                                <li>
                                    <span>Agus Prasojo</span>
                                    <a href="https://wa.me/6281229972733">Kontak</a>
                                </li>
                                <li>
                                    <span>Sugiarto</span>
                                    <a href="https://wa.me/6287816270626">Kontak</a>
                                </li>
                                <li>
                                    <span>Dian Kurniawan</span>
                                    <a href="https://wa.me/6285228801803">Kontak</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Resume Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Pedoman & SOP</h2>
                    <p>Berikut kumpulan pedoman & SOP :</p>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">Semua</li>
                            <li data-filter=".filter-app">Pedoman</li>
                            <li data-filter=".filter-card">SOP</li>
                            <li data-filter=".filter-web">Monev dan AMI</li>
                        </ul>
                    </div>
                </div>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap" style="text-align: center">
                            <img src="{{ asset('assets/pedoman-pengelolaan.png') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/pedoman-pengelolaan.png') }}"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                        class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap" style="text-align: center">
                            <img src="{{ asset('assets/laporan-ami-2021.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/laporan-ami-2021.png') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap" style="text-align: center">
                            <img src="{{ asset('assets/laporan-ami-2022.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('assets/laporan-ami-2022.png') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Portfolio Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">
                <div class="section-title">
                    <h2>Inventaris</h2>
                    <p>Inventaris merupakan kumpulan data terkait sarana prasarana yang tersedia di Universitas Bhamada
                        Slawi</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon"><i class="bi bi-briefcase"></i></div>
                        <h4 class="title">
                            <a href="">Ruang</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="bi bi-card-checklist"></i></div>
                        <h4 class="title">
                            <a href="">Gedung</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="bi bi-bar-chart"></i></div>
                        <h4 class="title">
                            <a href="">Lahan</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="bi bi-binoculars"></i></div>
                        <h4 class="title">
                            <a href="">Sistem Informasi</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="bi bi-brightness-high"></i></div>
                        <h4 class="title">
                            <a href="">Kendaraan</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                        <h4 class="title">
                            <a href="">Barang</a>
                        </h4>
                        <p class="description">
                            <a href="">Selengkapnya</a>
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="section-title">
                    <h2>Kontak Kami</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
                <div class="row" data-aos="fade-in">
                    <div class="d-flex align-items-stretch">
                        <div class="info">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="address">
                                        <i class="bi bi-geo-alt"></i>
                                        <h4>Lokasi:</h4>
                                        <p>Jl. Cut Nyak Dhien No.16, Desa Kalisapu, Kecamatan Slawi,
                                            Kabupaten Tegal 52416</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="email">
                                        <i class="bi bi-envelope"></i>
                                        <h4>Email:</h4>
                                        <p>saranaprasaranabhamada@gmail.com</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="phone">
                                        <i class="bi bi-phone"></i>
                                        <h4>Kontak:</h4>
                                        <p>
                                            <a href="">WhatsApp</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1493300923175!2d109.11826881450068!3d-6.991686470414839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fbef42471658d%3A0x883656d1325ef066!2sBhamada%20Slawi!5e0!3m2!1sen!2sus!4v1674634706554!5m2!1sen!2sus"
                                width="100%" height="290" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="credits">
                Copyright &copy; 2024, Designed & Developed by
                <strong>
                    <a href="https://it.bhamada.ac.id/">IT Bhamada</a>
                </strong>
            </div>
        </div>
    </footer>
    <!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('iportfolio/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('iportfolio/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('iportfolio/assets/js/main.js') }}"></script>

</body>

</html>
