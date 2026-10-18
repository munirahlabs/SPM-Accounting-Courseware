<style>
/* Sidebar */
.sidebar {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  width: 400px;
  padding: 16px 22px;
  background: #fafafa;
  border-right: 2px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  transition: transform 0.35s ease;
  transform: translateX(0);
  overflow: hidden;
  height: calc(100vh - 62px);
  position: fixed;
  left: 0;
  top: 62px;
  z-index: 999;
}

.sidebar.collapsed {
  transform: translateX(-100%);
  width: 0 !important;
  padding: 0 !important;
}

.sidebar-header {
  display: flex;
  flex-direction: column;
  padding: 18px 20px;
  border-bottom: 2px solid #e5e7eb;
  position: relative;
}

.header-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.sidebar-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111827;
}

.back-link {
  font-size: 0.8rem;
  color: #4b5563;
  text-decoration: none;
  margin-top: 6px;
  transition: color 0.2s;
}

.back-link:hover {
  color: #1e40af;
  text-decoration: underline;
}

.toggle-btn {
  background: none;
  border: none;
  font-size: 1.3rem;
  cursor: pointer;
  color: #4b5563;
  transition: color 0.2s;
}

.toggle-btn:hover {
  color: #2563eb;
}

.sidebar-content {
  overflow-y: auto;
  flex: 1;
  padding: 10px 15px 20px;
}

.module-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  border-radius: 6px;
  padding: 12px 10px;
  margin: 8px 0;
  transition: background 0.2s, border-color 0.2s;
  padding-right: 15px;
}

.module-header:hover {
  background: #f3f4f6;
}

.module-title {
  font-weight: 600;
  font-size: 1rem;
  color: #1f2937;
}

.arrow {
    font-size: 0.9rem;
    color: #6b7280;
    transition: transform 0.3s ease;
}

.subtopic-list {
    list-style: none;
    padding-left: 10px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    display: block;
    margin-top: 4px;
}

.subtopic-list.open {
  max-height: 1000px;
}

.module.open .arrow {
  transform: rotate(90deg);
}


.subtopic-item a {
  text-decoration: none;
  display: flex;
  background: #f8fafc;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 10px 12px;
  font-weight: 500;
  color: #4b5563;
  font-size: 0.95rem;
  transition: all 0.25s;
  align-items: center;
  gap: 12px;
}

.subtopic-item img {
  width: 34px !important;
  height: 34px !important;
  margin-right: 10px;
  object-fit: contain;
  opacity: 1;
}

.subtopic-item a:hover {
  background: #eef6ff;
  color: #2563eb;
  border-color: #93c5fd;
}

/* Floating toggle (when sidebar hidden) */
.floating-toggle {
  position: fixed;
  top: 57%;
  left: 0;
  transform: translateY(-50%);
  background: #ffffff;
  border: 2px solid #e5e7eb;
  border-left: none;
  border-radius: 0 12px 12px 0;
  width: 30px;
  height: 60px;
  cursor: pointer;
  display: none;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  color: #4b5563;
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
  transition: background 0.2s, color 0.2s;
  z-index: 999;
}

.floating-toggle.show {
  display: flex;
}

.floating-toggle:hover {
  background: #f3f4f6;
  color: #111827;
}

/* ✅ NEW: Subtopic Item - Grey Background Highlight */
.subtopic-item {
  margin: 6px 0;
  border-radius: 10px;
  transition: background 0.25s;
}

/* ✅ NEW: Active Item - Grey Background */
.subtopic-item.active-item {
  background: #e5e7eb !important;
  padding: 2px;
  border-radius: 10px;
}

.subtopic-item a.active {
  background: #dbeafe !important;
  color: #1e40af !important;
  border-color: #3b82f6 !important;
  font-weight: 600;
  box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
}

.subtopic-item a.active:hover {
  background: #bfdbfe !important;
  color: #1e3a8a !important;
}


</style>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="header-top">
      <span class="sidebar-title">Modul Tingkatan 4</span>
      <button class="toggle-btn" id="toggleSidebar">☰</button>
    </div>
    <a href="../tingkatan4/CourseOverviewT4.php" class="back-link">&lt; Kembali ke Pengenalan Kursus</a>
  </div>

  <div class="sidebar-content">
    <div class="module">
      <div class="module-header">
        <span class="module-title">Bab 1: Pengenalan Kepada Perakaunan</span>
        <span class="arrow">▶</span>
      </div>
      <ul class="subtopic-list">
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1Nota.php"> <img src="../img/nota.png" alt="Icon A">  Nota Bab 1</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub1.php"> <img src="../img/video.png" alt="Icon A"> Video: Pengenalan Asas Perakaunan</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub1Game.php"> <img src="../img/gamet4.png" alt="Icon A">  Permainan: Pengenalan Asas Perakaunan</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub2.php"> <img src="../img/video.png" alt="Icon A"> Video: Subbidang dan Badan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub2Game.php"> <img src="../img/gamet4.png" alt="Icon A">  Permainan: Subbidang dan Badan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub3.php"> <img src="../img/video.png" alt="Icon A"> Video: Andaian, Prinsip dan Batasan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1sub3Game.php"> <img src="../img/gameT4.png" alt="Icon A"> Permainan: Andaian, Prinsip dan Batasan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul1MCQ.php"> <img src="../img/summative.png" alt="Icon A">  Ujian Bab 1 </a> </li>
      </ul>
    </div>

    <div class="module">
      <div class="module-header">
        <span class="module-title">Bab 2: Klasifikasi Akaun dan Persamaan Perakaunan</span>
        <span class="arrow">▶</span>
      </div>
      <ul class="subtopic-list">
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2Nota.php"> <img src="../img/nota.png" alt="Icon A">  Nota Bab 2</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2sub1.php"> <img src="../img/video.png" alt="Icon A"> Video: Pengenalan kepada Klasifikasi dan Persamaan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2sub1.1.php"> <img src="../img/video.png" alt="Icon A"> Video: Komponen Klasifikasi Akaun </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2sub1Game.php"> <img src="../img/gameT4.png" alt="Icon A">  Permainan: Komponen Klasifikasi Akaun</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2sub2.php"> <img src="../img/video.png" alt="Icon A"> Video: Persamaan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2sub2Game.php"> <img src="../img/gamet4.png" alt="Icon A">  Permainan: Persamaan Perakaunan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul2MCQ.php"> <img src="../img/summative.png" alt="Icon A">  Ujian Bab 2 </a> </li>
      </ul>
    </div>

    <div class="module">
      <div class="module-header">
        <span class="module-title">Bab 7: Penyata Kewangan Milikan Tunggal Tanpa Pelarasan</span>
        <span class="arrow">▶</span>
      </div>
      <ul class="subtopic-list">
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7Nota.php"> <img src="../img/nota.png" alt="Icon A">  Nota Bab 7</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7sub1.php"> <img src="../img/video.png" alt="Icon A"> Video: Akaun Perdagangan</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7sub2.php"> <img src="../img/video.png" alt="Icon A"> Video: Akaun Untung dan Rugi </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7sub1&2Game.php"> <img src="../img/gameT4.png" alt="Icon A">  Permainan : Penyata Pendapatan</a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7sub3.php"> <img src="../img/video.png" alt="Icon A"> Video: Penyata Kewangan </a> </li>
        <li class="subtopic-item"> <a href="../Tingkatan4/Modul7sub3Game.php"> <img src="../img/gameT4.png" alt="Icon A"> Permainan: Penyata Kewangan </a> </li>
      </ul>
    </div>
  </div>
</aside>

<button class="floating-toggle" id="floatingToggle">▶</button>