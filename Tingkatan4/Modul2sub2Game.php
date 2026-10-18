<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">
  <title>ACCsmart: Spinning Wheel Game</title>
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
      background: url('../img/26.png') center center/contain no-repeat;
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

    .button-group {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 280px;
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
  background: linear-gradient(180deg, #cfeeff, #b9e2ff);
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

    /* WHEEL CONTAINER BOX */
    .wheel-box-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 18px;
      padding: 30px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      max-width: 1100px;
      margin: 0 auto 25px auto;
      width: 100%;
      box-sizing: border-box;
      border: 3px solid #FFD6E0;
      text-align: center;
      position: relative;
    }

    .wheel-box-container h3 {
      color: #EF476F;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      letter-spacing: 0.5px;
    }

    /* ---------- WHEEL GAME STYLES ---------- */
    
    .wheel-game-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }

    /* Wheel Container - Redesigned like the image */
    .wheel-container {
      position: relative;
      width: 450px;
      height: 450px;
      margin: 20px auto;
    }

    .wheel-arrow {
      position: absolute;
      top: -50px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      color: #FF6B8B;
      font-size: 52px;
      text-shadow: 0 4px 8px rgba(0,0,0,0.2);
      filter: drop-shadow(0 4px 2px rgba(0,0,0,0.3));
    }

    .wheel {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      position: relative;
      overflow: hidden;
      box-shadow: 
     0 0 0 12px #f9f5f6ff,  /* soft pastel ring */
  0 0 0 18px #312f32ff,  /* lavender outer ring */
  0 15px 40px rgba(0,0,0,0.25);

      transition: transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99);
      background: #fdf9f4ff;
    }

    .wheel-segment {
      position: absolute;
      width: 50%;
      height: 50%;
      transform-origin: bottom right;
      left: 0;
      top: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      clip-path: polygon(0 0, 100% 100%, 100% 0);
      transition: all 0.3s ease;
    }

    .wheel-segment.answered {
      opacity: 0.5;
      filter: grayscale(80%);
    }

    .wheel-segment.answered .segment-content {
      text-decoration: line-through;
      opacity: 0.6;
    }

    .segment-content {
      position: absolute;
      font-size: 42px;
      font-weight: 900;
      color: white;
      text-shadow: 3px 3px 0 rgba(0,0,0,0.2);
      transform-origin: center;
      left: 90px;
      top: 30px;
      transition: all 0.3s ease;
    }

    .wheel-center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100px;
      height: 100px;
      background: white;
      border-radius: 50%;
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 
        inset 0 0 10px rgba(0,0,0,0.1),
        0 8px 20px rgba(0,0,0,0.2);
      font-size: 28px;
      font-weight: 900;
      color: #EF476F;
      border: 6px solid #FFD166;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .wheel-center:hover {
      transform: translate(-50%, -50%) scale(1.05);
      box-shadow: 
        inset 0 0 15px rgba(0,0,0,0.1),
        0 10px 25px rgba(0,0,0,0.3);
    }

    .wheel-center.spinning {
      animation: spinCenter 2s infinite linear;
    }

    @keyframes spinCenter {
      from { transform: translate(-50%, -50%) rotate(0deg); }
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Spin Button */
    .spin-btn {
      background: linear-gradient(135deg, #EF476F, #FF6B8B);
      color: white;
      border: none;
      padding: 18px 50px;
      border-radius: 40px;
      font-size: 1.3rem;
      font-weight: 700;
      cursor: pointer;
      margin-top: 20px;
      box-shadow: 0 8px 25px rgba(239, 71, 111, 0.4);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 12px;
      letter-spacing: 1px;
      text-transform: uppercase;
        box-shadow:
    0 10px 20px rgba(255, 47, 85, 0.35),
    0 4px 8px rgba(0, 0, 0, 0.15);

  transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    
    
    .spin-btn:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 30px rgba(239, 71, 111, 0.5);
      background: linear-gradient(135deg, #FF6B8B, #EF476F);
    }

    .spin-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
      box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
    }

    /* QUESTION BOX (Under game header) */
    .question-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 18px;
      padding: 30px;
      max-width: 1100px;
      margin: 0 auto 25px auto;
      width: 100%;
      box-sizing: border-box;
      border: 3px solid #eef1f0ff;
      display: none;
    }

    .question-container.show {
      display: block;
      animation: slideUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .question-box-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 3px solid #E0E7FF;
    }

    .question-number-box {
      background: linear-gradient(135deg, #118AB2, #073B4C);
      color: white;
      padding: 12px 28px;
      border-radius: 25px;
      font-size: 1.3rem;
      font-weight: 700;
    }

    .question-nav-top {
      display: flex;
      gap: 10px;
    }

    .question-text-box {
      font-size: 1.5rem;
      line-height: 1.7;
      color: #073B4C;
      margin-bottom: 40px;
      padding: 25px;
      background: linear-gradient(135deg, #f8faff, #eef2ff);
      border-radius: 20px;
      border-left: 8px solid #f7f4f4ff;
    }

    .options-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .blank-box {
  display: inline-block;
  min-width: 90px;
  padding: 6px 12px;
  margin: 0 6px;
  border: 2px dashed #3643d1;
  border-radius: 8px;
  background: #ffffff;
  color: transparent;
  vertical-align: middle;
}


    .option-btn {
      background: white;
      border: 3px solid #E0E7FF;
      border-radius: 20px;
      padding: 20px;
      font-size: 1.1rem;
      color: #073B4C;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: left;
      font-weight: 500;
      position: relative;
      overflow: hidden;
    }

    .option-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: #E0E7FF;
    }

    .option-btn:hover {
      background: linear-gradient(135deg, #f0f4ff, #e6ebff);
      transform: translateY(-4px);
      border-color: #118AB2;
      box-shadow: 0 8px 25px rgba(17, 138, 178, 0.2);
    }

    .option-a {
    border-color: #EF476F !important;
    border-left: 8px solid #EF476F !important;
}

.option-a:hover {
    border-color: #EF476F !important;
    box-shadow: 0 8px 25px rgba(239, 71, 111, 0.3) !important;
}

.option-b {
    border-color: #FFD166 !important;
    border-left: 8px solid #FFD166 !important;
}

.option-b:hover {
    border-color: #FFD166 !important;
    box-shadow: 0 8px 25px rgba(255, 209, 102, 0.3) !important;
}

.option-c {
    border-color: #06D6A0 !important;
    border-left: 8px solid #06D6A0 !important;
}

.option-c:hover {
    border-color: #06D6A0 !important;
    box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3) !important;
}

.option-d {
    border-color: #118AB2 !important;
    border-left: 8px solid #118AB2 !important;
}

.option-d:hover {
    border-color: #118AB2 !important;
    box-shadow: 0 8px 25px rgba(17, 138, 178, 0.3) !important;
}

    .option-btn.correct {
      background: linear-gradient(135deg, #D4F7E2, #B8F1D5);
      border-color: #06D6A0;
      color: #035D46;
      box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);
    }

    .option-btn.wrong {
      background: linear-gradient(135deg, #FFE4E4, #FFD1D1);
      border-color: #EF476F;
      color: #9C2C3D;
      box-shadow: 0 8px 25px rgba(239, 71, 111, 0.3);
    }

    .question-nav-bottom {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .question-nav-bottom .control-btn {
      padding: 15px 35px;
      font-size: 1rem;
    }

    .question-nav-bottom .next-btn {
  margin-left: auto;
}

    /* MODIFIED: Game Screen Overlay (only covers game screen) */
/* FIXED: Game Screen Overlay (covers entire viewport) */
.game-overlay {
  position: fixed;  /* Changed from absolute to fixed */
  top: 64px;        /* Account for top navigation */
  left: 400px;      /* Account for sidebar width */
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(10px);
  z-index: 100;
  display: none;
  animation: fadeIn 0.3s ease;
  /* Ensure it covers entire area */
  min-height: calc(100vh - 64px);
  margin: 0;
  padding: 0;
}

/* When sidebar is collapsed */
body.sidebar-collapsed .game-overlay {
  left: 0;
}

/* When in fullscreen mode or on smaller screens */
@media (max-width: 1024px) {
  .game-overlay {
    left: 0;
  }
}

    .game-overlay.show {
      display: block;
    }

    /* MODIFIED: Result Notification (inside game screen) */
    .result-notification {
      position: fixed;
      top: 50%;
      left: calc(50% + 200px);
      transform: translate(-50%, -50%) scale(0.8);
      background: linear-gradient(135deg, #FFD166, #FFB347);
      border-radius: 30px;
      padding: 40px 50px;
      box-shadow: 
        0 25px 50px rgba(0,0,0,0.25),
        inset 0 -8px 0 rgba(0,0,0,0.1);
      z-index: 101;
      text-align: center;
      min-width: 400px;
      opacity: 0;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      border: 8px solid #EF476F;
      transition: left 0.45s ease;
    }

    body.sidebar-collapsed .result-notification {
  left: 50%; /* Center in full viewport when sidebar is hidden */
}

    .result-notification.show {
      opacity: 1;
      transform: translate(-50%, -50%) scale(1);
    }

    .notification-number {
      font-size: 100px;
      font-weight: 900;
      color: #EF476F;
      margin-bottom: 15px;
      text-shadow: 
        5px 5px 0 rgba(0,0,0,0.1),
        0 0 20px rgba(255,255,255,0.8);
      line-height: 1;
    }

    .notification-text {
      font-size: 1.8rem;
      color: #333;
      margin-bottom: 20px;
      font-weight: 700;
      text-shadow: 2px 2px 0 rgba(255,255,255,0.5);
    }

    .notification-subtext {
      color: #666;
      margin-bottom: 30px;
      font-size: 1.1rem;
      font-weight: 500;
    }

    .next-btn {
      background: #06D6A0;
      color: white;
      border: none;
      padding: 15px 40px;
      border-radius: 30px;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      display: inline-block;
      min-width: 200px; /* Optional: gives it a consistent width */
      text-align: center;
    }

    .next-btn:hover {
      transform: translateY(-3px);
      background: linear-gradient(135deg, #04B486, #06D6A0);
    }

    /* Result Screen */
 #result-screen {
  display: none;
  position: relative;
  min-height: 100vh;
  background: linear-gradient(180deg, #cfeeff, #b9e2ff);
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


    /* Animations */
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
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

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .wheel-container {
        width: 320px;
        height: 320px;
      }
      
      .segment-content {
        font-size: 32px;
        left: 70px;
        top: 25px;
      }
      
      .wheel-center {
        width: 80px;
        height: 80px;
        font-size: 22px;
      }
      
      .options-container {
        grid-template-columns: 1fr;
      }
      
      .result-notification {
        min-width: 320px;
        padding: 30px;
      }
      
      .notification-number {
        font-size: 70px;
      }
      
      .notification-text {
        font-size: 1.4rem;
      }
      
      .question-container {
        padding: 25px;
        margin: 20px;
      }
    }

    /* Floating Toggle */
    .floating-toggle {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, #EF476F, #FF6B8B);
      color: white;
      border: none;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(239, 71, 111, 0.4);
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .floating-toggle:hover {
      transform: scale(1.1) rotate(90deg);
      box-shadow: 0 8px 25px rgba(239, 71, 111, 0.5);
    }

    /* Question Instructions Section */
.question-instructions {
  background: linear-gradient(135deg, #E6F3FF, #D6E8FF);
  border: 2px dashed #4A90E2;
  border-radius: 15px;
  padding: 15px 20px;
  margin-bottom: 25px;
  display: flex;
  align-items: center;
  gap: 15px;
  animation: fadeInSlide 0.5s ease;
}

@keyframes fadeInSlide {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.instructions-icon {
  font-size: 1.8rem;
  background: #4A90E2;
  color: white;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.instructions-text {
  font-size: 1rem;
  color: #2C5282;
  font-weight: 600;
  line-height: 1.5;
}

/* Update question-text-box to account for instructions */
.question-text-box {
  font-size: 1.5rem;
  line-height: 1.7;
  color: #073B4C;
  margin-bottom: 40px;
  padding: 25px;
  background: linear-gradient(135deg, #f8faff, #eef2ff);
  border-radius: 20px;
  border-left: 8px solid #3643d1; /* Changed to match theme */
  font-weight: 600;
  text-align: center;
}

/* Feedback Box */
.feedback-container {
    display: none;
    margin: 30px 0;
    padding: 25px;
    border-radius: 18px;
    text-align: left;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    animation: slideUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.feedback-container.show {
    display: block;
}

.feedback-correct {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: 3px solid #28a745;
    color: #155724;
}

.feedback-incorrect {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border: 3px solid #dc3545;
    color: #721c24;
}

.feedback-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(0,0,0,0.1);
}

.feedback-icon {
    font-size: 2rem;
    background: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.feedback-correct .feedback-icon {
    background: #28a745;
    color: white;
}

.feedback-incorrect .feedback-icon {
    background: #dc3545;
    color: white;
}

.feedback-title {
    font-size: 1.5rem;
    font-weight: 700;
}

.feedback-content {
    padding: 15px;
    background: rgba(255,255,255,0.5);
    border-radius: 12px;
    margin-bottom: 20px;
}

.correct-answer-box {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border: 2px solid #2196f3;
    border-left: 6px solid #2196f3;
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
}

.correct-answer-label {
    font-weight: 700;
    color: #1565c0;
    margin-bottom: 5px;
    font-size: 1rem;
}

.correct-answer-text {
    font-size: 1.1rem;
    font-weight: 600;
    color: #0d47a1;
    padding: 8px 12px;
    background: white;
    border-radius: 6px;
    display: inline-block;
    margin-top: 5px;
}

.explanation-label {
    font-weight: 700;
    color: #2c5282;
    margin-bottom: 8px;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.explanation-label i {
    font-size: 1.2rem;
}

.explanation-text {
    font-size: 1rem;
    line-height: 1.6;
    font-weight: 500;
    padding: 12px;
    background: white;
    border-radius: 8px;
    border-left: 4px solid #4caf50;
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
        <h2>📖 Arahan Permainan Roda Rawak</h2>
        <p>Selamat datang ke <b>ACCsmart: Spinning Wheel Game</b>! 🎡</p>
        <ul style="text-align:left; line-height:1.8; display: block; padding-left: 20px;">
          <li>👉 Klik <strong>"Putarkan Roda"</strong> untuk memutar roda</li>
          <li>🎯 Roda akan berhenti pada nombor soalan tertentu</li>
          <li>✅ Soalan perakaunan akan muncul berdasarkan nombor yang dipilih</li>
          <li>❌ Pilih jawapan yang betul daripada pilihan yang diberikan</li>
          <li>⭐ Dapatkan 1 markah untuk setiap jawapan betul</li>
          <li>⏭️ Gunakan <strong>"Seterusnya"</strong> untuk kembali ke roda selepas menjawab</li>
          <li>🏆 Main sehingga semua soalan terjawab untuk selesaikan permainan</li>
          <li>🔁 Klik <strong>"Cuba Lagi"</strong> untuk bermain semula</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()" style="margin-top: 20px;">Tutup</button>
      </div>
    </div>

    <!-- GAME SCREEN -->
    <section id="game-screen">
      <!-- Game Overlay (only covers game screen) -->
      <div class="game-overlay" id="gameOverlay"></div>
      
      <!-- Result Notification (inside game screen) -->
      <div class="result-notification" id="resultNotification">
        <div class="notification-number" id="notificationNumber">3</div>
        <div class="notification-text" id="notificationMessage">Anda dapat nombor tiga!</div>
        <div class="notification-subtext">Klik "Seterusnya" untuk jawab soalan perakaunan</div>
        <button class="next-btn" onclick="showQuestionScreen()">Seterusnya</button>
      </div>

      <!-- Game Header Box -->
      <div class="game-header">
        <div class="game-top-controls">
          <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
          <button class="control-btn home" onclick="backToMenu()">🏠 Laman Utama</button>
        </div>
        <h2>🎡 Permainan Persamaan Perakaunan</h2>
        <div class="game-stats">
          <div class="stat-box">❓ Soalan: <span id="currentQuestion">0</span>/<span id="totalQuestions">5</span></div>
          <div class="stat-box">⭐ Skor: <span id="score">0</span></div>
          <div class="stat-box">🎯 Nombor: <span id="currentNumber">-</span></div>
        </div>
      </div>

      <!-- Wheel Box -->
      <div class="wheel-box-container" id="wheelBox">
        <h3>🎯 Putar Roda untuk Dapatkan Nombor Soalan</h3>
        <div class="wheel-game-container">
          <div class="wheel-container">
            <div class="wheel-arrow">▼</div>
            <div class="wheel" id="wheel"></div>
            <div class="wheel-center" id="wheelCenter" onclick="spinWheel()">SPIN</div>
          </div>
          
          <button class="spin-btn" id="spinBtn" onclick="spinWheel()">
            <i class="fas fa-redo-alt"></i> Putarkan Roda
          </button>
        </div>
      </div>

      <!-- Question Box -->
      <div class="question-container" id="questionBox">
        <div class="question-box-header">
          <div class="question-number-box">Soalan #<span id="questionNum">1</span></div>
        </div>
        
        <div class="question-instructions" id="questionInstructions">
          <div class="instructions-icon">📝</div>
          <div class="instructions-text">
            Lengkapkan persamaan perakaunan berikut
          </div>
        </div>

        <div class="question-text-box" id="questionText"></div>
        
        <div class="options-container" id="optionsContainer"></div>
        <!-- Feedback Box -->
<div class="feedback-container" id="feedbackBox"></div>
        
        <div class="question-nav-bottom">
          <button class="next-btn" onclick="backToWheel()">Seterusnya →</button>
        </div>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Permainan Selesai!</h2>
        <p id="resultText">Anda telah berjaya menjawab semua soalan perakaunan!</p>
        <div class="final-score" id="finalScore">0/5</div>
<div class="result-btns-vertical">
  <a href="javascript:void(0)" class="button-33 first-btn" onclick="tryAgain()">Cuba Lagi</a>
  <a href="javascript:void(0)" class="button-33 second-btn" onclick="backToMenu()">Menu Utama</a>
</div>

      </div>
    </section>
  </main>
</div>
<button class="floating-toggle" id="floatingToggle">☰</button>
<script src="../js/navigation.js"></script>
<script>
  // Sound Effects
  const spinSound = new Audio("../audio/spin_sound.mp3");
  const correctSound = new Audio("../audio/correct_answer_sound.mp3");
  const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
  const excellentSound = new Audio("../audio/congrats_sound.mp3");
  const poorSound = new Audio("../audio/fail_sound.mp3");
  const notificationSound = new Audio("../audio/notification_sound.mp3");

  // DOM Elements
  const startScreen = document.getElementById('start-screen');
  const gameScreen = document.getElementById('game-screen');
  const wheelBox = document.getElementById('wheelBox');
  const questionBox = document.getElementById('questionBox');
  const resultScreen = document.getElementById('result-screen');
  const instrScreen = document.getElementById('instruction-modal');
  const gameOverlay = document.getElementById('gameOverlay');
  const resultNotification = document.getElementById('resultNotification');
  
  // Game stats elements
  const currentQuestionEl = document.getElementById('currentQuestion');
  const totalQuestionsEl = document.getElementById('totalQuestions');
  const scoreEl = document.getElementById('score');
  const currentNumberEl = document.getElementById('currentNumber');
  const finalScoreEl = document.getElementById('finalScore');
  const resultTextEl = document.getElementById('resultText');
  
  // Question elements
  const questionNumEl = document.getElementById('questionNum');
  const questionTextEl = document.getElementById('questionText');
  const optionsContainer = document.getElementById('optionsContainer');
  
  // Wheel elements
  const wheel = document.getElementById('wheel');
  const wheelCenter = document.getElementById('wheelCenter');
  const spinBtn = document.getElementById('spinBtn');
  const notificationNumberEl = document.getElementById('notificationNumber');
  const notificationMessageEl = document.getElementById('notificationMessage');

  // Wheel Data - Numbers 1-5 only (5 questions)
  let wheelNumbers = [1, 2, 3, 4, 5];
  
  // Track answered questions
  let answeredNumbers = new Set();
  
  // Color palette for segments (5 colors only)
  const segmentColors = [
    { bg: '#FF8FAB', text: '#FFFFFF' }, // Red
    { bg: '#FFE066', text: '#333333' }, // Yellow
    { bg: '#80ED99', text: '#134E4A' }, // Green
    { bg: '#90DBF4', text: '#0C4A6E' }, // Blue
    { bg: '#CDB4DB', text: '#3A0CA3' }, // Purple
  ];

  // Accounting Questions Data - 5 questions only
const accountingQuestions = {
  1: {
    question: "Aset = ? + Ekuiti Pemilik",
    options: [
      "Liabiliti",
      "Modal",
      "Hasil",
      "Perbelanjaan"
    ],
    correct: 0,
    explanation: "Persamaan asas perakaunan: Aset = Liabiliti + Ekuiti Pemilik"
  },
  2: {
    question: "Aset = ? + Modal − ?",
    options: [
      "Liabiliti, Belanja",
      "Liabiliti, Hasil",
      "Liabiliti, Rugi Bersih",
      "Modal, Liabiliti"
    ],
    correct: 2,
    explanation: "Aset = Liabiliti + Modal + (Hasil − Belanja) → formula boleh ditulis Aset = Liabiliti + Modal − Belanja + Hasil."
  },
  3: {
    question: "Aset = ? + ? (Hasil − ?)",
    options: [
      "Liabiliti, Modal, Belanja",
      "Modal, Liabilit, Rugi Bersih",
      "Liabiliti, Liabiliti, Aset",
      "Modal, Modal, Libiliti"
    ],
    correct: 0,
    explanation: "Hasil dan belanja mempengaruhi modal, jadi persamaan boleh ditulis: Aset = Liabiliti + (Modal + (Hasil − Belanja))"
  },
  4: {
    question: "Aset = ? + Modal + ?",
    options: [
      "Liabiliti, Untung Bersih",
      "Liabiliti, Rugi Bersih ",
      "Modal, Liabiliti",
      "Hasil, Belanja"
    ],
    correct: 0,
    explanation: "Persamaan boleh direka sebagai: Aset + Liabiliti + Modal + Belanja = … (untuk tunjuk kesan naik turun akaun)"
  },
  5: {
    question: "Modal = ? − ?",
    options: [
      "Liabiliti, Aset",
      "Aset, Liabiliti",
      "Aset, Hasil",
      "Liabiliti, Belanja"
    ],
    correct: 1,
    explanation: "Modal ialah baki hak pemilik selepas tolak semua liabiliti daripada aset."
  }
};

  // Game Variables
  let score = 0;
  let questionsAnswered = 0;
  const totalQuestions = 5;
  let currentNumber = null;
  let isSpinning = false;
  let rotation = 0;
  let selectedAnswer = null;
  let showFeedback = false;
  let currentQuestionData = null;

  // Initialize wheel segments
  function initializeWheel() {
    wheel.innerHTML = '';
    const segmentAngle = 360 / wheelNumbers.length;
    
    wheelNumbers.forEach((number, index) => {
      const segment = document.createElement('div');
      segment.className = 'wheel-segment';
      segment.dataset.number = number;
      
      // Check if this number has been answered
      if (answeredNumbers.has(number)) {
        segment.classList.add('answered');
      }
      
      const color = segmentColors[index % segmentColors.length];
      segment.style.background = color.bg;
      
      // Calculate transform for proper segment placement
      const rotationAngle = index * segmentAngle;
      segment.style.transform = `rotate(${rotationAngle}deg)`;
      
      const content = document.createElement('div');
      content.className = 'segment-content';
      content.textContent = number;
      content.style.color = color.text;
      content.style.transform = `rotate(${segmentAngle/2}deg)`;
      content.style.left = `${wheel.offsetWidth * 0.35}px`;
      content.style.top = `${wheel.offsetHeight * 0.08}px`;
      
      segment.appendChild(content);
      wheel.appendChild(segment);
    });
    
    wheelCenter.textContent = "SPIN";
    wheelCenter.classList.remove('spinning');
    wheel.style.transform = 'rotate(0deg)';
    rotation = 0;
  }

  // FIXED: Spin the wheel with accurate landing logic
// FIXED: Spin the wheel with accurate landing logic
// SIMPLER FIX: Spin the wheel with guaranteed landing
function spinWheel() {
  // Check if game is already complete
  if (isSpinning) return;
  
  if (questionsAnswered >= totalQuestions) {
    showResult();
    return;
  }

  isSpinning = true;
  spinBtn.disabled = true;
  wheelCenter.classList.add('spinning');
  spinBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> RODA SEDANG BERPUTAR...';

  spinSound.play();

  // Choose a random available number (not yet answered)
  const availableNumbers = wheelNumbers.filter(num => !answeredNumbers.has(num));
  
  // If no available numbers, show result screen
  if (availableNumbers.length === 0) {
    isSpinning = false;
    spinBtn.disabled = false;
    wheelCenter.classList.remove('spinning');
    spinBtn.innerHTML = '<i class="fas fa-redo-alt"></i> Putarkan Roda';
    showResult();
    return;
  }
  
  const targetNumber = availableNumbers[Math.floor(Math.random() * availableNumbers.length)];
  
  // Find the index of the target number (0-4)
  const targetIndex = wheelNumbers.indexOf(targetNumber);
  
  // Each segment is 72° (360/5)
  // We want segment to be at the top (arrow position)
  // Segment positions:
  // 0: 324° to 36° (middle at 0°)
  // 1: 36° to 108° (middle at 72°)
  // 2: 108° to 180° (middle at 144°)
  // 3: 180° to 252° (middle at 216°)
  // 4: 252° to 324° (middle at 288°)
  
  // Calculate target angle so the segment is at the top
  const segmentAngle = 360 / 5; // 72°
  const segmentMiddle = targetIndex * segmentAngle; // 0°, 72°, 144°, 216°, 288°
  
  // We need to rotate so the segment middle is at -90° (top)
  // But our wheel starts with segment 0 at top, so we need to offset
  const targetAngle = 360 - segmentMiddle;
  
  // Add multiple full spins for effect
  const fullSpins = 5 + Math.floor(Math.random() * 3);
  const finalRotation = fullSpins * 360 + targetAngle;

  wheel.style.transition = 'transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99)';
  wheel.style.transform = `rotate(${finalRotation}deg)`;

  setTimeout(() => {
    // Update current number
    currentNumber = targetNumber;
    currentNumberEl.textContent = targetNumber;
    
    // Normalize rotation
    rotation = finalRotation % 360;
    
    // Show notification
    showResultNotification(targetNumber);

    isSpinning = false;
    spinBtn.disabled = false;
    wheelCenter.classList.remove('spinning');
    spinBtn.innerHTML = '<i class="fas fa-redo-alt"></i> Putarkan Roda';
    wheelCenter.textContent = targetNumber;
  }, 4000);
}
 
function debugWheelPosition() {
  const normalizedRotation = rotation % 360;
  const segmentAngle = 360 / 5;
  
  // Calculate which segment is at the top (-90° position)
  let segmentIndex = Math.floor((normalizedRotation + 90 + segmentAngle/2) % 360 / segmentAngle);
  segmentIndex = segmentIndex % 5; // Ensure 0-4
  
  const landedNumber = wheelNumbers[segmentIndex];
  console.log('Current Rotation:', rotation);
  console.log('Normalized Rotation:', normalizedRotation);
  console.log('Segment at top:', segmentIndex);
  console.log('Number at top:', landedNumber);
  console.log('Current Number variable:', currentNumber);
  
  return landedNumber;
}

function showResultNotification(number) {
  notificationNumberEl.textContent = number;

  // FIXED: Add more specific messages for each number
  const messages = {
    1: "🎯 Anda dapat nombor satu! ",
    2: "🎯 Anda dapat nombor dua! ",
    3: "🎯 Anda dapat nombor tiga! ",
    4: "🎯 Anda dapat nombor empat! ",
    5: "🎯 Anda dapat nombor lima! "
  };

  notificationMessageEl.textContent = messages[number] || `🎯 Anda dapat nombor ${number}!`;

  notificationSound.play();
  
  gameOverlay.classList.add('show');
  resultNotification.classList.add('show');
}

  // Show question screen after notification
// Show question screen after notification
function showQuestionScreen() {
  // Validate current number
  if (!currentNumber || !accountingQuestions[currentNumber]) {
    console.error('Invalid question number:', currentNumber);
    resultNotification.classList.remove('show');
    gameOverlay.classList.remove('show');
    return;
  }
  
  // Hide notification and overlay (only within game screen)
  resultNotification.classList.remove('show');
  gameOverlay.classList.remove('show');
  
  // Hide wheel box, show question box
  wheelBox.style.display = 'none';
  questionBox.style.display = 'block';
  questionBox.classList.add('show');
  
  // FIXED: Scroll to question box
  questionBox.scrollIntoView({ behavior: 'smooth' });
  
  // Load and show question
  loadQuestion(currentNumber);
  
  // Update question counter
  currentQuestionEl.textContent = questionsAnswered + 1;
}

  // Load question based on wheel number
function loadQuestion(number) {
    const questionData = accountingQuestions[number];
    if (!questionData) {
        console.error('Question not found for number:', number);
        return;
    }
    
    currentQuestionData = questionData;
    
    questionNumEl.textContent = number;
    questionTextEl.innerHTML = questionData.question.replace(
  /\?/g,
  '<span class="blank-box">____</span>'
);

    
    // Clear previous options
    optionsContainer.innerHTML = '';
    
    // Define color classes for each option
    const optionColors = ['option-a', 'option-b', 'option-c', 'option-d'];
    
    // Create new options with different colors
    questionData.options.forEach((option, index) => {
        const optionBtn = document.createElement('button');
        optionBtn.className = `option-btn ${optionColors[index]}`;
        optionBtn.textContent = `${String.fromCharCode(65 + index)}) ${option}`;
      
        
        optionBtn.onclick = () => handleAnswer(index);
        
        optionsContainer.appendChild(optionBtn);
    });
    
    // Reset answer state
    selectedAnswer = null;
    showFeedback = false;
}

function handleAnswer(selectedIndex) {
    if (showFeedback) return;
    
    showFeedback = true;
    selectedAnswer = selectedIndex;
    
    const optionBtns = document.querySelectorAll('.option-btn');
    const correctIndex = currentQuestionData.correct;
    const feedbackBox = document.getElementById('feedbackBox');
    
    // Style the answer buttons
    optionBtns.forEach((btn, index) => {
        if (index === correctIndex) {
            btn.classList.add('correct');
        } else if (index === selectedIndex && index !== correctIndex) {
            btn.classList.add('wrong');
        }
        
        if (index !== selectedIndex && index !== correctIndex) {
            btn.style.opacity = '0.5';
        }
        
        btn.style.pointerEvents = 'none';
    });
    
    // Generate feedback message
    const isCorrect = selectedIndex === correctIndex;
    const correctAnswerText = currentQuestionData.options[correctIndex];
    const explanation = currentQuestionData.explanation || "Tiada penerangan tersedia.";
    
    if (isCorrect) {
        // Correct answer feedback
        feedbackBox.className = 'feedback-container feedback-correct show';
        feedbackBox.innerHTML = `
            <div class="feedback-header">
                <div class="feedback-icon">✓</div>
                <div class="feedback-title">Betul!</div>
            </div>
            <div class="feedback-content">
                <div class="explanation-label">
                    <i class="fas fa-book"></i> PENERANGAN:
                </div>
                <div class="explanation-text">
                    ${explanation}
                </div>
            </div>
        `;
        
        score += 1;
        scoreEl.textContent = score;
        correctSound.play();
    } else {
        // Incorrect answer feedback
        feedbackBox.className = 'feedback-container feedback-incorrect show';
        feedbackBox.innerHTML = `
            <div class="feedback-header">
                <div class="feedback-icon">✗</div>
                <div class="feedback-title"> Salah!</div>
            </div>
            <div class="feedback-content">
                <div class="correct-answer-box">
                    <div class="correct-answer-label">Jawapan yang betul:</div>
                    <div class="correct-answer-text">"${correctAnswerText}"</div>
                </div>
                <div style="margin-top: 20px;">
                    <div class="explanation-label">
                        <i class="fas fa-lightbulb"></i> PENERANGAN:
                    </div>
                    <div class="explanation-text">
                        ${explanation}
                    </div>
                </div>
            </div>
        `;
        
        incorrectSound.play();
    }
    
    // Scroll feedback into view
    setTimeout(() => {
        feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 300);
}

  // Back to wheel from question
function backToWheel() {
    // Clear feedback
    const feedbackBox = document.getElementById('feedbackBox');
    feedbackBox.className = 'feedback-container';
    feedbackBox.innerHTML = '';
    
    if (!showFeedback) {
        alert('Sila pilih jawapan terlebih dahulu sebelum kembali ke roda!');
        return;
    }
    
    // Mark this number as answered
    answeredNumbers.add(currentNumber);
    questionsAnswered++;
    updateWheelSegments();
    
    // Update stats
    scoreEl.textContent = score;
    currentQuestionEl.textContent = questionsAnswered;
    
    questionBox.classList.remove('show');
    questionBox.style.display = 'none';
    wheelBox.style.display = 'block';
    
    // Reset variables
    showFeedback = false;
    selectedAnswer = null;
    currentQuestionData = null;
    
    // Check if all questions are answered
    if (questionsAnswered >= totalQuestions) {
      setTimeout(() => {
        showResult();
      }, 500);
    }
  }

  // Update wheel segments to show answered ones as grayed out
  function updateWheelSegments() {
    const segments = document.querySelectorAll('.wheel-segment');
    segments.forEach(segment => {
      const number = parseInt(segment.dataset.number);
      if (answeredNumbers.has(number)) {
        segment.classList.add('answered');
      }
    });
  }

  // Navigation Functions
  function startGame() {
    startScreen.style.display = 'none';
    gameScreen.style.display = 'block';
    wheelBox.style.display = 'block';
    questionBox.style.display = 'none';
    resultScreen.classList.remove('show');
    
    // Reset game state
    score = 0;
    questionsAnswered = 0;
    currentNumber = null;
    rotation = 0;
    answeredNumbers.clear();
    selectedAnswer = null;
    showFeedback = false;
    currentQuestionData = null;
    
    // Reset UI
    scoreEl.textContent = '0';
    currentQuestionEl.textContent = '0';
    currentNumberEl.textContent = '-';
    wheel.style.transform = 'rotate(0deg)';
    wheelCenter.textContent = 'SPIN';
    questionBox.classList.remove('show');
    
    // Initialize wheel
    initializeWheel();
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
    wheelBox.style.display = 'none';
    questionBox.style.display = 'none';
    startScreen.style.display = 'flex';
  }

 // Update your sound initialization with error handling
function playSound(sound) {
  try {
    sound.currentTime = 0; // Reset to start
    sound.volume = 0.7; // Set appropriate volume
    sound.play().catch(error => {
      console.log("Sound play prevented:", error);
    });
  } catch (error) {
    console.error("Error playing sound:", error);
  }
}

// Then use it like this in showResult():
if (score === maxScore) {
  message = 'Tahniah! Anda menguasai prinsip perakaunan dengan cemerlang! 🎓';
  playSound(excellentSound);
}

// FIXED: Show result with max score of 5
function showResult() {
  gameScreen.style.display = 'none';
  wheelBox.style.display = 'none';
  questionBox.style.display = 'none';
  resultScreen.classList.add('show');
  
  const maxScore = 5; // FIXED: Changed from totalQuestions * 10 to just 5
  finalScoreEl.textContent = `${score}/${maxScore}`;
  
  let message = '';
  if (score === maxScore) {
    message = 'Tahniah! Anda menguasai prinsip perakaunan dengan cemerlang! 🎓';
    excellentSound.play(); // FIXED: Added .play()
  } else if (score >= 4) {
    message = 'Hebat! Prestasi yang sangat baik dalam kuiz perakaunan! ⭐';
    excellentSound.play(); // FIXED: Added .play()
  } else if (score >= 3) {
    message = 'Bagus! Anda mempunyai pemahaman asas yang kukuh! 👍';
    // No sound for this score range
  } else if (score >= 2) {
    message = 'Memuaskan. Teruskan berusaha untuk memperbaiki pemahaman anda! 💪';
    poorSound.play(); // FIXED: Added .play()
  } else {
    message = 'Jangan putus asa! Cuba lagi dan tingkatkan pengetahuan perakaunan anda! 🔥';
    poorSound.play(); // FIXED: Added .play()
  }
  
  resultTextEl.textContent = message;
}

  // Initialize the game when page loads
  window.onload = function() {
    initializeWheel();
    totalQuestionsEl.textContent = totalQuestions;
    
    // Add click handler for floating toggle
    document.getElementById('floatingToggle').addEventListener('click', function() {
      document.body.classList.toggle('sidebar-collapsed');
    });
  };
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
