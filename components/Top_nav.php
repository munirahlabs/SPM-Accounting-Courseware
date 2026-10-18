<!-- components/Top_nav.php -->
<style>
/* ==== TOP NAV STYLES ==== */

/* Root Variables */
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
    font-size: 14px;
      line-height: 1.6;
}

html {
  scroll-behavior: smooth;
}

#about {
  scroll-margin-top: 80px; /* adjust this number based on your navbar height */
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
  background-color: white;
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
  background-color: #001f3f;
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
  width: 110px; 
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
  color: white;
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
      <img src="../img/AccSmartlogoWhite.png" alt="AccSmart Logo" class="logo-img">
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
