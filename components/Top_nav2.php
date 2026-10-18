<!-- components/Top_nav.php -->
<style>
/* ==== TOP NAV STYLES ==== */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");

/* Root Variables */
/* Root Variables */
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
</style>

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
      <li><a href="../Main_page/aboutUs.php">TENTANG KAMI</a></li>
      <li>    <a href="https://wa.me/60123456789?text=Hai%20saya%20ingin%20bertanya%20tentang%20ACCSmart:%20SPM"
       target="_blank">
       HUBUNGI KAMI
    </a></li>
      <li><a href="../Main_page/Homepage.php">SERTAI KAMI<img src="../img/arrow.png" alt="Join Icon" class="join-icon"></a></li>
    </ul>
  </div>
</nav>
