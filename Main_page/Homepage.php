<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACCSMART:SPM Course Showcase</title>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <style>

      :root {
      --primary-color: #a855f7;
      --primary-color-dark: #9333ea;
      --secondary-color:rgb(244, 63, 30);
      --text-dark: #1f2937;
      --text-light: #6b7280;
      --extra-light: #faf5ff;
      --max-width: 1200px;
    }

    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    a {
      text-decoration: none;
    }

    body {
      margin: 0;
      padding: 0; /* remove padding for layout accuracy */
    color: #1f2937;
        font-size: 16px;
          line-height: 1.6;
    }
      button, .btn, nav a {
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
  letter-spacing: 0.5px;
}

nav {
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  background-color: #ffffff;
  z-index: 99;
  padding: -4rem 0;
}

.nav__Menu {
  width: 100%;               /* make navbar full width */
  max-width: none;           /* remove 1200px limit */
  margin: 0;                 /* remove auto centering */
  padding: 0.3rem 2rem;      /* add a bit of horizontal breathing space */
  display: flex;
  align-items: center;
  justify-content: space-between; /* space between logo & menu */
}


nav .logo {
  margin-right: auto;
  padding-left: 0rem; /* ✅ no space */
}

nav .logo a {
  display: flex;
  align-items: center;
}

nav .logo-img{
  width: 205px; /* Adjust logo size */
  height: auto;
}

nav .checkbox {
  display: none;
}

nav input {
  display: none;
}

nav .checkbox i {
  font-size: 2rem;
  color: var(--primary-color);
  cursor: pointer;
}

ul {
  display: flex;
  align-items: center;
  gap: 1rem;
  list-style: none;
  transition: left 0.3s;
}

ul li a {
  padding: 0.5rem 1rem;
  border: 2px solid transparent;
  text-decoration: none;
  font-weight: 600;
  font-size: larger;
  color: var(--text-dark);
  transition: 0.3s;
}

ul li a:hover {
  border-top-color: var(--secondary-color);
  border-bottom-color: var(--secondary-color);
  color: var(--secondary-color);
}


    .course-intro {
  padding: 80px 10%;
  background: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 130px;
}

.intro-container {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  gap: 40px;
}

.intro-text {
  flex: 1;
  min-width: 300px;
}

.intro-text h1 {
  font-size: 2.5rem;
  line-height: 1.3;
  color: #222;
   font-weight: 700;
}

.highlight {
  color: #f97316; /* orange */
}

.blue {
  color: #1e3a8a; /* navy */
}

.intro-text p {
  margin-top: 20px;
  font-size: 1.1rem;
  color: #555;
  line-height: 1.6;
  font-weight: 400;
}

.cta-btn {
  display: inline-block;
  margin-top: 30px;
  padding: 14px 28px;
  background-color: #f97316;
  color: #fff;
  border-radius: 10px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s ease;
}

.cta-btn:hover {
  background-color: #ff8c32;
  transform: translateY(-2px);
}

.intro-illustration {
  flex: 1;
  min-width: 300px;
  text-align: center;
}

.intro-illustration img {
  width: 100%;
  max-width: 480px;
}

    h2 {
      font-size: 21px;
      margin-top: 0px;      /* small gap above */
      margin-bottom: 0;
      color: #333;
      padding-left: 3rem;
      font-weight: 100;
      background-color: #f9f8f8ff;
    }

    /* === COURSE SHOWCASE SECTION === */
    .course-showcase {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* exactly 3 per row */
        gap: 25px;                             /* more breathing space */
        justify-items: center;                 /* center each card */
        padding: 30px 60px; 
        background-color: #f9f8f8ff;
          }

      .course-showcase .course-item {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: stretch;
    width: 100%;
    max-width: 500px;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 450px;
  }

    .course-showcase .course-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .course-showcase .banner {
      height: 230px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: 600;
      color: #333;
    }

  .course-showcase .course-title {
    flex: 0 0 40px;               /* fixed height for all titles */
    display: flex;
    align-items: center;          /* vertically center text */
    justify-content: center;      /* horizontally center */
    font-size: 14px;
    font-weight: 600;
    color: #222;
    line-height: 1.1;
    margin: 30px;
    padding: 0;
  }

    .course-showcase .buttons {
        display: flex;
        border-top: 1px solid #eee;
        margin-top: 0px;
    }

    .course-showcase .buttons button {
      flex: 1;
      border: none;
      background: none;
      padding: 30px;
      font-weight: 600;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: background 0.2s ease;
    }

    .course-showcase .buttons button:first-child {
      border-right: 1px solid #eee;
    }

    .course-showcase .buttons button:hover {
      background-color: #f0f0f0;
    }

    .course-showcase .banner img {
    width: 100%;
  height: auto;
  object-fit: cover;
  border-radius: 15px 15px 0 0;
  margin-bottom: 0px;
    }

    .section-divider {
    border: none;
    height: 1px;
    background-color: #ddd; /* kelabu lembut */
    width: 100%; /* tak penuh, nampak elegan */
    margin: 30px auto; /* tengah-tengah */
    margin-bottom: 15px;
}
 .course-showcase .buttons .btn-link {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 30px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    color: #222;
    border-right: 1px solid #eee;
    transition: background 0.2s ease;
}

.course-showcase .buttons .btn-link:last-child {
    border-right: none;
}

.course-showcase .buttons .btn-link:hover {
    background-color: #f0f0f0;
}

.center-video {
  display: block;     /* jadikan block element */
  margin: 20px auto;  /* auto kiri & kanan untuk center, 20px jarak atas bawah */
  max-width: 80%;     /* optional, supaya video tak terlalu besar */
  width: 700px;
  height: 350px;
  margin-bottom: 70px;
}

  </style>
</head>
<body>
  
<nav>
  <div class="nav__Menu">
    <div class="logo">
      <img src="../img/AccSmartLogoo.png" alt="AccSmart Logo" class="logo-img">
    </div>
    <label for="check" class="checkbox">
      <i class="ri-menu-line"></i>
    </label>
    <ul>
      <li><a href="../Main_page/index.php">LAMAN UTAMA</a></li>
      <li><a href="../Main_page/Homepage.php">MODUL</a></li>
      <li><a href="../Main_page/AboutUs.php">TENTANG KAMI</a></li>
            <li>    <a href="https://wa.me/60123456789?text=Hai%20saya%20ingin%20bertanya%20tentang%20ACCSmart:%20SPM"
       target="_blank">
       HUBUNGI KAMI
    </a></li>
    </ul>
  </div>
</nav>

 <section class="course-intro">
  <div class="intro-container">
    <div class="intro-text">
      <h1><span class="highlight">Hai Pelajar Cemerlang!</span><br>
Mari kuasai <span class="blue">Perakaunan SPM</span> dengan cara paling mudah & menyeronokkan!
</h1>
<p>Kuasai SPM bersama <strong>ACCsmart: SPM</strong> dengan nota interaktif, kuiz pintar, dan latihan berformat peperiksaan untuk membantu anda belajar dengan lebih berkesan.</p>
    </div>

    <div class="intro-illustration">
      <!-- Canva or generated illustration -->
      <img src="../img/kad1.png" alt="ACCsmart SPM Illustration">
    </div>
  </div>
</section>

  <h2>SIRI PEMBELAJARAN KAMI</h2>

  <section class="course-showcase">
    <div class="course-item">
        <div class="banner">
            <img src="../img/SPMKickstartt4.png" alt="SPM Kickstart Tingkatan 4">
        </div>
     <div class="course-title">KSSM Prinsip Perakaunan Tingkatan 4</div>   
    <div class="buttons">
        <a href="../Tingkatan4/CourseOverviewT4.php" class="btn-link">
            <img src="../img/OverviewIcon.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Lihat Pengenalan Kursus
        </a>
        <a href="../Tingkatan4/Modul1Nota.php" class="btn-link">
            <img src="../img/OverviewIcon2.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Klik untuk Mula
        </a>
    </div>
    </div>

    <div class="course-item">
        <div class="banner">
            <img src="../img/SPMKickstart5.png" alt="SPM Kickstart Tingkatan 5">
        </div>
      <div class="course-title">KSSM Prinsip Perakaunan Tingkatan 5</div>
    <div class="buttons">
        <a href="../Tingkatan5/CourseOverviewT5.php" class="btn-link">
            <img src="../img/OverviewIcon.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Lihat Pengenalan Kursus
        </a>
        <a href="../Tingkatan5/Modul1s1.php" class="btn-link">
            <img src="../img/OverviewIcon2.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Klik untuk Mula
        </a>
    </div>
    </div>

    <div class="course-item">
        <div class="banner">
            <img src="../img/LatihanMenjawabSPM.png" alt="Misi Skor A Latihan Menjawab SPM">
        </div>
      <div class="course-title">Belajar Cara Menjawab SPM</div>
    <div class="buttons">
        <a href="../LatihanJawabSPM/CourseOverviewSPM.php" class="btn-link">
            <img src="../img/OverviewIcon.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Lihat Pengenalan Kursus
        </a>
        <a href="../LatihanJawabSPM/SetA.php" class="btn-link">
            <img src="../img/OverviewIcon2.png" alt="icon" style="width:35px; height:35px; margin-right:3px;">
            Klik untuk Mula
        </a>
    </div>
    </div>

  </section>

  <?php include '../components/Lower_Nav.php'; ?>

  <script>
  function showPDF() {
    document.getElementById("pdfViewer").style.display = "block";
    document.getElementById("pdfFrame").src = "yourfile.pdf";
  }
</script>

</body>
</html>
