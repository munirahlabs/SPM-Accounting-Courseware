<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACCSMART:SPM Footer</title>

  <style>
    /* ==== Footer Section ==== */
    footer {
      background-color: #001f3f; /* dark blue */
      color: white;
      padding: 60px 0 30px 0;
      font-family: "Poppins", sans-serif;
    }

    .footer-container {
      width: 90%;
      max-width: 1200px;
      margin: auto;
      display: grid;
      grid-template-columns: repeat(3, minmax(300px, 1fr));
      column-gap: 120px;
      align-items: start;
    }

    .footer-col {
      text-align: left;
      padding: 0;
    }

    .footer-col h3 {
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 1.6rem;
      line-height: 1.4;
      min-height: 48px;
      white-space: nowrap;
    }

    .footer-col ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: block;
    }

    .footer-col ul li {
      margin: 8px 0;
      margin-left: -13px;
      display: block;
    }

    .footer-col ul li a {
      display: block;
      text-decoration: none;
      color: white;
      font-size: 0.95rem;
      transition: 0.3s;
    }

    .footer-col ul li a:hover {
      color: #60a5fa; /* soft blue hover */
    }

    /* === Social Icons === */
    .footer-social {
      width: 90%;
      max-width: 1200px;
      margin: 40px auto 0;
      text-align: left;
    }

    .footer-social h3 {
      font-weight: 600;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .social-icons {
      display: flex;
      gap: 20px;
      margin-top: 10px;
    }

    .social-icons a img {
      width: 26px;
      height: 26px;
      filter: brightness(0) invert(1);
      transition: 0.3s ease;
    }

    .social-icons a:hover img {
      filter: brightness(0) invert(0.6);
      transform: scale(1.1);
    }

    .footer-bottom {
      text-align: center;
      margin-top: 40px;
      font-size: 0.85rem;
      color: #d1d5db;
    }

    .accsmart, .spm {
      color: #ee4625;
    }

    /* WhatsApp specific style */
    .whatsapp-link {
      color: #25D366 !important; /* WhatsApp green */
    }

    .whatsapp-link:hover {
      color: #1da851 !important;
    }

    /* === Responsive === */
    @media (max-width: 768px) {
      footer { text-align: center; }
      .footer-container { grid-template-columns: 1fr; }
      .footer-col { text-align: center; }
      .footer-social { text-align: center; }
      .social-icons { justify-content: center; }
    }
  </style>
</head>

<body>
  <!-- === Footer Section === -->
  <footer>
    <div class="footer-container">

      <div class="footer-col">
        <h3>Tentang <span class="accsmart">ACCSmart:</span> <span class="spm">SPM</span></h3>
        <ul>
          <li><a href="aboutUs.php">Tentang Kami</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Bantuan</h3>
        <ul>
          <li><a href="../components/faq.php">Soalan Lazim (FAQ)</a></li>
          <!-- WhatsApp Link - Replace phone number with yours -->
          <li><a href="https://wa.me/60123456789?text=Halo,%20saya%20ingin%20bertanya%20tentang%20ACCSMART:SPM" 
                 target="_blank" 
                 class="whatsapp-link">Hubungi Kami (WhatsApp)</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h3>Dasar & Polisi</h3>
        <ul>
          <li><a href="../components/TermaPengguna.php">Terma Penggunaan</a></li>
          <li><a href="../components/DasarPrivasi.php">Dasar Privasi</a></li>
        </ul>
      </div>

    </div>

    <div class="footer-social">
      <h3>Ikuti Kami</h3>
      <div class="social-icons">
        <!-- Instagram -->
        <a href="https://www.instagram.com/yourusername" target="_blank">
          <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" alt="Instagram">
        </a>
        <!-- Facebook -->
        <a href="https://www.facebook.com/yourpage" target="_blank">
          <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" alt="Facebook">
        </a>
        <!-- Twitter/X -->
        <a href="https://twitter.com/yourusername" target="_blank">
          <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/x.svg" alt="Twitter">
        </a>
        <!-- WhatsApp Icon (optional extra) -->
        <a href="https://wa.me/60123456789" target="_blank">
          <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp">
        </a>
      </div>
    </div>

    <div class="footer-bottom">
      © 2025 <span class="accsmart">ACCSMART:</span><span class="spm">SPM</span>. Semua Hak Cipta Terpelihara.
    </div>
  </footer>
</body>
</html>