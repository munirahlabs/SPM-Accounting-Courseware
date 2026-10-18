<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">
  <title>ACCsmart: Padanan Penyata Pendapatan</title>
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
      background: url('../img/97.png') center center/contain no-repeat;
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
      background: #e8f4ea  ;
      
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

    /* GAME CONTAINER */
    .game-container {
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      display: flex;
      flex-direction: column;
      gap: 25px;
      align-items: center;
    }

    /* MATCHING GAME STYLES */
    .matching-game-container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      position: relative;
      gap: 20px;
      margin-top: 20px;
    }

    .side {
      display: flex;
      flex-direction: column;
      gap: 18px;
      width: 200px;
      justify-content: center;
    }

    .side.left {
      margin-right: 180px;
    }

    .side.right {
      margin-left: 180px;
    }

    .statement-wrapper {
      position: relative;
      display: inline-block;
      justify-content: center;
    }

    .bullets-left {
      position: absolute;
      left: -40px;
      top: 0;
      display: flex;
      flex-direction: column;
      gap: 0;
      z-index: 2;
    }

    .statement-container {
      width: 420px;
      background: #0C8FA1;
      border-radius: 18px;
      padding: 16px;
      color: white;
      position: relative;
      z-index: 1;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .header {
      text-align: center;
      background: #ffb300;
      color: #003366;
      padding: 0;
      border-radius: 12px;
      margin-bottom: 14px;
    }

    .header h3 {
      margin: 6px 0 0 0;
      font-size: 1.2rem;
    }

    .header p {
      margin: 0 0 6px 0;
      font-size: 0.9rem;
    }

    .table {
      background: #2fa4e7;
      border-radius: 14px;
      overflow: hidden;
    }

    .section {
      padding: 6px 12px;
    }

    .section.dark {
      background: #1b8bd6;
    }

    .section-title {
      font-weight: bold;
      margin-top: 2px;
      margin-bottom: 6px;
      background: rgba(255, 255, 255, 0.66);
      padding: 4px 10px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 0.9rem;
      color: red;
      font-size: 1.3rem;
    }

    .rm-header {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      text-align: center;
      font-weight: bold;
      margin-bottom: 0;
      font-size: 0.8rem;
    }

    .row {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      align-items: center;
      padding: 2px 4px;
      border-bottom: none;
      font-size: 0.85rem;
    }

    /* Half-width title rectangle for Untung Kasar */
    .section-title.section-title-half {
      display: inline-block;
      width: 40%;
      font-weight: bold;
      margin-top: 2px;
      margin-bottom: 6px;
      background: rgba(255, 255, 255, 0.66);
      padding: 4px 10px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 0.9rem;
      color: red;
      font-size: 1.3rem;
    }

    /* Row beside the title */
    .row.final-half {
      display: inline-grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      align-items: center;
      gap: 4px;
      vertical-align: middle;
    }

    /* Double line for final results */
    .row.final-half .cell:nth-child(3) {
      border-top: 3px double white;
      padding-top: 6px;
    }

    .item {
      text-align: left;
    }

    .cell {
      margin: 0 4px;
      text-align: center;
      font-weight: bold;
      background: transparent;
    }

    .row.total .cell:not(:empty) {
      border-top: 2px solid white;
      padding-top: 6px;
    }

    .cell-total {
      border-top: 2px solid white;
      padding-top: 6px;
    }

    .row.final .cell {
      border-top: 3px double white;
      padding-top: 6px;
      font-weight: bold;
    }

    .label {
      background: #000;
      color: #fff;
      padding: 14px 18px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      position: relative;
      text-align: center;
      transition: all 0.2s ease;
      border: 2px solid transparent;
      font-size: 1.1rem;
      min-height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .label:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .label.selected {
      background: #333;
      border-color: #00e5ff;
      box-shadow: 0 0 15px rgba(0, 229, 255, 0.5);
    }

    .side-bullet {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      border: 3px solid;
      position: absolute;
      cursor: grab;
      top: 50%;
      transform: translateY(-50%);
      transition: all 0.3s ease;
      z-index: 10;
    }

    .side-bullet:active {
      cursor: grabbing;
    }

    .side.left .side-bullet {
      right: -56px;
    }

    .side.right .side-bullet {
      left: -56px;
    }

    .side.left .label::after {
      content: '';
      position: absolute;
      right: -30px;
      top: 50%;
      transform: translateY(-50%);
      border-left: 28px solid #00e5ff;
      border-top: 14px solid transparent;
      border-bottom: 14px solid transparent;
    }

    .side.right .label::after {
      content: '';
      position: absolute;
      left: -30px;
      top: 50%;
      transform: translateY(-50%) rotate(180deg);
      border-left: 28px solid #00e5ff;
      border-top: 14px solid transparent;
      border-bottom: 14px solid transparent;
    }

    .bullet {
      width: 30px;
      height: 30px;
      border: 5px solid #00e5ff;
      border-radius: 50%;
      background: transparent;
      cursor: pointer;
      transition: all 0.2s ease;
      pointer-events: all;
      position: absolute;
    }

    .bullet.active {
      box-shadow: 0 0 12px currentColor;
    }

    .bullet:hover {
      transform: scale(1.2);
      box-shadow: 0 0 6px rgba(0,0,0,0.3);
    }

    .bullet.selected {
      box-shadow: 0 0 12px #ff4081;
      transform: scale(1.3);
    }

    #lines {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      inset: 0;
      pointer-events: none;
      z-index: 5;
    }

    .matching-controls {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 10px;
    }

    .matching-controls button {
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
      margin: left;
      border: 2px solid rgba(255, 255, 255, 0.3);
      transition: all 0.3s ease;
    }

    .matching-controls button:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(76, 175, 80, 0.5);
    }

    .matching-controls button:disabled {
      background: #cccccc;
      cursor: not-allowed;
      transform: none;
    }

    /* Color coding for matches */
    .side.left .label[data-match="hasil"],
    .side.left .side-bullet[data-match="hasil"] {
      background: #ff7043;
      border-color: #ff7043;
    }

    .side.left .label[data-match="kos-jualan"],
    .side.left .side-bullet[data-match="kos-jualan"] {
      background: #29b6f6;
      border-color: #29b6f6;
    }

    .side.left .label[data-match="untung-kasar"],
    .side.left .side-bullet[data-match="untung-kasar"] {
      background: #ab47bc;
      border-color: #ab47bc;
    }

    .side.right .label[data-match="hasil-lain"],
    .side.right .side-bullet[data-match="hasil-lain"] {
      background: #66bb6a;
      border-color: #66bb6a;
    }

    .side.right .label[data-match="belanja"],
    .side.right .side-bullet[data-match="belanja"] {
      background: #F9A825;
      border-color: #F9A825;
      color: #FFFFFF;
    }

    .side.right .label[data-match="untung-bersih"],
    .side.right .side-bullet[data-match="untung-bersih"] {
      background: #e91e63;
      border-color: #e91e63;
      color: #fff;
    }

    /* FEEDBACK STYLES */
    .match-feedback {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 30px 40px;
      border-radius: 15px;
      z-index: 1000;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      max-width: 500px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      animation: fadeInScale 0.3s ease;
    }

    /* TOAST NOTIFICATION */
    .toast-notification {
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%) translateY(100px);
      background: linear-gradient(135deg, #ff9800, #ff5722);
      color: white;
      padding: 18px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(255, 87, 34, 0.4);
      z-index: 9999;
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 600;
      font-size: 1.05rem;
      opacity: 0;
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      max-width: 90%;
      min-width: 300px;
      text-align: center;
    }

    .toast-notification.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }

    .toast-icon {
      font-size: 1.8rem;
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

    /* RESULT SCREEN - Changed from popup to full page */
    #result-screen {
      display: none;
      min-height: 100vh;
      background: url('../img/wallklasifikasiii.png') center center/contain no-repeat;
      padding: 40px 20px;
      position: relative;
      font-family: 'Poppins', sans-serif;
      color: #1f2937;
      overflow-y: auto;
      justify-content: center;
      align-items: center;
    }

    #result-screen.show {
      display: flex;
    }

    .result-card {
      background: linear-gradient(145deg, #ffffff, #f0f4ff);
      color: #1f2937;
      border-radius: 25px;
      padding: 50px 40px;
      max-width: 500px;
      width: 90%;
      text-align: center;
      box-shadow: 0 12px 30px rgba(0,0,0,0.25);
      animation: slideIn 0.5s ease;
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
      margin-bottom: 20px;
    }

    .result-card h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #3643d1;
      margin: 0 0 10px 0;
    }

    .result-card p {
      font-size: 1.1rem;
      color: #6b7280;
      line-height: 1.6;
      margin: 10px 0;
    }

    .result-card .final-score {
      font-size: 3rem;
      font-weight: 800;
      color: #3643d1;
      margin: 20px 0;
    }

    .result-btns-vertical {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 25px;
      align-items: center;
    }

    .button-33 {
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
      padding: 12px 30px;
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

    .button-33:hover {
      box-shadow: rgba(146, 144, 144, 0.3) 0 -25px 18px -14px inset,
                  rgba(146, 144, 144, 0.3) 0 1px 2px,
                  rgba(146, 144, 144, 0.3) 0 2px 4px,
                  rgba(146, 144, 144, 0.3) 0 4px 8px,
                  rgba(146, 144, 144, 0.3) 0 8px 16px,
                  rgba(146, 144, 144, 0.3) 0 16px 32px;
      transform: scale(1.05) rotate(-1deg);
    }

    .first-btn {
      background-color: #f16037;
      color: #fff;
    }

    .first-btn:hover {
      background-color: rgba(253, 74, 25, 0.95);
    }

    .second-btn {
      background-color: rgba(246, 247, 249, 0.78);
      color: black;
    }

    .second-btn:hover {
      background-color: rgba(215, 216, 217, 0.78);
    }

    /* INSTRUCTION TEXT */
    .instruction-text {
      text-align: center;
      margin: 10px 0 10px 0;
      padding: 15px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      border: 2px dashed #3643d1;
      font-size: 1.3rem;
      color: #1f2937;
      font-weight: 700;
    }

    .bulb {
  font-size: 2.2rem;
  animation: glow 1.5s ease-in-out infinite alternate;
}
    /* RESPONSIVE */
    @media (max-width: 1024px) {
      .matching-game-container {
        flex-direction: column;
        gap: 40px;
      }
      
      .side.left, .side.right {
        margin: 0;
        width: 100%;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
      }
      
      .side.left .label, .side.right .label {
        width: 45%;
        min-height: 70px;
      }
      
      .statement-wrapper {
        order: 3;
        width: 100%;
      }
      
      .bullets-left {
        left: -35px;
      }
      
      .side.left .side-bullet {
        right: -45px;
      }
      
      .side.right .side-bullet {
        left: -45px;
      }
    }

    @media (max-width: 768px) {
      .statement-container {
        width: 100%;
        padding: 12px;
      }
      
      .game-header h2 {
        font-size: 1.5rem;
      }
      
      .intro-content h1 {
        font-size: 1.8rem;
      }
      
      .label {
        font-size: 1rem;
        padding: 12px 15px;
      }
      
      .section-title {
        font-size: 0.8rem;
      }
      
      .row {
        font-size: 0.8rem;
      }
    }

    @media (max-width: 480px) {
      .side.left .label, .side.right .label {
        width: 100%;
      }
      
      .statement-container {
        padding: 10px;
      }
      
      .bullets-left {
        left: -25px;
      }
      
      .bullet {
        width: 16px;
        height: 16px;
        border-width: 4px;
      }
    }
  </style>
</head>
<body>
<?php include '../components/Top_nav.php'; ?>

<div class="layout">
  <?php include '../components/SidebarNav_T4.php'; ?>

  <main class="main" id="main">
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
        <p>Selamat datang ke <b>ACCsmart: Padanan Penyata Pendapatan</b>! 🎓</p>
        <ul style="text-align:left; line-height:1.8; display: block; padding-left: 20px;">
          <li>👉 Seret dan lepaskan bulatan dari sebelah kiri/kanan ke bahagian yang betul dalam penyata pendapatan</li>
          <li>✅ Setiap padanan yang betul akan memberikan maklum balas serta penerangan</li>
          <li>⭐ Anda perlu membuat semua padanan dengan betul untuk meneruskan</li>
          <li>🎯 Objektif: Padankan semua 6 komponen dengan betul!</li>
          <li>📊 Komponen: Hasil, Kos Jualan, Untung Kasar, Hasil Lain, Belanja, Untung Bersih</li>
        </ul>
        <button class="control-btn" onclick="closeInstructions()" style="margin-top: 20px;">Tutup</button>
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
          <h2>📊 Permainan Penyata Pendapatan</h2>
          <div class="game-stats">
            <div class="stat-box">⭐ Padanan Betul: <span id="score">0</span>/6</div>
          </div>
        </div>

          <div class="instruction-text">
            <span class="bulb">💡</span>Arahan: Padankan Komponen Penyata Pendapatan pada kedudukannya
        </div>

        <div class="matching-game-container">
          <!-- LEFT LABELS -->
          <div class="side left">
            <div class="label" data-match="hasil">
              HASIL
              <div class="side-bullet" data-match="hasil"></div>
            </div>

            <div class="label" data-match="kos-jualan">
              KOS JUALAN
              <div class="side-bullet" data-match="kos-jualan"></div>
            </div>

            <div class="label" data-match="untung-kasar">
              UNTUNG KASAR
              <div class="side-bullet" data-match="untung-kasar"></div>
            </div>
          </div>

          <!-- STATEMENT + BULLETS -->
          <div class="statement-wrapper">
            <div class="bullets-left" id="bullets-column">
              <!-- bullets will be dynamically created here -->
            </div>

            <div class="statement-container">
              <div class="header">
                <h3>Nama Perniagaan</h3>
                <p>Penyata Pendapatan bagi tahun berakhir …</p>
              </div>

              <div class="rm-header">
                <span></span>
                <span>RM</span>
                <span>RM</span>
                <span>RM</span>
              </div>

              <div class="section" data-id="hasil">
                <div class="section-title" data-match="hasil">?</div>
                <div class="row">
                  <span class="item">Jualan</span>
                  <span class="cell"></span><span class="cell"></span><span class="cell">x</span>
                </div>
                <div class="row">
                  <span class="item">Tolak: Pulangan Jualan</span>
                  <span class="cell"></span><span class="cell"></span><span class="cell">(x)</span>
                </div>
                <div class="row total">
                  <span class="item">Jualan Bersih</span>
                  <span class="cell"></span><span class="cell"></span><span class="cell">xx</span>
                </div>
              </div>

              <div class="section" data-id="kos-jualan">
                <div class="section-title" data-match="kos-jualan">?</div>
                <div class="row">
                  <span class="item">Stok Awal</span>
                  <span class="cell">xx</span><span class="cell"></span><span class="cell"></span>
                </div>
                <div class="row">
                  <span class="item">Belian</span>
                  <span class="cell">x</span><span class="cell"></span><span class="cell"></span>
                </div>
                <div class="row total">
                  <span class="item"></span>
                  <span class="cell"></span><span class="cell">xx</span><span class="cell"></span>
                </div>
                <div class="row">
                  <span class="item">Tolak: Stok Akhir</span>
                  <span class="cell"></span><span class="cell">(xx)</span><span class="cell"></span>
                </div>
                <div class="row">
                  <span class="item">Jumlah</span>
                  <span class="cell"></span>
                  <span class="cell cell-total"></span>
                  <span class="cell">(xx)</span>
                </div>
              </div>

              <div class="section" data-id="untung-kasar">
                <div class="section-title section-title-half" data-match="untung-kasar">?</div> 
                <div class="row final-half"> 
                  <span class="cell"></span>
                  <span class="cell"></span>
                  <span class="cell">xx</span>
                </div>
              </div>
              <br>

              <div class="section" data-id="hasil-lain">
                <div class="section-title" data-match="hasil-lain">Tambah: ?</div>
                <div class="row">
                  <span class="item">Komisen Diterima</span>
                  <span class="cell"></span>
                  <span class="cell"></span>
                  <span class="cell">x</span>
                </div>
                <div class="row">
                  <span class="item">Sewa Diterima</span>
                  <span class="cell"></span>
                  <span class="cell"></span>
                  <span class="cell">x</span>
                </div>
                <div class="row total">
                  <span class="item">Jumlah</span>
                  <span class="cell"></span>
                  <span class="cell"></span>
                  <span class="cell">xx</span>
                </div>
              </div>

              <div class="section" data-id="belanja">
                <div class="section-title" data-match="belanja">Tolak: ?</div>
                <div class="row">
                  <span class="item">Gaji</span>
                  <span class="cell"></span>
                  <span class="cell">x</span>
                  <span class="cell"></span>
                </div>
                <div class="row">
                  <span class="item">Iklan</span>
                  <span class="cell"></span>
                  <span class="cell">x</span>
                  <span class="cell"></span>
                </div>
                <div class="row total">
                  <span class="item">Jumlah</span>
                  <span class="cell"></span>
                  <span class="cell">(xx)</span>
                  <span class="cell"></span>
                </div>
              </div>

              <div class="section" data-id="untung-bersih">
                <div class="section-title section-title-half" data-match="untung-bersih">?</div> 
                <div class="row final-half"> 
                  <span class="cell"></span>
                  <span class="cell"></span>
                  <span class="cell">xx</span>
                </div>
              </div>
            </div>
          </div>

          <!-- RIGHT LABELS -->
          <div class="side right">
            <div class="label" data-match="hasil-lain">
              HASIL-HASIL LAIN
              <div class="side-bullet" data-match="hasil-lain"></div>
            </div>

            <div class="label" data-match="belanja">
              BELANJA
              <div class="side-bullet" data-match="belanja"></div>
            </div>

            <div class="label" data-match="untung-bersih">
              UNTUNG/RUGI BERSIH
              <div class="side-bullet" data-match="untung-bersih"></div>
            </div>
          </div>

          <!-- SVG for lines -->
          <svg id="lines"></svg>
        </div>

        <div class="matching-controls">
          <button id="seterusnyaBtn" onclick="checkIfComplete()">Seterusnya →</button>
        </div>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy" id="trophy-icon">🏆</div>
        <h2 id="result-title">Tahniah!</h2>
        <p id="resultText">Anda telah berjaya menyelesaikan permainan!</p>
        <div class="final-score" id="finalScore">6/6</div>
        <div id="result-message"></div>
        <div class="result-btns-vertical">
          <a href="javascript:void(0)" class="button-33 first-btn" onclick="tryAgain()">Cuba Lagi</a>
          <a href="javascript:void(0)" class="button-33 second-btn" onclick="backToMenu()">Menu Utama</a>
        </div>
      </div>
    </section>
  </main>
</div>

<!-- TOAST NOTIFICATION -->
<div id="toast-notification" class="toast-notification warning">
  <div class="toast-icon">⚠️</div>
  <div class="toast-content">
    Sila lengkapkan semua padanan sebelum meneruskan!
  </div>
</div>

<script src="../js/navigation.js"></script>

<script>
// Game variables
let score = 0;
const totalQuestions = 6;
const connections = new Map();
const lines = new Map();
const reverseConnections = new Map();
const bulletElements = new Map();
const draggableBullets = new Map();

// Correct answers mapping for Penyata Pendapatan
const correctAnswers = {
  'hasil': 'hasil',
  'kos-jualan': 'kos-jualan',
  'untung-kasar': 'untung-kasar',
  'hasil-lain': 'hasil-lain',
  'belanja': 'belanja',
  'untung-bersih': 'untung-bersih'
};

// DOM Elements
const startScreen = document.getElementById('start-screen');
const instrScreen = document.getElementById('instruction-modal');
const gameScreen = document.getElementById('game-screen');
const resultScreen = document.getElementById('result-screen');
const scoreElement = document.getElementById('score');
const seterusnyaBtn = document.getElementById('seterusnyaBtn');
const svg = document.getElementById('lines');
const toastNotification = document.getElementById('toast-notification');

// Sound Effects
const correctSound = new Audio("../audio/correct_answer_sound.mp3");
const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
const excellentSound = new Audio("../audio/congrats_sound.mp3");
const warningSound = new Audio("https://assets.mixkit.co/sfx/preview/mixkit-warning-alarm-buzzer-958.mp3");

// Toast notification functions
function showToast(message, type = 'warning') {
  const toast = toastNotification;
  const toastContent = toast.querySelector('.toast-content');
  
  toastContent.textContent = message;
  toast.className = `toast-notification ${type}`;
  
  const toastIcon = toast.querySelector('.toast-icon');
  toastIcon.textContent = type === 'warning' ? '⚠️' : '✅';
  
  toast.classList.add('show');
  
  if (type === 'warning') {
    warningSound.currentTime = 0;
    warningSound.play().catch(e => console.log("Audio error:", e));
  }
  
  setTimeout(() => {
    toast.classList.remove('show');
  }, 3000);
}

// Navigation Functions
function startGame() {
  startScreen.style.display = 'none';
  gameScreen.style.display = 'block';
  resultScreen.classList.remove('show');
  score = 0;
  updateScore();
  initGame();
}

function showInstructions() {
  instrScreen.classList.add('show');
}

function closeInstructions() {
  instrScreen.classList.remove('show');
}

function resetGame() {
  if (confirm('Set semula semua padanan?')) {
    clearGame();
    initGame();
    score = 0;
    updateScore();
    updateSeterusnyaButton();
  }
}

function tryAgain() {
  resultScreen.classList.remove('show');
  gameScreen.style.display = 'block';
  resetGame();
}

function backToMenu() {
  resultScreen.classList.remove('show');
  gameScreen.style.display = 'none';
  startScreen.style.display = 'flex';
}

function updateScore() {
  scoreElement.textContent = score;
}

function checkIfComplete() {
  const allAnswered = Object.keys(correctAnswers).every(from => connections.has(from));
  
  if (allAnswered) {
    checkAllMatches();
  } else {
    const completedCount = Object.keys(correctAnswers).filter(from => connections.has(from)).length;
    const totalCount = Object.keys(correctAnswers).length;
    const remaining = totalCount - completedCount;
    
    let message = `Sila lengkapkan semua padanan sebelum meneruskan!`;
    
    if (remaining > 0) {
      message = `Anda perlu membuat ${remaining} padanan lagi. Sila lengkapkan semua padanan!`;
    }
    
    showToast(message, 'warning');
    
    seterusnyaBtn.style.animation = 'shake 0.5s ease';
    setTimeout(() => {
      seterusnyaBtn.style.animation = '';
    }, 500);
  }
}

const style = document.createElement('style');
style.textContent = `
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
  }
`;
document.head.appendChild(style);

function initGame() {
  clearGame();
  
  const bulletsColumn = document.getElementById("bullets-column");
  bulletsColumn.innerHTML = '';
  
  document.querySelectorAll(".section").forEach(section => {
    const bullet = document.createElement("div");
    bullet.className = "bullet";
    bullet.dataset.match = section.dataset.id;
    bulletsColumn.appendChild(bullet);
    bulletElements.set(section.dataset.id, bullet);

    const updatePosition = () => {
      const wrapperRect = document.querySelector(".statement-wrapper").getBoundingClientRect();
      const titleRect = section.querySelector(".section-title").getBoundingClientRect();

      bullet.style.position = "absolute";
      bullet.style.top = titleRect.top + titleRect.height/2 - wrapperRect.top - 10 + "px";
      bullet.style.left = "-25px";
    };

    updatePosition();
    window.addEventListener("resize", updatePosition);
  });

  initDragAndDrop();
  updateSeterusnyaButton();
}

function clearGame() {
  svg.innerHTML = '';
  
  connections.clear();
  lines.clear();
  reverseConnections.clear();
  bulletElements.clear();
  
  draggableBullets.forEach((bullet, key) => {
    if (bullet && bullet.parentNode) {
      bullet.remove();
    }
  });
  draggableBullets.clear();
  
  document.querySelectorAll('.dragging-bullet').forEach(b => {
    if (b && b.parentNode) {
      b.remove();
    }
  });
  
  document.querySelectorAll(".bullet").forEach(b => {
    b.style.background = 'transparent';
    b.style.borderColor = '#00e5ff';
    b.classList.remove("active");
  });
  
  document.querySelectorAll(".side-bullet").forEach(b => {
    b.style.cursor = 'grab';
  });
}

function initDragAndDrop() {
  let activeLine = null;
  let draggableBullet = null;
  let isDragging = false;
  let startBulletElement = null;

  document.querySelectorAll(".side-bullet").forEach(sideBullet => {
    sideBullet.addEventListener("mousedown", e => {
      e.preventDefault();
      e.stopPropagation();
      
      const matchType = sideBullet.dataset.match;
      
      if (connections.has(matchType)) {
        const oldTargetId = connections.get(matchType);
        const oldLine = lines.get(matchType);
        if (oldLine && oldLine.parentNode) {
          oldLine.remove();
        }
        
        const oldDraggable = draggableBullets.get(matchType);
        if (oldDraggable && oldDraggable.parentNode) {
          oldDraggable.remove();
        }
        draggableBullets.delete(matchType);
        
        const oldTargetBullet = bulletElements.get(oldTargetId);
        if (oldTargetBullet) {
          oldTargetBullet.style.background = 'transparent';
          oldTargetBullet.style.borderColor = '#00e5ff';
          oldTargetBullet.classList.remove('active');
        }
        
        connections.delete(matchType);
        reverseConnections.delete(oldTargetId);
        lines.delete(matchType);
      }
      
      startBulletElement = sideBullet;
      isDragging = true;

      const bRect = sideBullet.getBoundingClientRect();
      const svgRect = svg.getBoundingClientRect();

      const startX = bRect.left + bRect.width/2 - svgRect.left;
      const startY = bRect.top + bRect.height/2 - svgRect.top;

      draggableBullet = document.createElement('div');
      draggableBullet.className = 'dragging-bullet';
      draggableBullet.dataset.match = matchType;
      draggableBullet.style.position = 'fixed';
      draggableBullet.style.width = '28px';
      draggableBullet.style.height = '28px';
      draggableBullet.style.borderRadius = '50%';
      draggableBullet.style.border = '3px solid ' + getComponentColor(matchType);
      draggableBullet.style.background = getComponentColor(matchType);
      draggableBullet.style.pointerEvents = 'none';
      draggableBullet.style.zIndex = '100';
      draggableBullet.style.left = e.clientX - 14 + 'px';
      draggableBullet.style.top = e.clientY - 14 + 'px';
      document.body.appendChild(draggableBullet);

      activeLine = document.createElementNS("http://www.w3.org/2000/svg", "line");
      activeLine.setAttribute("x1", startX);
      activeLine.setAttribute("y1", startY);
      activeLine.setAttribute("x2", e.clientX - svgRect.left);
      activeLine.setAttribute("y2", e.clientY - svgRect.top);
      
      const color = getComponentColor(matchType);
      activeLine.setAttribute("stroke", color);
      activeLine.setAttribute("stroke-width", 4);
      activeLine.dataset.from = matchType;

      svg.appendChild(activeLine);
      
      sideBullet.style.cursor = 'grabbing';
    });
  });

  document.addEventListener("mousemove", e => {
    if (!isDragging || !activeLine || !draggableBullet) return;
    
    const svgRect = svg.getBoundingClientRect();
    const mouseX = e.clientX - svgRect.left;
    const mouseY = e.clientY - svgRect.top;
    
    draggableBullet.style.left = e.clientX - 14 + 'px';
    draggableBullet.style.top = e.clientY - 14 + 'px';
    
    activeLine.setAttribute("x2", mouseX);
    activeLine.setAttribute("y2", mouseY);
  });

  document.addEventListener("mouseup", e => {
    if (!isDragging) return;
    
    const target = document.elementFromPoint(e.clientX, e.clientY);
    let matchSuccessful = false;

    if (target && target.classList.contains("bullet")) {
      const targetId = target.dataset.match;
      const fromId = startBulletElement.dataset.match;
      
      const isCorrectMatch = correctAnswers[fromId] === targetId;
      
      if (!isCorrectMatch) {
        showFeedback(false, fromId);
      } else {
        matchSuccessful = true;
        
        if (reverseConnections.has(targetId)) {
          const oldSideBulletId = reverseConnections.get(targetId);
          
          const oldLine = lines.get(oldSideBulletId);
          if (oldLine && oldLine.parentNode) {
            oldLine.remove();
          }
          
          const oldDraggable = draggableBullets.get(oldSideBulletId);
          if (oldDraggable && oldDraggable.parentNode) {
            oldDraggable.remove();
          }
          draggableBullets.delete(oldSideBulletId);
          
          connections.delete(oldSideBulletId);
          lines.delete(oldSideBulletId);
        }
        
        const rect = target.getBoundingClientRect();
        const svgRect = svg.getBoundingClientRect();

        activeLine.setAttribute("x2", rect.left + rect.width/2 - svgRect.left);
        activeLine.setAttribute("y2", rect.top + rect.height/2 - svgRect.top);
        activeLine.dataset.to = targetId;

        draggableBullet.style.display = 'none';
        draggableBullets.set(fromId, draggableBullet);

        connections.set(fromId, targetId);
        reverseConnections.set(targetId, fromId);
        lines.set(fromId, activeLine);
        
        const color = getComponentColor(fromId);
        
        target.style.background = color;
        target.style.borderColor = color;
        target.classList.add('active');
        
        score++;
        updateScore();
        
        showFeedback(true, fromId);
        
        correctSound.play().catch(e => console.log("Audio error:", e));
      }
    }
    
    if (!matchSuccessful) {
      if (activeLine && activeLine.parentNode) {
        activeLine.remove();
      }
      
      if (draggableBullet && draggableBullet.parentNode) {
        draggableBullet.remove();
      }
    }

    if (startBulletElement) {
      startBulletElement.style.cursor = 'grab';
    }
    
    isDragging = false;
    activeLine = null;
    draggableBullet = null;
    startBulletElement = null;
    updateSeterusnyaButton();
  });
}

function showFeedback(isCorrect, componentId) {
  const existingFeedback = document.querySelector('.match-feedback');
  if (existingFeedback) existingFeedback.remove();
  
  const feedback = document.createElement('div');
  feedback.className = 'match-feedback';
  feedback.style.position = 'fixed';
  feedback.style.zIndex = '1000';
  feedback.style.fontSize = '20px';
  feedback.style.fontWeight = 'bold';
  feedback.style.textAlign = 'center';
  feedback.style.maxWidth = '500px';
  feedback.style.boxShadow = '0 10px 30px rgba(0,0,0,0.3)';
  feedback.style.animation = 'fadeInScale 0.3s ease';
  
  // Get the game screen element and its position
  const gameScreenElement = document.getElementById('game-screen');
  const gameScreenRect = gameScreenElement.getBoundingClientRect();
  
  // Calculate position relative to game screen, not viewport
  const gameScreenCenterX = gameScreenRect.left + (gameScreenRect.width / 2);
  const gameScreenCenterY = gameScreenRect.top + (gameScreenRect.height / 2);
  
  feedback.style.left = `${gameScreenCenterX}px`;
  feedback.style.top = `${gameScreenCenterY}px`;
  feedback.style.transform = 'translate(-50%, -50%)';
  
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
  
  closeBtn.onmouseover = () => closeBtn.style.opacity = '1';
  closeBtn.onmouseout = () => closeBtn.style.opacity = '0.7';
  closeBtn.onclick = () => {
    feedback.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    feedback.style.opacity = '0';
    feedback.style.transform = 'translate(-50%, -50%) scale(0.8)';
    setTimeout(() => feedback.remove(), 300);
  };
  
  if (isCorrect) {
    feedback.style.background = 'linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%)';
    feedback.style.color = '#1b5e20';
    feedback.style.border = '3px solid #4caf50';
    
    const explanations = {
      'hasil': 'Hasil adalah pendapatan daripada jualan barang atau perkhidmatan. Ia termasuk jualan bersih selepas tolak pulangan jualan.',
      'kos-jualan': 'Kos Jualan adalah kos untuk mendapatkan atau menghasilkan barang yang dijual. Ia dikira daripada stok awal + belian - stok akhir.',
      'untung-kasar': 'Untung Kasar adalah perbezaan antara hasil jualan dengan kos jualan. Ia menunjukkan keuntungan sebelum ditolak belanja.',
      'hasil-lain': 'Hasil Lain adalah pendapatan selain daripada jualan seperti sewa diterima, dividen, faedah dan diskaun diterima.',
      'belanja': 'Belanja adalah perbelanjaan untuk menjalankan perniagaan seperti sewa, gaji, utiliti, insurans dan lain-lain.',
      'untung-bersih': 'Untung Bersih adalah keuntungan akhir selepas untung kasar ditambah hasil lain dan ditolak belanja.'
    };
    
    feedback.innerHTML = `
      <div style="font-size: 50px; margin-bottom: 10px;">✓</div>
      <div style="font-size: 28px; margin-bottom: 20px; color: #2e7d32;">Betul!</div>
      <div style="font-size: 17px; font-weight: normal; line-height: 1.8; text-align: left; background: rgba(255,255,255,0.5); padding: 20px; border-radius: 10px; border: 2px solid #4caf50;">
        <div style="font-size: 19px; font-weight: bold; margin-bottom: 12px; color: #1b5e20; background: #ffeb3b; padding: 8px 12px; border-radius: 5px; display: inline-block;">
          📚 PENERANGAN:
        </div>
        <div style="color: #2e7d32; font-weight: 600;">
          ${explanations[componentId] || ''}
        </div>
      </div>
    `;
  } else {
    feedback.style.background = 'linear-gradient(135deg, #ffcdd2 0%, #ef9a9a 100%)';
    feedback.style.color = '#b71c1c';
    feedback.style.border = '3px solid #f44336';
    
    feedback.innerHTML = `
      <div style="font-size: 50px; margin-bottom: 10px;">✗</div>
      <div style="font-size: 28px; color: #c62828;">Salah! Cuba lagi</div>
      <div style="font-size: 16px; margin-top: 15px; font-weight: normal;">
        Padankan komponen dengan bahagian yang betul dalam penyata pendapatan
      </div>
    `;
    
    incorrectSound.play().catch(e => console.log("Audio error:", e));
    
    setTimeout(() => {
      if (document.body.contains(feedback)) {
        feedback.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        feedback.style.opacity = '0';
        feedback.style.transform = 'translate(-50%, -50%) scale(0.8)';
        setTimeout(() => feedback.remove(), 300);
      }
    }, 4000);
  }
  
  feedback.appendChild(closeBtn);
  document.body.appendChild(feedback);
}

function getComponentColor(match) {
  const colors = {
    "hasil": "#ff7043",
    "kos-jualan": "#29b6f6",
    "untung-kasar": "#ab47bc",
    "hasil-lain": "#66bb6a",
    "belanja": "#ffee58",
    "untung-bersih": "#e91e63"
  };
  return colors[match] || "#00e5ff";
}

function updateSeterusnyaButton() {
  const allAnswered = Object.keys(correctAnswers).every(from => connections.has(from));
  
  if (allAnswered) {
    seterusnyaBtn.style.background = "#4CAF50";
    seterusnyaBtn.style.color = "white";
    seterusnyaBtn.style.boxShadow = "0 4px 15px rgba(76, 175, 80, 0.4)";
    seterusnyaBtn.style.cursor = "pointer";
  } else {
    seterusnyaBtn.style.background = "#0b75c9";
    seterusnyaBtn.style.color = "white";
    seterusnyaBtn.style.boxShadow = "0 2px 8px rgba(11, 117, 201, 0.3)";
    seterusnyaBtn.style.cursor = "pointer";
  }
}

// Add resize observer to reposition feedback when sidebar changes
const sidebarObserver = new MutationObserver(() => {
  // Reposition any existing feedback element
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

function checkAllMatches() {
  let correct = 0;
  let total = Object.keys(correctAnswers).length;
  
  for (const [from, correctTo] of Object.entries(correctAnswers)) {
    const userAnswer = connections.get(from);
    const isCorrect = userAnswer === correctTo;
    
    if (isCorrect) correct++;
  }
  
  showResults(correct, total);
}

function showResults(correct, total) {
  const finalScore = document.getElementById("finalScore");
  const resultTitle = document.getElementById("result-title");
  const resultMessage = document.getElementById("result-message");
  const trophyIcon = document.getElementById("trophy-icon");
  
  finalScore.textContent = `${correct}/${total}`;
  
  if (correct === total) {
    excellentSound.play().catch(e => console.log("Audio error:", e));
  }
  
  if (correct === total) {
    resultTitle.textContent = "Tahniah!";
    resultMessage.innerHTML = "<p>🎉 Anda berjaya menjawab semua soalan dengan betul!</p>";
    trophyIcon.textContent = "🏆";
  } else if (correct >= total * 0.7) {
    resultTitle.textContent = "Bagus!";
    resultMessage.innerHTML = `<p>⭐ Anda hampir sempurna! ${correct} daripada ${total} betul.</p>`;
    trophyIcon.textContent = "⭐";
  } else if (correct >= total * 0.5) {
    resultTitle.textContent = "Boleh Ditingkatkan";
    resultMessage.innerHTML = `<p>👍 Anda menjawab ${correct} daripada ${total} dengan betul.</p>`;
    trophyIcon.textContent = "👍";
  } else {
    resultTitle.textContent = "Cuba Lagi";
    resultMessage.innerHTML = `<p>📚 Anda menjawab ${correct} daripada ${total} dengan betul. Jangan berputus asa!</p>`;
    trophyIcon.textContent = "📚";
  }
  
  gameScreen.style.display = 'none';
  resultScreen.classList.add("show");
}

document.addEventListener('DOMContentLoaded', function() {
  seterusnyaBtn.textContent = "Seterusnya →";
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
