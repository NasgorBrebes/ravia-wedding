<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rama & Oktavia Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/transition.css') }}">
    <link rel="stylesheet" href="{{ asset('css/musik.css') }}">
</head>

<body>


    <nav class="navbar navbar-expand-md bg-transparent sticky-top mynavbar">
        <div class="container">
            <a class="navbar-brand" href="#">Ravia</a>
            <button class="navbar-toggler border-0" style="color: white;" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Ravia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="#home">Home</a>
                        <a class="nav-link" href="#mempelai">Mempelai</a>
                        <a class="nav-link" href="#info">Info</a>
                        <a class="nav-link" href="#map">Maps</a>
                        <a class="nav-link" href="#story">Story</a>
                        <a class="nav-link" href="#gallery">Gallery</a>
                        <a class="nav-link" href="#gift-section">Gift</a>
                        <a class="nav-link" href="#komen">RSVP</a>
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Author</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="home">
        <div class="container">
            <div class="image-home">
                <img src="img/home.JPG" alt="Pasangan Pengantin">
            </div>
            <p class="quote">
                Di antara tanda-tanda (kebesaran)-Nya ialah bahwa Dia menciptakan pasangan-pasangan untukmu dari (jenis)
                dirimu sendiri agar kamu merasa tenteram kepadanya.
                Dia menjadikan di antaramu rasa cinta dan kasih sayang. Sesungguhnya pada yang demikian itu benar-benar
                terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir.
                <strong>QS. Ar-Rum Ayat 21</strong>
            </p>
        </div>
    </section>


    <section id="mempelai" class="mempelai">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="row align-items-center">
                        <!-- Mempelai Pria -->
                        <div class="col-md-6">
                            <div class="circle syachrul mx-auto"></div>
                            <h3 class="name">Syachrul Ramadhan</h3>
                            <p class="desc">
                                Putra pertama dari pasangan<br>
                                Travis Sekut &<br>
                                Kylie Jannar<br>
                                Jl. Kebenaran
                            </p>
                        </div>
                        <!-- Mempelai Wanita -->
                        <div class="col-md-6">
                            <div class="circle dhinda mx-auto"></div>
                            <h3 class="name">Dhinda Oktavia Ramadhansi</h3>
                            <p class="desc">
                                Putri pertama dari pasangan<br>
                                Tatang &<br>
                                Siti<br>
                                Jl. Ombak
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="info" class="info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>ASSALAMUALAIKUM WARAHMATULLAH WABARAKATUH</h2>
                    <p>Dengan memohon rahmat dan ridho Allah SWT, Kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk
                        hadir dalam acara Resepsi Pernikahan putra dan puteri kami yang akan dilaksanakan pada:</p>
                    <p>Hari<br><span class="highlight">16 April 2025</span></p>
                    <p>Pukul<br><span class="highlight">19.30 s/d selesai</span></p>
                    <p>Bertempat di</p>
                    <p class="highlight" style="font-size: 25px;">Gran Melia</p>
                    <p>Merupakan suatu kebahagiaan dan kehormatan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir
                        untuk memberikan doa restu kepada kami.</p>
                    <p>Atas kehadiran dan doa restunya kami ucapkan terimakasih.</p>
                    <h2>WASSALAMUALAIKUM WARAHMATULLAH WABARAKATUH</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="map" class="map">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h2>Lokasi Acara</h2>
                    <iframe src="https://maps.google.com/maps?q=Gran+Melia+Jakarta&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        width="900" height="350" style="border:0; border-radius:20px;" allowfullscreen=""
                        loading="lazy">
                    </iframe>
                    <a href="https://www.google.com/maps?q=Gran+Melia+Jakarta" class="map-btn">View Map</a>
                </div>
            </div>
        </div>
    </section>

    <section id="story" class="story">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-10 text-center">
                    <span>Cara Kita Bertemu</span>
                    <h2 style="font-size: 45px;">Our Story</h2>
                    <p>Kisah kami berawal dari sebuah pertemuan sederhana yang perlahan tumbuh menjadi perjalanan cinta
                        yang penuh makna dan harapan.</p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image" style="background-image: url(img/pertemuan11.jpg);"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h3>Pertemuan Pertama</h3>
                                    <span>10 Oktober 2020</span>
                                </div>
                                <div class="timeline-body">
                                    <p>Kami bertemu secara tidak sengaja. Katanya sih, jodoh nggak akan ke mana—eh,
                                        ternyata benar! Awalnya cuma basa-basi, lama-lama jadi sering cari-cari alasan
                                        buat ngobrol. Entah kenapa, dari semua orang di ruangan itu, matanya cuma
                                        nangkep dia terus. Mungkin karena dia yang paling nyentrik... atau paling sering
                                        ngambil cemilan.
                                    </p>
                                </div>
                            </div>

                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="background-image: url(img/pertemuan11.jpg);"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h3>Masa Pacaran</h3>
                                    <span>16 April 2022</span>
                                </div>
                                <div class="timeline-body">
                                    <p>Kami resmi jadi pasangan setelah proses PDKT yang penuh kode—yang seringnya salah
                                        tangkap. Dari nonton film bareng tapi ngantuk duluan, makan bareng tapi rebutan
                                        makanan, sampai debat seru cuma gara-gara warna langit. Tapi ya begitulah, semua
                                        keanehan itu malah bikin makin sayang.
                                    </p>
                                </div>
                            </div>

                        </li>
                        <li>
                            <div class="timeline-image" style="background-image: url(img/pertemuan11.jpg);"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h3>Lamaran & Menikah</h3>
                                    <span>16 April 2025</span>
                                </div>
                                <div class="timeline-body">
                                    <p>Waktu berjalan cepat, tahu-tahu udah sampai di titik ini. Proses lamaran
                                        berlangsung dengan lancar (setelah latihan omongan berkali-kali di depan
                                        cermin), dan akhirnya kami sepakat: kita serius, kita lanjut. Hari pernikahan
                                        pun datang—rame, heboh, haru, dan penuh tawa. Dari stres nyiapin acara, sampe
                                        deg-degan di pelaminan, semua jadi kenangan manis. Sekarang, kami siap memulai
                                        hidup baru... dengan satu aturan penting: siapa cepat dia yang dapet sisa ayam
                                        goreng terakhir.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="gallery py-5">
        <div class="container">
            <!-- Header Section with Animation -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 col-md-10 col-12 text-center">
                    <div class="gallery-heading" data-aos="fade-up">
                        <span class="subtitle">Our Memory</span>
                        <h2 class="title">Galeri Foto</h2>
                        <div class="divider mx-auto"></div>
                        <p class="description">Momen-momen indah yang telah kami lalui bersama dalam perjalanan cinta
                            kami</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid with Hover Effects -->
            <div class="row g-4 justify-content-center gallery-container">
                <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gallery-card">
                        <a href="img/gallery/gallery1.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                            <div class="gallery-image">
                                <img src="img/gallery/thumbnail/t1.jpg" alt="Moment Bahagia 1" class="img-fluid">
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gallery-card">
                        <a href="img/gallery/gallery2.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                            <div class="gallery-image">
                                <img src="img/gallery/thumbnail/t2.jpg" alt="Moment Bahagia 2" class="img-fluid">
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 gallery-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="gallery-card">
                        <a href="img/gallery/gallery3.jpg" data-toggle="lightbox" data-gallery="wedding-gallery">
                            <div class="gallery-image">
                                <img src="img/gallery/thumbnail/t3.jpg" alt="Moment Bahagia 3" class="img-fluid">
                                <div class="overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="row mt-5">
                <div class="col-12 text-center" data-aos="fade-up">
                    <button class="btn-view-more">Lihat Galeri Lainnya</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Gift Section -->
    <section id="gift-section" class="gift-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title">Wedding Gift</h2>
                    <p class="mb-5">Kehadiran dan doa Anda adalah hadiah terindah bagi kami. Namun jika Anda ingin
                        memberikan tanda kasih, kami menyediakan informasi di bawah ini:</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Bank BCA -->
                <div class="col-md-6 col-lg-4">
                    <div class="gift-card">
                        <div class="gift-header">
                            <h5 class="mb-0">Bank BCA</h5>
                        </div>
                        <div class="gift-body">
                            <img src="img/bca.jpg" alt="Logo BCA" class="bank-logo">
                            <p class="mb-2" style="color: #F5C28D;">a.n Syachrul Ramadhan</p>
                            <div class="account-number" id="bca-number">8720374981</div>
                            <button class="copy-btn"
                                onclick="copyToClipboard('bca-number', 'bca-success', 'bca-failed')">
                                <i class="fa fa-copy me-2"></i>Salin No. Rekening
                            </button>
                            <div class="copy-success" id="bca-success">
                                <i class="fa fa-check-circle me-1"></i>Berhasil disalin!
                            </div>
                            <div class="copy-failed" id="bca-failed">
                                <i class="fa fa-info-circle me-1"></i>Silakan salin manual: tekan lama dan pilih
                                "Salin"
                            </div>
                            <!-- Hidden input for fallback -->
                            <textarea class="clipboard-input" id="bca-input">8720374981</textarea>
                        </div>
                    </div>
                </div>

                <!-- Bank Mandiri -->
                <div class="col-md-6 col-lg-4">
                    <div class="gift-card">
                        <div class="gift-header">
                            <h5 class="mb-0">Bank Mandiri</h5>
                        </div>
                        <div class="gift-body">
                            <img src="img/mandiri2.jpg" alt="Logo Mandiri" class="bank-logo">
                            <p class="mb-2" style="color: #F5C28D;">a.n Dhinda Oktavia</p>
                            <div class="account-number" id="mandiri-number">1290374650</div>
                            <button class="copy-btn"
                                onclick="copyToClipboard('mandiri-number', 'mandiri-success', 'mandiri-failed')">
                                <i class="fa fa-copy me-2"></i>Salin No. Rekening
                            </button>
                            <div class="copy-success" id="mandiri-success">
                                <i class="fa fa-check-circle me-1"></i>Berhasil disalin!
                            </div>
                            <div class="copy-failed" id="mandiri-failed">
                                <i class="fa fa-info-circle me-1"></i>Silakan salin manual: tekan lama dan pilih
                                "Salin"
                            </div>
                            <!-- Hidden input for fallback -->
                            <textarea class="clipboard-input" id="mandiri-input">1290374650</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="gift-message">Terima kasih atas doa dan restu yang diberikan untuk pernikahan kami.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Section Ucapan -->
    <section id="komen" class="komen">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center mb-5">
                    <h2 class="display-4 font-weight-bold">Ucapan & Doa</h2>
                    <p class="lead" style="font-size: 2rem;">Berikan ucapan dan doa restu untuk pernikahan kami</p>
                </div>
            </div>

            <!-- Form Kirim Ucapan -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form id="wishesForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Masukkan nama Anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="relationship" class="form-label">Hubungan</label>
                                    <select class="form-select" id="relationship" required>
                                        <option value="" selected disabled>Pilih hubungan</option>
                                        <option value="Keluarga">Keluarga</option>
                                        <option value="Teman">Teman</option>
                                        <option value="Rekan Kerja">Rekan Kerja</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="attendance" class="form-label">Kehadiran</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendance"
                                            id="hadir" value="Hadir" required>
                                        <label class="form-check-label" for="hadir">
                                            Saya akan hadir
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="attendance"
                                            id="tidak-hadir" value="Tidak Hadir">
                                        <label class="form-check-label" for="tidak-hadir">
                                            Maaf, saya tidak bisa hadir
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">Ucapan & Doa</label>
                                    <textarea class="form-control" id="message" rows="4" placeholder="Tulis ucapan dan doa Anda untuk mempelai"
                                        required></textarea>
                                </div>

                                <button type="submit" class="btn w-100"
                                    style="background-color: #F5C28D; color: white;">Kirim Ucapan</button>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Ucapan -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="text-center mb-4">Ucapan dari Tamu</h3>

                    <div class="wishes-container">
                        <!-- Ucapan 1 -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="card-title mb-0">Ahmad Saputra</h5>
                                    <span class="badge bg-primary">Keluarga</span>
                                </div>
                                <p class="card-text">Selamat menempuh hidup baru untuk kedua mempelai. Semoga menjadi
                                    keluarga yang sakinah, mawaddah, warahmah. Aamiin.</p>
                                <div class="text-muted small">20 April 2025</div>
                            </div>
                        </div>

                        <!-- Ucapan 2 -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="card-title mb-0">Siti Nurhaliza</h5>
                                    <span class="badge bg-success">Teman</span>
                                </div>
                                <p class="card-text">Bahagia selalu untuk kalian berdua! Semoga pernikahan ini menjadi
                                    awal yang indah untuk mengarungi kehidupan berdua dengan penuh cinta dan
                                    kebahagiaan.</p>
                                <div class="text-muted small">19 April 2025</div>
                            </div>
                        </div>

                        <!-- Ucapan 3 -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="card-title mb-0">Budi Santoso</h5>
                                    <span class="badge bg-info">Rekan Kerja</span>
                                </div>
                                <p class="card-text">Selamat atas pernikahan kalian! Semoga cinta kalian bertahan
                                    selamanya dan selalu berbahagia dalam mengarungi bahtera rumah tangga.</p>
                                <div class="text-muted small">18 April 2025</div>
                            </div>
                        </div>

                        <!-- Tombol Load More -->
                        <div class="text-center mt-4">
                            <button class="btn btn-outline-primary" id="loadMore"
                                style="border-color: pink; color: pink;">Lihat Lebih Banyak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="page-transition-overlay"></div>
    <section id="main" class="main-content">

        <div class="audio-player">
            <button id="playPauseBtn">▶</button>
        </div>
        <audio id="bgMusic" loop>
            <source src="musik/Rachmaninov - Symphony No. 2 Op. 27 III. Adagio_ Adagio (LSO).mp3" type="audio/mp3">
        </audio>


        <script src="{{ asset('js/gift.js') }}"></script>
        <script src="{{ asset('js/komen.js') }}"></script>
        <script src="{{ asset('js/gallery.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
        <script src="{{ asset('js/transition.js') }}"></script>
        <script src="{{ asset('js/musik.js') }}"></script>
        <script src="{{ asset('js/animasi.js') }}"></script>
</body>

</html>
