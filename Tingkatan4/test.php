<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">
  
  <title>ACCsmart: SPM Accounting Game</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: #f8faff;
      color: #1f2937;
      overflow: hidden;
    }

    .layout {
      display: flex;
      height: calc(100vh - 64px);
      margin-top: 64px;
      transition: all 0.3s ease;
    }

    .main {
  flex: 1;
  display: flex;
  flex-direction: column;
  transition: all 0.3s ease;
  margin-left: 400px;
  width: calc(100% - 400px);
  transition: margin-left 0.45s ease, width 0.45s ease;
  overflow: auto; 
  height: 100%;
    }

    .scrollable-content {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
}

    body.sidebar-collapsed .main {
      margin-left: 0 !important;
      width: 100% !important;
    }

    /* ---------- Start Screen ---------- */
    #start-screen {
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 30px 40px;
      box-sizing: border-box;
      position: relative;
      background: url('../img/wall100.png') center center/contain no-repeat;
      color: white;
      min-height: 100%;
      align-items: center;
    }

    .intro-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .intro-content {
      z-index: 2;
      padding: 20px 40px;
    }

    .intro-content h1 {
      font-size: 1.6rem;
      margin-top: 12rem;
      font-weight: 800;
      color: black;
    }

    .button-group {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 20px;
      align-items: center;
    }

    .start-btn {
      background-color: white;
      border: 2px solid black;
      color: black;
      padding: 8px 30px;
      border-radius: 20px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .start-btn:hover {
      background-color: #68ede7;
      color: #fff;
      transform: scale(1.05);
    }

    /* ---------- Instruction Modal ---------- */
    #instruction-modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 999;
    }

    .modal-overlay {
      position: absolute;
      inset: 0;
      background: transparent;
    }

    .modal-content {
      background: #fff;
      color: #111;
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      max-width: 480px;
      width: 90%;
      z-index: 2;
      text-align: center;
      position: relative;
    }

    #instruction-modal.show {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ---------- Game Screen ---------- */
    #game-screen {
      display: none;
      min-height: 100vh;
      background: url('../img/wall4.png') center center/contain no-repeat;;
      padding: 40px 20px;
      position: relative;
      font-family: 'Poppins', sans-serif;
      color: #1f2937;
    }

    /* GAME TOP CONTROLS */
    .game-top-controls {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 15px;
      max-width: 1100px;
      margin-left: auto;
      margin-right: auto;
    }

    .control-btn {
      background: linear-gradient(135deg, #ff7f50, #ff6347);
      color: white;
      border: none;
      padding: 10px 22px;
      border-radius: 25px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(255, 99, 71, 0.3);
    }

    .control-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 99, 71, 0.4);
    }

    .control-btn.home {
      background: linear-gradient(135deg, #3498db, #2980b9);
      box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
    }

    .control-btn.home:hover {
      box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
    }

    /* HEADER */
    .game-header {
      background: rgba(255, 255, 255, 0.92);
      border-radius: 18px;
      padding: 20px 30px;
      text-align: center;
      margin-bottom: 25px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      max-width: 1100px;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 25px;
        width: 100%;
     box-sizing: border-box;
    }

    .game-header h2 {
      color: #3643d1;
      font-size: 1.9rem;
      font-weight: 700;
      margin-bottom: 10px;
      letter-spacing: 0.5px;
    }

    .game-stats {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .stat-box {
      background: linear-gradient(135deg, #3643d1, #5a67d8);
      color: #fff;
      padding: 10px 22px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 3px 8px rgba(54, 67, 209, 0.3);
    }

    /* MAIN CONTAINER */
    .game-container {
      max-width: 1100px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    /* STATION CARD */
    .station-card {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 20px;
      padding: 25px 35px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .station-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .station-card h3 {
      color: #3643d1;
      font-size: 1.5rem;
      margin-bottom: 8px;
      font-weight: 700;
    }

    .station-card p {
      color: #6b7280;
      margin-bottom: 18px;
      font-size: 1rem;
    }

    /* PROGRESS BAR */
    .progress-container {
      width: 100%;
      background-color: #e0e0e0;
      border-radius: 10px;
      margin-bottom: 20px;
      height: 12px;
      overflow: hidden;
    }


    /* QUESTION AREA */
    .question {
      font-size: 1.3rem;
      margin-bottom: 25px;
      font-weight: 600;
      color: #2c3e50;
      text-align: center;
    }

    /* ANSWERS GRID */
.answers-grid {
  display: grid;
  grid-template-columns: repeat(2, auto); /* columns fit content, not full width */
  row-gap: 18px;        /* vertical spacing between rows */
  column-gap: 10px;     /* small horizontal spacing */
  justify-content: center; /* centers the whole grid horizontally */
  margin-bottom: 30px;  /* space before next question button */
}


    .answer-card {
          width: 300px; /* slightly bigger than 340px image for padding */
  height: 300px; /* adjust height to fit image + text */
      background: linear-gradient(145deg, #ffffff, #f8f9fa);
      border: 3px solid #e9ecef;
      border-radius: 15px;
      padding: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      min-height: 180px;
    }

    .answer-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(54, 67, 209, 0.2);
      border-color: #3643d1;
    }

    .answer-card img {
      width: 280px;
      height: 200px;
      object-fit: contain;
      margin-bottom: 15px;
      border-radius: 12px;
      background: #f0f4ff;
      padding: 10px;
    }

    .answer-text {
      font-size: 0.95rem;
      font-weight: 500;
      line-height: 1.5;
      color: #2c3e50;
    }

    .answer-card.correct {
      background: linear-gradient(145deg, #dcfce7, #bbf7d0);
      border-color: #22c55e;
      animation: correctPulse 0.5s ease;
    }

    .answer-card.incorrect {
      background: linear-gradient(145deg, #fee2e2, #fecaca);
      border-color: #ef4444;
      animation: shake 0.4s ease;
    }

    @keyframes correctPulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-8px); }
      75% { transform: translateX(8px); }
    }

    /* FEEDBACK AREA */
    .feedback {
      margin-top: 20px;
      padding: 18px 22px;
      border-radius: 12px;
      font-weight: 500;
      display: none;
      animation: fadeIn 0.3s ease;
      text-align: center;
    }

    .feedback.correct {
      background: #dcfce7;
      border-left: 5px solid #22c55e;
      color: #166534;
    }

    .feedback.incorrect {
      background: #fee2e2;
      border-left: 5px solid #ef4444;
      color: #991b1b;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* CONTROLS */
    .controls {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .next-btn {
      background: linear-gradient(135deg, #3643d1, #5a67d8);
      color: white;
      border: none;
      padding: 12px 35px;
      border-radius: 25px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(54, 67, 209, 0.3);
    }

    .next-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(54, 67, 209, 0.4);
    }

    /* RESULT SCREEN */
    #result-screen {
      display: none;
      position: relative;
      min-height: 100vh;
      background: url('../img/wall4.png') center center/contain no-repeat;;
      overflow: hidden;
    }

    #result-screen.show {
      display: flex;
      justify-content: center;
      align-items: center;
    }


    .result-card {
      position: relative;
      z-index: 2;
      background: linear-gradient(145deg, #ffffff, #f0f4ff);
      color: #1f2937;
      border-radius: 25px;
      padding: 50px 40px;
      max-width: 500px;
      width: 90%;
      text-align: center;
      box-shadow: 0 12px 30px rgba(0,0,0,0.25);
      animation: slideIn 0.5s ease;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .result-card .trophy {
      font-size: 5rem;
    }

    .result-card h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #3643d1;
    }

    .result-card p {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    .result-card .final-score {
      font-size: 3rem;
      font-weight: 800;
      color: #3643d1;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .answers-grid {
        grid-template-columns: 1fr;
      }

      .station-card {
        padding: 20px;
      }

      .game-header h2 {
        font-size: 1.5rem;
      }

      .intro-content h1 {
        font-size: 1.8rem;
      }
    }

    /* ---------- INSTRUCTION BOX ---------- */
.instruction-box {
  background: #f0f4ff;
  border: 2px solid #d1d9ff;
  border-radius: 12px;
  padding: 15px 20px;
  margin: 15px 0 25px 0;
  position: relative;
}

.instruction-label {
  font-weight: 700;
  color: #3643d1;
  font-size: 1.1rem;
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.instruction-label::before {
  content: "📝";
  font-size: 1.2rem;
}

.instruction-content {
  color: #4b5563;
  font-size: 1rem;
  line-height: 1.6;
  padding-left: 10px;
}

/* ---------- QUESTION LABEL & BOX ---------- */
.question-label {
  font-weight: 700;
  color: #3643d1;
  font-size: 1.2rem;
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.question-label::before {
  content: "❓";
  font-size: 1.3rem;
}

.question-box {
  background: #ffffff;
  border: 2px solid #e5e7eb;
  border-radius: 15px;
  padding: 25px 30px;
  margin: 10px 0 25px 0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  position: relative;
  overflow: hidden;
}

.question-box::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(135deg, #3643d1, #5a67d8);
}

.question-content {
  font-size: 1.4rem;
  font-weight: 700;
  color: #1f2937;
  line-height: 1.4;
  text-align: center;
}

/* Station 1 specific styling */
.station-card h3 {
  color: #3643d1;
  font-size: 1.5rem;
  margin-bottom: 8px;
  font-weight: 700;
}

.station-card > p {
  color: #6b7280;
  margin-bottom: 18px;
  font-size: 1rem;
  font-weight: 500;
}
  </style>
</head>
<body>
<?php include '../components/Top_nav.php'; ?>

<div class="layout">
  <?php include '../components/SidebarNav_T4.php'; ?>

  <main class="main" id="main">
    <!-- START SCREEN -->
    <section id="start-screen">
      <div class="intro-overlay">
        <div class="intro-content">
<div class="bottombar" style="background: transparent; margin-top: 210px; margin-right: 30px;">
            <div class="c4">
              <button class="btn primary" onclick="startGame()">
                <div class="btntext">MULAKAN</div>
              </button>
            </div>
            <div class="c4">
              <button class="btn secondary" onclick="showInstructions()">
                <div class="btntext">ARAHAN</div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- INSTRUCTION MODAL -->
    <div id="instruction-modal">
      <div class="modal-overlay" onclick="closeInstructions()"></div>
      <div class="modal-content">
        <h2>📖 Arahan Permainan</h2>
        <p>Selamat datang ke <b>ACCsmart: SPM Quiz</b>! 🎓</p>
        <ul style="text-align:left; line-height:1.8; display: block; padding-left: 20px;">
          <li>👉 Pilih jawapan yang betul dari pilihan yang diberikan</li>
          <li>✅ Anda akan dapat maklum balas selepas setiap soalan</li>
          <li>⭐ Kumpul skor sebanyak mungkin untuk lulus quiz</li>
          <li>🎯 Objektif: Jawab semua soalan dengan betul!</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()" style="margin-top: 20px;">Tutup</button>
      </div>
    </div>

    <!-- GAME SCREEN -->
    <section id="game-screen">
      <div class="game-container">
        <div class="game-header">
         <div class="game-top-controls">
        <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
        <button class="control-btn home" onclick="backToMenu()">🏠 Home</button>
      </div>
          <h2>🎯 Accountant Quest: Quiz Edition</h2>
          <div class="game-stats">
            <div class="stat-box">📊 Station: <span id="currentStation">1</span>/2</div>
            <div class="stat-box">❓ Soalan: <span id="currentQuestion">1</span>/<span id="totalQuestions">3</span></div>
            <div class="stat-box">⭐ Skor: <span id="score">0</span></div>
          </div>
        </div>

        <div id="stationContainer"></div>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Quiz Selesai!</h2>
        <p id="resultText">--</p>
        <div class="final-score" id="finalScore">0</div>
        <div class="button-group">
          <button class="start-btn" onclick="tryAgain()">🔁 Cuba Lagi</button>
          <button class="start-btn" onclick="backToMenu()">🏠 Menu Utama</button>
        </div>
      </div>
    </section>
  </main>

</div>
<button class="floating-toggle" id="floatingToggle">☰</button>

<script src="../js/navigation.js"></script>

<script>

// Quiz Data - Organized by Stations
const stations = [
  {
    id: 1,
    title: '📂 Station 1: Sub-Bidang Perakaunan',
    description: 'Nyatakan subbidang perakaunan berkaitan dengan penyataan yang diberi',
    arahan: 'Klik pada jawapan yang betul berdasarkan penyataan yang diberikan.', // Arahan untuk station 1
    questions: [
      {
        question: "Menyediakan pelaporan maklumat perakaunan dalam bentuk Penyata Kewangan",
        answers: [
          {
            text: "Perakaunan Kewangan",
            correct: true,
            image: "../img/perakaunanKewangan.jpg"
          },
          {
            text: "Perakaunan Pengurusan",
            correct: false,
            image: "../img/perakaunanPengurusan.jpg"
          },
          {
            text: "Percukaian",
            correct: false,
            image: "../img/percukaian.jpg"
          },
          {
            text: "Pengauditan",
            correct: false,
            image: "../img/pengauditan.jpg"
          }
        ],
        explanation: "Perakaunan Kewangan melibatkan penyediaan laporan kewangan seperti Penyata Kedudukan Kewangan, Penyata Pendapatan, dan Penyata Aliran Tunai untuk kegunaan pihak luar seperti pelabur, pemiutang, dan agensi kerajaan."
      },
      {
        question: "Merancang hal-hal percukaian dan menyediakan penyata cukai bagi pihak syarikat",
        answers: [
          {
            text: "Perakaunan Pengurusan",
            correct: false,
            image: "../img/perakaunanPengurusan.jpg"
          },
          {
            text: "Percukaian",
            correct: true,
            image: "../img/percukaian.jpg"
          },
          {
            text: "Pengauditan",
            correct: false,
            image: "../img/pengauditan.jpg"
          },
          {
            text: "Perakaunan Kewangan",
            correct: false,
            image: "../img/perakaunanKewangan.jpg"
          }
        ],
        explanation: "Percukaian merangkumi perancangan cukai, pematuhan undang-undang cukai, dan penyediaan penyata cukai bagi individu atau syarikat, selaras dengan peraturan LHDN."
      },
      {
        question: "Menyediakan maklumat perakaunan untuk pengguna dalaman",
        answers: [
          {
            text: "Pengauditan",
            correct: false,
            image: "../img/pengauditan.jpg"
          },
          {
            text: "Perakaunan Pengurusan",
            correct: true,
            image: "../img/perakaunanPengurusan.jpg"
          },
          {
            text: "Percukaian",
            correct: false,
            image: "../img/percukaian.jpg"
          },
          {
            text: "Perakaunan Kewangan",
            correct: false,
            image: "../img/perakaunanKewangan.jpg"
          }
        ],
        explanation: "Perakaunan Pengurusan menyediakan maklumat terperinci seperti bajet, analisis kos, dan ramalan kewangan untuk membantu pihak pengurusan membuat keputusan, merancang, dan mengawal operasi."
      },
      {
        question: "Meliputi kerja memeriksa dokumen perniagaan dan rekod kewangan untuk mengesahkan rekod maklumat perakaunan adalah betul dan tepat",
        answers: [
          {
            text: "Percukaian",
            correct: false,
            image: "../img/percukaian.jpg"
          },
          {
            text: "Pengauditan",
            correct: true,
            image: "../img/pengauditan.jpg"
          },
          {
            text: "Perakaunan Pengurusan",
            correct: false,
            image: "../img/perakaunanPengurusan.jpg"
          },
          {
            text: "Perakaunan Kewangan",
            correct: false,
            image: "../img/perakaunanKewangan.jpg"
          }
        ],
        explanation: "Pengauditan melibatkan pemeriksaan sistematik terhadap rekod kewangan dan dokumen perniagaan untuk memastikan ia tepat, lengkap, dan mematuhi piawaian perakaunan yang ditetapkan."
      },
    ]
  },
  {
    id: 2,
    title: '🏢 Station 2: Badan Perakaunan',
    description: 'Kenali badan-badan perakaunan profesional',
    arahan: 'Klik pada jawapan yang betul berdasarkan ciri-ciri badan perakaunan yang diberikan.', // Arahan untuk station 2
    questions: [
      {
        question: "a) Menentukan kelayakan seseorang untuk menjadi ahli<br>b) Menawarkan latihan, pelajaran dan peperiksaan kepada seseorang yang ingin mencuburi profesion perakaunan",
        answers: [
          {
            text: "Lembaga Piawaian Perakaunan Malaysia (MASB)",
            correct: false,
            image: "../img/masb.jpg"
          },
          {
            text: "Institut Akauntan Malaysia (MIA)",
            correct: true,
            image: "../img/mia.png"
          },
          {
            text: "Association of Chartered Certified Accountants (ACCA)",
            correct: false,
            image: "../img/acca.png"
          },
          {
            text: "Certified Public Accountant Malaysia (CPA)",
            correct: false,
            image: "../img/cpa.png"
          }
        ],
        explanation: "MIA berfungsi mengawal selia profesion perakaunan di Malaysia. Ia menentukan syarat keahlian dan menyediakan latihan serta peperiksaan untuk bakal akauntan."
      },
      {
        question: "a) Memberi khidmat sokongan kepada ahli dan pelajarnya sepanjang kerjaya dalam bidang perakaunan mereka<br>b) Memberi pendedahan tentang peraturan dan undang-undang yang berkaitan dengan amalan perakaunan dan etika dalam perakaunan",
        answers: [
          {
            text: "Institut Akauntan Malaysia (MIA)",
            correct: false,
            image: "../img/mia.png"
          },
          {
            text: "Certified Public Accountant Malaysia (CPA)",
            correct: false,
            image: "../img/cpa.png"
          },
          {
            text: "Association of Chartered Certified Accountants (ACCA)",
            correct: true,
            image: "../img/acca.png"
          },
          {
            text: "Lembaga Piawaian Perakaunan Malaysia (MASB)",
            correct: false,
            image: "../img/masb.jpg"
          }
        ],
        explanation: "ACCA memberi sokongan profesional kepada ahli dan pelajarnya sepanjang kerjaya. Ia juga menekankan etika, undang-undang, dan amalan perakaunan."
      },
      {
        question: "a) Melahirkan akauntan profesional yang mahir dalam bidang pengurusan dan pentadbiran perniagaan<br>b) Mengkaji dan menangani perubahan semasa dalam perniagaan",
        answers: [
          {
            text: "Lembaga Piawaian Perakaunan Malaysia (MASB)",
            correct: false,
            image: "../img/masb.jpg"
          },
          {
            text: "Certified Public Accountant Malaysia (CPA)",
            correct: false,
            image: "../img/cpa.png"
          },
          {
            text: "Chartered Institute of Management Accountants (CIMA)",
            correct: true,
            image: "../img/cima.png"
          },
          {
            text: "Association of Chartered Certified Accountants (ACCA)",
            correct: false,
            image: "../img/acca.png"
          }
        ],
        explanation: "CIMA melahirkan akauntan pengurusan yang mahir dalam perniagaan dan pentadbiran. Ia membantu ahli menilai perubahan dalam perniagaan untuk membuat keputusan pengurusan yang bijak."
      },
      {
        question: "a) Menggubal dan menerbitkan piawaian perakaunan<br>b) Bertindak sebagai penasihat kepada akauntan",
        answers: [
          {
            text: "Lembaga Piawaian Perakaunan Malaysia (MASB)",
            correct: true,
            image: "../img/masb.jpg"
          },
          {
            text: "Association of Chartered Certified Accountants (ACCA)",
            correct: false,
            image: "../img/acca.png"
          },
          {
            text: "Certified Public Accountant Malaysia (CPA)",
            correct: false,
            image: "../img/cpa.png"
          },
          {
            text: "Chartered Institute of Management Accountants (CIMA)",
            correct: false,
            image: "../img/cima.png"
          }
        ],
        explanation: "MASB bertanggungjawab menggubal dan menerbitkan piawaian perakaunan di Malaysia. Piawaian ini digunakan oleh semua syarikat supaya laporan kewangan menjadi seragam dan boleh dipercayai."
      },
      {
        question: "a)Memajukan profesion perakaunan melalui latihan dan peperiksaan<br>b) Melatih dan melahirkan akauntan bertauliah",
        answers: [
          {
            text: "Certified Public Accountant Malaysia (CPA)",
            correct: true,
            image: "../img/cpa.png"
          },
          {
            text: "Institut Akauntan Malaysia (MIA)",
            correct: false,
            image: "../img/mia.png"
          },
          {
            text: "Lembaga Piawaian Perakaunan Malaysia (MASB)",
            correct: false,
            image: "../img/masb.jpg"
          },
          {
            text: "Chartered Institute of Management Accountants (CIMA)",
            correct: false,
            image: "../img/cima.png"
          }
        ],
        explanation: "CIMA (Chartered Institute of Management Accountants) memajukan profesion perakaunan pengurusan dengan menyediakan latihan, peperiksaan, dan pensijilan kepada bakal akauntan bertauliah."
      }
    ]
  }
];

// Game State
let currentStationIndex = 0;
let currentQuestionIndex = 0;
let score = 0;
let answered = false;
let totalQuestionsCount = 0;
let currentQuestionNumber = 0;

// Calculate total questions
stations.forEach(station => {
  totalQuestionsCount += station.questions.length;
});

// DOM Elements
const startScreen = document.getElementById('start-screen');
const instrScreen = document.getElementById('instruction-modal');
const gameScreen = document.getElementById('game-screen');
const resultScreen = document.getElementById('result-screen');
const stationContainer = document.getElementById('stationContainer');
const currentStationEl = document.getElementById('currentStation');
const currentQuestionEl = document.getElementById('currentQuestion');
const totalQuestionsEl = document.getElementById('totalQuestions');
const scoreEl = document.getElementById('score');
const resultText = document.getElementById('resultText');
const finalScore = document.getElementById('finalScore');

// Initialize
totalQuestionsEl.textContent = stations[0].questions.length;

// Sound Effects
const correctSound = new Audio("../audio/correct_answer_sound.mp3");
const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
const excellentSound = new Audio("../audio/congrats_sound.mp3");
const poorSound = new Audio("../audio/fail_sound.mp3");

// Create simple beep sounds using Web Audio API
function createBeepSound(frequency, duration, type) {
  const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
  const oscillator = audioCtx.createOscillator();
  const gainNode = audioCtx.createGain();
  
  oscillator.connect(gainNode);
  gainNode.connect(audioCtx.destination);
  
  oscillator.frequency.value = frequency;
  oscillator.type = type;
  
  gainNode.gain.setValueAtTime(0.3, audioCtx.currentTime);
  gainNode.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + duration);
  
  oscillator.start(audioCtx.currentTime);
  oscillator.stop(audioCtx.currentTime + duration);
}

// Navigation Functions
function startGame() {
  startScreen.style.display = 'none';
  gameScreen.style.display = 'block';
  currentStationIndex = 0;
  currentQuestionIndex = 0;
  currentQuestionNumber = 0; // global if you use it
  score = 0;
  updateScore();        // ensure UI reflects initial values
  loadStation();        // loads station 1 and question 1
}

function showInstructions() {
  instrScreen.classList.add('show');
}

function closeInstructions() {
  instrScreen.classList.remove('show');
}

function resetGame() {
  if (confirm('Reset skor dan mula semula dari awal?')) {
    currentStationIndex = 0;
    currentQuestionIndex = 0;
    currentQuestionNumber = 0;
    score = 0;
    updateScore();
    loadStation();
  }
}

function tryAgain() {
  resultScreen.classList.remove('show');
  startGame();
}

function backToMenu() {
  resultScreen.classList.remove('show');
  gameScreen.style.display = 'none';
  startScreen.style.display = 'flex';
}

// Score Management
function updateScore() {
  scoreEl.textContent = score;
  currentStationEl.textContent = currentStationIndex + 1;

  // Make sure currentQuestionIndex is valid before showing
  currentQuestionEl.textContent = (currentQuestionIndex >= 0 ? currentQuestionIndex + 1 : 1);

  // Update total questions for the current station (guard for index)
  const station = stations[currentStationIndex] || stations[0];
  totalQuestionsEl.textContent = station.questions.length;
}

function loadStation() {
  const station = stations[currentStationIndex];
  stationContainer.innerHTML = '';

  const wrapper = document.createElement('div');
  wrapper.className = 'station-card';

  // Station Header dengan arahan di bawah
  wrapper.innerHTML = `
    <h3>${station.title}</h3>
    <p>${station.description}</p>
    
    <!-- Arahan dalam kotak di bawah station description -->
    <div class="instruction-box">
      <div class="instruction-label">Arahan:</div>
      <div class="instruction-content">${station.arahan}</div>
    </div>
  `;

  // Question Container
  const questionDiv = document.createElement('div');
  questionDiv.id = 'questionContainer';
  wrapper.appendChild(questionDiv);

  // Feedback Area
  const feedbackDiv = document.createElement('div');
  feedbackDiv.className = 'feedback';
  feedbackDiv.id = 'feedback';
  wrapper.appendChild(feedbackDiv);

  // Controls
  const controls = document.createElement('div');
  controls.className = 'controls';
  const nextBtn = document.createElement('button');
  nextBtn.className = 'next-btn';
  nextBtn.id = 'next-btn';
  nextBtn.textContent = '✅ Soalan Berikutnya';
  nextBtn.onclick = nextQuestion;
  controls.appendChild(nextBtn);
  wrapper.appendChild(controls);

  stationContainer.appendChild(wrapper);

  // Ensure per-station UI counters show correct totals
  totalQuestionsEl.textContent = station.questions.length;
  currentStationEl.textContent = currentStationIndex + 1;
  currentQuestionIndex = currentQuestionIndex || 0;
  currentQuestionEl.textContent = currentQuestionIndex + 1;

  loadQuestion();
  updateProgressBar && updateProgressBar();
}
// Load Question
function loadQuestion() {
  const station = stations[currentStationIndex];
  const question = station.questions[currentQuestionIndex];
  const questionContainer = document.getElementById('questionContainer');

  answered = false;

  // Shuffle answers
  const shuffledAnswers = shuffleArray([...question.answers]);

  questionContainer.innerHTML = `
    <!-- Label SOALAN: seperti dalam gambar -->
    <div class="question-label">SOALAN:</div>
    
    <!-- Soalan content dalam kotak -->
    <div class="question-box">
      <div class="question-content">${question.question}</div>
    </div>
    
    <div class="answers-grid" id="answers-grid"></div>
  `;

  const answersGrid = document.getElementById('answers-grid');

  shuffledAnswers.forEach(answer => {
    const card = document.createElement('div');
    card.className = 'answer-card';
    
    // Image
    const img = document.createElement('img');
    img.src = answer.image;
    card.appendChild(img);
    
    // Text
    const text = document.createElement('div');
    text.className = 'answer-text';
    text.textContent = answer.text;
    card.appendChild(text);
    
    // Click event
    card.addEventListener('click', () => {
      selectAnswer(card, answer.correct, question.explanation, shuffledAnswers);
    });

    answersGrid.appendChild(card);
  });

  // Hide feedback but keep next button visible
  document.getElementById('feedback').style.display = 'none';
  document.getElementById('next-btn').style.display = 'block';

  // Enable all cards
  const allCards = answersGrid.querySelectorAll('.answer-card');
  allCards.forEach(c => {
    c.style.pointerEvents = 'auto';
    c.classList.remove('correct', 'incorrect');
  });

  updateScore();
}

// Select Answer
function selectAnswer(card, isCorrect, explanation, allAnswers) {
  if (answered) return;
  answered = true;

  const feedbackEl = document.getElementById('feedback');
  const answersGrid = document.getElementById('answers-grid');

  if (isCorrect) {
    card.classList.add('correct');
    feedbackEl.innerHTML = `<strong>✅ Betul!</strong><br>${explanation}`;
    feedbackEl.className = 'feedback correct';
    feedbackEl.style.display = 'block';
    score++;
    updateScore();
    correctSound.play();
  } else {
    card.classList.add('incorrect');
    const correctAnswer = allAnswers.find(a => a.correct);
    feedbackEl.innerHTML = `<strong>❌ Salah!</strong><br>Jawapan yang betul: "${correctAnswer.text}"<br><br>${explanation}`;
    feedbackEl.className = 'feedback incorrect';
    feedbackEl.style.display = 'block';
    incorrectSound.play();
  }

  // Highlight correct answer
  const allCards = answersGrid.querySelectorAll('.answer-card');
  allCards.forEach((c, index) => {
    if (allAnswers[index] && allAnswers[index].correct) {
      c.classList.add('correct');
    }
  });

  // Disable all cards
  allCards.forEach(c => {
    c.style.pointerEvents = 'none';
  });
}

// Next Question
function nextQuestion() {
  const station = stations[currentStationIndex];

  // If there are more questions in current station → go to next question
  if (currentQuestionIndex < station.questions.length - 1) {
    currentQuestionIndex++;
    // optional: increment global question counter
    currentQuestionNumber++;
    loadQuestion();
    updateProgressBar && updateProgressBar();
    return;
  }

  // No more questions in this station → move to next station if exists
  if (currentStationIndex < stations.length - 1) {
    currentStationIndex++;
    currentQuestionIndex = 0;     // reset question index for the new station
    currentQuestionNumber++;     // optional global counter increment for transition
    const newStation = stations[currentStationIndex];

    // Update UI counters for the new station
    currentStationEl.textContent = currentStationIndex + 1;
    totalQuestionsEl.textContent = newStation.questions.length;
    currentQuestionEl.textContent = 1;

    loadStation();
    updateProgressBar && updateProgressBar();
    return;
  }

  // No more stations → finish quiz
  showResult();
}

// Show Result
function showResult() {
  gameScreen.style.display = 'none';
  resultScreen.classList.add('show');
  
  // Use /8 format (8 total questions)
  const totalQuestions = questions.length;
  finalScoreEl.textContent = `${score} / ${totalQuestions}`;
  
  // Calculate percentage
  const percentage = (score / totalQuestions) * 100;
  let message = '';
  
  if (percentage >= 70) {
    message = '🎉 Cemerlang! Anda sangat mahir dalam topik prinsip, andaian dan batas perakaunan!';
    excellentSound.play();
  } else {
    message = '💪 Anda perlu mengulangkaji topik prinsip, andaian dan batas perakaunan. Jangan putus asa!';
    poorSound.play();
  }
  
  resultTextEl.textContent = message;
}

// Utility: Shuffle Array
function shuffleArray(array) {
  const arr = [...array];
  for (let i = arr.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
  return arr;
}
</script>
</body>
</html>