<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>accsmart:spm.my</title>
  <!-- ✅ 1. Google Font (use link, not @import, for best performance) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- ✅ 2. Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>

<style>

/* Root Variables */
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
  background: white;
    font-size: 16px;
      line-height: 1.6;
}

html {
  scroll-behavior: smooth;
}

#about {
  scroll-margin-top: 80px; /* adjust this number based on your navbar height */
}

.join-icon {
  width: 29px;         /* perfectly proportional to nav text */
  height: auto;
  margin-left: 8px;    /* small gap from text */
  vertical-align: middle;
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

.section{
    background-color: transparent;
}
.container {
    padding: 4.8rem 0; /* Vertical spacing */
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.slider {
    width: 100%;
    aspect-ratio: 1920 / 800;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.slides {
    width: 200%; /* 2 slides → 200% */
    height: 100%;
    display: flex;
}

.slide {
    width: 50%; /* each takes half */
    transition: 2s;
    position: relative;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slides input {
    display: none; /* hide the radio buttons on the left */
}

.navigation-manual {
    position: absolute;
    width: 100%;
    bottom: 20px;  /* place at bottom of slider */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px; /* spacing between buttons */
}

.manual-btn {
    border: 2px solid rgb(217, 192, 242);
    padding: 5px;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.5s;
}

.manual-btn:hover {
    background: rgb(215, 215, 215);
}

#radio1:checked ~ .first{
    margin-left: 0;
}

#radio2:checked ~ .first{
    margin-left: -50%;
}

/*css for automatic navigation*/

.navigation-auto{
    position: absolute;
    display: flex;
    width: 800px;
    justify-content: center;
    margin-top: 460px;
}

.navigation-auto div{
    border: 2px solid rgb(217, 192, 242);
    padding: 5px;
    border-radius: 10px;
    transition: 1s;
}

.navigation-auto div:not(:last-child){
    margin-right: 40px;
}

#radio1:checked ~ .navigation-auto .auto-btn1{
    background: #999;
}

#radio2:checked ~ .navigation-auto .auto-btn2{
    background: #999;
}

.slide {
  position: relative; /* make it parent for absolute children */
}


/* Position umum untuk semua banner-btns */
.banner-btns {
  position: absolute;
  display: flex;
  gap: 28px;
  z-index: 10;
}

/* Slide 1 khusus */
.slide1-btns {
  top: 78%;   /* boleh adjust */
  left: 29%;  /* letak kiri */
  transform: translate(-50%, -50%);
}

.button-33 {
  border-radius: 100px;
  box-shadow: rgba(146, 144, 144, 0.2) 0 -25px 18px -14px inset,
              rgba(146, 144, 144, 0.2) 0 1px 2px,
              rgba(146, 144, 144, 0.2) 0 2px 4px,
              rgba(146, 144, 144, 0.2) 0 4px 8px,
              rgba(146, 144, 144, 0.2) 0 8px 16px,
              rgba(146, 144, 144, 0.2) 0 16px 32px;
  color: lavenderblush; /* will override per button */
  cursor: pointer;
  display: inline-block;
  font-family: "Poppins",sans-serif;
  padding: 7px 20px;
  text-decoration: none;
  transition: all 250ms;
  border: 0;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  font-size: 20px; /* inherit font-size from .slide1-btns */
}

.button-33:hover {
  box-shadow: rgba(146, 144, 144, 0.2) 0 -25px 18px -14px inset,
              rgba(146, 144, 144, 0.2) 0 1px 2px,
              rgba(146, 144, 144, 0.2) 0 2px 4px,
              rgba(146, 144, 144, 0.2) 0 4px 8px,
              rgba(146, 144, 144, 0.2) 0 8px 16px,
              rgba(146, 144, 144, 0.2) 0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
}


/* Slide 1 first button (pink) */
.slide1-btns .first-btn {
  background-color:#f16037; 
  color: #fff;
}

.slide1-btns .first-btn:hover {
  background-color:rgba(253, 74, 25, 0.95);
}

/* Slide 1 second button (blue) */
.slide1-btns .second-btn {
  background-color:rgba(246, 247, 249, 0.78); /* blue */
  color: black;
}

.slide1-btns .second-btn:hover {
  background-color: rgba(215, 216, 217, 0.78);
}


/* Slide 2 khusus */
.slide2-btns {
  top: 84%;   /* boleh adjust */
  left: 67%;  /* kanan */
  transform: translate(-50%, -50%);
}

.button-55 {
  align-self: center;
  background-color: #fff; /* base, override per button for color */
  background-image: none;
  background-position: 0 90%;
  background-repeat: repeat no-repeat;
  background-size: 4px 3px;
  border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
  border-style: solid;
  border-width: 2px;
  box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
  box-sizing: border-box;
  color: #41403e;
  cursor: pointer;
  display: inline-block;
  font-family: Neucha, sans-serif;
  font-size: 1rem;
  line-height: 23px;
  outline: none;
  padding: .75rem 1.5rem;
  text-decoration: none;
  transition: all 235ms ease-in-out;
  border-bottom-left-radius: 15px 255px;
  border-bottom-right-radius: 225px 15px;
  border-top-left-radius: 255px 15px;
  border-top-right-radius: 15px 225px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-55:hover {
  box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
  transform: translate3d(0, 2px, 0);
}

.button-55:focus {
  box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
}

/* Slide 2 first button */
.slide2-btns .first-btn {
  background-color: #f43f5e;
  color: #fff;
}

.slide2-btns .first-btn:hover {
  background-color: #e11d48;
}

/* Slide 2 second button (blue) */
.slide2-btns .second-btn {
  background-color: #3b82f6;
  color: #fff;
}

.slide2-btns .second-btn:hover {
  background-color: #2563eb;
}

/* CSS for course card */
.course-card {

  background: #f9f8f8ff;
  margin: 0;
  padding: 40px 20px;
  text-align: center;
}

.course-card h2 {
  font-size: 2rem;
  font-weight: 600;
  margin: 10px 0;
  color: #777; 
  margin-bottom: 25px;
  letter-spacing: 1px;
}

.course-card p.subtitle {
  color: gray;
  margin-bottom: 40px;
}

.course-card .cards-container {
  display: flex;
  justify-content: center;
  gap: 50px;
  flex-wrap: wrap;
}

.course-card .card {
  flex: 1;
  min-width: 340px;
  max-width: 380px;
  padding: 24px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  text-align: center;
  transition: transform 0.3s;
}

.course-card .card:hover {
  transform: translateY(-5px);
}

.course-card .icon {
  font-size: 40px;
  margin-bottom: 10px;
}

.course-card .card h3 {
  margin: 10px 0;
  font-size: 1.2rem;
}

.course-card .card p {
  font-size: 0.9rem;
  color: #555;
  margin: 10px 0 20px;
}

.course-card .btn {
  display: inline-block;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: bold;
  text-decoration: none;
  color: white;
}
.course-card .icon img {
  width: 130px;
  height: 130px;
  object-fit: contain;
}

.course-count {
  display: inline-block;
  color: whitesmoke; /* white text */
  font-size: 3rem;
    font-weight: 900;
  text-shadow:
    1px 0 black,
    -1px 0 black,
    0 1px black,
    0 -1px black;
  margin-top: 12px;
}


/* Custom card colors */
.course-card .degree { background:#fedaec; }

.course-card .off-campus { background: #dce6ff; }

.course-card .hybrid { background: #fff6e5; }

/* === ABOUT US SECTION === */
/* General Section Layout */
/* Bahagian utama */
.about-section {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: 3rem;
  padding: 4rem 2rem;
  font-family: "Poppins", sans-serif;
    position: relative;
  overflow: hidden; /* ensures shapes don’t overflow on smaller screens */
  z-index: 1;
}

/* left-side design */
.about-section::before {
  content: "";
  position: absolute;
  top: 10%;
  left: -60px;
  width: 200px;
  height: 200px;
  background: url("../img/shape-right.svg") no-repeat center/contain;
  opacity: 0.25;
  z-index: 0;
  animation: floatLeft 6s ease-in-out infinite alternate;
}

.about-section::after {
  content: "";
  position: absolute;
  bottom: 5%;
  right: -70px;
  width: 220px;
  height: 220px;
  background: url("../img/shape-right.svg") no-repeat center/contain;
  opacity: 0.25;
  z-index: 0;
  animation: floatRight 6s ease-in-out infinite alternate;
} 
@keyframes floatLeft {
  from { transform: translateY(0); }
  to { transform: translateY(15px); }
}

@keyframes floatRight {
  from { transform: translateY(0); }
  to { transform: translateY(-15px); }
}
.about-section.reverse {
  flex-direction: row-reverse;
   margin-top: -2rem;
}

/* Gambar dan tajuk kecil di atas kiri */
.about-image {
  position: relative;
  width: 100%;
  max-width: 500px;
}

.about-subtitle {
  font-size: 1rem;
  font-weight: 600;
  color: #777;
  letter-spacing: 1px;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.about-image img {
  width: 100%;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

/* Kandungan teks di sebelah kanan */
.about-content {
  max-width: 550px;
}

.about-title {
  font-size: 2rem;
  font-weight: 700;
  color: #555;
  line-height: 1.4;
  margin-bottom: 1rem;
}

.accsmart {
  color: #152d4a; /* biru gelap */
}

.spm {
  color: #ee4625; /* oren-merah */
}

.highlight-pink {
  color: #ec4899; /* merah jambu */
}

.about-text {
  color: #555;
  line-height: 1.7;
  margin-bottom: 1.5rem;
}

/* Senarai */
.about-list {
  display: block;
  flex-direction: column;
  list-style: none;
  padding: 0;
  margin: 0;
}

.about-list li {
  display: list-item;
  margin-bottom: 10px;
  font-weight: 500;
  color: #333;
}

.about-list li::before {
  content: "✔ ";
  color: #fbbf24;
  font-weight: bold;
}

.learn-more-container {
  display: flex;
  justify-content: flex-start;
  margin-top: 1rem;
}

.learn-more-btn {
  display: inline-flex;
  align-items: center;
  background-color: #001f3f;
  color: #ffffff;
  font-weight: 600;
  padding: 11px 24px;
  border-radius: 999px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.learn-more-btn .join-icon {
  width: 21px;
  height: auto;
  margin-left: 9px;
}

.learn-more-btn:hover {
  background-color: #001f3f; /* your deep navy color */
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0, 31, 63, 0.25);
}
/* Responsif */
@media (max-width: 768px) {
  .about-section {
    flex-direction: column;
    text-align: center;
  }

  .about-content {
    max-width: 100%;
  }

  .about-subtitle {
    text-align: center;
  }
}


/* === WELCOME BANNER === */
.welcome-banner {
  text-align: center;
  margin-top: 3rem;
  margin-bottom: 2rem;
  opacity: 0;
  transform: translateY(50px); /* hidden and below initially */
  transition: all 0.8s ease-out; /* smooth transition */
}

.welcome-banner.show {
  opacity: 1;
  transform: translateY(0); /* slides up smoothly */
}

.welcome-banner h2 {
  font-size: 4rem;
  font-weight: 600;
  color: #152d4a;
  margin-bottom: 0.8rem;
  letter-spacing: 1px
}

.welcome-banner .welcome-logo {
  width: 550px;
  height: auto;
}

/* Keyframes for the slide-up animation */
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
 
    /* === Team Section === */
.team-card, 
    .team-card * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .team-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      min-height: 100vh;;
    }

    .team-title h2{
      font-size: 2rem;
      font-weight: 600;
      margin: 55px 0;
      color: #777; 
      margin-bottom: 25px;
      letter-spacing: 1px;
      text-align: center; 
}

    .team-title p{
      width: 70%; 
      margin: 0 auto 2rem; 
      text-align: center; 
      line-height: 1.7;
      color: gray;
      margin-bottom: 0px;
    }

    .card-list .card-item {
      color: #555; 
      user-select: none;
      padding: 35px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      background: rgba(225, 217, 217, 0.3);
      border: 1px solid rgba(234, 228, 228, 0.6);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }

    .card-list .card-item .user-image {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 3px solid #0a0000ff;
      padding: 4px;
      object-fit: cover;
    }

    .card-list .card-item .user-name {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .card-list .card-item .user-profession {
      font-size: 1.1rem;
      color: #333;
      font-weight: 400;
    }

    /* Swiper Container Styling */
    .swiper {
      width: 94%;
      max-width: 1500px;
      padding: 40px 0;
    }

    .slider-wrapper {
      overflow: hidden;
      max-width: 1200px;
      margin: 0 auto;
    }

    .slider-wrapper .swiper-pagination-bullet {
      background: gray;
      height: 12px;
      width: 12px;
    }

    .slider-wrapper .swiper-slide-button {
      color: gray;
      transition: 0.3s ease;
    }

    .slider-wrapper .swiper-slide-button:hover {
      color: #2a328a;
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
      <li><a href="index.php">LAMAN UTAMA</a></li>
      <li><a href="#about">TENTANG KAMI</a></li>
      <li>    <a href="https://wa.me/60123456789?text=Hai%20saya%20ingin%20bertanya%20tentang%20ACCSmart:%20SPM"
       target="_blank">
       HUBUNGI KAMI
    </a></li>
      <li><a href="Homepage.php">MULA BELAJAR<img src="../img/arrow.png" alt="Join Icon" class="join-icon"></a></li>
    </ul>
  </div>
</nav>

<section class="container">
  <div class="slider">
    <div class="slides">
      <!-- radio button start -->
      <input type="radio" name="radio-btn" id="radio1" checked>
      <input type="radio" name="radio-btn" id="radio2">
      <!-- radio button end -->

      <!-- slide image start -->
    <div class="slide first">
    <img src="../img/sliderr1.png" alt="slider1">
    <div class="banner-btns slide1-btns">
        <a href="Homepage.php" class="button-33 first-btn">Mula Belajar</a>
        <a href="https://wa.me/60123456789?text=Hai%20saya%20ingin%20bertanya%20tentang%20ACCSmart:%20SPM"
       target="_blank"
       class="button-33 second-btn">
       Hubungi Kami
    </a>
    </div>
    </div>

    <div class="slide">
    <img src="../img/slider2.png" alt="slider2">
        <div class="banner-btns slide2-btns">
            <a href="Homepage.php" class="button-55 first-btn">Lihat Kursus</a>
            <a href="AboutUs.php" class="button-55 second-btn">Kenali Kami</a>
        </div>
    </div>
      <!-- slide image end -->
    </div>

    <!-- automatic navigation start -->
    <div class="navigation-auto">
      <div class="auto-btn1"></div>
      <div class="auto-btn2"></div>
    </div>
    <!-- automatic navigation end -->

    <!-- manual navigation start -->
    <div class="navigation-manual">
      <label for="radio1" class="manual-btn"></label>
      <label for="radio2" class="manual-btn"></label>
    </div>
    <!-- manual navigation end -->
  </div>
</section>

<script type="text/javascript">
    var counter = 1;
    setInterval(function() {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if (counter > 2) {
            counter = 1;
        }
    }, 8000);
</script>

<section class="welcome-banner">
  <h2>Selamat Datang ke</h2>
  <img src="../img/AccSmartlogo.png" alt="ACCSmart Logo" class="welcome-logo">
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const banner = document.querySelector(".welcome-banner");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          banner.classList.add("show");
        } else {
          banner.classList.remove("show"); // optional: removes it when you scroll away
        }
      });
    }, { threshold: 0.3 }); // triggers when 30% of banner is visible

    observer.observe(banner);
  });
</script>

<section class="about-section" id="about">
    <div class="about-image">
      <img src="../img/aboutus1.png" alt="about us""> 
    </div>

    <div class="about-content">
       <p class="about-subtitle">TENTANG KAMI</p>
      <h2 class="about-title">
         <span class="accsmart">ACCSmart:</span>
        <span class="spm">SPM</span> ialah platform pembelajaran lengkap anda untuk 
        mata pelajaran <span class="highlight-pink">Prinsip Perakaunan SPM</span>.</h2>
      <p class="about-text">
        Direka khusus untuk pelajar Malaysia, ia membantu anda menguasai topik utama, 
        berlatih soalan gaya peperiksaan, dan membina keyakinan sebenar untuk menghadapi 
        peperiksaan SPM, bila-bila masa, di mana sahaja.
      </p>
    </div>
  </section>

 <section class="about-section reverse">
  <div class="about-image">
    <img src="../img/aboutus2.png" alt="keistimewaan accsmart">
  </div>

  <div class="about-content">
  <h2 class="about-title">
    Daripada <span class="highlight-pink">Bilik Darjah</span> ke 
    <span class="accsmart">Skrin Anda</span>. 
    Pendekatan Pembelajaran Baharu untuk 
    <span class="spm">Generasi Digital</span>
  </h2>
      <ul class="about-list">
        <li>✔ ACCSmart: SPM menggabungkan teknologi digital dengan bimbingan guru berpengalaman.</li>
        <li>✔ Belajar fleksibel — bila-bila masa, di mana sahaja.</li>
        <li>✔ Kandungan multimedia menarik minat pelajar visual dan interaktif.</li>
        <li>✔ Pembelajaran lebih mudah diakses, selangkah maju dalam pendidikan digital Malaysia.</li>
      </ul>

          <!-- Learn More Button -->
<div class="learn-more-container">
  <a href="AboutUs.php" class="learn-more-btn">
    Ketahui Lebih Lanjut
    <img src="../img/abouticon.png" alt="Arrow Icon" class="join-icon">
  </a>
</div>
  </div>
</section>


<!-- ==== COURSE CARD SECTION ==== -->
<section class="course-card">
  <h2>KAMI MENAWARKAN</h2>
  <p class="about-text" style="width: 50%; margin: 0 auto 2rem; text-align: center; line-height: 1.7;">
    ACCSMART:SPM berusaha untuk menghasilkan lebih banyak kandungan pembelajaran Akaun SPM setiap hari
    bagi membantu pelajar memahami topik dengan cara yang lebih interaktif dan menyeronokkan.
    Kini kami mempunyai:
  </p>

  <div class="cards-container">
    <div class="card degree">
      <div class="icon">
        <img src="../img/kad1.png" alt="Quiz">
      </div>
      <h3>Pembelajaran Video</h3>
      <p>ACCSmart: SPM menyediakan pembelajaran video bersama guru-guru berpengalaman.</p>
      <div class="course-count">
          <span class="count-number">10</span>
            <span class="count-label" style="display:block; font-size:1.3rem;">Video Sedia Ada</span>
        </div>
    </div> <!-- ✅ fixed closing tag -->

    <div class="card off-campus">
      <div class="icon">
        <img src="../img/kad2.png" alt="latihan asas minda">
      </div>
      <h3>Latihan Minda</h3>
      <p>Terdiri daripada permainan dan kuiz akaun interaktif.</p>
   <div class="course-count">
      <span class="count-number">10</span>
        <span class="count-label" style="display:block; font-size:1.3rem;">Latihan Sedia Ada</span>
    </div>
    </div>

 <div class="card hybrid">
      <div class="icon">
        <img src="../img/kad3.png" alt="Percubaan SPM">
      </div>
      <h3>Percubaan SPM</h3>
      <p>Koleksi soalan percubaan sebenar bagi membantu pelajar membuat persediaan peperiksaan dengan lebih baik.</p>
      <div class="course-count">
        <span class="count-number">1</span>
        <span class="count-label" style="display:block; font-size:1.3rem;">Set Soalan</span>
      </div>
    </div>
  </div>
</section>

 <!-- === Team Section === -->
 <section class="team-card"> 
  <div class="team-title"> 
  <h2>GURU-GURU KAMI</h2> 
  <p>
    Di AccSmart: SPM, guru-guru kami berpengalaman dan berdedikasi untuk membantu pelajar mencapai kecemerlangan dalam Perakaunan.
  </p>
</div>
    <div class="container swiper">
      <div class="slider-wrapper">
        <div class="card-list swiper-wrapper">
          <div class="card-item swiper-slide">
            <img src="../img/myteam1.png" alt="my team" class="user-image" />
            <h2 class="user-name">Cikgu Siti</h2>
            <p class="user-profession"> 10 tahun pengalaman </p>
          </div>

          <div class="card-item swiper-slide">
            <img src="../img/myteam.png" alt="my team" class="user-image" />
            <h2 class="user-name">Unknown</h2>
            <p class="user-profession">-</p>
          </div>

          <div class="card-item swiper-slide">
            <img src="../img/myteam.png" alt="my team" class="user-image" />
            <h2 class="user-name">Unknown</h2>
            <p class="user-profession">-</p>
          </div>

          <div class="card-item swiper-slide">
            <img src="../img/myteam.png" alt="my team" class="user-image" />
            <h2 class="user-name">Unknown</h2>
            <p class="user-profession">-</p>
          </div>

          <div class="card-item swiper-slide">
            <img src="../img/myteam.png" alt="my team" class="user-image" />
            <h2 class="user-name">Unknown</h2>
            <p class="user-profession">-</p>
          </div>
        </div>

        <!-- Swiper controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-slide-button swiper-button-prev"></div>
        <div class="swiper-slide-button swiper-button-next"></div>
      </div>
    </div> 
  </section>

  <!-- ✅ Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper('.slider-wrapper', {
      loop: true,
      grabCursor: true,
      spaceBetween: 30,

      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      breakpoints: {
        0: { slidesPerView: 1 },
        620: { slidesPerView: 2 },
        900: { slidesPerView: 3 },
        1200: { slidesPerView: 4 },
      },
    });
  </script>

<?php include '../components/Lower_Nav.php'; ?>

</body>
</html>