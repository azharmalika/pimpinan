<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Agenda | Beranda</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('enno/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('enno/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('enno/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('enno/assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <div class="sidebar-brand d-flex flex-column align-items-center justify-content-center py-3">
          <div class="sidebar-brand-icon mb-2">
              <img src="{{ asset('images/logo-dpad.png') }}" alt="Logo" style="width: 60px; height: 60px;">
          </div>
      </div>
      
      <a href="#" class="logo d-flex align-items-center me-auto">
      
        <h1 class="sitename">DPAD DIY</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      @auth
          <a class="btn-getstarted" href="{{ route('dashboard') }}">Dashboard</a>

      @else
          <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

      @endauth


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1>Agenda Pimpinan</h1>
            <p>Aplikasi Agenda Pimpinan</p>
            <div class="d-flex">
              @auth
                  <a href="{{ route('dashboard') }}" class="btn-get-started">Dashboard</a>
              @else
                  <a href="{{ route('login') }}" class="btn-get-started">Login</a>
              @endauth
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ asset('enno/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->
    
    <!-- Agenda Hari Ini -->
    <section id="agenda-hari-ini" class="section">
        <div class="container">
            <h2 class="mb-4">Agenda Pimpinan Hari Ini</h2>

            @if($agendaHariIni->isEmpty())
                <p>Tidak ada agenda untuk hari ini.</p>
            @else
                @foreach($agendaHariIni as $pimpinan => $agendas)
                    <div class="mb-5">
                        <h4 class="mb-3">Pimpinan: {{ $pimpinan }}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agendas as $agenda)
                                        <tr>
                                            <td>{{ $agenda->judul }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                                                - {{ $agenda->jam }}
                                            </td>
                                            <td>{{ $agenda->tempat }}</td>
                                            <td>{{ $agenda->deskripsi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>About Us<br></span>
        <h2>About</h2>
        <p>Dinas Perpustakaan dan Arsip Daerah DIY (DPAD DIY) adalah lembaga pemerintah daerah yang bertugas menyelenggarakan urusan di bidang perpustakaan dan kearsipan di lingkungan Daerah Istimewa Yogyakarta.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('enno/assets/img/about.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Meningkatkan Literasi & Pelayanan Informasi Publik</h3>
            <p class="fst-italic">
            DPAD DIY berkomitmen untuk meningkatkan literasi masyarakat, mendukung pelestarian arsip, dan menyediakan akses informasi yang terbuka, mudah, dan inklusif bagi seluruh warga.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Menyediakan layanan perpustakaan digital dan fisik yang ramah pengguna.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Mengelola arsip pemerintahan dan publik untuk menjamin akuntabilitas.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Menyelenggarakan pelatihan, edukasi, dan promosi literasi di berbagai kalangan.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Mendukung pengembangan budaya baca dan pelestarian warisan dokumen sejarah.</span></li>
            </ul>
            <p>
            Dengan visi menjadi pusat literasi dan informasi terpercaya di wilayah Yogyakarta, 
            DPAD DIY terus berinovasi dalam pelayanan, kolaborasi, dan digitalisasi arsip serta perpustakaan untuk masa depan yang lebih cerdas dan terbuka.
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->
  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
      </div>
    </div>

    

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('enno/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('enno/assets/js/main.js') }}"></script>

</body>

</html>