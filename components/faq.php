<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ Accordion</title>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Work Sans', sans-serif;
      background: linear-gradient(135deg, #eef2ff 0%, #f5f8ff 100%);
      margin: 0;
      padding: 0;
    }

    /* Wrapper to center FAQ & create spacing from navs */
    .page-wrapper {
      max-width: 980px;
      margin: 140px auto 120px auto; /* top and bottom spacing */
      padding: 0 20px; /* left/right padding for responsiveness */
    }

    .faq-container {
      background: #fff;
      padding: 20px 25px;
      border-radius: 12px;
      box-shadow: 0px 6px 18px rgba(0,0,0,0.12);
    }

    .faq-header {
      font-size: 35px;
      font-weight: 650;
      color: #001f3f;
      margin-bottom: 20px;
      letter-spacing: 0.5px;
      
    }

    .faq {
      border-top: 1px solid #ddd;
      padding: 12px 0;
    }

    .faq-title {
      display: flex;
      justify-content: space-between;
      cursor: pointer;
      font-size: 17px;
      font-weight: 600;
      align-items: center;
    }

    .faq-title:hover {
  color: #4169E1;
}
    .faq-toggle {
      width: 30px;
      height: 30px;
      transition: transform 0.3s;
    }

    .faq-content {
      padding-top: 8px;
      line-height: 1.4em;
      color: #555;
      font-size: 15px;
      max-height: 0;
  overflow: hidden;
  opacity: 0;
  padding-right: 20px;
    }

    .faq.open .faq-content {
        max-height: 500px; /* big enough for your content */
  opacity: 1;
    }
  </style>
</head>
<body>

  <?php include("../components/Top_nav2.php"); ?>

  <section class="page-wrapper">
    <div class="faq-container">
      <div class="faq-header">✨ FAQs</div>

      <div class="faq">
        <div class="faq-title">
          Siapakah yang boleh menggunakan sistem ini?
          <img class="faq-toggle" src="../img/plus-icon.png" alt="toggle" />
        </div>
        <div class="faq-content">
          Sistem ini boleh digunakan oleh pelajar yang mengambil subjek Akaun, guru yang ingin menggunakan bahan tambahan, serta calon persendirian SPM.
        </div>
      </div>

      <div class="faq">
        <div class="faq-title">
          Bagaimana cara untuk mula menggunakan sistem ini?
          <img class="faq-toggle" src="../img/plus-icon.png" alt="toggle" />
        </div>
        <div class="faq-content">Pelajar boleh mendaftar dan log masuk, kemudian mengikuti modul yang disediakan.
        </div>
      </div>

      <div class="faq">
        <div class="faq-title">
          Adakah terdapat urutan pembelajaran tertentu?
          <img class="faq-toggle" src="../img/plus-icon.png" alt="toggle" />
        </div>
        <div class="faq-content">
          Ya. Pelajar digalakkan memulakan pembelajaran mengikut turutan modul, bermula dengan asas perakaunan sebelum ke topik yang lebih kompleks.
        </div>
      </div>

      <div class="faq">
        <div class="faq-title">
          Mengapa video atau kuiz tidak berfungsi dengan baik?
          <img class="faq-toggle" src="../img/plus-icon.png" alt="toggle" />
        </div>
        <div class="faq-content">
          Pastikan sambungan internet stabil dan browser dikemas kini. Jika masih ada masalah, hubungi sokongan.
        </div>
      </div>

      <div class="faq">
        <div class="faq-title">
          Adakah sistem ini boleh digunakan melalui telefon?
          <img class="faq-toggle" src="../img/plus-icon.png" alt="toggle" />
        </div>
        <div class="faq-content">
          Ya, sistem ini responsif dan boleh diakses melalui telefon pintar, tablet, dan komputer.
        </div>
      </div>

    </div>
  </section>

  <script>
    const faqs = document.querySelectorAll('.faq');

    faqs.forEach(faq => {
      const toggleIcon = faq.querySelector('.faq-toggle');
      faq.addEventListener('click', () => {
        faq.classList.toggle('open');

        if (faq.classList.contains('open')) {
          toggleIcon.src = '../img/minus-icon.png';
        } else {
          toggleIcon.src = '../img/plus-icon.png';
        }
      });
    });
  </script>

  <?php include '../components/Lower_Nav.php'; ?>
</body>
</html>
