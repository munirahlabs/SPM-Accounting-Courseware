<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACCSMART:SPM Course Modules</title>
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
        font-family: "Poppins", sans-serif;
      background: #fff;
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
      background-color: #001f3f;
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
      width: 207px; /* Adjust logo size */
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
      color: var(--extra-light);
      transition: 0.3s;
    }

    ul li a:hover {
      border-top-color: var(--secondary-color);
      border-bottom-color: var(--secondary-color);
      color: var(--secondary-color);
    }

    body.web-navigation nav {
      background-color: rgba(224, 231, 255); /* biru */
    }

    .course-intro {
      margin: 0 auto;
      background: #fff;
      padding: 7.5rem 3rem 0 3rem;
    }

    .intro h1 {
      font-size: 3rem;
      font-weight: 800;
      color: black; /* dark blue */
      margin-bottom: 10px;
      text-align: left;
    }

    .intro h2 {
      font-size: 1.3rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 12px;
      text-align: left;
    }

    .intro p {
      font-size: 1rem;
      line-height: 1.6;
      color: #4b5563;
      margin-bottom: 60px;
      text-align: justify;
    }

    .course-modules {
      margin-top: 0; /* jarak dari intro */
      padding: 0 2rem;
    }


    .module {
      border-top: 2px solid #e5e7eb;
      padding: 30px 20px;
    }

    .module:first-child {
      border-top: 2px solid #e5e7eb;
    }

    .module h3 {
      font-size: 1.1rem;
      color: #F97316; /* orange */
      margin-bottom: 12px;
      font-weight: 600;
    }

    .subtopic {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 8px 0;
      padding: 12px 14px;
      background: #f9fafb;
      border-radius: 8px;
      transition: background 0.2s ease;
      cursor: pointer;
      text-decoration: none;
    }

    .subtopic:hover {
      background: #f3f4f6;
    }

    .subtopic img {
      width: 35px;
      height: 35px;
    }

    .subtopic span {
      font-size: 0.95rem;
      color: #374151;
    }
  </style>
</head>

<nav>
  <div class="nav__Menu">
    <div class="logo">
      <img src="../img/AccSmartlogoWhite.png" alt="AccSmart Logo" class="logo-img">
    </div>
    <label for="check" class="checkbox">
      <i class="ri-menu-line"></i>
    </label>
    <ul>
      <li><a href="../Main_page/index.php">LAMAN UTAMA</a></li>
      <li><a href="../Main_page/Homepage.php">MODUL</a></li>
      <li><a href="../Main_page/AboutUs.php">TENTANG KAMI</a></li>
      <li><a href="../Main_page/ContactUs.php">HUBUNGI KAMI</a></li>
    </ul>
  </div>
</nav>

<section class="course-intro">
  <div class="intro">
    <h1>Latihan Menjawan SPM</h1>
    <h2>Pengenalan Kursus</h2>
    <p>
Kursus ini direka khas untuk membantu pelajar menguasai teknik dan strategi menjawab soalan Perakaunan SPM dengan lebih berkesan. Modul ini memfokuskan kepada latihan berstruktur berasaskan format sebenar SPM, termasuk soalan objektif dan subjektif, panduan langkah demi langkah, contoh jawapan, serta kuiz interaktif bagi meningkatkan ketepatan dan keyakinan pelajar semasa menjawab peperiksaan.
    </p>
  </div>
</section>

<section class="course-modules">
  <div class="course-structure">
    <!-- Module 1 -->
    <div class="module">
      <h3>Latihan Menjawab SPM <b>Set 1</b></h3>
      <a href="../LatihanJawabSPM/SetADownl.php" class="subtopic"><img src="../img/noteT4.png" alt=""> <span>PDF: Soalan SPM <b>Set 1</b></span></a>
      <a href="../LatihanJawabSPM/SetA.php" class="subtopic"><img src="../img/video.png" alt=""> <span>Video: Cara Menjawab Soalan SPM <b>Set 1</b></span></a>      
    </div>

</section>

</body>
</html>
