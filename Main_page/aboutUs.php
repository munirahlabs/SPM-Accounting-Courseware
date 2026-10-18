<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ Accordion</title>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">

  <style>
.about-us {
  width: 100%;
  display: flex;
  flex-direction: column;
  padding-top: 100px;
}

.about-row {
  display: flex;
  min-height: 100vh;
  align-items: center;
}

.about-row.reverse {
  flex-direction: row-reverse;
}

/* IMAGE full height section */
.about-row img {
  width: 50%;
  height: 100vh;
  object-fit: cover;
  object-position: center;
}

/* TEXT SECTION STYLE */
.about-text {
  width: 50%;
  padding: 10px 7% 100px;
  justify-content: center;
}

.about-text h1 {
  font-family: 'Poppins', sans-serif;
  font-size: 6rem;         /* big elegant title */
  margin-bottom: 35px;
    font-weight: 700;
  color: #555;
  line-height: 1.4;
}

.about-text p {
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  line-height: 1.7;
  color: #333;
  max-width: 480px;   /* narrow paragraph like screenshot */
  margin-bottom: 22px;
}

/* SECOND PARAGRAPH slightly lighter tone */
.about-text p + p {
  color: #555;
}

/* MOBILE RESPONSIVE */
@media (max-width: 900px) {
  .about-row, .about-row.reverse {
    flex-direction: column;
    min-height: auto;
  }
  .about-row img {
    width: 100%;
    height: 50vh;
  }
  .about-text {
    width: 100%;
    padding: 60px 25px;
  }
  .about-text h1 {
    font-size: 3rem;
  }
}
.text-columns {
  display: flex;
  gap: 60px;
  max-width: 700px;
}

.text-columns p {
  flex: 1;
  font-family: "Work Sans", sans-serif;
  font-size: 18px;
  line-height: 1.7;
  color: #333;
}

 </style>
</head>
<body>
    <?php include("../components/Top_nav2.php"); ?>

    <section class="about-us">

  <!-- Row 1 -->
  <div class="about-row">
    <img src="../img/aboutus3.png" alt="">
    <div class="about-text">
<h1>Tentang Kami</h1>
<div class="text-columns">
  <p>
    AccSmart: SPM dibangunkan bagi membantu pelajar Tingkatan 4 dan 5
    memahami subjek Perakaunan SPM dengan lebih jelas, tersusun dan
    berkesan melalui pembelajaran digital.
  </p>

  <p>
    Platform ini direka khusus berdasarkan silibus KSSM dan pendekatan
    pengajaran guru berpengalaman, dengan penekanan kepada kefahaman
    konsep dan pembelajaran kendiri.
  </p>
</div>
</div>
  </div>

  <!-- Row 2 -->
  <div class="about-row reverse">
    <img src="../img/aboutus4.png"" alt="">
    <div class="about-text">
      <h1>Proses Pembelajaran</h1>
<div class="text-columns">
  <p>
    AccSmart: SPM menggunakan gabungan video pengajaran, nota interaktif,
    latihan berperingkat dan kuiz bagi menyokong gaya pembelajaran
    pelajar yang berbeza.
  </p>

  <p>
    Setiap modul dibangunkan berdasarkan teori Pembelajaran Kognitif
    dan Konstruktivisme untuk mengurangkan beban kognitif serta
    meningkatkan pemahaman jangka panjang.
  </p>
</div>

    </div>
  </div>

  <!-- Row 3 -->
  <div class="about-row">
    <img src="../img/aboutus5.png"" alt="">
    <div class="about-text">
<h1>Proses Pembelajaran</h1>
<div class="text-columns">
  <p>
    AccSmart: SPM menggunakan gabungan video pengajaran, nota interaktif,
    latihan berperingkat dan kuiz bagi menyokong gaya pembelajaran
    pelajar yang berbeza.
  </p>

  <p>
    Setiap modul dibangunkan berdasarkan teori Pembelajaran Kognitif
    dan Konstruktivisme untuk mengurangkan beban kognitif serta
    meningkatkan pemahaman jangka panjang.
  </p>
</div>

    </div>
  </div>

</section>

<?php include '../components/Lower_Nav.php'; ?>

</body>
</html>