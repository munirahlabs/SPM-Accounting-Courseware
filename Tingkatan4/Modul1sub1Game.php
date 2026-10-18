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
      background: url('../img/wall209.png') center center/contain no-repeat;
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
      background: url('../img/wall200.png') center center/cover no-repeat;
    }

    /* HEADER */
    .game-header {
      background: rgba(255, 255, 255, 0.92);
      border-radius: 18px;
      padding: 20px 30px;
      text-align: center;
      margin-bottom: 25px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .game-header h2 {
      color: #d2691e;
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
      background: linear-gradient(135deg, #ff7f50, #ff6347);
      color: #fff;
      padding: 10px 22px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 3px 8px rgba(255, 99, 71, 0.3);
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

    /* LEVEL CARD */
    .level-card {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 20px;
      padding: 25px 35px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .level-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    /* DRAG & DROP AREA */
    .board {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
      margin-top: 10px;
    }

    /* ---------- SOALAN STYLING ---------- */
    .soalan-container {
      margin-bottom: 25px;
    }

    .soalan-description {
      background: #ffffff;
      border: 2px solid #e5e7eb;
      border-radius: 15px;
      padding: 25px 30px;
      margin: 15px 0;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      position: relative;
      overflow: hidden;
    }

    .soalan-description::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .soalan-description.level-2::before {
      background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    /* Styling untuk arahan di ATAS soalan */
    .instruction-above-soalan {
      text-align: left;
      margin-bottom: 25px;
      padding: 15px;
      background: #f9fafb;
      border-radius: 10px;
      border: 2px solid #e5e7eb;
      border-left: 4px solid #9ca3af;
      font-size: 1.1rem;
      font-weight: 600;
      color: #404752ff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .instruction-above-soalan.level-2 {
      border-left: 4px solid #f59e0b;
    }

    .instruction-above-soalan p {
      margin: 0;
    }

    .instruction-above-soalan p::before {
      content: "💡 ";
      font-size: 1.1rem;
      color: #6b7280;
    }

    /* Styling untuk soalan di BAWAH */
    .soalan-below-instruction {
      text-align: center;
      margin-top: 15px;
    }

    .soalan-label {
      color: #4b5563;
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-align: center;
    }

    .soalan-content {
      font-size: 1.4rem;
      margin: 15px 0;
      font-weight: 700;
      color: #1f2937;
      line-height: 1.4;
      text-align: center;
    }

    /* ---------- PANEL STYLING ---------- */
    .panel {
      background: #ffffff;
      border-radius: 15px;
      padding: 20px;
      border: 2px solid #e5e7eb;
      min-height: 300px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    /* Warna border berbeza untuk panel kiri dan kanan */
    .left-panel {
      border-left: 4px solid #f59e0b;
    }

    .right-panel {
      border-left: 4px solid #f59e0b;
    }

    /* Untuk level 2 - warna oren */
    .left-panel.level-2 {
      border-left: 4px solid #f59e0b;
    }

    .right-panel.level-2 {
      border-left: 4px solid #d97706;
    }

    /* Add to CSS */
.target-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  flex-shrink: 0;
  font-family: 'Poppins', sans-serif;
}

/* For better alignment in Level 3 */
.panel.level-2 .target {
  display: flex;
  align-items: center;
  min-height: 60px;
  padding: 12px 15px;
  font-size: 0.95rem;
}
    /* ---------- DRAGGABLE ITEMS ---------- */
    .draggable {
      background: #f59e0b;
      color: white;
      padding: 15px;
      border-radius: 8px;
      margin: 0;
      cursor: grab;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 6px rgba(223, 198, 137, 0.3);
      text-align: center;
      font-size: 1.1rem;
      border: none;
    }

    .draggable:hover {
      background: #fcbe5aff;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(223, 198, 137, 0.3);
    }

    .draggable.dragging {
      opacity: 0.8;
      cursor: grabbing;
      transform: scale(0.98);
    }

    /* Untuk level 2 - draggable bernombor (oren) */
    .draggable.numbered {
      background: #f59e0b;
      box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);
    }

    .draggable.numbered:hover {
      background: #d97706;
      box-shadow: 0 4px 10px rgba(245, 158, 11, 0.4);
    }

    /* ---------- TARGET STYLING ---------- */
    .target {
      background: #ffffff;
      border: 2px dashed #d1d5db;
      border-radius: 8px;
      padding: 12px 14px;
      margin: 0;
      min-height: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      color: #6b7280;
      font-size: 1rem;
      text-align: center;
      line-height: 1.4;
        height: fit-content;
    }

    .panel .target {
  align-self: flex-start;
}

    .target.drag-over {
      background: #f9fafb;
      border-color: #8b5cf6;
      border-style: solid;
      transform: scale(1.01);
    }

    .target.correct {
      background: #f0fdf4;
      border-color: #22c55e;
      color: #166534;
    }

    .target.wrong {
      background: #fef2f2;
      border-color: #ef4444;
      color: #991b1b;
      animation: shake 0.4s ease;
    }

    /* Untuk level 2 - target styling */
    .target.level-2.drag-over {
      border-color: #f59e0b;
    }

    .target.level-2 {
      font-size: 0.95rem;
      line-height: 1.4;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* ---------- FEEDBACK AREA ---------- */
    #feedbackArea {
      margin-top: 15px;
      min-height: 60px;
      text-align: center;
    }

    .feedback {
      padding: 20px;
      border-radius: 12px;
      margin-top: 20px;
      animation: fadeIn 0.3s ease;
      text-align: left;
    }

    .feedback.good {
      background: #dcfce7;
      border-left: 5px solid #22c55e;
      color: #166534;
    }

    .feedback.bad {
      background: #fee2e2;
      border-left: 5px solid #ef4444;
      color: #991b1b;
    }

    /* ---------- CONTROLS ---------- */
    .controls {
      display: flex;
      justify-content: flex-end;
      margin-top: 10px;
    }
    
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
      margin: left;
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .next-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(76, 175, 80, 0.5);

    }

    .btn {
      background: linear-gradient(135deg, #ff7f50 0%, #ff6347 100%);
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(255, 99, 71, 0.3);
    }

    .btn:hover {
      background: linear-gradient(135deg, #ff6347 0%, #ff4500 100%);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 99, 71, 0.4);
    }

    .btn.danger {
      background: #ef4444;
    }

    .btn.danger:hover {
      background: #dc2626;
    }

    /* GAME TOP CONTROLS (HOME + RESET) */
    .game-top-controls {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 15px;
    }

    .game-top-controls .btn {
      padding: 10px 22px;
      font-size: 0.95rem;
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
    /* ---------- LEVEL 2 VERTICAL LAYOUT ---------- */
    .vertical-layout {
      display: flex;
      flex-direction: column;
      gap: 25px;
      margin-top: 20px;
    }
    
    .vertical-panel {
      background: #ffffff;
      border-radius: 15px;
      padding: 25px;
      border: 2px solid #e5e7eb;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .vertical-panel.level-2 {
      border-left: 4px solid #f59e0b;
    }
    
    .draggables-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      margin-top: 15px;
    }
    
    .numbered-target {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 12px;
    }
    
    .target-circle {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: linear-gradient(135deg, #f59e0b, #d97706);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      flex-shrink: 0;
    }

    /* ---------- RESPONSIVE ---------- */
    @media (max-width: 768px) {
      .board {
        grid-template-columns: 1fr;
      }

      .level-card {
        padding: 20px;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      .controls {
        justify-content: center;
      }
      
      .draggables-grid {
        gap: 8px;
      }
      
      .numbered-target {
        gap: 10px;
      }
      
      .target-circle {
        width: 35px;
        height: 35px;
      }
    }

    /* Add to the CSS style section */
/* Update the panel-label CSS to be more consistent */
.panel-label {
  font-family: 'Poppins', sans-serif;
  font-size: 1.2rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 15px;
  text-align: center;
  padding: 8px 0;
  border-bottom: 2px solid #e5e7eb;
}

/* Add this for better visual separation in Level 3 */
.vertical-panel .panel-label {
  border-bottom: 2px solid #f59e0b;
  color: #d97706;
  margin-bottom: 20px;
}

.answer-label {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  color: #f59e0b;
  font-size: 1.1rem;
  min-width: 35px;
  padding-top: 12px;
}

.target-wrapper {
  width: 100%;
}

/* Adjust target styling for labeled targets */
.panel .target-wrapper .target {
  align-self: stretch;
  min-height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 12px 15px;
}
    /* ---------- RESULT SCREEN ---------- */
    #result-screen {
      display: none;
      position: relative;
      min-height: 100vh;
      background: url('../img/wall2.png') center center / cover no-repeat;
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
      font-size: 1.3rem;
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
    
    .panel.level-2 .target {
      padding: 15px;
      min-height: 60px;
      font-size: 0.95rem;
      margin: 5px 0;
    }

    /* Untuk ruang kosong dalam level 2 */
    .target.level-2 {
      font-family: 'Courier New', monospace;
      font-size: 1rem;
      letter-spacing: 0.5px;
      min-height: 60px;
      padding: 15px 10px 15px 20px;
    }

    .target.level-2.drag-over {
      background: #fffbeb;
      border-color: #f59e0b;
      border-style: solid;
    }

    .target.level-2.correct {
      background: #fffbeb;
      border-color: #f59e0b;
      border-style: solid;
      color: #92400e;
    }

    .target.level-2.wrong {
      background: #fef2f2;
      border-color: #ef4444;
      color: #991b1b;
    }

    /* Add this CSS for the row layout */
    @media (max-width: 1024px) {
      .vertical-layout .row-container {
        flex-direction: column;
        align-items: center;
      }
      
      .vertical-layout .row-container .target-wrapper {
        min-width: 90%;
        max-width: 100%;
      }
    }

    @media (max-width: 768px) {
      .draggables-grid {
        gap: 10px;
      }
      
      .draggables-grid .draggable {
        min-width: 160px !important;
        font-size: 0.9rem !important;
        padding: 10px 12px !important;
      }
      
      .vertical-layout .target-wrapper {
        min-width: 100% !important;
        max-width: 100% !important;
      }
      
      /* Responsive for result screen */
      .result-card {
        padding: 30px 20px;
        max-width: 90%;
      }
      
      .result-btns-vertical .button-33 {
        min-width: 160px;
        max-width: 200px;
        padding: 8px 25px;
        font-size: 0.95rem;
      }
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

    <!-- Instruction Modal -->
    <div id="instruction-modal">
      <div class="modal-overlay" onclick="closeInstructions()"></div>
      <div class="modal-content">
        <h2>Arahan Permainan</h2>
        <p>Selamat datang ke <b>ACCsmart: SPM Game</b>! 🧮</p>
        <ul style="text-align:left; line-height:1.6; display: block;">
          <li>👉 Seret (drag) item ke dalam kategori yang betul.</li>
          <li>✅ Jika jawapan betul, anda akan mendapat maklum balas positif.</li>
          <li>❌ Jika salah, cuba lagi sehingga betul.</li>
          <li>🎯 Objektif anda adalah untuk memadankan semua item dengan betul!</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()">Tutup</button>
      </div>
    </div>

    <section id="game-screen">
      <div class="game-container">
        <div class="game-header">
          <div class="game-top-controls" style="display: flex; justify-content: flex-start; gap: 10px;">
            <button class="btn danger" onclick="resetProgress()">🔄 Reset</button>
            <button class="btn" onclick="backToMenu()">🏠 Laman utama</button>
          </div>
          <h2>🎯 Permainan Pengenalan Asas Perakaunan</h2>
          <div class="game-stats">
            <div class="stat-box">📊 Level: <span id="currentLevel">1</span>/3</div>
            <div class="stat-box">⭐ Skor: <span id="score">0</span></div>
          </div>
        </div>

        <div id="levelContainer"></div>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Permainan Selesai!</h2>
        <p id="resultText" style="color: #6b7280; margin: 15px 0;">--</p>
        <div class="final-score" id="finalScore">0</div>

        <!-- Buttons inside the card - stacked vertically -->
        <div class="result-btns-vertical">
          <a href="javascript:void(0)" class="button-33 first-btn" onclick="tryAgain()">Cuba lagi</a>
          <a href="javascript:void(0)" class="button-33 second-btn" onclick="backToMenu()">Menu Utama</a>
        </div>
      </div>
    </section>

  
  </main>
</div>
<button class="floating-toggle" id="floatingToggle">☰</button>

<div id="toast-notification" class="toast-notification warning">
  <div class="toast-icon">⚠️</div>
  <div class="toast-content">
    Sila lengkapkan semua padanan sebelum meneruskan!
  </div>
</div>

<script src="../js/navigation.js"></script>

<script>
// Game Levels Configuration - UPDATED WITH BETTER EXPLANATIONS
// Game Levels Configuration - UPDATED WITH BETTER EXPLANATIONS
const levels = [
  {
    id: 1,
    soalan: "Padankan definisi berikut ke kotak 'Pilihan Jawapan' yang betul.",
    type: 'match',
    keys: [
      {
        key: 'Simpan kira',
        match: 'A',
        explain: 'Simpan Kira menumpukan pada merekod transaksi secara sistematik. Ia membina asas untuk langkah seterusnya dalam perakaunan, seperti pelaporan dan analisis. Tanpa simpan kira yang baik, perakaunan tidak boleh dijalankan dengan efektif.'
      },
    ],
    values: [
      {
        id: 'A',
        text: 'Proses perakaunan yang meliputi aktiviti mengumpul, menyusun, menyimpan, merekod dan melapor rekod-rekod perakaunan',
        label: 'A)'
      },
      {
        id: 'X',
        text: 'Aktiviti merancang, mengawal dan membuat keputusan berkaitan penggunaan wang dalam sesebuah organisasi',
        label: 'B)'
      }
    ]
  },
  {
    id: 2,
    soalan: "Padankan definisi berikut ke kotak 'Pilihan Jawapan' yang betul.",
    type: 'match',
    keys: [
      {
      key: 'Perakaunan',
      match: 'B', // This should match the item with id: 'B'
        explain: 'Perakaunan adalah bidang yang lebih luas yang meliputi aktiviti mengumpul, menyusun, menyimpan, merekod, melapor, menganalisis, mentafsir, merancang, menilai dan merumus maklumat kewangan. Ia menggunakan data dari simpan kira untuk membuat keputusan perniagaan.'
      },
    ],
    values: [
      {
       id: 'X',  // Distraction - appears first with A) label
        text: 'Aktiviti merancang, mengawal dan membuat keputusan berkaitan penggunaan wang dalam sesebuah organisasi',
         label: 'A)'
      },
      {
         id: 'B',
        text: 'Bidang yang lebih luas iaitu meliputi aktiviti mengumpul, menyusun, menyimpan, merekod, melapor, menganalisis, mentafsir, merancang, menilai dan merumus',
         label: 'B)'
      }
    ]
  },
  {
    id: 3,
    arahan: "Arahan: Susun langkah-langkah kitaran yang diberikan mengikut urutan yang betul di kotak sebelah.",
    soalan: "Susun langkah-langkah kitaran yang diberikan mengikut urutan yang betul di kotak sebelah.",
    type: 'match-sequence',
    items: [
      {
        key: 'Dokumen Sumber', 
        value: '1', 
        explain: 'Dokumen Sumber ialah langkah pertama dalam kitaran perakaunan. Ini termasuk invois, resit, baucer dan dokumen perniagaan lain yang membuktikan berlakunya transaksi. Tanpa dokumen sumber, tiada rekod boleh dibuat. Contoh: Resit pembelian, invois jualan, baucer bank.'
      },
      {
        key: 'Buku Catatan Pertama', 
        value: '2', 
        explain: 'Buku Catatan Pertama (seperti Jurnal Am dan Jurnal Khas) ialah tempat dokumen sumber direkodkan secara kronologi. Setiap transaksi direkodkan dengan tarikh, butiran, debit dan kredit. Semua transaksi mesti direkodkan di sini sebelum dipindahkan ke lejar.'
      },
      {
        key: 'Lejar', 
        value: '3', 
        explain: 'Lejarialah langkah ketiga di mana maklumat dari buku catatan pertama dipindahkan ke akaun-akaun khusus (seperti Akaun Tunai, Akaun Belanja). Ini dikenali sebagai "posting" dan mengklasifikasikan transaksi mengikut jenis akaun untuk analisis yang lebih mudah.'
      },
      {
        key: 'Imbangan Duga', 
        value: '4', 
        explain: 'Imbangan Duga disediakan untuk menguji kesamaan jumlah debit dan kredit dalam lejar. Jika imbangan duga tidak seimbang, terdapat kesilapan dalam merekod yang perlu dibetulkan. Ia membantu mengesahkan ketepatan catatan sebelum membuat pelarasan.'
      },
      {
        key: 'Pelarasan', 
        value: '5', 
        explain: 'Pelarasan dibuat untuk memastikan pendapatan dan belanja direkod dalam tempoh perakaunan yang betul. Contoh pelarasan termasuk susut nilai, belanja terdahulu, pendapatan belum terima dan belanja belum bayar. Ini memastikan prinsip perakaunan accrual dipatuhi.'
      },
      {
        key: 'Imbangan Duga Terselaras', 
        value: '6', 
        explain: 'Imbangan Duga Terselaras disediakan selepas membuat pelarasan. Ia menunjukkan baki terkini semua akaun selepas pelarasan dan merupakan asas untuk menyediakan penyata kewangan. Ini adalah langkah terakhir sebelum menyediakan laporan kewangan.'
      },
      {
        key: 'Catatan Penutupan', 
        value: '7', 
        explain: 'Catatan Penutupan dibuat untuk menutup akaun sementara (Akaun Pendapatan dan Belanja) ke Akaun Untung Rugi. Ini "mengosongkan" akaun sementara untuk tempoh perakaunan baru. Akaun modal dikemaskini dengan untung atau rugi.'
      },
      {
        key: 'Penyata Kewangan', 
        value: '8', 
        explain: 'Penyata Kewangan (termasuk Penyata Pendapatan dan Kunci Kira-kira) ialah produk akhir kitaran perakaunan. Ia melaporkan prestasi dan kedudukan kewangan perniagaan untuk membantu pengguna seperti pelabur, pemiutang dan pengurusan membuat keputusan.'
      },
    ]
  }
];

// Game State
let current = 0;
let score = 0;
let levelComplete = false;

// DOM Elements
const startScreen = document.getElementById('start-screen');
const instrScreen = document.getElementById('instruction-modal');
const gameScreen = document.getElementById('game-screen');
const resultScreen = document.getElementById('result-screen');
const levelContainer = document.getElementById('levelContainer');
const currentLevelEl = document.getElementById('currentLevel');
const scoreEl = document.getElementById('score');
const resultText = document.getElementById('resultText');
const finalScore = document.getElementById('finalScore');
const highscoreDisplay = document.getElementById('highscoreDisplay');

// Sound Effects
const correctSound = new Audio("../audio/correct_answer_sound.mp3");
const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
const excellentSound = new Audio("../audio/congrats_sound.mp3");
const poorSound = new Audio("../audio/fail_sound.mp3");
const warningSound = new Audio("https://assets.mixkit.co/sfx/preview/mixkit-warning-alarm-buzzer-958.mp3");

// Navigation Functions
function startGame() {
  startScreen.style.display = 'none';
  gameScreen.style.display = 'block';
  current = 0;
  score = 0;
  levelComplete = false;
  updateScore();
  loadLevel();
}

function showInstructions() {
  instrScreen.classList.add('show');
}

function closeInstructions() {
  instrScreen.classList.remove('show');
}

function resetProgress() {
  if (confirm('Reset skor dan mula semula dari awal?')) {
    current = 0;
    score = 0;
    levelComplete = false;
    updateScore();
    loadLevel();
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
  currentLevelEl.textContent = (current + 1);
}

// Toast notification functions
function showToast(message, type = 'warning') {
  const toast = document.getElementById('toast-notification');
  const toastContent = toast.querySelector('.toast-content');
  
  // Update toast content and type
  toastContent.textContent = message;
  toast.className = `toast-notification ${type}`;
  
  // Update icon based on type
  const toastIcon = toast.querySelector('.toast-icon');
  toastIcon.textContent = type === 'warning' ? '⚠️' : '✅';
  
  // Show toast
  toast.classList.add('show');
  
  // Play warning sound for warning type
  if (type === 'warning') {
    warningSound.currentTime = 0;
    warningSound.play().catch(e => console.log("Audio error:", e));
  }
  
  // Auto-hide after 3 seconds
  setTimeout(() => {
    toast.classList.remove('show');
  }, 7000);
}

function loadLevel() {
  const lvl = levels[current];
  currentLevelEl.textContent = (current + 1);
  levelContainer.innerHTML = '';
  levelComplete = false;

  const wrapper = document.createElement('div');
  wrapper.className = 'level-card';
  
  // ===== NEW: ARAHAN & SOALAN SECTION =====
  // Soalan container
  const soalanContainer = document.createElement('div');
  soalanContainer.className = 'soalan-container';
  
  // Arahan (Instruction above soalan)
  const arahanElement = document.createElement('div');
  arahanElement.className = `instruction-above-soalan ${lvl.id === 3 ? 'level-2' : ''}`;
  
  // Soalan Description Box
  const description = document.createElement('div');
  description.className = `soalan-description ${lvl.id === 3 ? 'level-2' : ''}`;
  
  const soalanLabel = document.createElement('div');
  soalanLabel.className = 'soalan-label';
  soalanLabel.textContent = 'ARAHAN:';
  
  const soalanContent = document.createElement('div');
  soalanContent.className = 'soalan-content';
  soalanContent.textContent = lvl.soalan;
  
  description.appendChild(soalanLabel);
  description.appendChild(soalanContent);
  soalanContainer.appendChild(description);
  
  wrapper.appendChild(soalanContainer);
  // ===== END NEW SECTION =====
  
  // Continue with the existing code for creating game board based on level type
  if (lvl.type === 'match') {
    // Level 1 & 2 (Simpan Kira & Perakaunan) with keys, values, and distraction
    const board = document.createElement('div');
    board.className = 'board';
    
    const left = document.createElement('div');
    left.className = 'panel left-panel';
    
    const right = document.createElement('div');
    right.className = 'panel right-panel';

    // Add "Definisi:" label above the draggable items (left panel)
    const definisiLabel = document.createElement('div');
    definisiLabel.className = 'panel-label';
    definisiLabel.textContent = 'Definisi:';
    left.appendChild(definisiLabel);

    // Create draggable items from keys - NO SHUFFLE
    const leftItems = lvl.keys.map(k => k.key); // REMOVED shuffleArray()
    leftItems.forEach(text => {
      const d = makeDraggable(text, false);
      left.appendChild(d);
    });

    // Add "Jawapan pilihan:" label above the targets (right panel)
    const jawapanLabel = document.createElement('div');
    jawapanLabel.className = 'panel-label';
    jawapanLabel.textContent = 'Pilihan Jawapan:';
    right.appendChild(jawapanLabel);

    // Create targets from values (includes distraction) with A) and B) labels
    // NO SHUFFLE - keep A then B order
    const valueItems = lvl.values; // REMOVED shuffleArray()
    
    valueItems.forEach((val, index) => {
      // Create wrapper for labeled target
      const targetWrapper = document.createElement('div');
      targetWrapper.className = 'target-wrapper';
      targetWrapper.style.display = 'flex';
      targetWrapper.style.alignItems = 'flex-start';
      targetWrapper.style.gap = '10px';
      targetWrapper.style.marginBottom = '15px';
      
      // Add A) or B) label - USE THE LABEL PROPERTY
      const labelSpan = document.createElement('span');
      labelSpan.className = 'answer-label';
      
      // Use the label property if it exists, otherwise fallback
      if (val.label) {
        labelSpan.textContent = val.label;
      } else {
        // Fallback logic (shouldn't be needed with our updated data)
        labelSpan.textContent = val.id === 'X' ? (index === 0 ? 'A)' : 'B)') : 
                               val.id === 'A' ? 'A)' : 
                               val.id === 'B' ? 'B)' : 'X)';
      }
      
      const t = makeTarget(val.text, false);
      t.dataset.matchId = val.id;
      t.dataset.value = val.text;
      t.style.flex = '1';
      
      targetWrapper.appendChild(labelSpan);
      targetWrapper.appendChild(t);
      right.appendChild(targetWrapper);
    });

    board.appendChild(left);
    board.appendChild(right);
    wrapper.appendChild(board);

  } else if (lvl.type === 'match-sequence') {
    // Level 3: Accounting cycle matching sequence - COMBINED LAYOUT
    const combinedBoard = document.createElement('div');
    combinedBoard.className = 'board';
    
    // Left panel: Draggable steps
    const leftPanel = document.createElement('div');
    leftPanel.className = 'panel left-panel level-2';
    
    // Add "Langkah-langkah Kitaran Perakaunan:" label
    const leftHeader = document.createElement('div');
    leftHeader.className = 'panel-label';
    leftHeader.textContent = 'Langkah-langkah Kitaran Perakaunan:';
    leftPanel.appendChild(leftHeader);
    
    // Create draggable items container
    const draggableContainer = document.createElement('div');
    draggableContainer.style.display = 'flex';
    draggableContainer.style.flexDirection = 'column';
    draggableContainer.style.gap = '12px';
    draggableContainer.style.marginTop = '10px';
    
    const leftItems = shuffleArray(lvl.items.map(i => i.key));
    leftItems.forEach(text => {
      const d = makeDraggable(text, false);
      d.classList.add('numbered');
      d.style.width = '100%';
      d.style.textAlign = 'center';
      d.style.fontSize = '1rem';
      d.style.padding = '12px 15px';
      draggableContainer.appendChild(d);
    });
    
    leftPanel.appendChild(draggableContainer);
    
    // Right panel: Numbered sequence targets
    const rightPanel = document.createElement('div');
    rightPanel.className = 'panel right-panel level-2';
    
    // Add "Turutan Kitaran Perakaunan:" label
    const rightHeader = document.createElement('div');
    rightHeader.className = 'panel-label';
    rightHeader.textContent = 'Turutan Kitaran Perakaunan:';
    rightPanel.appendChild(rightHeader);
    
    // Create numbered targets in vertical layout
    const targetContainer = document.createElement('div');
    targetContainer.style.display = 'flex';
    targetContainer.style.flexDirection = 'column';
    targetContainer.style.gap = '15px';
    targetContainer.style.marginTop = '10px';
    
    // Create 8 numbered targets in a single column
    const totalTargets = 8;
    
    for (let i = 0; i < totalTargets; i++) {
      const targetWrapper = document.createElement('div');
      targetWrapper.style.display = 'flex';
      targetWrapper.style.alignItems = 'center';
      targetWrapper.style.gap = '15px';
      targetWrapper.style.width = '100%';
      
      const numberLabel = document.createElement('div');
      numberLabel.className = 'target-circle';
      numberLabel.textContent = i + 1;
      numberLabel.style.width = '40px';
      numberLabel.style.height = '40px';
      numberLabel.style.flexShrink = '0';
      
      // Create empty target box (no number inside)
      const target = makeTarget('', true); // Pass true for Level 3
      target.classList.add('level-2');
      target.style.flex = '1';
      target.style.minHeight = '60px';
      target.style.padding = '12px 15px';
      target.style.textAlign = 'left';
      target.dataset.expectedNumber = i + 1;
      target.dataset.value = ''; // Empty value
      
      targetWrapper.appendChild(numberLabel);
      targetWrapper.appendChild(target);
      targetContainer.appendChild(targetWrapper);
    }
    
    rightPanel.appendChild(targetContainer);
    
    combinedBoard.appendChild(leftPanel);
    combinedBoard.appendChild(rightPanel);
    wrapper.appendChild(combinedBoard);
  }

  const feedback = document.createElement('div');
  feedback.id = 'feedbackArea';
  feedback.style.marginTop = '25px';
  wrapper.appendChild(feedback);

  const controls = document.createElement('div');
  controls.className = 'controls';
  const nextBtn = document.createElement('button');
  nextBtn.className = 'btn next-btn';
  nextBtn.textContent = 'Seterusnya →';
  nextBtn.onclick = () => { 
    checkLevelCompletion(nextBtn, lvl);
  };
  controls.appendChild(nextBtn);
  wrapper.appendChild(controls);

  levelContainer.appendChild(wrapper);
  attachDragDrop();
}

function checkLevelCompletion(nextBtn, lvl) {
  if (lvl.type === 'match') {
    // For Levels 1 & 2: Check if all draggables have been matched
    const allDragged = document.querySelectorAll('.draggable[style*="display: none"]').length === lvl.keys.length;
    
    if (allDragged) {
      // All items have been dragged
      levelComplete = true;
      finishLevel();
    } else {
      // Show toast notification
      const remaining = lvl.keys.length - document.querySelectorAll('.draggable[style*="display: none"]').length;
      showToast(`Sila lengkapkan semua padanan! ${remaining} lagi perlu dipadankan.`, 'warning');
      
      // Add shake animation to button
      nextBtn.style.animation = 'shake 0.5s ease';
      setTimeout(() => {
        nextBtn.style.animation = '';
      }, 500);
    }
  } else if (lvl.type === 'match-sequence') {
    // For Level 3: Check if all 8 items have been matched
    const matchedTargets = document.querySelectorAll('.target.level-2[data-correct="true"]').length;
    const totalTargets = 8;
    
    if (matchedTargets === totalTargets) {
      levelComplete = true;
      finishLevel();
    } else {
      const remaining = totalTargets - matchedTargets;
      showToast(`Sila lengkapkan semua padanan! ${remaining} langkah lagi perlu dipadankan.`, 'warning');
      
      // Add shake animation to button
      nextBtn.style.animation = 'shake 0.5s ease';
      setTimeout(() => {
        nextBtn.style.animation = '';
      }, 500);
    }
  }
}

function finishLevel() {
  if (current < levels.length - 1) {
    current++;
    loadLevel();
  } else {
    showResult();
  }
}

function showResult() {
  gameScreen.style.display = 'none';
  resultScreen.classList.add('show');
  
  // Calculate total possible score
  const totalPossibleScore = levels.reduce((total, level) => {
    if (level.type === 'match') {
      return total + level.keys.length;
    } else if (level.type === 'match-sequence') {
      return total + level.items.length;
    }
    return total;
  }, 0);
  
  finalScore.textContent = `${score} / ${totalPossibleScore}`;
  
  // Calculate percentage
  const percentage = (score / totalPossibleScore) * 100;
  let message = "";
  
  if (percentage >= 70) {
    message = "🎉 Cemerlang! Anda sangat mahir dalam topik perakaunan!";
    excellentSound.play();
  } else {
    message = "💪 Anda perlu mengulangkaji topik perakaunan. Jangan putus asa!";
    poorSound.play();
  }
  
  resultText.textContent = message;

  // Save score to session
  fetch(window.location.href, {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `action=save_score&score=${score}`
  })
  .then(r => r.json())
  .then(j => {
    if (j.highscore !== undefined) {
      highscoreDisplay.textContent = j.highscore;
    }
  });
}

// Drag & Drop Functions
function makeDraggable(text, isNumbered = false) {
  const d = document.createElement('div');
  d.className = isNumbered ? 'draggable numbered' : 'draggable';
  d.textContent = text;
  d.draggable = true;
  d.ondragstart = (e) => {
    e.dataTransfer.setData('text/plain', text);
    e.dataTransfer.effectAllowed = 'move';
    d.classList.add('dragging');
  };
  d.ondragend = (e) => {
    d.classList.remove('dragging');
  };
  return d;
}

function makeTarget(val, isLevel3 = false) {
  const t = document.createElement('div');
  t.className = 'target expecting';
  t.dataset.value = val;
  
  // For Level 3 - create empty target box
  if (isLevel3) {
    // Create placeholder text
    const placeholder = document.createElement('span');
    placeholder.textContent = 'Seret jawapan ke sini';
    placeholder.style.fontStyle = 'italic';
    placeholder.style.color = '#9ca3af';
    placeholder.style.fontSize = '0.95rem';
    
    t.appendChild(placeholder);
    t.style.display = 'flex';
    t.style.alignItems = 'center';
    t.style.justifyContent = 'center';
    t.style.color = '#6b7280';
    t.style.fontFamily = "'Poppins', sans-serif";
    t.style.fontSize = '1rem';
    t.style.fontWeight = '600';
    t.style.textAlign = 'center';
    t.style.lineHeight = '1.4';
  } else {
    // For Levels 1 & 2
    t.textContent = val;
  }
  
  return t;
}

function attachDragDrop() {
  document.querySelectorAll('.target.expecting').forEach(t => {
    t.ondragover = (e) => {
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
      t.classList.add('drag-over');
    };
    t.ondragleave = (e) => {
      t.classList.remove('drag-over');
    };
    t.ondrop = (e) => {
      e.preventDefault();
      t.classList.remove('drag-over');
      const data = e.dataTransfer.getData('text/plain');
      handleDrop(t, data);
    };
  });
}

function handleDrop(target, draggedText) {
  const lvl = levels[current];
  let correct = false;
  let explanation = '';
  let feedbackMessage = '';
  let correctAnswerKey = '';
  let correctAnswerText = '';

  if (lvl.type === 'match') {
    // Levels 1 & 2 (Simpan Kira & Perakaunan)
    const draggedKey = lvl.keys.find(k => k.key === draggedText);
    const targetValue = lvl.values.find(v => v.text === target.dataset.value);
    
    // Find the CORRECT answer for the dragged item
    const correctKeyForDragged = lvl.keys.find(k => k.key === draggedText);
    const correctValueForDragged = lvl.values.find(v => v.id === correctKeyForDragged?.match);
    
    // Determine the correct letter and text
    const correctLetter = correctValueForDragged?.id === 'A' ? 'A' : 
                         correctValueForDragged?.id === 'B' ? 'B' : 'X';
    const correctText = correctValueForDragged?.text || target.dataset.value;
    
    // Get explanation from the correct key for the dragged item
    explanation = correctKeyForDragged?.explain || draggedKey?.explain || '';
    
    if (draggedKey && targetValue && draggedKey.match === targetValue.id) {
      correct = true;
      feedbackMessage = `
        <div style="margin-bottom: 10px;">
          <span style="background: #22c55e; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">Betul!</span>
        </div>
        <div>
          <span style="font-weight: bold; color: #166534; font-size: 1.3em;">Penerangan:</span><br>
          ${explanation}
        </div>
      `;
      
      // Update target to show the correct match
      target.innerHTML = `
        <div style="font-weight: bold; color: #166534; font-size: 1.1em;">
          ${draggedText}
        </div>
        <div style="font-size: 0.9em; color: #4b5563; margin-top: 5px;">
          ${target.dataset.value}
        </div>
      `;
      target.dataset.matched = draggedText;
      
      // Auto-scroll to feedback area for CORRECT answer too
      setTimeout(() => {
        const feedbackBox = document.querySelector('#feedbackArea .feedback');
        if (feedbackBox) {
          feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 700);
      
    } else {
      // WRONG ANSWER - Show correct answer and explanation
      feedbackMessage = `
        <div style="margin-bottom: 10px;">
          <span style="background: #ef4444; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">Salah!</span>
        </div>
        <div style="margin-bottom: 15px;">
          <span style="font-weight: bold; color: #991b1b; font-size: 1.3em;">Jawapan yang betul:</span><br> 
          <span style="background: #f0f9ff; padding: 8px 15px; border-radius: 10px; display: inline-block; margin-top: 5px; border-left: 4px solid #3b82f6; font-weight: bold; color: #1e40af;">
            ${correctLetter}) ${correctText}
          </span>
        </div>
        <div>
          <span style="font-weight: bold; color: #991b1b; font-size: 1.3em;">Penerangan:</span><br>
          ${explanation}
        </div>
      `;
      
      // Auto-scroll to feedback area after showing
      setTimeout(() => {
        const feedbackBox = document.querySelector('#feedbackArea .feedback');
        if (feedbackBox) {
          feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }, 700);
      
      // Reveal correct answer on target
      target.innerHTML = `
        <div style="font-weight: bold; color: #166534; font-size: 1.1em;">
          ${correctKeyForDragged?.key || ''}
        </div>
        <div style="font-size: 0.9em; color: #4b5563; margin-top: 5px;">
          ${target.dataset.value}
        </div>
      `;
      target.dataset.matched = correctKeyForDragged?.key || '';
    }
    
  } else if (lvl.type === 'match-sequence') {
    // Level 3: Accounting cycle - WITH FEEDBACK FOR CORRECT ANSWERS
    const found = lvl.items.find(i => i.key === draggedText);
    if (found) {
      const itemIndex = lvl.items.findIndex(i => i.key === draggedText);
      const expectedNumber = parseInt(target.dataset.expectedNumber);
      
      if (itemIndex + 1 === expectedNumber) {
        correct = true;
        explanation = found.explain; // Get explanation for correct answer
        
        // Update target to show correct answer (without number inside)
        target.innerHTML = `<span style="font-weight: bold; color: #1f2937;">${draggedText}</span>`;
        target.dataset.value = draggedText;
        target.dataset.correct = 'true';
        
        // SHOW FEEDBACK MESSAGE FOR CORRECT ANSWER IN MATCH-SEQUENCE
        feedbackMessage = `
          <div style="margin-bottom: 10px;">
            <span style="background: #22c55e; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.3em;">Betul!</span>
          </div>
          <div>
            <span style="font-weight: bold; color: #166534; font-size: 1.3em;">Penerangan:</span><br>
            ${explanation}
          </div>
        `;
        
        // Show brief positive visual feedback
        target.style.background = '#f0fdf4';
        target.style.borderColor = '#22c55e';
        setTimeout(() => {
          if (target.dataset.correct === 'true') {
            target.style.background = '#ffffff';
          }
        }, 1000);
        
        // Auto-scroll to feedback area for CORRECT answer
        setTimeout(() => {
          const feedbackBox = document.querySelector('#feedbackArea .feedback');
          if (feedbackBox) {
            feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }, 300);
        
      } else {
        // Show temporary wrong feedback in target box only
        const originalHTML = target.innerHTML;
        target.innerHTML = `<span style="color: #ef4444; font-weight: bold;">Salah! Cuba lagi</span>`;
        target.style.color = '#ef4444';
        target.style.background = '#fef2f2';
        target.style.borderColor = '#ef4444';
        
        // NO FEEDBACK MESSAGE FOR WRONG ANSWER IN MATCH-SEQUENCE
        feedbackMessage = ''; // Empty feedback message
        
        // Reset after 1 second
        setTimeout(() => {
          if (!target.dataset.correct) {
            target.innerHTML = `<span style="font-style: italic; color: #9ca3af;">Seret jawapan ke sini</span>`;
            target.style.color = '#6b7280';
            target.style.background = '#ffffff';
            target.style.borderColor = '#d1d5db';
          }
        }, 1000);
      }
    } else {
      // NO FEEDBACK MESSAGE IF ITEM NOT FOUND
      feedbackMessage = ''; // Empty feedback message
    }
  }

  target.classList.remove('correct', 'wrong');
  const feedbackArea = document.getElementById('feedbackArea');
  feedbackArea.innerHTML = '';

  if (correct) {
    target.classList.add('correct');
    score += 1;
    updateScore();
    
    // Only create feedback element if there's a feedback message
    if (feedbackMessage) {
      const f = document.createElement('div');
      f.className = 'feedback good';
      f.innerHTML = feedbackMessage;
      feedbackArea.appendChild(f);
    }
    
    // Play correct sound for ALL correct answers (both match and match-sequence)
    correctSound.play();
    
    // Remove dragged item
    const draggedItem = Array.from(document.querySelectorAll('.draggable')).find(d => d.textContent === draggedText);
    if (draggedItem) draggedItem.style.display = 'none';
    
  } else {
    target.classList.add('wrong');
    
    // Only create feedback element if there's a feedback message
    if (feedbackMessage) {
      const f = document.createElement('div');
      f.className = 'feedback bad';
      f.innerHTML = feedbackMessage;
      feedbackArea.appendChild(f);
    }
    
    // Play incorrect sound for wrong answers
    incorrectSound.play();
    
    // For Levels 1 & 2, remove the dragged item even if wrong (since answer is revealed)
    if (lvl.type === 'match') {
      const draggedItem = Array.from(document.querySelectorAll('.draggable')).find(d => d.textContent === draggedText);
      if (draggedItem) draggedItem.style.display = 'none';
    }
  }
}

// Utility Functions
function shuffleArray(a) {
  const arr = a.slice();
  for (let i = arr.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
  return arr;
}

// Auto-hide feedback after 6 seconds
setInterval(() => {
  const feedbackArea = document.getElementById('feedbackArea');
  if (!feedbackArea) return;

  feedbackArea.querySelectorAll('.feedback').forEach(feedback => {
    if (!feedback.dataset.timestamp) {
      feedback.dataset.timestamp = Date.now();
    }
    const age = Date.now() - feedback.dataset.timestamp;
    if (age > 6000) {
      feedback.style.transition = 'opacity 1s ease';
      feedback.style.opacity = '0';
      setTimeout(() => {
        if (feedback.parentNode) feedback.remove();
      }, 1000);
    }
  });
}, 500);
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