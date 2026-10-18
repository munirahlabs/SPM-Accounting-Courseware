<?php
session_start();

// Handle AJAX requests for score saving
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_score') {
    $score = intval($_POST['score'] ?? 0);
    if (!isset($_SESSION['highscore']) || $score > $_SESSION['highscore']) {
        $_SESSION['highscore'] = $score;
    }
    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok', 'highscore' => $_SESSION['highscore']]);
    exit;
}

$highscore = $_SESSION['highscore'] ?? 0;
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>ACCsmart: SPM Accounting Game</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
      background: #f8faff;
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
      background: url('../img/wall8.png') center center/contain no-repeat;
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

    /* ---------- Quiz/Test Screen Styles ---------- */
    #test-screen {
      display: none;
      min-height: 100vh;
      background: white;
      padding: 40px 20px;
      position: relative;
      font-family: 'Poppins', sans-serif;
      overflow-y: auto;
      background: #faf7e9;
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
      background: rgba(255, 255, 255, 0.92);
      border-radius: 18px;
      padding: 20px 30px;
      text-align: center;
      margin-bottom: 25px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      width: 100%;
      box-sizing: border-box;
    }

    .game-header h1 {
      color: #3643d1;
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
      background: linear-gradient(135deg, #3643d1, #5a67d8);
      color: #fff;
      padding: 10px 22px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 3px 8px rgba(54, 67, 209, 0.3);
    }

    .test {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
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
      background: #f8f9fa;
      padding: 10px;
      border-radius: 10px;
    }

    .question-box {
      background: #f8f9fa;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 30px;
      border-left: 5px solid #667eea;
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
    }

    .options-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 15px;
      margin-bottom: 30px;
    }

    .option-btn {
      background: white;
      border: 2px solid #e0e0e0;
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
      border-color: #667eea;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
    }

    .option-btn.selected {
      background: #667eea;
      color: white;
      border-color: #667eea;
    }

    .option-letter {
      position: absolute;
      left: 20px;
      width: 30px;
      height: 30px;
      background: #e0e0e0;
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
      color: #667eea;
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
      background: #667eea;
      color: white;
      min-width: 220px;
    }

    .next-btn:hover {
      background: #5568d3;
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
    }

    .grade-circle {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      border: 10px solid #f44336;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 30px auto;
      font-size: 3em;
      font-weight: bold;
      color: #f44336;
    }

    .grade-circle.a-plus {
      border-color: #4CAF50;
      color: #4CAF50;
    }

    .grade-circle.a {
      border-color: #8BC34A;
      color: #8BC34A;
    }

    .grade-circle.a-minus {
      border-color: #9CCC65;
      color: #9CCC65;
    }

    .grade-circle.b-plus {
      border-color: #2196F3;
      color: #2196F3;
    }

    .grade-circle.b {
      border-color: #42A5F5;
      color: #42A5F5;
    }

    .grade-circle.c-plus {
      border-color: #FF9800;
      color: #FF9800;
    }

    .grade-circle.c {
      border-color: #FFB74D;
      color: #FFB74D;
    }

    .grade-circle.d {
      border-color: #FF5722;
      color: #FF5722;
    }

    .grade-circle.e {
      border-color: #795548;
      color: #795548;
    }

    .grade-circle.f {
      border-color: #f44336;
      color: #f44336;
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
      padding: 10px;
      background: #f8f9fa;
      border-radius: 10px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }

    .restart-btn {
      background: #667eea;
      color: white;
  margin-top: 0;  
      padding: 15px 50px;
      font-size: 1.1em;
    }

    .restart-btn:hover {
      background: #5568d3;
      transform: scale(1.05);
    }

    .hidden {
      display: none;
    }

    .question-number {
      display: inline-block;
      background: #667eea;
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
      background: #e0e0e0; /* Grey for not yet answered */
      transition: all 0.3s ease;
    }

    .progress-dot.active {
      background: #3498db; /* Blue for current question being answered */
    }

    .progress-dot.answered {
      background: #555; /* Dark grey for already answered */
    }

    /* Style for last question button */
    .final-btn {
      background: #ff9800 !important;
    }

    .final-btn:hover {
      background: #e68900 !important;
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
    }

    .review-title {
      text-align: center;
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 20px;
      color: #3643d1;
      padding-bottom: 10px;
      border-bottom: 2px solid #f0f0f0;
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
      background: #f1f8e9;
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
      border: 1px solid #e0e0e0;
      background: #fafafa;
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
      background: #e0e0e0;
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
      background: #9c27b0;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.3s ease;
      font-size: 1em;
      order: -1;          /* forces it to the top */
      margin-bottom: 3px;
    }

    .toggle-review-btn:hover {
      background: #7b1fa2;
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
      background: #f8f9fa;
      border-radius: 10px;
      font-weight: 600;
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
        <h2>Arahan Permainan</h2>
        <p>Selamat datang ke <b>ACCsmart: SPM Quiz</b>! 🧮</p>
        <ul style="text-align:left; line-height:1.6; display: block;">
          <li>👉 Anda akan menjawab 15 soalan pilihan berganda.</li>
          <li>⏱️ Anda mempunyai masa keseluruhan 30 minit (1.875 minit/soalan).</li>
          <li>✅ Pilih jawapan dengan klik pada pilihan A, B, C atau D.</li>
          <li>⏭️ Klik butang "SOALAN SETERUSNYA" untuk terus ke soalan berikutnya.</li>
          <li>🎯 Objektif anda adalah untuk mendapat markah setinggi mungkin!</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()">Tutup</button>
      </div>
    </div>

    <!-- TEST SCREEN -->
    <section id="test-screen">
      <div class="game-container">
        <div class="game-header">
          <div class="game-top-controls">
            <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
            <button class="control-btn home" onclick="backToMenu()">🏠 Home</button>
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
              <h1>TAMAT UJIAN!</h1>
            </div>
            
            <div class="grade-circle" id="gradeCircle">A+</div>
            
            <div class="score-text" id="scoreText">80%</div>
            <!-- Only show MARKAH ANDA and Masa digunakan -->
            <div class="result-details">MARKAH ANDA: <span id="finalScore">12/15</span></div>
            <div class="result-details">Masa digunakan: <span id="timeUsed">28:15</span></div>
            
            <div class="result-actions">
              <button class="toggle-review-btn" onclick="showReviewModal()">
                <i class="fas fa-chart-bar"></i> SEMAK SEMULA JAWAPAN
              </button>

              <button class="restart-btn" onclick="restartQuiz()">
                <i class="fas fa-redo"></i> CUBA LAGI
              </button>

              <button class="restart-btn" onclick="backToMenu()" style="background: #ff9800;">
                <i class="fas fa-home"></i> MENU UTAMA
              </button>
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
    <div class="review-title">SEMAKAN SEMULA JAWAPAN</div>
    
    <div class="review-summary" id="reviewSummary">
      <!-- Summary will be inserted here -->
    </div>
    
    <div id="review-section"></div>
    
    <div style="text-align: center; margin-top: 20px;">
      <button class="toggle-review-btn" onclick="closeReviewModal()" style="background: #667eea;">
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

  // Quiz Data - Accounting questions based on NOTA BAB 1
const questions = [
    {
      question: "Apakah aktiviti pertama dalam Simpan Kira dan Perakaunan?",
      options: [
        "Merekod",
        "Mengumpul", 
        "Menyusun",
        "Menilai"
      ],
      answer: 1, // Mengumpul
      image: null
    },
    {
      question: "Aktiviti 'Merekod' dalam perakaunan merujuk kepada:",
      options: [
        "Menulis transaksi ke dalam jurnal atau buku tunai",
        "Mengasingkan dokumen mengikut tarikh",
        "Menyediakan penyata kewangan",
        "Mengkaji maklumat kewangan"
      ],
      answer: 0,
      image: null
    },
    {
      question: "Manakah antara berikut BUKAN langkah dalam Kitaran Perakaunan?",
      options: [
        "Dokumen Perniagaan",
        "Buku Catatan Pertama", 
        "Pemasaran Produk",
        "Imbangan Duga"
      ],
      answer: 2,
      image: null
    },
    {
      question: "Subbidang Perakaunan yang memeriksa dokumen perniagaan dan rekod kewangan ialah:",
      options: [
        "Perakaunan Pengurusan",
        "Pengauditan",
        "Percukaian", 
        "Perakaunan Kewangan"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Badan perakaunan yang menggubal piawaian perakaunan antarabangsa ialah:",
      options: [
        "CIMA",
        "MICPA", 
        "MIA",
        "IASB"
      ],
      answer: 3,
      image: null
    },
    {
      question: "Andaian perakaunan yang memisahkan urus niaga perniagaan daripada urus niaga peribadi pemilik ialah:",
      options: [
        "Tempoh Perakaunan",
        "Entiti Berasingan", 
        "Usaha Berterusan",
        "Wang sebagai Ukuran"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Prinsip perakaunan yang memastikan semua aset direkod berdasarkan harga perolehan ialah:",
      options: [
        "Prinsip Kos", 
        "Prinsip Ketekalan",
        "Prinsip Pengiktirafan Hasil",
        "Prinsip Pencocokan"
      ],
      answer: 0,
      image: null
    },
    {
      question: "Batas perakaunan yang mempertimbangkan keseimbangan antara manfaat maklumat dengan kos penyediaannya ialah:",
      options: [
        "Batas Materialiti",
        "Batas Kos-Manfaat", 
        "Batas Ketekalan",
        "Batas Konservatisme"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Aktiviti 'Menganalisis' dalam perakaunan bermaksud:",
      options: [
        "Menyediakan penyata kewangan",
        "Mengkaji maklumat kewangan untuk melihat prestasi", 
        "Menjelaskan maksud keputusan kewangan",
        "Menentukan strategi kewangan"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Manakah antara berikut merupakan fungsi Perakaunan Pengurusan?",
      options: [
        "Menyediakan maklumat untuk pengguna dalaman", 
        "Memeriksa dokumen perniagaan",
        "Menyediakan penyata cukai",
        "Menyeragamkan laporan kewangan"
      ],
      answer: 0,
      image: null
    },
    {
      question: "Langkah 'Pelarasan' dalam Kitaran Perakaunan dilakukan sebelum:",
      options: [
        "Imbangan Duga",
        "Imbangan Duga Terselaras", 
        "Catatan Penutupan",
        "Penyata Kewangan"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Andaian 'Usaha Berterusan' menganggap perniagaan akan:",
      options: [
        "Beroperasi untuk tempoh yang tidak terbatas", 
        "Ditutup dalam masa terdekat",
        "Beroperasi untuk satu tempoh sahaja",
        "Bergantung kepada pemilik semata-mata"
      ],
      answer: 0,
      image: null
    },
    {
      question: "Aktiviti 'Merancang' dalam perakaunan termasuk:",
      options: [
        "Merekod transaksi",
        "Menilai prestasi",
        "Menetapkan bajet dan sasaran", 
        "Menyimpan dokumen"
      ],
      answer: 2,
      image: null
    },
    {
      question: "Badan profesional yang melahirkan akauntan pengurusan ialah:",
      options: [
        "MIA",
        "CIMA", 
        "MICPA",
        "IASB"
      ],
      answer: 1,
      image: null
    },
    {
      question: "Prinsip 'Ketekalan' dalam perakaunan memastikan:",
      options: [
        "Semua hasil diiktiraf dengan betul",
        "Konsistensi dalam prosedur perakaunan", 
        "Aset direkod pada nilai pasaran",
        "Pendedahan penuh maklumat"
      ],
      answer: 1,
      image: null
    }
  ];

  let currentQuestion = 0;
  let score = 0;
  let answered = 0;
  let skipped = 0;
  let selectedOption = null;
  let userAnswers = Array(questions.length).fill(null); // Store user's answers
  let questionStatus = Array(questions.length).fill(null); // null = not answered, true/false = answered
  let totalTime = 30 * 60; // 30 minutes in seconds
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
    
    // Reset result screen
    document.getElementById('result-screen').classList.add('hidden');
    document.getElementById('quiz-screen').classList.remove('hidden');
    closeReviewModal();
    
    // Initialize progress dots
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
        dot.classList.add('active'); // Blue for current question
      } else if (questionStatus[index] !== null) {
        dot.classList.add('answered'); // Dark grey for answered
      }
      // Grey (default) for not yet answered
    });
  }

  function displayQuestion() {
    selectedOption = null;
    const question = questions[currentQuestion];

    document.getElementById('currentQNum').textContent = currentQuestion + 1;
    document.getElementById('questionText').textContent = question.question;
    
    // Show/hide image
    const questionImage = document.getElementById('questionImage');
    if (question.image) {
      questionImage.src = `../img/questions/${question.image}`;
      questionImage.style.display = 'block';
      // For demo, use placeholder
      questionImage.src = `https://placehold.co/600x300/667eea/ffffff?text=Question+${currentQuestion+1}+Image`;
    } else {
      questionImage.style.display = 'none';
    }
    
    // Create options
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
    
    // Update button text based on question number
    const nextBtn = document.getElementById('nextBtn');
    const nextBtnText = document.getElementById('nextBtnText');
    
    if (currentQuestion === questions.length - 1) {
      nextBtnText.textContent = 'TAMAT UJIAN';
      nextBtn.classList.add('final-btn');
    } else {
      nextBtnText.textContent = 'SOALAN SETERUSNYA';
      nextBtn.classList.remove('final-btn');
    }
    
    // Disable the next button initially
    nextBtn.disabled = true;
    
    updateProgressDots();
  }

  function selectOption(index) {
    // Deselect previous option
    const prevSelected = document.querySelector('.option-btn.selected');
    if (prevSelected) {
      prevSelected.classList.remove('selected');
    }
    
    // Select new option
    selectedOption = index;
    const options = document.querySelectorAll('.option-btn');
    options[index].classList.add('selected');
    
    // Enable the next button when an answer is selected
    document.getElementById('nextBtn').disabled = false;
  }

  function nextQuestion() {
    // Store user's answer
    userAnswers[currentQuestion] = selectedOption;
    
    // Check if answer was selected
    if (selectedOption !== null) {
      answered++;
      
      // Check if answer is correct (no sound played during quiz)
      const isCorrect = selectedOption === questions[currentQuestion].answer;
      if (isCorrect) {
        score++;
        questionStatus[currentQuestion] = true;
      } else {
        questionStatus[currentQuestion] = false;
      }
    } else {
      // No answer selected - count as skipped
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
    
    // Calculate time used
    const timeUsed = totalTime - timeLeft;
    const minutesUsed = Math.floor(timeUsed / 60);
    const secondsUsed = timeUsed % 60;
    const timeUsedText = `${minutesUsed.toString().padStart(2, '0')}:${secondsUsed.toString().padStart(2, '0')}`;
    
    // Calculate percentage
    const percentage = Math.round((score / questions.length) * 100);
    
    // Determine grade based on SPM grading system
    let grade;
    let gradeClass;
    
    if (percentage >= 90 && percentage <= 100) {
      grade = 'A+';
      gradeClass = 'a-plus';
      excellentSound.play(); // Sound only plays at final results
    } else if (percentage >= 80 && percentage <= 89) {
      grade = 'A';
      gradeClass = 'a';
      excellentSound.play(); // Sound only plays at final results
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
      poorSound.play(); // Sound only plays at final results
    } else if (percentage >= 45 && percentage <= 49) {
      grade = 'D';
      gradeClass = 'd';
      poorSound.play(); // Sound only plays at final results
    } else if (percentage >= 40 && percentage <= 44) {
      grade = 'E';
      gradeClass = 'e';
      poorSound.play(); // Sound only plays at final results
    } else {
      grade = 'F';
      gradeClass = 'f';
      poorSound.play(); // Sound only plays at final results
    }
    
    // Update result screen
    document.getElementById('quiz-screen').classList.add('hidden');
    document.getElementById('result-screen').classList.remove('hidden');
    
    const gradeCircle = document.getElementById('gradeCircle');
    gradeCircle.textContent = grade;
    gradeCircle.className = 'grade-circle ' + gradeClass;
    
    document.getElementById('scoreText').textContent = percentage + '%';
    document.getElementById('finalScore').textContent = `${score}/${questions.length}`;
    document.getElementById('timeUsed').textContent = timeUsedText;
    
    // Save score to session
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
    
    // Calculate correct and incorrect answers
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
    
    // Update summary
    reviewSummary.innerHTML = `
      <div class="summary-item">
        <span class="summary-value correct-summary">${correctCount}</span>
        <span class="summary-label">Betul</span>
      </div>
      <div class="summary-item">
        <span class="summary-value incorrect-summary">${incorrectCount}</span>
        <span class="summary-label">Salah</span>
      </div>
      <div class="summary-item">
        <span class="summary-value">${score}/${questions.length}</span>
        <span class="summary-label">Markah</span>
      </div>
    `;
    
    // Clear existing review content
    reviewSection.innerHTML = '';
    
    questions.forEach((question, index) => {
      const userAnswer = userAnswers[index];
      const correctAnswer = question.answer;
      const isCorrect = userAnswer === correctAnswer;
      
      const reviewQuestion = document.createElement('div');
      reviewQuestion.className = `review-question ${isCorrect ? 'correct' : 'incorrect'}`;
      
      const letters = ['A', 'B', 'C', 'D'];
      
      // Create options HTML
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
        <div class="review-options">
          ${optionsHTML}
        </div>
      `;
      
      reviewSection.appendChild(reviewQuestion);
    });
  }

  function saveScore(score) {
    const formData = new FormData();
    formData.append('action', 'save_score');
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
        
        // Show new highscore message if achieved
        if (data.current_score === data.highscore && data.current_score > 0) {
          setTimeout(() => {
            alert(`🎉 Tahniah! Anda mencapai rekod baru: ${data.highscore}/15!`);
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