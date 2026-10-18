<?php
session_start();

// Handle AJAX requests for score saving - separate for MCQ2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_score_mcq2') {
    $score = intval($_POST['score'] ?? 0);
    if (!isset($_SESSION['highscore_mcq2']) || $score > $_SESSION['highscore_mcq2']) {
        $_SESSION['highscore_mcq2'] = $score;
    }
    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok', 'highscore' => $_SESSION['highscore_mcq2']]);
    exit;
}

$highscore = $_SESSION['highscore_mcq2'] ?? 0;
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>ACCsmart: Ujian Asas Perakaunan</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(135deg, #ff7eb3 0%, #ff758c 100%);
      color: #1f2937;
      overflow: hidden;
      min-height: 100vh;
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
      background: #fff5f7;
    }

    body.sidebar-collapsed .main {
      margin-left: 0 !important;
      width: 100% !important;
    }

    /* ---------- Start Screen ---------- */
    /* ---------- Start Screen ---------- */
    #start-screen {
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 30px 40px;
      box-sizing: border-box;
      position: relative;
      background: url('../img/wallmcq2.png') center center/contain no-repeat;
      color: white;
      min-height: 100%;
      align-items: flex-start;
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
      margin-top: 200px; /* Add margin to push content down */
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
      background: white;
      color: #333;
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      width: 90%;
      z-index: 2;
      text-align: center;
      position: relative;
      border-top: 5px solid #ff4081;
    }

    #instruction-modal.show {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ---------- Game Top Controls ---------- */
    .game-top-controls {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 15px;
      max-width: 1100px;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
    }

    .control-btn {
      background: linear-gradient(135deg, #ff4081, #f50057);
      color: white;
      border: none;
      padding: 10px 22px;
      border-radius: 25px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(255, 64, 129, 0.3);
    }

    .control-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 64, 129, 0.4);
    }

    .control-btn.home {
      background: linear-gradient(135deg, #7b1fa2, #4a148c);
      box-shadow: 0 2px 8px rgba(123, 31, 162, 0.3);
    }

    .control-btn.home:hover {
      box-shadow: 0 4px 12px rgba(123, 31, 162, 0.4);
    }

    /* ---------- Quiz/Test Screen Styles ---------- */
    #test-screen {
      display: none;
      min-height: 100vh;
      background: #fff5f7;
      padding: 40px 20px;
      position: relative;
      font-family: 'Poppins', sans-serif;
      overflow-y: auto;
    }

    .game-container {
      max-width: 1100px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .game-header {
      background: white;
      border-radius: 18px;
      padding: 20px 30px;
      text-align: center;
      margin-bottom: 25px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.08);
      width: 100%;
      box-sizing: border-box;
    }

    .game-header h1 {
      color: #d81b60;
      font-size: 1.9rem;
      font-weight: 700;
      margin-bottom: 10px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .game-stats {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .stat-box {
      background: linear-gradient(135deg, #ff4081, #f50057);
      color: white;
      padding: 10px 22px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 1rem;
    }

    .test {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
      max-width: 900px;
      width: 100%;
      padding: 30px;
      margin: 0 auto;
      animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .question-counter {
      text-align: center;
      font-size: 1.2em;
      color: #666;
      margin-bottom: 30px;
      background: #fce4ec;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #f8bbd9;
    }

    .question-box {
      background: #fce4ec;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 30px;
      border-left: 5px solid #ff4081;
    }

    .question-text {
      font-size: 1.4em;
      color: #333;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .question-image {
      max-width: 100%;
      max-height: 300px;
      border-radius: 10px;
      margin-bottom: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border: 2px solid #ff4081;
    }

    .options-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 15px;
      margin-bottom: 30px;
    }

    .option-btn {
      background: white;
      border: 2px solid #f8bbd9;
      border-radius: 12px;
      padding: 18px 20px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1.1em;
      text-align: left;
      position: relative;
      padding-left: 60px;
      display: flex;
      align-items: center;
    }

    .option-btn:hover {
      border-color: #ff4081;
      background: #fce4ec;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 64, 129, 0.1);
    }

    .option-btn.selected {
      background: #ff4081;
      color: white;
      border-color: #ff4081;
    }

    .option-letter {
      position: absolute;
      left: 20px;
      width: 30px;
      height: 30px;
      background: #f8bbd9;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #333;
      transition: all 0.3s ease;
    }

    .option-btn.selected .option-letter {
      background: white;
      color: #ff4081;
    }

    .navigation-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .nav-btn {
      padding: 12px 40px;
      font-size: 1.1em;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .next-btn {
      background: linear-gradient(135deg, #ff4081, #f50057);
      color: white;
      min-width: 220px;
    }

    .next-btn:hover {
      background: linear-gradient(135deg, #f50057, #c51162);
      transform: scale(1.05);
    }

    .nav-btn:disabled {
      background: #cccccc !important;
      color: #888888 !important;
      cursor: not-allowed;
      transform: none;
      opacity: 0.7;
      box-shadow: none;
    }

    .nav-btn:disabled:hover {
      background: #cccccc !important;
      transform: none;
      box-shadow: none;
    }

    .result-screen {
      text-align: center;
      animation: slideIn 0.5s ease-out;
      padding: 40px;
      min-height: 100vh;
      background: white;
      border-radius: 20px;
      margin: 20px auto;
      max-width: 800px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .grade-circle {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      border: 10px solid #ff4081;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 30px auto;
      font-size: 3em;
      font-weight: bold;
      color: #ff4081;
      background: #fff5f7;
    }

    .grade-circle.a-plus {
      border-color: #00c853;
      color: #00c853;
      background: #e8f5e9;
    }

    .grade-circle.a {
      border-color: #64dd17;
      color: #64dd17;
      background: #f1f8e9;
    }

    .grade-circle.a-minus {
      border-color: #aeea00;
      color: #aeea00;
      background: #f9fbe7;
    }

    .grade-circle.b-plus {
      border-color: #ffd600;
      color: #ffd600;
      background: #fffde7;
    }

    .grade-circle.b {
      border-color: #ffab00;
      color: #ffab00;
      background: #fff3e0;
    }

    .grade-circle.c-plus {
      border-color: #ff6d00;
      color: #ff6d00;
      background: #fff3e0;
    }

    .grade-circle.c {
      border-color: #ff5722;
      color: #ff5722;
      background: #fbe9e7;
    }

    .grade-circle.d {
      border-color: #d50000;
      color: #d50000;
      background: #ffebee;
    }

    .grade-circle.e {
      border-color: #c51162;
      color: #c51162;
      background: #fce4ec;
    }

    .grade-circle.f {
      border-color: #880e4f;
      color: #880e4f;
      background: #f8bbd9;
    }

    .score-text {
      font-size: 2.5em;
      color: #333;
      margin: 20px 0;
      font-weight: 700;
    }

    .result-details {
      font-size: 1.2em;
      color: #666;
      margin: 15px 0;
      padding: 15px;
      background: #fce4ec;
      border-radius: 10px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      border: 1px solid #f8bbd9;
    }

    .restart-btn {
      background: linear-gradient(135deg, #ff4081, #f50057);
      color: white;
      margin-top: 10px;
      padding: 15px 50px;
      font-size: 1.1em;
      border-radius: 25px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .restart-btn:hover {
      background: linear-gradient(135deg, #f50057, #c51162);
      transform: scale(1.05);
    }

    .hidden {
      display: none;
    }

    .question-number {
      display: inline-block;
      background: #ff4081;
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      margin-right: 10px;
    }

    .questions-progress {
      display: flex;
      justify-content: center;
      gap: 5px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .progress-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #f8bbd9;
      transition: all 0.3s ease;
    }

    .progress-dot.active {
      background: #ff4081;
    }

    .progress-dot.answered {
      background: #c51162;
    }

    /* Style for last question button */
    .final-btn {
      background: linear-gradient(135deg, #ff6d00, #ff5722) !important;
    }

    .final-btn:hover {
      background: linear-gradient(135deg, #ff5722, #e64a19) !important;
    }

    /* Review Modal Styles */
    #review-modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 999;
    }

    #review-modal.show {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .review-modal-content {
      background: #fff;
      color: #111;
      padding: 20px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      max-width: 800px;
      width: 90%;
      max-height: 80vh;
      overflow-y: auto;
      z-index: 2;
      position: relative;
      border-top: 5px solid #ff4081;
    }

    .review-title {
      text-align: center;
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 20px;
      color: #d81b60;
      padding-bottom: 10px;
      border-bottom: 2px solid #f8bbd9;
    }

    .review-question {
      margin-bottom: 20px;
      padding: 15px;
      border-radius: 10px;
      background: white;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .review-question.correct {
      border-left: 5px solid #4CAF50;
      background: #e8f5e9;
    }

    .review-question.incorrect {
      border-left: 5px solid #f44336;
      background: #ffebee;
    }

    .review-question-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .review-question-number {
      font-weight: bold;
      color: #333;
      font-size: 1.1em;
    }

    .review-status {
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.9em;
      font-weight: bold;
    }

    .review-status.correct {
      background: #4CAF50;
      color: white;
    }

    .review-status.incorrect {
      background: #f44336;
      color: white;
    }

    .review-question-text {
      margin-bottom: 10px;
      font-weight: 500;
      line-height: 1.4;
    }

    .review-options {
      margin-top: 10px;
    }

    .review-option {
      padding: 10px 15px;
      margin-bottom: 8px;
      border-radius: 8px;
      position: relative;
      padding-left: 50px;
      border: 1px solid #f8bbd9;
      background: #fff5f7;
    }

    .review-option.correct-answer {
      background: #c8e6c9;
      border: 2px solid #4CAF50;
    }

    .review-option.user-answer {
      background: #ffcdd2;
      border: 2px solid #f44336;
    }

    .review-option-label {
      position: absolute;
      left: 15px;
      font-weight: bold;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #f8bbd9;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .review-option.correct-answer .review-option-label {
      background: #4CAF50;
      color: white;
    }

    .review-option.user-answer .review-option-label {
      background: #f44336;
      color: white;
    }

    .review-indicator {
      float: right;
      font-size: 0.9em;
      font-weight: bold;
      padding: 2px 8px;
      border-radius: 10px;
    }

    .correct-indicator {
      color: #4CAF50;
      background: rgba(76, 175, 80, 0.1);
    }

    .incorrect-indicator {
      color: #f44336;
      background: rgba(244, 67, 54, 0.1);
    }
    
    .result-actions {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      margin-top: 10px;
    }

    .toggle-review-btn {
      background: linear-gradient(135deg, #7b1fa2, #4a148c);
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.3s ease;
      font-size: 1em;
      order: -1;
      margin-bottom: 3px;
    }

    .toggle-review-btn:hover {
      background: linear-gradient(135deg, #4a148c, #311b92);
      transform: scale(1.05);
    }

    .close-review-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #f44336;
      color: white;
      border: none;
      width: 35px;
      height: 35px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2em;
      transition: all 0.3s ease;
    }

    .close-review-btn:hover {
      background: #d32f2f;
      transform: rotate(90deg);
    }

    .review-summary {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
      padding: 15px;
      background: #fce4ec;
      border-radius: 10px;
      font-weight: 600;
      border: 1px solid #f8bbd9;
    }

    .summary-item {
      text-align: center;
    }

    .summary-value {
      font-size: 1.5em;
      font-weight: bold;
      display: block;
    }

    .summary-label {
      font-size: 0.9em;
      color: #666;
    }

    .correct-summary {
      color: #4CAF50;
    }

    .incorrect-summary {
      color: #f44336;
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
          <div class="button-group">
            <button class="start-btn" onclick="startGame()">
              <i class="fas fa-play-circle"></i> Mulakan Permainan
            </button>
            <button class="start-btn" onclick="showInstructions()">
              <i class="fas fa-book"></i> Arahan
            </button>
          </div>
          <div style="margin-top: 20px; background: rgba(17, 12, 12, 0.47); padding: 20px; border-radius: 15px; backdrop-filter: blur(5px);">
            <p style="margin: 0; font-size: 1.2rem;">
              <i class="fas fa-trophy"></i> Rekod Tertinggi: <span id="current-highscore"><?php echo $highscore; ?></span>/15
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Instruction Modal -->
    <div id="instruction-modal">
      <div class="modal-overlay" onclick="closeInstructions()"></div>
      <div class="modal-content">
        <h2 style="color: #ff4081;">📚 Arahan Ujian</h2>
        <p>Selamat datang ke <b style="color: #ff4081;">Ujian Asas Perakaunan</b>! 🧾</p>
        <ul style="text-align:left; line-height:1.6; display: block; margin: 20px 0;">
          <li>📝 Anda akan menjawab 15 soalan pilihan berganda.</li>
          <li>⏱️ Masa keseluruhan: 30 minit (2 minit/soalan).</li>
          <li>✅ Klik pada pilihan A, B, C atau D untuk memilih jawapan.</li>
          <li>⏭️ Klik "SOALAN SETERUSNYA" untuk teruskan.</li>
          <li>🏆 Dapatkan markah setinggi mungkin dan pecahkan rekod anda!</li>
          <li>📊 Dapatkan gred berdasarkan sistem penilaian SPM.</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()" style="background: #ff4081;">TUTUP</button>
      </div>
    </div>

    <!-- TEST SCREEN -->
    <section id="test-screen">
      <div class="game-container">
        <div class="game-header">
          <div class="game-top-controls">
            <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
            <button class="control-btn home" onclick="backToMenu()">🏠 Laman Utama</button>
          </div>
          <h1>🎯 Ujian Bab 1: Pengenalan kepada Perakaunan</h1>
          <div class="game-stats">
            <div class="stat-box">⏱️ Masa: <span id="timeRemaining">30:00</span></div>
          </div>
        </div>

        <div class="test">
          <div id="quiz-screen">
            <div class="questions-progress" id="questionsProgress"></div>
            
            <div class="question-counter">
              <span class="question-number" id="currentQNum">1</span>
              <span>daripada 15</span>
            </div>
            
            <div class="question-box">
              <div class="question-text" id="questionText"></div>
              <img id="questionImage" class="question-image" style="display: none;">
            </div>
            
            <div class="options-grid" id="optionsContainer"></div>
            
            <div class="navigation-buttons">
              <button class="nav-btn next-btn" onclick="nextQuestion()" id="nextBtn" disabled>
                <i class="fas fa-arrow-right"></i> <span id="nextBtnText">SOALAN SETERUSNYA</span>
              </button>
            </div>
          </div>

          <div id="result-screen" class="hidden result-screen">
            <div class="header">
              <h1 style="color: #ff4081;">TAMAT UJIAN! 🎉</h1>
              <p style="color: #666; margin-bottom: 20px;">Tahniah! Anda telah selesai menjawab semua soalan.</p>
            </div>
            
            <div class="grade-circle" id="gradeCircle">A+</div>
            
            <div class="score-text" id="scoreText">80%</div>
            
            <div class="result-details">
              <i class="fas fa-star" style="color: #ff4081;"></i> MARKAH ANDA: 
              <span id="finalScore" style="font-weight: bold; color: #ff4081;">12/15</span>
            </div>
            <div class="result-details">
              <i class="fas fa-clock" style="color: #ff4081;"></i> Masa digunakan: 
              <span id="timeUsed" style="font-weight: bold; color: #ff4081;">28:15</span>
            </div>
            
            <div class="result-actions">
              <button class="toggle-review-btn" onclick="showReviewModal()">
                <i class="fas fa-chart-bar"></i> SEMAK SEMULA JAWAPAN
              </button>

              <button class="restart-btn" onclick="restartQuiz()">
                <i class="fas fa-redo"></i> CUBA LAGI
              </button>

              <button class="restart-btn" onclick="backToMenu()" style="background: linear-gradient(135deg, #7b1fa2, #4a148c);">
                <i class="fas fa-home"></i> MENU UTAMA
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>

<!-- Review Modal -->
<div id="review-modal">
  <div class="review-modal-content">
    <button class="close-review-btn" onclick="closeReviewModal()">×</button>
    <div class="review-title">📋 SEMAKAN SEMULA JAWAPAN</div>
    
    <div class="review-summary" id="reviewSummary">
      <!-- Summary will be inserted here -->
    </div>
    
    <div id="review-section"></div>
    
    <div style="text-align: center; margin-top: 20px;">
      <button class="toggle-review-btn" onclick="closeReviewModal()" style="background: #ff4081;">
        <i class="fas fa-times"></i> TUTUP SEMAKAN
      </button>
    </div>
  </div>
</div>

<button class="floating-toggle" id="floatingToggle">☰</button>
<script src="../js/navigation.js"></script>
<script>
  // Sound Effects - only for final results
  const excellentSound = new Audio("../audio/congrats_sound.mp3");
  const poorSound = new Audio("../audio/fail_sound.mp3");

  // Navigation Functions
  function startGame() {
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('test-screen').style.display = 'block';
    initializeQuiz();
  }

  function showInstructions() {
    document.getElementById('instruction-modal').classList.add('show');
  }

  function closeInstructions() {
    document.getElementById('instruction-modal').classList.remove('show');
  }

  function resetGame() {
    if (confirm('Reset skor dan mula semula dari awal?')) {
      initializeQuiz();
    }
  }

  function backToMenu() {
    if (confirm('Kembali ke menu utama? Skor semasa akan hilang.')) {
      document.getElementById('test-screen').style.display = 'none';
      document.getElementById('start-screen').style.display = 'flex';
      document.getElementById('result-screen').classList.add('hidden');
      document.getElementById('quiz-screen').classList.remove('hidden');
      closeReviewModal();
    }
  }

  // Quiz Data - Based on the questions provided
  const questions = [
    {
      question: "Semua yang berikut merupakan Liabiliti Semasa bagi sebuah pasar raya KECUALI",
      options: [
        "Akaun Belum Bayar",
        "Akaun Belum Terima",
        "Overdraft bank",
        "Pinjaman"
      ],
      answer: 1, // Akaun Belum Terima (this is an asset, not liability)
      explanation: "Akaun Belum Terima adalah aset semasa, bukannya liabiliti semasa."
    },
    {
      question: "Pilih penyataan yang benar tentang Ekuiti Pemilik",
      options: [
        "Tuntutan pihak luar tetap terhadap aset perniagaan",
        "Tuntutan pemilik terhadap aset perniagaan",
        "Harta yang digunakan untuk menjana pendapatan",
        "Hutang perniagaan terhadap pihak ketiga"
      ],
      answer: 1, // Tuntutan pemilik terhadap aset perniagaan
      explanation: "Ekuiti Pemilik mewakili tuntutan pemilik ke atas aset perniagaan selepas ditolak liabiliti."
    },
    {
      question: "Urus niaga yang manakah meningkatkan jumlah ekuiti pemilik?",
      options: [
        "Menerima komisen RM500",
        "Membayar insurans kebakaran RM600",
        "Memperoleh alatan pejabat secara kredit RM 3 000",
        "Membayar yuran kolej anak RM 2 000 melalui bank perniagaan"
      ],
      answer: 0, // Menerima komisen RM500
      explanation: "Menerima komisen meningkatkan pendapatan, seterusnya meningkatkan untung bersih dan ekuiti pemilik."
    },
    {
      question: "Berapakah ekuiti pemilik Perniagaan Tasik jika: Aset bukan semasa RM30,000, Aset semasa RM20,940, Liabiliti bukan semasa RM18,000, Liabiliti semasa RM1,740?",
      options: [
        "RM12,000",
        "RM31,200",
        "RM49,200",
        "RM55,000"
      ],
      answer: 1, // RM31,200
      explanation: "Ekuiti = Aset - Liabiliti = (30,000 + 20,940) - (18,000 + 1,740) = 50,940 - 19,740 = 31,200"
    },
    {
      question: "Yang manakah antara berikut bukan belanja operasi bagi sebuah kedai elektrik?",
      options: [
        "Kadar bayaran",
        "Belanja runcit",
        "Alat tulis",
        "Rugi pelupusan aset"
      ],
      answer: 3, // Rugi pelupusan aset
      explanation: "Rugi pelupusan aset adalah belanja bukan operasi, bukan belanja operasi."
    },
    {
      question: "Semua yang berikut adalah benar tentang Aset Bukan Semasa KECUALI",
      options: [
        "Aset Bukan Semasa dimiliki untuk dijual semua",
        "Aset Bukan Semasa digunakan untuk jangka masa panjang",
        "Aset Bukan Semasa sukar untuk ditukar menjadi tunai",
        "Hampir Semua Aset Bukan Semasa mengalami susut nilai"
      ],
      answer: 0, // Aset Bukan Semasa dimiliki untuk dijual semua
      explanation: "Aset bukan semasa dimiliki untuk digunakan dalam operasi perniagaan, bukan untuk dijual."
    },
    {
      question: "Semua persamaan perakunan berikut adalah betul KECUALI",
      options: [
        "Aset = Liabiliti + Modal",
        "Aset = Liabiliti + Modal + Untung Bersih",
        "Aset = Liabiliti + Modal + Rugi Bersih",
        "Aset = Liabiliti + Modal + Ambilan"
      ],
      answer: 3, // Aset = Liabiliti + Modal + Ambilan
      explanation: "Persamaan yang betul: Aset = Liabiliti + Modal (modal sudah termasuk untung/rugi dan ambilan)."
    },
    {
      question: "Kod 1000-1999 untuk Aset, 2000-2999 untuk Liabiliti, 3000-3999 untuk Hasil, 4000-4999 untuk Belanja. Yang manakah kod sesuai untuk Akaun Alat Tulis?",
      options: [
        "1000-1999",
        "2000-2999",
        "3000-3999",
        "4000-4999"
      ],
      answer: 3, // 4000-4999
      explanation: "Alat tulis adalah belanja, jadi kodnya dalam julat 4000-4999."
    },
    {
      question: "Antara berikut, yang manakah merupakan liabiliti jangka pendek?",
      options: [
        "Pinjaman bank 5 tahun",
        "Gaji belum bayar",
        "Gedung perniagaan",
        "Kenderaan"
      ],
      answer: 1, // Gaji belum bayar
      explanation: "Gaji belum bayar perlu dijelaskan dalam tempoh setahun, menjadikannya liabiliti semasa."
    },
    {
      question: "Apakah persamaan asas perakaunan?",
      options: [
        "Aset = Ekuiti + Liabiliti",
        "Aset + Liabiliti = Ekuiti",
        "Aset = Liabiliti + Ekuiti",
        "Liabiliti = Aset + Ekuiti"
      ],
      answer: 2, // Aset = Liabiliti + Ekuiti
      explanation: "Persamaan asas perakaunan: Aset = Liabiliti + Ekuiti Pemilik."
    },
    {
      question: "Yang manakah BUKAN ciri Aset Semasa?",
      options: [
        "Boleh ditukar kepada tunai dalam tempoh setahun",
        "Digunakan dalam operasi harian perniagaan",
        "Tidak mengalami susut nilai",
        "Biasanya bernilai tinggi berbanding aset bukan semasa"
      ],
      answer: 3, // Biasanya bernilai tinggi berbanding aset bukan semasa
      explanation: "Aset bukan semasa biasanya bernilai lebih tinggi daripada aset semasa."
    },
    {
      question: "Ekuiti pemilik akan berkurang dengan:",
      options: [
        "Menerima pinjaman bank",
        "Memperoleh untung bersih",
        "Pemilik membuat ambilan",
        "Membeli aset secara tunai"
      ],
      answer: 2, // Pemilik membuat ambilan
      explanation: "Ambilan oleh pemilik mengurangkan ekuiti pemilik."
    },
    {
      question: "Perniagaan mempunyai Aset RM50,000 dan Liabiliti RM20,000. Berapakah Ekuiti Pemilik?",
      options: [
        "RM20,000",
        "RM30,000",
        "RM50,000",
        "RM70,000"
      ],
      answer: 1, // RM30,000
      explanation: "Ekuiti = Aset - Liabiliti = 50,000 - 20,000 = 30,000"
    },
    {
      question: "Yang manakah merupakan belanja operasi?",
      options: [
        "Belian kenderaan",
        "Bayar dividen",
        "Bayar gaji pekerja",
        "Beli tanah"
      ],
      answer: 2, // Bayar gaji pekerja
      explanation: "Gaji pekerja adalah belanja operasi yang perlu dibayar untuk menjalankan operasi harian."
    },
    {
      question: "Transaksi yang manakah tidak mengubah jumlah aset?",
      options: [
        "Beli alatan secara kredit",
        "Beli stok dengan tunai",
        "Bayar hutang dengan tunai",
        "Pemilik buat modal tambahan"
      ],
      answer: 2, // Bayar hutang dengan tunai
      explanation: "Bayar hutang dengan tunai: Aset (tunai) ↓ dan Liabiliti (hutang) ↓, jumlah aset berkurang."
    }
  ];

  let currentQuestion = 0;
  let score = 0;
  let answered = 0;
  let skipped = 0;
  let selectedOption = null;
  let userAnswers = Array(questions.length).fill(null);
  let questionStatus = Array(questions.length).fill(null);
  let totalTime = 30 * 60;
  let timeLeft = totalTime;
  let quizTimer;
  let startTime;

  function initializeQuiz() {
    currentQuestion = 0;
    score = 0;
    answered = 0;
    skipped = 0;
    selectedOption = null;
    userAnswers = Array(questions.length).fill(null);
    questionStatus = Array(questions.length).fill(null);
    timeLeft = totalTime;
    
    document.getElementById('result-screen').classList.add('hidden');
    document.getElementById('quiz-screen').classList.remove('hidden');
    closeReviewModal();
    
    const progressContainer = document.getElementById('questionsProgress');
    progressContainer.innerHTML = '';
    questions.forEach((_, index) => {
      const dot = document.createElement('div');
      dot.className = 'progress-dot';
      dot.id = `progress-dot-${index}`;
      progressContainer.appendChild(dot);
    });
    
    updateProgressDots();
    startOverallTimer();
    displayQuestion();
  }

  function startOverallTimer() {
    startTime = Date.now();
    clearInterval(quizTimer);
    
    quizTimer = setInterval(() => {
      timeLeft--;
      updateTimerDisplay();
      
      if (timeLeft <= 0) {
        clearInterval(quizTimer);
        showResults();
      }
    }, 1000);
  }

  function updateTimerDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    const timeText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    document.getElementById('timeRemaining').textContent = timeText;
  }

  function updateProgressDots() {
    questions.forEach((_, index) => {
      const dot = document.getElementById(`progress-dot-${index}`);
      dot.className = 'progress-dot';
      
      if (index === currentQuestion) {
        dot.classList.add('active');
      } else if (questionStatus[index] !== null) {
        dot.classList.add('answered');
      }
    });
  }

  function displayQuestion() {
    selectedOption = null;
    const question = questions[currentQuestion];

    document.getElementById('currentQNum').textContent = currentQuestion + 1;
    document.getElementById('questionText').textContent = question.question;
    
    const questionImage = document.getElementById('questionImage');
    questionImage.style.display = 'none';
    
    const optionsContainer = document.getElementById('optionsContainer');
    optionsContainer.innerHTML = '';
    
    const letters = ['A', 'B', 'C', 'D'];
    question.options.forEach((option, index) => {
      const optionBtn = document.createElement('button');
      optionBtn.className = 'option-btn';
      optionBtn.innerHTML = `
        <div class="option-letter">${letters[index]}</div>
        <div class="option-text">${option}</div>
      `;
      optionBtn.onclick = () => selectOption(index);
      optionsContainer.appendChild(optionBtn);
    });
    
    const nextBtn = document.getElementById('nextBtn');
    const nextBtnText = document.getElementById('nextBtnText');
    
    if (currentQuestion === questions.length - 1) {
      nextBtnText.textContent = 'TAMAT UJIAN';
      nextBtn.classList.add('final-btn');
    } else {
      nextBtnText.textContent = 'SOALAN SETERUSNYA';
      nextBtn.classList.remove('final-btn');
    }
    
    nextBtn.disabled = true;
    
    updateProgressDots();
  }

  function selectOption(index) {
    const prevSelected = document.querySelector('.option-btn.selected');
    if (prevSelected) {
      prevSelected.classList.remove('selected');
    }
    
    selectedOption = index;
    const options = document.querySelectorAll('.option-btn');
    options[index].classList.add('selected');
    
    document.getElementById('nextBtn').disabled = false;
  }

  function nextQuestion() {
    userAnswers[currentQuestion] = selectedOption;
    
    if (selectedOption !== null) {
      answered++;
      
      const isCorrect = selectedOption === questions[currentQuestion].answer;
      if (isCorrect) {
        score++;
        questionStatus[currentQuestion] = true;
      } else {
        questionStatus[currentQuestion] = false;
      }
    } else {
      skipped++;
      questionStatus[currentQuestion] = false;
    }
    
    currentQuestion++;
    
    if (currentQuestion < questions.length) {
      displayQuestion();
    } else {
      showResults();
    }
  }

  function showResults() {
    clearInterval(quizTimer);
    
    const timeUsed = totalTime - timeLeft;
    const minutesUsed = Math.floor(timeUsed / 60);
    const secondsUsed = timeUsed % 60;
    const timeUsedText = `${minutesUsed.toString().padStart(2, '0')}:${secondsUsed.toString().padStart(2, '0')}`;
    
    const percentage = Math.round((score / questions.length) * 100);
    
    let grade;
    let gradeClass;
    
    if (percentage >= 90 && percentage <= 100) {
      grade = 'A+';
      gradeClass = 'a-plus';
      excellentSound.play();
    } else if (percentage >= 80 && percentage <= 89) {
      grade = 'A';
      gradeClass = 'a';
      excellentSound.play();
    } else if (percentage >= 70 && percentage <= 79) {
      grade = 'A-';
      gradeClass = 'a-minus';
    } else if (percentage >= 65 && percentage <= 69) {
      grade = 'B+';
      gradeClass = 'b-plus';
    } else if (percentage >= 60 && percentage <= 64) {
      grade = 'B';
      gradeClass = 'b';
    } else if (percentage >= 55 && percentage <= 59) {
      grade = 'C+';
      gradeClass = 'c-plus';
    } else if (percentage >= 50 && percentage <= 54) {
      grade = 'C';
      gradeClass = 'c';
      poorSound.play();
    } else if (percentage >= 45 && percentage <= 49) {
      grade = 'D';
      gradeClass = 'd';
      poorSound.play();
    } else if (percentage >= 40 && percentage <= 44) {
      grade = 'E';
      gradeClass = 'e';
      poorSound.play();
    } else {
      grade = 'F';
      gradeClass = 'f';
      poorSound.play();
    }
    
    document.getElementById('quiz-screen').classList.add('hidden');
    document.getElementById('result-screen').classList.remove('hidden');
    
    const gradeCircle = document.getElementById('gradeCircle');
    gradeCircle.textContent = grade;
    gradeCircle.className = 'grade-circle ' + gradeClass;
    
    document.getElementById('scoreText').textContent = percentage + '%';
    document.getElementById('finalScore').textContent = `${score}/${questions.length}`;
    document.getElementById('timeUsed').textContent = timeUsedText;
    
    saveScore(score);
  }

  function showReviewModal() {
    generateReviewSection();
    document.getElementById('review-modal').classList.add('show');
  }

  function closeReviewModal() {
    document.getElementById('review-modal').classList.remove('show');
  }

  function generateReviewSection() {
    const reviewSection = document.getElementById('review-section');
    const reviewSummary = document.getElementById('reviewSummary');
    
    let correctCount = 0;
    let incorrectCount = 0;
    
    questions.forEach((question, index) => {
      if (userAnswers[index] !== null) {
        if (userAnswers[index] === question.answer) {
          correctCount++;
        } else {
          incorrectCount++;
        }
      }
    });
    
    reviewSummary.innerHTML = `
      <div class="summary-item">
        <span class="summary-value correct-summary">${correctCount}</span>
        <span class="summary-label">Jawapan Betul</span>
      </div>
      <div class="summary-item">
        <span class="summary-value incorrect-summary">${incorrectCount}</span>
        <span class="summary-label">Jawapan Salah</span>
      </div>
      <div class="summary-item">
        <span class="summary-value" style="color: #ff4081;">${score}/${questions.length}</span>
        <span class="summary-label">Markah Akhir</span>
      </div>
    `;
    
    reviewSection.innerHTML = '';
    
    questions.forEach((question, index) => {
      const userAnswer = userAnswers[index];
      const correctAnswer = question.answer;
      const isCorrect = userAnswer === correctAnswer;
      
      const reviewQuestion = document.createElement('div');
      reviewQuestion.className = `review-question ${isCorrect ? 'correct' : 'incorrect'}`;
      
      const letters = ['A', 'B', 'C', 'D'];
      
      let optionsHTML = '';
      question.options.forEach((option, optIndex) => {
        let optionClass = '';
        
        if (optIndex === correctAnswer) {
          optionClass = 'correct-answer';
        }
        
        if (userAnswer !== null && optIndex === userAnswer && !isCorrect) {
          optionClass = 'user-answer';
        }
        
        let indicator = '';
        if (optIndex === correctAnswer) {
          indicator = '<span class="review-indicator correct-indicator">✓ Jawapan Betul</span>';
        } else if (userAnswer !== null && optIndex === userAnswer && !isCorrect) {
          indicator = '<span class="review-indicator incorrect-indicator">✗ Jawapan Anda</span>';
        }
        
        optionsHTML += `
          <div class="review-option ${optionClass}">
            <span class="review-option-label">${letters[optIndex]}</span>
            ${option} ${indicator}
          </div>
        `;
      });
      
      reviewQuestion.innerHTML = `
        <div class="review-question-header">
          <div class="review-question-number">Soalan ${index + 1}</div>
          <div class="review-status ${isCorrect ? 'correct' : 'incorrect'}">
            ${isCorrect ? 'BETUL' : 'SALAH'}
          </div>
        </div>
        <div class="review-question-text">${question.question}</div>
        <div style="font-size: 0.9em; color: #666; margin: 10px 0; padding: 10px; background: #f9f9f9; border-radius: 5px;">
          <strong>Penjelasan:</strong> ${question.explanation || 'Tiada penjelasan tambahan.'}
        </div>
        <div class="review-options">
          ${optionsHTML}
        </div>
      `;
      
      reviewSection.appendChild(reviewQuestion);
    });
  }

  function saveScore(score) {
    const formData = new FormData();
    formData.append('action', 'save_score_mcq2');
    formData.append('score', score);

    fetch('', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      console.log('Score saved:', data);
      if (data.highscore !== undefined) {
        document.getElementById('current-highscore').textContent = data.highscore;
        
        if (score === data.highscore && score > 0) {
          setTimeout(() => {
            alert(`🏆 TAHNIAH! Anda mencapai rekod baru: ${data.highscore}/15!`);
          }, 500);
        }
      }
    })
    .catch(error => {
      console.error('Error saving score:', error);
    });
  }

  function restartQuiz() {
    document.getElementById('result-screen').classList.add('hidden');
    document.getElementById('quiz-screen').classList.remove('hidden');
    closeReviewModal();
    initializeQuiz();
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    // Set up progress dots initially
    const progressContainer = document.getElementById('questionsProgress');
    if (progressContainer) {
      progressContainer.innerHTML = '';
      questions.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'progress-dot';
        dot.id = `progress-dot-${index}`;
        progressContainer.appendChild(dot);
      });
      updateProgressDots();
    }
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