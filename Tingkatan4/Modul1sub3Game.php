<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">

  <title>ACCsmart: SPM Game</title>
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
      background: url('../img/wall5.png') center center/contain no-repeat;
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
      background-color: #ffc052;
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
      background: white;
      padding: 40px 20px;
      position: relative;
      font-family: 'Poppins', sans-serif;
      color: #1f2937;
      overflow-y: auto;
      background: url('../img/wall200.png') center center/contain no-repeat;

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

 .answer-hint-box {
  background: #f8faff;
  border: 2px dashed #3643d1;
  border-radius: 16px;
  padding: 22px;
  margin-bottom: 25px;
  text-align: center;
}

.answer-hint-title {
  font-weight: 700;
  margin-bottom: 16px;
  color: #3643d1;
  font-size: 1.4rem;
  letter-spacing: 0.5px;
}

.answer-options {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
}

.answer-option {
  background: white;
  border: 1.5px solid #c7d2fe;
  padding: 8px 18px;
  border-radius: 999px;
  font-size: 1rem;
  font-weight: 600;
  color: #1e3a8a;
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

    /* FLASHCARD GAME STYLES */
    .flashcard-container {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 6px 20px rgba(110, 109, 109, 0.4);
      max-width: 1100px;
      margin: 0 auto;
    }

    .flashcard-question {
      font-size: 1.4rem;
      margin-bottom: 25px;
      font-weight: 600;
      color: #2c3e50;
      text-align: center;
      line-height: 1.6;
    }

    .flashcard-input-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 25px;
    }

    .flashcard-input {
      width: 100%;
      max-width: 500px;
      padding: 15px 20px;
      border: 2px solid #ddd;
      border-radius: 12px;
      font-size: 1.1rem;
      margin-bottom: 15px;
      transition: border-color 0.3s;
    }

    .flashcard-input:focus {
      border-color: #3643d1;
      outline: none;
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
      width: 100%;
      max-width: 500px;
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

    /* EXPLANATION CONTAINER */
    .explanation-container {
      background-color: #f0f9ff;
      border-left: 4px solid #3b82f6;
      padding: 15px;
      margin-top: 15px;
      border-radius: 0 8px 8px 0;
      display: none;
      width: 100%;
      max-width: 500px;
    }

    .explanation-title {
      font-weight: bold;
      margin-bottom: 8px;
      color: #1e40af;
    }

    /* ANSWER DISPLAY */
    .answer-display {
      background: linear-gradient(145deg, #dcfce7, #bbf7d0);
      border: 2px solid #22c55e;
      color: #166534;
      padding: 18px 22px;
      border-radius: 12px;
      font-weight: 600;
      margin: 15px 0;
      display: none;
      text-align: center;
      width: 100%;
      max-width: 500px;
      animation: fadeIn 0.3s ease;
    }

    .flashcard-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
      flex-wrap: wrap;
    }

    .flashcard-btn {
      padding: 12px 25px;
      border: none;
      border-radius: 25px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 140px;
    }

    .flashcard-submit-btn {
      background: linear-gradient(135deg, #3643d1, #5a67d8);
      color: white;
    }

    .flashcard-submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(54, 67, 209, 0.4);
    }

    .flashcard-answer-btn {
      background: linear-gradient(135deg, #3498db, #2980b9);
      color: white;
      display: none;
    }

    .flashcard-answer-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
    }

    .flashcard-next-btn {
      background: linear-gradient(135deg, #2ecc71, #27ae60);
      color: white;
      display: none;
    }

    .flashcard-next-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(46, 204, 113, 0.4);
    }

    /* RESULT SCREEN */
#result-screen {
  display: none;
  position: relative;
  min-height: 100vh;
  background: url('../img/wall200.png') center center / cover no-repeat;
  background-color: #f0f0f0;
  overflow: hidden;
}

#result-screen.show {
  display: flex;
  justify-content: center;
  align-items: center;
}

#result-screen::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(211, 211, 211, 0.6);
  z-index: 1;
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
/* Vertical Button Layout for Result Screen */
.result-btns-vertical {
  display: flex;
  flex-direction: column;
  gap: 15px;
  margin-top: 25px;
  z-index: 10;
  align-items: center;
}

.result-btns-vertical .button-33 {
  border-radius: 100px;
  box-shadow: rgba(146, 144, 144, 0.2) 0 -25px 18px -14px inset,
              rgba(146, 144, 144, 0.2) 0 1px 2px,
              rgba(146, 144, 144, 0.2) 0 2px 4px,
              rgba(146, 144, 144, 0.2) 0 4px 8px,
              rgba(146, 144, 144, 0.2) 0 8px 16px,
              rgba(146, 144, 144, 0.2) 0 16px 32px;
  cursor: pointer;
  display: inline-block;
  font-family: "Poppins", sans-serif;
  padding: 10px 30px;
  text-decoration: none;
  transition: all 250ms;
  border: 0;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  font-size: 1rem;
  font-weight: 600;
  text-align: center;
  min-width: 180px;
  width: 100%;
  max-width: 220px;
}

.result-btns-vertical .button-33:hover {
  box-shadow: rgba(146, 144, 144, 0.3) 0 -25px 18px -14px inset,
              rgba(146, 144, 144, 0.3) 0 1px 2px,
              rgba(146, 144, 144, 0.3) 0 2px 4px,
              rgba(146, 144, 144, 0.3) 0 4px 8px,
              rgba(146, 144, 144, 0.3) 0 8px 16px,
              rgba(146, 144, 144, 0.3) 0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
}

/* First button (orange - Cuba lagi) */
.result-btns-vertical .first-btn {
  background-color: #f16037;
  color: #fff;
  margin-bottom: 5px;
}

.result-btns-vertical .first-btn:hover {
  background-color: rgba(253, 74, 25, 0.95);
}

/* Second button (gray - Menu Utama) */
.result-btns-vertical .second-btn {
  background-color: rgba(246, 247, 249, 0.78);
  color: black;
  margin-top: 5px;
}

.result-btns-vertical .second-btn:hover {
  background-color: rgba(215, 216, 217, 0.78);
}

/* Remove old button styles */
.button-group {
  display: none !important;
}

.result-btns {
  display: none !important;
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

    /* ---------- INSTRUCTION ABOVE SOALAN ---------- */
    .instruction-above-soalan {
        text-align: center;
        margin-bottom: 25px;
        padding: 15px;
        background: #f9fafb;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        border-left: 4px solid #9ca3af;
        font-size: 1.2rem;
        font-weight: 600;
        color: #4b5563;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    /* Soalan Below Instruction */
    .soalan-below-instruction {
        text-align: center;
        margin-top: 15px;
        margin-bottom: 30px;
    }

    .soalan-label {
        color: #4b5563;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .soalan-content {
        font-size: 1.4rem;
        margin: 15px 0;
        font-weight: 700;
        color: #1f2937;
        line-height: 1.4;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    /* RESPONSIVE */
    @media (max-width: 768px) {
      .flashcard-buttons {
        flex-direction: column;
        align-items: center;
      }
      
      .flashcard-btn {
        width: 100%;
        max-width: 300px;
      }
      
      .flashcard-question {
        font-size: 1.2rem;
      }
      
      .answer-options {
        gap: 8px;
      }
      
      .answer-option {
        padding: 6px 12px;
        font-size: 0.8rem;
      }
    }
        /* ANSWER HINT BOX - Updated styles */
    .answer-hint-box {
      background: #f8faff;
      border: 2px dashed #3643d1;
      border-radius: 16px;
      padding: 22px;
      margin-bottom: 25px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .answer-hint-title {
      font-weight: 700;
      margin-bottom: 16px;
      color: #3643d1;
      font-size: 1.4rem;
      letter-spacing: 0.5px;
    }

    .answer-options {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
    }

    .answer-option {
      background: white;
      border: 1.5px solid #c7d2fe;
      padding: 8px 18px;
      border-radius: 999px;
      font-size: 1rem;
      font-weight: 600;
      color: #1e3a8a;
      transition: all 0.3s ease;
      cursor: default;
      position: relative;
    }

    /* All options have the same base color */
    .answer-option.distractor {
      background: white;
      border: 1.5px solid #c7d2fe;
      color: #1e3a8a;
    }

    /* Used/Answered option style */
    .answer-option.used {
      background: #f3f4f6;
      color: #9ca3af;
      border-color: #d1d5db;
      text-decoration: line-through;
      opacity: 0.7;
      transform: scale(0.95);
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    /* Add to responsive section */
    @media (max-width: 768px) {
      .answer-option {
        padding: 6px 12px;
        font-size: 0.8rem;
      }
    }
  </style>
</head>
<body>
<?php include '../components/Top_nav.php'; ?>

<div class="layout">
  <?php include '../components/SidebarNav_T4.php'; ?>

  <main class="main" id="main">
    <!-- START SCREEN (unchanged) -->
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

    <!-- INSTRUCTION MODAL (unchanged) -->
    <div id="instruction-modal">
      <div class="modal-overlay" onclick="closeInstructions()"></div>
      <div class="modal-content">
        <h2>📖 Arahan Permainan</h2>
        <p>Selamat datang ke <b>ACCsmart: SPM Quiz</b>! 🎓</p>
        <ul style="text-align:left; line-height:1.8; display: block; padding-left: 20px;">
          <li>👉 Tulis jawapan anda dalam kotak input</li>
          <li>👉 Klik <strong>"Hantar Jawapan"</strong> untuk menyemak jawapan</li>
          <li>✅ Jika betul, akan muncul <strong>penjelasan</strong> dan skor bertambah</li>
          <li>❌ Jika salah, akan muncul "<strong>Salah, cuba lagi!</strong>"</li>
          <li>📝 Klik <strong>"Jawapan & Penjelasan"</strong> untuk melihat jawapan yang betul</li>
          <li>➡️ Klik <strong>"Seterusnya"</strong> untuk ke soalan berikutnya</li>
          <li>🎯 <strong>Petunjuk:</strong> Pilihan jawapan akan dipangkah setelah digunakan</li>
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
            <button class="control-btn home" onclick="backToMenu()">🏠 Laman Utama</button>
          </div>
          <h2>🎯 Permainan Prinsip, Andaian & Batas Perakaunan</h2>
          <div class="game-stats">
            <div class="stat-box">❓ Soalan: <span id="currentQuestion">1</span>/<span id="totalQuestions">8</span></div>
            <div class="stat-box">⭐ Skor: <span id="score">0</span></div>
          </div>
        </div>

        <!-- ANSWER HINT BOX - UPDATED -->
        <div class="answer-hint-box" id="answer-hint-box">
          <div class="answer-hint-title">Pilihan Jawapan:</div>
          <div class="answer-options" id="answer-options">
            <!-- All options have the same style now -->
            <div class="answer-option" data-answer="Entiti berasingan">Entiti Berasingan</div>
            <div class="answer-option" data-answer="Usaha berterusan">Usaha Berterusan</div>
            <div class="answer-option" data-answer="Wang sebagai ukuran">Wang Sebagai Ukuran</div>
            <div class="answer-option" data-answer="Tempoh perakaunan">Tempoh Perakaunan</div>
            <div class="answer-option" data-answer="Ketekalan">Ketekalan</div>
            <div class="answer-option" data-answer="Prinsip kos">Prinsip Kos</div>
            <div class="answer-option" data-answer="Pengiktirafan hasil dan belanja">Pengiktirafan Hasil & Belanja</div>
            <div class="answer-option" data-answer="Kos manfaat">Kos Manfaat</div>
            <div class="answer-option" data-distractor="true">Perakaunan Tunai</div>
            <div class="answer-option" data-distractor="true">Konsep Konservatif</div>
          </div>
          <div style="margin-top: 10px; font-size: 0.8rem; color: #6b7280;">
            <span style="color: #9ca3af;">●</span> Telah digunakan
          </div>
        </div>

        <!-- Flashcard container (unchanged) -->
        <div class="flashcard-container">
            <div class="flashcard-question" id="flashcard-question"></div>
            
            <div class="flashcard-input-container">
                <input type="text" class="flashcard-input" id="flashcard-input" placeholder="Tulis jawapan anda di sini...">
                
                <!-- Feedback Area -->
                <div class="feedback" id="flashcard-feedback"></div>
                
                <!-- Answer Display Area -->
                <div class="answer-display" id="answer-display"></div>
                
                <!-- Explanation Container -->
                <div class="explanation-container" id="explanation-container">
                    <div class="explanation-title">
                      <span style="font-weight: bold; font-size: 1.3em;">Penjelasan:</span>
                    </div>
                    <div id="explanation-text"></div>
                </div>
            </div>
            <div class="flashcard-buttons">
                <button class="flashcard-btn flashcard-submit-btn" id="flashcard-submit-btn">Semak Jawapan</button>
                <button class="flashcard-btn flashcard-answer-btn" id="flashcard-answer-btn">Jawapan & Penjelasan</button>
                <button class="flashcard-btn flashcard-next-btn" id="flashcard-next-btn">Seterusnya →</button>
            </div>
        </div>
      </div>
    </section>

    <!-- RESULT SCREEN (unchanged) -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Quiz Selesai!</h2>
        <p id="resultText">Anda telah berjaya menjawab semua soalan mengenai prinsip, andaian dan batas perakaunan!</p>
        <div class="final-score" id="finalScore">0/8</div>
    <div class="result-btns-vertical">
      <a href="javascript:void(0)" class="button-33 first-btn" onclick="tryAgain()">Cuba lagi</a>
      <a href="javascript:void(0)" class="button-33 second-btn" onclick="backToMenu()">Menu Utama</a>
    </div>
      </div>
    </section>
  </main>
</div>
<button class="floating-toggle" id="floatingToggle">☰</button>
<script src="../js/navigation.js"></script>
<script>
  // Sound Effects (unchanged)
  const correctSound = new Audio("../audio/correct_answer_sound.mp3");
  const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
  const excellentSound = new Audio("../audio/congrats_sound.mp3");
  const poorSound = new Audio("../audio/fail_sound.mp3");

  // DOM Elements (simplified - removed counter elements)
  const startScreen = document.getElementById('start-screen');
  const gameScreen = document.getElementById('game-screen');
  const resultScreen = document.getElementById('result-screen');
  const instrScreen = document.getElementById('instruction-modal');
  const answerHintBox = document.getElementById('answer-hint-box');
  const answerOptionsContainer = document.getElementById('answer-options');
  
  // Flashcard elements (unchanged)
  const flashcardQuestion = document.getElementById('flashcard-question');
  const flashcardInput = document.getElementById('flashcard-input');
  const flashcardFeedback = document.getElementById('flashcard-feedback');
  const answerDisplay = document.getElementById('answer-display');
  const explanationContainer = document.getElementById('explanation-container');
  const explanationText = document.getElementById('explanation-text');
  
  // Button elements (unchanged)
  const flashcardSubmitBtn = document.getElementById('flashcard-submit-btn');
  const flashcardAnswerBtn = document.getElementById('flashcard-answer-btn');
  const flashcardNextBtn = document.getElementById('flashcard-next-btn');
  
  // Game stats elements (unchanged)
  const currentQuestionEl = document.getElementById('currentQuestion');
  const totalQuestionsEl = document.getElementById('totalQuestions');
  const scoreEl = document.getElementById('score');
  const finalScoreEl = document.getElementById('finalScore');
  const resultTextEl = document.getElementById('resultText');

  // Game Data (unchanged)
  const questions = [
    {
      question: "Perniagaan perlu menyimpan rekodnya berasingan dari rekod pemilik.",
      answer: "Entiti berasingan",
      explanation: "Andaian entiti berasingan menganggap perniagaan sebagai satu unit yang berasingan daripada pemiliknya. Oleh itu, hanya urus niaga perniagaan direkodkan dalam akaun perniagaan bagi memastikan ketepatan penyata kewangan."
    },
    {
      question: "Semua aktiviti kewangan perniagaan diandaikan beroperasi untuk tempoh yang tidak terbatas.",
      answer: "Usaha berterusan",
      explanation: "Andaian usaha berterusan menganggap perniagaan akan meneruskan operasinya dan tidak akan ditutup dalam masa terdekat. Ini membolehkan aset direkod berdasarkan kos perolehan dan penyata kewangan disediakan secara berterusan."
    },
    {
      question: "Maklumat Penyata Kewangan mesti dinyatakan dalam nilai mata wang sesebuah negara.",
      answer: "Wang sebagai ukuran",
      explanation: "Andaian wang sebagai ukuran menyatakan bahawa hanya urus niaga yang boleh dinilai dalam unit mata wang direkodkan dalam perakaunan. Ini membolehkan perbandingan dan pengukuran kewangan dibuat dengan lebih sistematik."
    },
    {
      question: "Pembahagian operasi dan aktiviti peniagaan kepada tempoh yang ditentukan.",
      answer: "Tempoh perakaunan",
      explanation: "Andaian tempoh perakaunan membahagikan hayat perniagaan kepada tempoh tertentu seperti bulanan atau tahunan. Ini membolehkan prestasi dan kedudukan kewangan dinilai secara berkala."
    },
    {
      question: "Memastikan wujudnya konsistensi dalam prosedur perakaunan.",
      answer: "Ketekalan",
      explanation: "Prinsip ketekalan menyatakan bahawa kaedah perakaunan yang digunakan hendaklah dikekalkan dari satu tempoh ke tempoh yang lain. Ini membolehkan perbandingan prestasi kewangan dibuat dengan lebih adil dan tepat."
    },
    {
      question: "Semua aset perniagaan yang diporolehi hendaklah direkod berdasarkan harga sebenar",
      answer: "Prinsip kos",
      explanation: "Prinsip kos menyatakan bahawa aset direkod berdasarkan kos perolehan asal, iaitu harga sebenar semasa aset dibeli. Prinsip ini memastikan rekod perakaunan bersifat objektif dan boleh dipercayai."
    },
    {
      question: "Semua hasil dan semua belanja perlu diambil kira menyediakan penyata kewangan.",
      answer: "Pengiktirafan hasil dan belanja",
      explanation: "Prinsip pengiktirafan hasil dan belanja menyatakan bahawa hasil dan belanja hendaklah direkod dalam tempoh perakaunan yang berkaitan, tanpa mengira sama ada tunai telah diterima atau dibayar. Ini memastikan pengiraan keuntungan yang tepat."
    },
    {
      question: "Maklumat kewangan dicatat hanya jika manfaatnya melebihi kos penyediaannya.",
      answer: "Kos manfaat",
      explanation: "Batas kos manfaat menekankan bahawa maklumat perakaunan hanya perlu disediakan jika manfaat kepada pengguna penyata kewangan melebihi kos untuk memperolehnya."
    }
  ];

  // Game Variables (simplified)
  let currentQuestionIndex = 0;
  let score = 0;
  let answerShown = false;
  let userAnswered = false;
  let usedOptions = new Set(); // Track used answer options

  // NEW: Mark an answer option as used
  function markOptionAsUsed(optionText) {
    const normalizedText = optionText.toLowerCase().trim();
    
    // Find the matching option element
    const allOptions = document.querySelectorAll('.answer-option');
    allOptions.forEach(option => {
      const optionData = option.getAttribute('data-answer') || option.textContent.trim();
      if (optionData.toLowerCase() === normalizedText) {
        // Mark as used
        option.classList.add('used');
        usedOptions.add(optionData);
      }
    });
  }

  // NEW: Reset all answer options
  function resetAnswerOptions() {
    const allOptions = document.querySelectorAll('.answer-option');
    allOptions.forEach(option => {
      option.classList.remove('used');
    });
    usedOptions.clear();
  }

  // Navigation Functions (updated)
  function startGame() {
    startScreen.style.display = 'none';
    gameScreen.style.display = 'block';
    resultScreen.classList.remove('show');
    currentQuestionIndex = 0;
    score = 0;
    answerShown = false;
    userAnswered = false;
    
    // Reset answer options
    resetAnswerOptions();
    
    updateScore();
    loadQuestion();
  }

  function resetGame() {
    if (confirm('Reset skor dan mula semula dari awal?')) {
      currentQuestionIndex = 0;
      score = 0;
      answerShown = false;
      userAnswered = false;
      
      // Reset answer options
      resetAnswerOptions();
      
      updateScore();
      loadQuestion();
    }
  }

  function tryAgain() {
    resultScreen.classList.remove('show');
    startGame();
  }

  // Score Management (unchanged)
  function updateScore() {
    scoreEl.textContent = score;
    currentQuestionEl.textContent = currentQuestionIndex + 1;
    totalQuestionsEl.textContent = questions.length;
  }

  // Flashcard Game Functions (updated)
  function loadQuestion() {
    const currentQuestion = questions[currentQuestionIndex];
    
    // Create the Arahan-Soalan structure
    flashcardQuestion.innerHTML = `
        <div class="instruction-above-soalan">
            <p><strong>Arahan:</strong> Nyatakan Andaian, Prinsip dan Batasan perakaunan bagi setiap definisi berikut berdasarkan "Pilihan Jawapan" yang diberi di atas.</p>
        </div>
        
        <div class="soalan-below-instruction">
            <div class="soalan-label">SOALAN:</div>
            <div class="soalan-content">"${currentQuestion.question}"</div>
        </div>
    `;
    
    flashcardInput.value = '';
    flashcardInput.disabled = false;
    
    // Reset UI elements
    flashcardFeedback.style.display = 'none';
    flashcardFeedback.className = 'feedback';
    answerDisplay.style.display = 'none';
    explanationContainer.style.display = 'none';
    
    // Reset button states
    flashcardSubmitBtn.style.display = 'block';
    flashcardAnswerBtn.style.display = 'none';
    flashcardNextBtn.style.display = 'none';
    
    // Ensure hint box is visible
    answerHintBox.style.display = 'block';
    
    answerShown = false;
    userAnswered = false;
    flashcardInput.focus();
    updateScore();
  }

  function checkAnswer() {
    const userAnswer = flashcardInput.value.trim();
    const correctAnswer = questions[currentQuestionIndex].answer;
    
    // Normalize both answers for comparison
    const normalizedUserAnswer = userAnswer.toLowerCase().replace(/\s+/g, ' ').trim();
    const normalizedCorrectAnswer = correctAnswer.toLowerCase().replace(/\s+/g, ' ').trim();
    
    // Check if answers match exactly (case-insensitive)
    if (normalizedUserAnswer === normalizedCorrectAnswer) {
        return { isCorrect: true, exactMatch: true };
    }
    
    // Check if it's a close match (spelling issues)
    const similarity = calculateSimilarity(normalizedUserAnswer, normalizedCorrectAnswer);
    return { 
        isCorrect: false, 
        isCloseMatch: similarity >= 0.7, 
        similarity: similarity 
    };
  }

  function calculateSimilarity(str1, str2) {
    // Simple similarity calculation using Levenshtein distance
    const len1 = str1.length;
    const len2 = str2.length;
    
    if (len1 === 0 || len2 === 0) return 0;
    
    // Create a matrix
    const matrix = [];
    for (let i = 0; i <= len1; i++) {
        matrix[i] = [i];
    }
    for (let j = 0; j <= len2; j++) {
        matrix[0][j] = j;
    }
    
    // Fill the matrix
    for (let i = 1; i <= len1; i++) {
        for (let j = 1; j <= len2; j++) {
            const cost = str1[i - 1] === str2[j - 1] ? 0 : 1;
            matrix[i][j] = Math.min(
                matrix[i - 1][j] + 1, // deletion
                matrix[i][j - 1] + 1, // insertion
                matrix[i - 1][j - 1] + cost // substitution
            );
        }
    }
    
    // Calculate similarity percentage
    const distance = matrix[len1][len2];
    const maxLength = Math.max(len1, len2);
    return 1 - (distance / maxLength);
  }

  function submitAnswer() {
    const userAnswer = flashcardInput.value.trim();
    
    if (userAnswer === '') {
        flashcardFeedback.style.display = 'block';
        flashcardFeedback.className = 'feedback incorrect';
        flashcardFeedback.innerHTML = '<strong>⚠️ Sila tulis jawapan anda terlebih dahulu!</strong>';
        return;
    }
    
    const result = checkAnswer();
    showFeedback(result);
  }

  function showFeedback(result) {
    flashcardFeedback.style.display = 'block';
    
    if (result.isCorrect) {
        // Only exact matches are considered correct
        flashcardFeedback.className = 'feedback correct';
        flashcardFeedback.innerHTML = '<span style="background: #22c55e; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">Betul!</span>';
        
        // Play correct sound
        correctSound.play();
        
        // Mark the correct answer as used
        markOptionAsUsed(questions[currentQuestionIndex].answer);
        
        // Show explanation
        explanationText.textContent = questions[currentQuestionIndex].explanation;
        explanationContainer.style.display = 'block';
        
        // Disable input
        flashcardInput.disabled = true;
        
        // Hide submit button, show next button
        flashcardSubmitBtn.style.display = 'none';
        flashcardAnswerBtn.style.display = 'none';
        flashcardNextBtn.style.display = 'block';
        
        // Update score if not already answered
        if (!userAnswered) {
            score++;
            userAnswered = true;
            updateScore();
        }
    } else {
        // Always show as incorrect, even if close match
        flashcardFeedback.className = 'feedback incorrect';
        
        if (result.isCloseMatch) {
            flashcardFeedback.innerHTML = `
                <span style="background: #ef4444; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">
                    ❌ Hampir betul, ejaan salah!
                </span>
                <br>
                <small style="color: #991b1b; margin-top: 10px; display: block; font-size: 1em">
                    Jawapan anda hampir betul tetapi ada kesilapan ejaan. Cuba periksa ejaan anda.
                </small>
            `;
        } else {
            // Normal wrong answer with badge style
            flashcardFeedback.innerHTML = '<span style="background: #ef4444; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">Salah! Cuba lagi</span>';
        }
        
        // Play incorrect sound
        incorrectSound.play();
        
        // Show answer button after wrong attempt
        flashcardAnswerBtn.style.display = 'block';
        flashcardSubmitBtn.style.display = 'block';
    }
  }

  function showAnswerAndExplanation() {
    // Clear any existing feedback messages
    flashcardFeedback.style.display = 'none';
    
    // Mark the correct answer as used (but not correct since user got it wrong)
    markOptionAsUsed(questions[currentQuestionIndex].answer);
    
    // Show the correct answer
    answerDisplay.textContent = `Jawapan yang betul: ${questions[currentQuestionIndex].answer}`;
    answerDisplay.style.display = 'block';
    
    // Show the explanation
    explanationText.textContent = questions[currentQuestionIndex].explanation;
    explanationContainer.style.display = 'block';
    
    // Disable input
    flashcardInput.disabled = true;
    answerShown = true;
    
    // Hide submit and answer buttons, show next button
    flashcardSubmitBtn.style.display = 'none';
    flashcardAnswerBtn.style.display = 'none';
    flashcardNextBtn.style.display = 'block';
    
    // Don't add score if answer was shown
    if (!userAnswered) {
        userAnswered = true;
    }
  }

  function nextQuestion() {
    currentQuestionIndex++;
    
    if (currentQuestionIndex < questions.length) {
      loadQuestion();
    } else {
      showResult();
    }
  }

  // Event Listeners (add new setup)
  flashcardSubmitBtn.addEventListener('click', submitAnswer);
  flashcardAnswerBtn.addEventListener('click', showAnswerAndExplanation);
  flashcardNextBtn.addEventListener('click', nextQuestion);

  flashcardInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      submitAnswer();
    }
  });

  function showResult() {
    gameScreen.style.display = 'none';
    resultScreen.classList.add('show');
    finalScoreEl.textContent = `${score}/${questions.length}`;
    
    let message = '';
    if (score === questions.length) {
      message = 'Tahniah! Anda menguasai prinsip, andaian dan batas perakaunan dengan cemerlang!';
      excellentSound.play();
    } else if (score >= questions.length * 0.7) {
      message = 'Bagus! Anda mempunyai pemahaman yang baik tentang prinsip, andaian dan batas perakaunan.';
    } else if (score >= questions.length * 0.5) {
      message = 'Memuaskan. Anda memahami asas prinsip, andaian dan batas perakaunan.';
    } else {
      message = 'Anda perlu mengulangkaji prinsip, andaian dan batas perakaunan. Teruskan berusaha!';
      poorSound.play();
    }
    
    resultTextEl.textContent = message;
  }

  // Initialize the game
  window.addEventListener('DOMContentLoaded', function() {
    updateScore();
  });
</script>

<!-- ADD THIS NEW SCRIPT FOR SIDEBAR HIGHLIGHTING -->
<script>
console.log("🟢 Modul1sub1.php custom script running");

// Function to highlight sidebar
function highlightSidebar() {
    console.log("🎯 highlightSidebar() called");
    
    // Get current page
    const currentPage = window.location.pathname.split('/').pop();
    console.log("Current page:", currentPage);
    
    // Find all sidebar links
    const sidebarLinks = document.querySelectorAll('.subtopic-item a');
    console.log("Found", sidebarLinks.length, "sidebar links");
    
    // Loop through links to find match
    let foundMatch = false;
    
    for (let i = 0; i < sidebarLinks.length; i++) {
        const link = sidebarLinks[i];
        const href = link.getAttribute('href');
        const linkPage = href.split('/').pop();
        
        console.log(`Link ${i + 1}: ${linkPage}`);
        
        if (linkPage === currentPage) {
            console.log("✅ Found matching link!");
            
            // 1. Add active class to the link itself
            link.classList.add('active');
            
            // 2. Add active class to parent li
            const parentLi = link.closest('.subtopic-item');
            if (parentLi) {
                parentLi.classList.add('active-item');
                parentLi.style.backgroundColor = '#e6f7ff'; // Visual feedback
                console.log("✅ Added active-item to parent");
            }
            
            // 3. Expand the parent module
            const parentModule = link.closest('.module');
            if (parentModule) {
                // Expand subtopic list
                const subtopicList = parentModule.querySelector('.subtopic-list');
                if (subtopicList) {
                    subtopicList.classList.add('open');
                    subtopicList.style.display = 'block';
                }
                
                // Add open class to module
                parentModule.classList.add('open');
                
                console.log("✅ Expanded parent module");
            }
            
            foundMatch = true;
            break; // Stop after finding first match
        }
    }
    
    if (!foundMatch) {
        console.log("⚠️ No matching link found. Looking for 'Modul1sub1.php' specifically...");
        
        // Try to find by filename directly
        document.querySelectorAll('.subtopic-item a').forEach(link => {
            if (link.getAttribute('href').includes('Modul1sub1.php')) {
                console.log("✅ Found Modul1sub1.php link!");
                link.classList.add('active');
                link.closest('.subtopic-item').classList.add('active-item');
                
                // Expand module
                const module = link.closest('.module');
                if (module) {
                    module.querySelector('.subtopic-list').classList.add('open');
                    module.classList.add('open');
                }
            }
        });
    }
    
}

// Run when DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log("📄 DOM fully loaded");
    highlightSidebar();
});

// Run again after a short delay (in case of dynamic content)
setTimeout(highlightSidebar, 500);
setTimeout(highlightSidebar, 1000);

// Log when page is fully loaded
window.addEventListener('load', function() {
    console.log("🚀 Page fully loaded");
});
</script>
</body>
</html>