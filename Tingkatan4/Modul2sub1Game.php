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
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">
  <title>ACCsmart: Latihan Minda 2.1 - Drag & Drop</title>
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
      background: url('../img/27.png') center center/contain no-repeat;
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

    .instructions {
      background:  rgba(255, 241, 221, 1);
      border-left: 5px solid #ff9800;
      padding: 18px 25px;
      margin-bottom: 3px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(255, 152, 0, 0.2);
      border: 2px solid #ffb74d;
    }

    .instructions p {
      color: #e65100;
      line-height: 1.8;
      font-weight: 500;
      margin: 0;
      font-size: 1.25rem;
    }

    .game-area {
      display: flex;
      gap: 30px;
      margin-top: 30px;
    }

    .items-pool {
      flex: 1;
      background: linear-gradient(145deg, #ffffff 0%, #f8f9ff 100%);
      padding: 25px;
      border-radius: 15px;
      border: 3px solid #e0e7ff;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
      transition: all 0.3s ease;
    }

    .items-pool:hover {
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.25);
    }

    .items-pool h3 {
      color: #000000ff;
      margin-bottom: 20px;
      font-size: 1.3rem;
      font-weight: 700;
      text-align: center;
      padding-bottom: 15px;
      border-bottom: 3px solid #000000ff;
    }

    .items-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 12px;
    }

.draggable-item {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 14px 18px;
  border-radius: 12px;
  cursor: grab;
  user-select: none;
  text-align: center;
  font-size: 14px;
  font-weight: 600;
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
  transition: all 0.3s ease;
  border: 2px solid rgba(255, 255, 255, 0.2);
  opacity: 1 !important; /* Ensure full opacity */
}

    .draggable-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 18px rgba(102, 126, 234, 0.5);
    }

    .draggable-item:active {
      cursor: grabbing;
    }

.draggable-item.dragging {
  cursor: grabbing;
  opacity: 1; /* Change from 0.6 to 1 */
  transform: scale(1.05);
}

.drop-zone .draggable-item {
  font-size: 13px;
  padding: 10px 15px;
  cursor: grab;
  opacity: 1 !important;
}

    .draggable-item.correct-item {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
      color: white !important;
      border-color: rgba(56, 239, 125, 0.5) !important;
    }

    .draggable-item.incorrect-item {
      background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%) !important;
      color: white !important;
      border-color: rgba(244, 92, 67, 0.5) !important;
    }

    .drop-zones {
      flex: 1.5;
    }

    .drop-section {
      margin-bottom: 25px;
      background: rgba(255, 255, 255, 0.95);
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border: 2px solid #e0e7ff;
    }

    .section-title {
      background: #6A8C77;
      color: white;
      padding: 15px 25px;
      border-radius: 12px;
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 1.2rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(9, 163, 91, 0.3);
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .drop-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .drop-table th {
      background: #9ACCAD;
      color: white;
      padding: 15px;
      text-align: left;
      font-weight: 700;
      font-size: 1.05rem;
      border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .drop-table th:first-child {
      border-top-left-radius: 12px;
    }

    .drop-table th:last-child {
      border-top-right-radius: 12px;
    }

    .drop-table td {
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      background: white;
      font-weight: 500;
    }

    .drop-table tr:nth-child(even) td {
      background: #f8f9ff;
    }

    .drop-zone {
      min-height: 50px;
      background: linear-gradient(145deg, #f5f5f5 0%, #fafafa 100%);
      border: 3px dashed #bbb;
      border-radius: 8px;
      padding: 10px;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      align-items: center;
      transition: all 0.3s ease;
    }

    .drop-zone.drag-over {
      background: linear-gradient(145deg, #e3f2fd 0%, #bbdefb 100%);
      border-color: #2196f3;
      border-style: solid;
      box-shadow: 0 0 15px rgba(33, 150, 243, 0.3);
      transform: scale(1.02);
    }

    .drop-zone.correct {
      background: linear-gradient(145deg, #c8e6c9 0%, #a5d6a7 100%);
      border-color: #4caf50;
      border-style: solid;
      box-shadow: 0 0 15px rgba(76, 175, 80, 0.3);
    }

    .drop-zone.incorrect {
      background: linear-gradient(145deg, #ffcdd2 0%, #ef9a9a 100%);
      border-color: #f44336;
      border-style: solid;
      box-shadow: 0 0 15px rgba(244, 67, 54, 0.3);
    }

    .drop-zone .draggable-item {
      font-size: 13px;
      padding: 10px 15px;
      cursor: grab;
    }

    /* Next Button */
    .next-btn {
      background: linear-gradient(135deg, #4caf50, #45a049);
      color: white;
      border: none;
      padding: 15px 40px;
      border-radius: 30px;
      font-size: 1.2rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
      display: block;
      margin: 30px auto;
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .next-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(76, 175, 80, 0.5);
    }

    .next-btn:active {
      transform: translateY(-1px);
    }

    .items-pool.highlight {
      animation: highlightBox 1.5s ease-in-out;
      border: 3px solid #ff9800 !important;
      box-shadow: 0 0 25px rgba(255, 152, 0, 0.6) !important;
    }

    @keyframes highlightBox {
      0% {
        box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.7);
        transform: scale(1);
      }
      50% {
        box-shadow: 0 0 25px 15px rgba(255, 152, 0, 0.4);
        transform: scale(1.02);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(255, 152, 0, 0);
        transform: scale(1);
      }
    }

    .items-pool .highlight-item {
      animation: pulseItem 1s ease-in-out;
    }

    /* TOAST NOTIFICATION */
    .toast-notification {
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%) translateY(100px);
      background: linear-gradient(135deg, #ff9800, #ff5722);
      color: white;
      padding: 20px 35px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(255, 87, 34, 0.4);
      z-index: 9999;
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 600;
      font-size: 1.1rem;
      opacity: 0;
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      max-width: 90%;
      min-width: 320px;
      text-align: center;
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .toast-notification.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }

    .toast-icon {
      font-size: 2rem;
      flex-shrink: 0;
    }

    .toast-content {
      flex: 1;
    }

    .toast-notification.warning {
      background: linear-gradient(135deg, #ff9800, #ff5722);
    }

    .toast-notification.success {
      background: linear-gradient(135deg, #4CAF50, #2E7D32);
    }

    @keyframes pulseButton {
      0% { 
        transform: scale(1); 
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
      }
      50% { 
        transform: scale(1.05); 
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.6);
      }
      100% { 
        transform: scale(1); 
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
      }
    }

    @keyframes pulseItem {
      0%, 100% {
        transform: translateY(0);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
      }
      50% {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.6);
      }
    }

    /* Feedback Modal */
    .match-feedback {
      animation: fadeInScale 0.3s ease;
    }

    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
      }
      to {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
      }
    }

    .start-btn {
      background-color: white;
      border: 2px solid black;
      color: black;
      padding: 10px 35px;
      border-radius: 25px;
      font-size: 1.05rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .start-btn:hover {
      background-color: #68ede7;
      color: #fff;
      transform: scale(1.05);
    }

    /* ---------- RESULT SCREEN ---------- */
     #result-screen {
      display: none;
      position: relative;
      min-height: 100vh;
      background: url('../img/16.png') center center / cover no-repeat;
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

    .result-card .trophy {
      font-size: 5rem;
    }

    .result-card h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #3b82f6;
    }

    .result-card p {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    .result-card .final-score {
      font-size: 3rem;
      font-weight: 800;
      color: #667eea;
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

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      .game-area {
        flex-direction: column;
      }

      .items-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      }
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

    <!-- Instruction Modal -->
    <div id="instruction-modal">
      <div class="modal-overlay" onclick="closeInstructions()"></div>
      <div class="modal-content">
        <h2>Arahan Permainan</h2>
        <p><strong>Arahan:</strong> Permainan ini mempunyai 2 level:</p>
        <ul style="text-align:left; line-height:1.6; display: block;">
          <li><strong>Level 1:</strong> Akaun Perdagangan dan Untung Rugi</li>
          <li><strong>Level 2:</strong> Penyata Kedudukan Kewangan</li>
          <li>👉 Seret dan lepaskan item ke komponen yang betul</li>
          <li>✅ Setiap jawapan akan disemak secara automatik</li>
          <li>➡️ Tekan butang "Seterusnya" selepas jawab semua soalan</li>
          <li>🎯 Dapatkan markah penuh untuk kedua-dua level!</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()">Tutup</button>
      </div>
    </div>

    <section id="game-screen">
      <div class="game-container">
        <div class="game-header">
          <div class="game-top-controls">
            <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
            <button class="control-btn home" onclick="backToMenu()">🏠 Laman Utama</button>
          </div>
          <h2>🎯 Permainan Komponen Klasifikasi Akaun</h2>
          <div class="game-stats">
            <div class="stat-box">📊 Level: <span id="currentLevel">1</span>/2</div>
            <div class="stat-box">⭐ Skor: <span id="score">0</span>/<span id="totalQuestions">11</span></div>
          </div>
        </div>

        <div class="instructions">
          <p id="levelInstruction"><strong> Level 1:</strong> Seret item ke komponen Akaun Perdagangan dan Untung Rugi yang betul. Setiap jawapan akan disemak secara automatik.</p>
        </div>

        <div class="game-area">
          <div class="items-pool">
            <h3>📦 Item untuk Diklasifikasikan</h3>
            <div class="items-grid" id="itemsPool">
              <!-- Items will be generated here -->
            </div>
          </div>

          <div class="drop-zones" id="dropZones">
            <!-- Drop zones will be generated based on current level -->
          </div>
        </div>

        <button class="next-btn" id="nextBtn" onclick="handleNextClick()">Seterusnya →</button>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Permainan Selesai!</h2>
        <p id="resultText" style="color: #6b7280; margin: 15px 0;">--</p>
        <div class="final-score" id="finalScore">0/0</div>

        <div class="result-btns-vertical">
          <a href="javascript:void(0)" class="button-33 first-btn" onclick="tryAgain()">Cuba lagi</a>
          <a href="javascript:void(0)" class="button-33 second-btn" onclick="backToMenu()">Menu Utama</a>
        </div>
      </div>
    </section>

    <!-- TOAST NOTIFICATION -->
    <div id="toast-notification" class="toast-notification warning">
      <div class="toast-icon">⚠️</div>
      <div class="toast-content">
        Sila lengkapkan semua soalan terlebih dahulu
      </div>
    </div>

  </main>
</div>

<button class="floating-toggle" id="floatingToggle">☰</button>

<script src="../js/navigation.js"></script>

<script>
// DOM Elements
const startScreen = document.getElementById('start-screen');
const instrScreen = document.getElementById('instruction-modal');
const gameScreen = document.getElementById('game-screen');
const resultScreen = document.getElementById('result-screen');
const scoreEl = document.getElementById('score');
const totalQuestionsEl = document.getElementById('totalQuestions');
const currentLevelEl = document.getElementById('currentLevel');
const levelInstruction = document.getElementById('levelInstruction');
const resultText = document.getElementById('resultText');
const finalScore = document.getElementById('finalScore');
const nextBtn = document.getElementById('nextBtn');
const dropZonesContainer = document.getElementById('dropZones');

// Game Variables
let currentLevel = 1;
let currentScore = 0;
let level1Score = 0;
let level2Score = 0;
let draggedElement = null;
let correctAnswers = new Set();

// Assign unique solid colors to each item text
const itemColors = {
  // Level 1 Items
  'Angkutan masuk': { bg: '#4CAF50', text: 'white' },
  'Jualan': { bg: '#2196F3', text: 'white' },
  'Angkutan keluar': { bg: '#FF9800', text: 'white' },
  'Komisen diterima': { bg: '#9C27B0', text: 'white' },
  'Pulangan belian': { bg: '#00BCD4', text: 'white' },
  'Alat tulis': { bg: '#FF5722', text: 'white' },
  'Faedah simpanan': { bg: '#795548', text: 'white' },
  'Upah atas belian': { bg: '#607D8B', text: 'white' },
  'Faedah pinjaman': { bg: '#E91E63', text: 'white' },
  'Belanja am': { bg: '#3F51B5', text: 'white' },
  'Kadar bayaran': { bg: '#009688', text: 'white' },
  
  // Level 2 Items
  'Tunai': { bg: '#FFC107', text: 'white' },
  'Inventori akhir': { bg: '#8BC34A', text: 'white' },
  'Ambilan': { bg: '#CDDC39', text: 'white' },
  'Akaun Belum Terima': { bg: '#7986CB', text: 'white' },
  'Modal': { bg: '#FF9800', text: 'white' },
  'Akaun Belum Bayar': { bg: '#FF5722', text: 'white' },
  'Pinjaman': { bg: '#795548', text: 'white' },
  'Premis': { bg: '#607D8B', text: 'white' },
  'Alatan kedai': { bg: '#9C27B0', text: 'white' }
};

// Level 1: Akaun Perdagangan dan Untung Rugi
const level1Items = [
  { text: 'Angkutan masuk', category: 'kos-jualan' },
  { text: 'Jualan', category: 'jualan-bersih' },
  { text: 'Angkutan keluar', category: 'belanja' },
  { text: 'Komisen diterima', category: 'hasil' },
  { text: 'Pulangan belian', category: 'kos-jualan' },
  { text: 'Alat tulis', category: 'belanja' },
  { text: 'Faedah simpanan', category: 'hasil' },
  { text: 'Upah atas belian', category: 'kos-jualan' },
  { text: 'Faedah pinjaman', category: 'belanja' },
  { text: 'Belanja am', category: 'belanja' },
  { text: 'Kadar bayaran', category: 'belanja' }
];

// Level 2: Penyata Kedudukan Kewangan
const level2Items = [
  { text: 'Tunai', category: 'aset-semasa' },
  { text: 'Inventori akhir', category: 'aset-semasa' },
  { text: 'Ambilan', category: 'ekuiti-pemilik' },
  { text: 'Akaun Belum Terima', category: 'aset-semasa' },
  { text: 'Modal', category: 'ekuiti-pemilik' },
  { text: 'Akaun Belum Bayar', category: 'liabiliti-semasa' },
  { text: 'Pinjaman', category: 'liabiliti-bukan-semasa' },
  { text: 'Premis', category: 'aset-bukan-semasa' },
  { text: 'Alatan kedai', category: 'aset-bukan-semasa' }
];

// Sound Effects
const correctSound = new Audio("../audio/correct_answer_sound.mp3");
const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
const excellentSound = new Audio("../audio/congrats_sound.mp3");
const poorSound = new Audio("../audio/fail_sound.mp3");

function startGame() {
  startScreen.style.display = 'none';
  gameScreen.style.display = 'block';
  currentLevel = 1;
  currentScore = 0;
  level1Score = 0;
  level2Score = 0;
  correctAnswers.clear();
  
  const nextBtn = document.getElementById('nextBtn');
  nextBtn.classList.remove('pulse-warning');
  nextBtn.style.display = 'block';
  
  window.isLevelComplete = false;
  
  updateScore();
  loadLevel(1);
}

function showInstructions() {
  instrScreen.classList.add('show');
}

function closeInstructions() {
  instrScreen.classList.remove('show');
}

function resetGame() {
    if (confirm('Reset skor dan mula semula dari awal?')) {
      startGame();
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

function updateScore() {
  currentScore = level1Score + level2Score;
  scoreEl.textContent = currentScore;
  currentLevelEl.textContent = currentLevel;
  
  const totalItems = level1Items.length + level2Items.length;
  totalQuestionsEl.textContent = totalItems;
}

function nextLevel() {
  if (currentLevel === 1) {
    currentLevel = 2;
    correctAnswers.clear();
    nextBtn.style.display = 'block';
    loadLevel(2);
  } else {
    showResultScreen();
  }
}

function loadLevel(level) {
  currentLevel = level;
  currentLevelEl.textContent = level;
  
  const nextBtn = document.getElementById('nextBtn');
  nextBtn.classList.remove('pulse-warning');
  nextBtn.style.display = 'block';
  
  const itemsPoolBox = document.querySelector('.items-pool');
  if (itemsPoolBox) {
    itemsPoolBox.classList.remove('highlight');
  }
  
if (level === 1) {
    levelInstruction.innerHTML = `
        <span style="font-size: 1.2em; margin-right: 8px;">💡</span>
        <strong>Level 1:</strong> Padankan "Item untuk Diklasifikasikan" ke kotak jawapan komponen Akaun Perdagangan yang betul.
    `;
    loadLevel1();
} else {
    levelInstruction.innerHTML = `
        <span style="font-size: 1.2em; margin-right: 8px;">💡</span>
        <strong>Level 2:</strong> Seret item ke komponen Penyata Kedudukan Kewangan yang betul. Setiap jawapan akan disemak secara automatik.
    `;
    loadLevel2();
}
  
  updateScore();
}

function loadLevel1() {
  const pool = document.getElementById('itemsPool');
  pool.innerHTML = '';
  
  level1Items.forEach((item, index) => {
    const itemEl = document.createElement('div');
    itemEl.className = 'draggable-item';
    itemEl.draggable = true;
    itemEl.textContent = item.text;
    itemEl.dataset.category = item.category;
    itemEl.dataset.index = 'l1-' + index;
    itemEl.dataset.originalText = item.text;
    
    // Apply unique solid color
    const colors = itemColors[item.text];
    if (colors) {
      itemEl.style.background = colors.bg;
      itemEl.style.color = colors.text;
      itemEl.style.border = `2px solid ${colors.bg}`;
    }
    
    itemEl.addEventListener('dragstart', handleDragStart);
    itemEl.addEventListener('dragend', handleDragEnd);
    
    pool.appendChild(itemEl);
  });

  dropZonesContainer.innerHTML = `
    <div class="drop-section">
      <div class="section-title" style="background-color: #3643d1; color: white; border: 2px solid #3643d1;">Akaun Perdagangan dan Untung Rugi</div>
      <table class="drop-table">
        <thead>
          <tr>
            <th style="width: 40%; background-color: #3643d1; color: white; border: 2px solid #3643d1;">Komponen</th>
            <th style="background-color: #3643d1; color: white; border: 2px solid #3643d1;">Akaun</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;">Jualan Bersih</td>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="jualan-bersih"></div></td>
          </tr>
          <tr>
            <td style="background-color: white; border: 2px solid #e0e0e0;">Kos Jualan</td>
            <td style="background-color: white; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="kos-jualan"></div></td>
          </tr>
          <tr>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;">Hasil</td>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="hasil"></div></td>
          </tr>
          <tr>
            <td style="background-color: white; border: 2px solid #e0e0e0;">Belanja</td>
            <td style="background-color: white; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="belanja"></div></td>
          </tr>
        </tbody>
      </table>
    </div>
  `;

  initDropZones();
}

function loadLevel2() {
  const pool = document.getElementById('itemsPool');
  pool.innerHTML = '';
  
  level2Items.forEach((item, index) => {
    const itemEl = document.createElement('div');
    itemEl.className = 'draggable-item';
    itemEl.draggable = true;
    itemEl.textContent = item.text;
    itemEl.dataset.category = item.category;
    itemEl.dataset.index = 'l2-' + index;
    itemEl.dataset.originalText = item.text;
    
    // Apply unique solid color
    const colors = itemColors[item.text];
    if (colors) {
      itemEl.style.background = colors.bg;
      itemEl.style.color = colors.text;
      itemEl.style.border = `2px solid ${colors.bg}`;
    }
    
    itemEl.addEventListener('dragstart', handleDragStart);
    itemEl.addEventListener('dragend', handleDragEnd);
    
    pool.appendChild(itemEl);
  });

  dropZonesContainer.innerHTML = `
    <div class="drop-section">
      <div class="section-title">Penyata Kedudukan Kewangan</div>
      <table class="drop-table">
        <thead>
          <tr>
            <th style="width: 40%; background-color: #6A8C77; color: white; border: 2px solid #6A8C77;">Komponen</th>
            <th style="background-color: #6A8C77; color: white; border: 2px solid #6A8C77;">Akaun</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;">Aset Semasa</td>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="aset-semasa"></div></td>
          </tr>
          <tr>
            <td style="background-color: white; border: 2px solid #e0e0e0;">Aset Bukan Semasa</td>
            <td style="background-color: white; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="aset-bukan-semasa"></div></td>
          </tr>
          <tr>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;">Liabiliti Semasa</td>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="liabiliti-semasa"></div></td>
          </tr>
          <tr>
            <td style="background-color: white; border: 2px solid #e0e0e0;">Liabiliti Bukan Semasa</td>
            <td style="background-color: white; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="liabiliti-bukan-semasa"></div></td>
          </tr>
          <tr>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;">Ekuiti Pemilik</td>
            <td style="background-color: #f8f9ff; border: 2px solid #e0e0e0;"><div class="drop-zone" data-category="ekuiti-pemilik"></div></td>
          </tr>
        </tbody>
      </table>
    </div>
  `;

  initDropZones();
}

function initDropZones() {
  document.querySelectorAll('.drop-zone').forEach(zone => {
    zone.addEventListener('dragover', handleDragOver);
    zone.addEventListener('drop', handleDrop);
    zone.addEventListener('dragleave', handleDragLeave);
  });
}

function handleDragStart(e) {
  draggedElement = e.target;
  e.target.classList.add('dragging');
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', e.target.innerHTML);
  document.body.style.cursor = 'grabbing';
}

function handleDragEnd(e) {
  e.target.classList.remove('dragging');
  document.body.style.cursor = 'default';
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault();
  }
  e.dataTransfer.dropEffect = 'move';
  e.currentTarget.classList.add('drag-over');
  return false;
}

function handleDragLeave(e) {
  e.currentTarget.classList.remove('drag-over');
}

function handleDrop(e) {
  if (e.stopPropagation) {
    e.stopPropagation();
  }
  e.preventDefault();

  e.currentTarget.classList.remove('drag-over');

  if (draggedElement) {
    const newItem = draggedElement.cloneNode(true);
    newItem.addEventListener('dragstart', handleDragStart);
    newItem.addEventListener('dragend', handleDragEnd);
    
    newItem.addEventListener('dblclick', function() {
      returnToPool(this);
    });
    
    e.currentTarget.appendChild(newItem);
    draggedElement.remove();
    
    checkAnswer(e.currentTarget, newItem);
  }

  return false;
}

function checkAnswer(dropZone, item) {
  const droppedCategory = item.dataset.category;
  const targetCategory = dropZone.dataset.category;
  const itemIndex = item.dataset.index;
  const itemText = item.textContent;
  
  // Remove any previous correct/incorrect classes
  item.classList.remove('correct-item', 'incorrect-item');
  
  if (droppedCategory === targetCategory) {
    // CORRECT: Keep the original item color
    correctAnswers.add(itemIndex);
    
    // Ensure the item keeps its original color
    const colors = itemColors[itemText];
    if (colors) {
      item.style.background = colors.bg;
      item.style.color = colors.text;
      item.style.border = `2px solid ${colors.bg}`;
      item.style.opacity = '1'; // Ensure full opacity
    }
    
    if (currentLevel === 1) {
      level1Score = correctAnswers.size;
    } else {
      level2Score = correctAnswers.size;
    }
    updateScore(); 
    
    showFeedback(true, targetCategory, itemText, function() {
      dropZone.classList.remove('drag-over');
    });
    
    playSound(correctSound);
    
    // Light green border for correct drop zone (subtle feedback)
dropZone.style.borderColor = '#4CAF50';
dropZone.style.borderStyle = 'solid';
dropZone.style.backgroundColor = '#E8F5E9';

// Remove the green border after a short delay to return to normal
setTimeout(() => {
    dropZone.style.borderColor = '#bbb';
    dropZone.style.borderStyle = 'dashed';
    dropZone.style.backgroundColor = '#f5f5f5';
}, 800); // 800ms delay
    
  } else {
    // WRONG: Show red border briefly, then return to pool
    // Keep original color but add red border
    const colors = itemColors[itemText];
    if (colors) {
      item.style.background = colors.bg;
      item.style.color = colors.text;
      item.style.border = `2px solid #F44336`; // Red border for wrong
      item.style.opacity = '1';
    }
    
    dropZone.style.borderColor = '#F44336';
    dropZone.style.borderStyle = 'solid';
    dropZone.style.backgroundColor = '#FFEBEE';
    
    showFeedback(false, targetCategory, itemText, function() {});
    
    playSound(incorrectSound);
    
setTimeout(() => {
    returnToPool(item);
    // Note: returnToPool already resets the drop zone style
}, 1000);
  }
  
  checkLevelCompletion();
}

function playSound(sound) {
  sound.currentTime = 0;
  sound.play().catch(e => console.log("Audio error:", e));
}

function returnToPool(item) {
  const pool = document.getElementById('itemsPool');
  const itemIndex = item.dataset.index;
  const itemText = item.dataset.originalText || item.textContent;
  
  correctAnswers.delete(itemIndex);
  
  if (currentLevel === 1) {
    level1Score = correctAnswers.size;
  } else {
    level2Score = correctAnswers.size;
  }
  updateScore();

  const newPoolItem = document.createElement('div');
  newPoolItem.className = 'draggable-item';
  newPoolItem.draggable = true;
  newPoolItem.textContent = itemText;
  newPoolItem.dataset.category = item.dataset.category;
  newPoolItem.dataset.index = item.dataset.index;
  newPoolItem.dataset.originalText = itemText;
  
  // Restore original item color with full opacity
  const colors = itemColors[itemText];
  if (colors) {
    newPoolItem.style.background = colors.bg;
    newPoolItem.style.color = colors.text;
    newPoolItem.style.border = `2px solid ${colors.bg}`;
    newPoolItem.style.opacity = '1';
  }
  
  newPoolItem.addEventListener('dragstart', handleDragStart);
  newPoolItem.addEventListener('dragend', handleDragEnd);
  
  pool.appendChild(newPoolItem);
  
  const dropZone = item.parentElement;
  item.remove();
  
  // Reset drop zone to default style
dropZone.style.borderColor = '#bbb';
dropZone.style.borderStyle = 'dashed';
dropZone.style.backgroundColor = '#f5f5f5';
dropZone.style.opacity = '1';
  
  checkLevelCompletion();
}

function checkLevelCompletion() {
  const totalItems = currentLevel === 1 ? level1Items.length : level2Items.length;
  const placedItems = document.querySelectorAll('.drop-zone .draggable-item').length;
  
  // Check 1: Semua item mesti telah diletakkan
  if (placedItems !== totalItems) {
    window.isLevelComplete = false;
    return;
  }
  
  // Check 2: Semua item mesti berada di kategori yang betul
  let allCorrect = true;
  
  document.querySelectorAll('.drop-zone').forEach(zone => {
    const items = zone.querySelectorAll('.draggable-item');
    
    // Check setiap item dalam zone ini
    items.forEach(item => {
      if (item.dataset.category !== zone.dataset.category) {
        allCorrect = false;
      }
    });
  });
  
  window.isLevelComplete = allCorrect;
  
  // Debug log (boleh buang selepas testing)
  console.log('Level complete?', window.isLevelComplete, 
              'Placed items:', placedItems, 
              'Total items:', totalItems);
}

function handleNextClick() {
  // Semak semula sebelum proceed
  checkLevelCompletion();
  
  if (!window.isLevelComplete) {
    showToast("Sila lengkapkan semua soalan terlebih dahulu!");
    
    // Highlight items yang belum diletakkan
    highlightRemainingItems();
    return;
  }
  
  nextLevel();
}

function highlightRemainingItems() {
  const remainingItems = document.querySelectorAll('#itemsPool .draggable-item');
  
  // Animate each remaining item
  remainingItems.forEach((item, index) => {
    setTimeout(() => {
      item.classList.add('highlight-item');
      setTimeout(() => {
        item.classList.remove('highlight-item');
      }, 1000);
    }, index * 200);
  });
  
  // Highlight the items pool box
  const itemsPoolBox = document.querySelector('.items-pool');
  itemsPoolBox.classList.add('highlight');
  setTimeout(() => {
    itemsPoolBox.classList.remove('highlight');
  }, 2000);
}

function showToast(message) {
  const toast = document.getElementById('toast-notification');
  
  if (message) {
    const content = toast.querySelector('.toast-content');
    if (content) {
      content.textContent = message;
    }
  }
  
  toast.classList.add('show');
  
  setTimeout(() => {
    toast.classList.remove('show');
  }, 3000);
}

function showFeedback(isCorrect, componentId, itemText, onCloseCallback) {
  const existingFeedback = document.querySelector('.match-feedback');
  if (existingFeedback) existingFeedback.remove();
  
  const feedback = document.createElement('div');
  feedback.className = 'match-feedback';
feedback.style.position = 'fixed';
feedback.style.zIndex = '1000';

// Get the game screen element and its position
const gameScreenElement = document.getElementById('game-screen');
const gameScreenRect = gameScreenElement.getBoundingClientRect();

// Calculate position relative to game screen, not viewport
const gameScreenCenterX = gameScreenRect.left + (gameScreenRect.width / 2);
const gameScreenCenterY = gameScreenRect.top + (gameScreenRect.height / 2);

feedback.style.left = `${gameScreenCenterX}px`;
feedback.style.top = `${gameScreenCenterY}px`;
feedback.style.transform = 'translate(-50%, -50%)';

  feedback.style.padding = '30px 40px';
  feedback.style.borderRadius = '15px';
  feedback.style.zIndex = '1000';
  feedback.style.fontSize = '20px';
  feedback.style.fontWeight = 'bold';
  feedback.style.textAlign = 'center';
  feedback.style.maxWidth = '500px';
  feedback.style.boxShadow = '0 10px 30px rgba(0,0,0,0.3)';
  feedback.style.animation = 'fadeInScale 0.3s ease';
  
  const closeBtn = document.createElement('button');
  closeBtn.innerHTML = '×';
  closeBtn.style.position = 'absolute';
  closeBtn.style.top = '10px';
  closeBtn.style.right = '15px';
  closeBtn.style.background = 'transparent';
  closeBtn.style.border = 'none';
  closeBtn.style.fontSize = '35px';
  closeBtn.style.cursor = 'pointer';
  closeBtn.style.color = 'inherit';
  closeBtn.style.opacity = '0.7';
  closeBtn.style.transition = 'opacity 0.2s';
  closeBtn.style.fontWeight = 'normal';
  closeBtn.style.lineHeight = '1';
  closeBtn.style.padding = '0';
  closeBtn.style.width = '30px';
  closeBtn.style.height = '30px';
  
  const closeFeedback = () => {
    feedback.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    feedback.style.opacity = '0';
    feedback.style.transform = 'translate(-50%, -50%) scale(0.8)';
    setTimeout(() => {
      feedback.remove();
      if (onCloseCallback) onCloseCallback();
    }, 300);
  };
  
  closeBtn.onmouseover = () => closeBtn.style.opacity = '1';
  closeBtn.onmouseout = () => closeBtn.style.opacity = '0.7';
  closeBtn.onclick = closeFeedback;
  
  if (isCorrect) {
    feedback.style.background = '#E8F5E9';
    feedback.style.color = '#1b5e20';
    feedback.style.border = '3px solid #4caf50';
    
    const explanations = {
      'jualan-bersih': 'Jualan Bersih adalah jumlah jualan sebenar selepas tolak pulangan jualan dan diskaun.',
      'kos-jualan': 'Kos Jualan merangkumi inventori awal, belian, angkutan masuk, upah, tolak inventori akhir dan pulangan belian.',
      'hasil': 'Hasil adalah pendapatan sampingan selain daripada jualan seperti komisen, faedah, dan sewa.',
      'belanja': 'Belanja adalah perbelanjaan untuk menjalankan perniagaan seperti gaji, sewa, dan utiliti.',
      'ekuiti-pemilik': 'Ekuiti Pemilik terdiri daripada modal awal, tambahan modal, untung atau rugi bersih, dan tolak ambilan.',
      'aset-bukan-semasa': 'Aset Bukan Semasa adalah aset jangka panjang seperti premis, kenderaan, dan mesin.',
      'aset-semasa': 'Aset Semasa adalah aset yang mudah ditukar kepada tunai dalam masa setahun seperti bank, stok, dan akaun belum terima.',
      'liabiliti-semasa': 'Liabiliti Semasa adalah hutang yang perlu dijelaskan dalam masa setahun seperti overdraf bank dan akaun belum bayar.',
      'liabiliti-bukan-semasa': 'Liabiliti Bukan Semasa adalah hutang jangka panjang seperti pinjaman bank dan gadai janji.'
    };
    
    feedback.innerHTML = `
      <div style="font-size: 50px; margin-bottom: 10px;">✓</div>
      <div style="font-size: 28px; margin-bottom: 20px; color: #2e7d32;">Betul!</div>
      <div style="font-size: 16px; margin-bottom: 15px; color: #1b5e20; font-weight: 600;">
        "${itemText}" adalah sebahagian daripada ${getComponentName(componentId)}
      </div>
      <div style="font-size: 17px; font-weight: normal; line-height: 1.8; text-align: left; background: #ffffff; padding: 20px; border-radius: 10px; border: 2px solid #4caf50;">
        <div style="font-size: 19px; font-weight: bold; margin-bottom: 12px; color: #1b5e20; background: #FFEB3B; padding: 8px 12px; border-radius: 5px; display: inline-block;">
          📚 PENERANGAN:
        </div>
        <div style="color: #2e7d32; font-weight: 600;">
          ${explanations[componentId] || ''}
        </div>
      </div>
    `;
  } else {
    feedback.style.background = '#FFEBEE';
    feedback.style.color = '#b71c1c';
    feedback.style.border = '3px solid #f44336';
    
    feedback.innerHTML = `
      <div style="font-size: 50px; margin-bottom: 10px;">✗</div>
      <div style="font-size: 28px; color: #c62828;">Salah! Cuba lagi</div>
      <div style="font-size: 16px; margin-top: 15px; font-weight: normal;">
        "${itemText}" bukan sebahagian daripada ${getComponentName(componentId)}.
        <br><br>
        <strong>Item akan kembali ke kotak item.</strong>
      </div>
    `;
    
    setTimeout(() => {
      if (document.body.contains(feedback)) {
        closeFeedback();
      }
    }, 2500);
  }
  
  feedback.appendChild(closeBtn);
  document.body.appendChild(feedback);
}

function getComponentName(componentId) {
  const names = {
    'jualan-bersih': 'Jualan Bersih',
    'kos-jualan': 'Kos Jualan',
    'hasil': 'Hasil',
    'belanja': 'Belanja',
    'ekuiti-pemilik': 'Ekuiti Pemilik',
    'aset-bukan-semasa': 'Aset Bukan Semasa',
    'aset-semasa': 'Aset Semasa',
    'liabiliti-semasa': 'Liabiliti Semasa',
    'liabiliti-bukan-semasa': 'Liabiliti Bukan Semasa'
  };
  return names[componentId] || componentId;
}
// Add resize observer to reposition feedback when sidebar changes
const sidebarObserver = new MutationObserver(() => {
  const existingFeedback = document.querySelector('.match-feedback');
  if (existingFeedback) {
    const gameScreenElement = document.getElementById('game-screen');
    const gameScreenRect = gameScreenElement.getBoundingClientRect();
    
    const gameScreenCenterX = gameScreenRect.left + (gameScreenRect.width / 2);
    const gameScreenCenterY = gameScreenRect.top + (gameScreenRect.height / 2);
    
    existingFeedback.style.left = `${gameScreenCenterX}px`;
    existingFeedback.style.top = `${gameScreenCenterY}px`;
  }
});

// Observe the main element for changes when sidebar opens/closes
const mainElement = document.getElementById('main');
if (mainElement) {
  sidebarObserver.observe(mainElement, { 
    attributes: true, 
    attributeFilter: ['style'] 
  });
}

// Also listen for window resize
window.addEventListener('resize', () => {
  const existingFeedback = document.querySelector('.match-feedback');
  if (existingFeedback) {
    const gameScreenElement = document.getElementById('game-screen');
    const gameScreenRect = gameScreenElement.getBoundingClientRect();
    
    const gameScreenCenterX = gameScreenRect.left + (gameScreenRect.width / 2);
    const gameScreenCenterY = gameScreenRect.top + (gameScreenRect.height / 2);
    
    existingFeedback.style.left = `${gameScreenCenterX}px`;
    existingFeedback.style.top = `${gameScreenCenterY}px`;
  }
});

function showResultScreen() {
  const totalCorrect = level1Score + level2Score;
  const totalQuestions = level1Items.length + level2Items.length;
  
  finalScore.textContent = `${totalCorrect}/${totalQuestions}`;
  
  const percentage = Math.round((totalCorrect / totalQuestions) * 100);
  
  if (percentage === 100) {
    resultText.textContent = "SEMPURNA! Anda telah menjawab semua soalan dengan betul untuk kedua-dua level!";
    playSound(excellentSound);
  } else if (percentage >= 80) {
    resultText.textContent = "Cemerlang! Prestasi yang sangat baik!";
    playSound(excellentSound);
  } else if (percentage >= 60) {
    resultText.textContent = "Baik! Teruskan usaha anda!";
    playSound(poorSound);
  } else {
    resultText.textContent = "Cuba lagi! Anda boleh lakukan lebih baik!";
    playSound(poorSound);
  }
  
  gameScreen.style.display = 'none';
  resultScreen.classList.add('show');
  
  saveScore(percentage);
}

function saveScore(score) {
  fetch(window.location.href, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-form-urlencoded',
    },
    body: `action=save_score&score=${score}`
  })
  .then(response => response.json())
  .then(data => {
    console.log('Score saved:', data);
  })
  .catch(error => console.error('Error saving score:', error));
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