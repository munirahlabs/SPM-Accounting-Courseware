<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/ButtonT4Modul1.css">
  <title>ACCsmart: Card Flip Game</title>
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
      background: url('../img/28.png') center center/contain no-repeat;
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

    .control-btn.shuffle {
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
    
     .control-btn.shuffle:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 30px rgba(239, 71, 111, 0.5);
      background: linear-gradient(135deg, #FF6B8B, #EF476F);
    }

     .control-btn.shuffle:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
      box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
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
      border: 3px solid #3643d1;
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

    /* CARD CONTAINER BOX */
    .card-box-container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 18px;
      padding: 30px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      max-width: 1100px;
      margin: 0 auto 25px auto;
      width: 100%;
      box-sizing: border-box;
      border: 3px solid #FF6B8B;
      text-align: center;
    }

    .card-box-container h3 {
      color: #EF476F;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      letter-spacing: 0.5px;
    }

    /* ---------- CARD GAME STYLES ---------- */
    .card-game-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }

    /* Updated: Card Row for 8 cards */
    .card-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin: 30px auto;
      max-width: 1000px;
      padding: 10px;
    }

    /* Card Styles - Slightly smaller for 8 cards */
    .card {
      width: 160px;
      height: 220px;
      perspective: 1000px;
      cursor: pointer;
      flex-shrink: 0;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
      transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      transform-style: preserve-3d;
    }

    .card.flipped .card-inner {
      transform: rotateY(180deg);
    }

    .card.disabled {
      cursor: not-allowed;
      opacity: 0.7;
    }

    .card-front, .card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      border-radius: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    .card-front {
      background: linear-gradient(135deg, #EF476F, #FF6B8B);
      color: white;
      border: 6px solid #FFD166;
    }

    .card-back {
      background: linear-gradient(135deg, #06D6A0, #04B486);
      color: white;
      transform: rotateY(180deg);
      border: 6px solid #118AB2;
    }

    .card-front .card-question {
      font-size: 80px;
      font-weight: 900;
      text-shadow: 4px 4px 0 rgba(0,0,0,0.3);
    }

    .card-front .card-number {
      display: none;
    }

    .card-back .card-label {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .card-back .card-value {
      font-size: 50px;
      font-weight: 900;
      text-shadow: 3px 3px 0 rgba(0,0,0,0.2);
    }

    .card.answered .card-front {
      background: linear-gradient(135deg, #A0AEC0, #718096);
      opacity: 0.6;
    }

    .card.answered .card-back {
      background: linear-gradient(135deg, #48BB78, #38A169);
      opacity: 0.6;
    }

    /* Shuffle Animation */
    .card.shuffling {
      animation: shuffleAnimation 0.5s ease;
    }

    @keyframes shuffleAnimation {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }

    /* Game Overlay */
    .game-overlay {
      position: fixed;
      top: 64px;
      left: 400px;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(10px);
      z-index: 100;
      display: none;
      animation: fadeIn 0.3s ease;
      min-height: calc(100vh - 64px);
      margin: 0;
      padding: 0;
    }

    body.sidebar-collapsed .game-overlay {
      left: 0;
    }

    .game-overlay.show {
      display: block;
    }

    /* Result Notification */
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
      left: 50%;
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
      min-width: 200px;
      text-align: center;
    }

    .next-btn:hover {
      transform: translateY(-3px);
      background: linear-gradient(135deg, #04B486, #06D6A0);
    }

    /* QUESTION BOX */
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

    .options-container {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      margin-bottom: 40px;
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
      justify-content: flex-end;
      margin-top: 40px;
    }

    .question-nav-bottom .next-btn {
      margin-left: auto;
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

    .result-btns-vertical .first-btn {
      background-color: #f16037;
      color: #fff;
      margin-bottom: 5px;
    }

    .result-btns-vertical .first-btn:hover {
      background-color: rgba(253, 74, 25, 0.95);
    }

    .result-btns-vertical .second-btn {
      background-color: rgba(246, 247, 249, 0.78);
      color: black;
      margin-top: 5px;
    }

    .result-btns-vertical .second-btn:hover {
      background-color: rgba(215, 216, 217, 0.78);
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

    /* Responsive for 8 cards */
    @media (max-width: 1200px) {
      .card-row {
        max-width: 900px;
      }
    }

    @media (max-width: 1024px) {
      .card-row {
        max-width: 800px;
        gap: 15px;
      }
      
      .card {
        width: 140px;
        height: 190px;
      }
      
      .game-overlay {
        left: 0;
      }
    }

    @media (max-width: 768px) {
      .card-row {
        max-width: 600px;
        gap: 10px;
      }
      
      .card {
        width: 120px;
        height: 170px;
      }
      
      .card-front .card-question {
        font-size: 60px;
      }
      
      .card-back .card-value {
        font-size: 40px;
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
      
      .game-top-controls {
        flex-wrap: wrap;
      }
    }

    @media (max-width: 480px) {
      .card-row {
        max-width: 400px;
      }
      
      .card {
        width: 100px;
        height: 140px;
      }
      
      .card-front .card-question {
        font-size: 50px;
      }
      
      .card-back .card-value {
        font-size: 30px;
      }
    }
  </style>
</head>
<body>
<?php include '../components/Top_nav.php'; ?>

<div class="layout">
  <?php include '../components/SidebarNav_T5.php'; ?>

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
        <h2>📖 Arahan Permainan Kad Terbalik</h2>
        <p>Selamat datang ke <b>ACCsmart: Card Flip Game</b>! 🎴</p>
        <ul style="text-align:left; line-height:1.8; display: block; padding-left: 20px;">
          <li>👉 Klik pada <strong>kad dengan tanda "?"</strong> untuk memilih soalan</li>
          <li>🎯 8 kad tersedia dengan soalan nisbah keuntungan</li>
          <li>✅ Soalan perakaunan akan muncul berdasarkan nombor yang dipilih</li>
          <li>❌ Pilih jawapan yang betul daripada pilihan yang diberikan</li>
          <li>⭐ Dapatkan 1 markah untuk setiap jawapan betul</li>
          <li>🔄 Kad akan dikocok secara automatik setiap permainan baru</li>
          <li>⏭️ Gunakan <strong>"Seterusnya"</strong> untuk kembali ke kad selepas menjawab</li>
          <li>🏆 Main sehingga semua 8 soalan terjawab untuk selesaikan permainan</li>
          <li>🔁 Klik <strong>"Cuba Lagi"</strong> untuk bermain semula</li>
        </ul>
        <button class="start-btn" onclick="closeInstructions()" style="margin-top: 20px;">Tutup</button>
      </div>
    </div>

    <!-- GAME SCREEN -->
    <section id="game-screen">
      <!-- Game Overlay -->
      <div class="game-overlay" id="gameOverlay"></div>
      
      <!-- Result Notification -->
      <div class="result-notification" id="resultNotification">
        <div class="notification-number" id="notificationNumber">3</div>
        <div class="notification-text" id="notificationMessage">Anda pilih Kad Tiga!</div>
        <div class="notification-subtext">Klik "Seterusnya" untuk jawab soalan perakaunan</div>
        <button class="next-btn" onclick="showQuestionScreen()">Seterusnya</button>
      </div>

      <!-- Game Header Box -->
      <div class="game-header">
        <div class="game-top-controls">
          <button class="control-btn" onclick="resetGame()">🔄 Reset</button>
          <button class="control-btn home" onclick="backToMenu()">🏠 Laman Utama</button>
        </div>
        <h2>🎴 Permainan Nisbah Keuntungan Perakaunan</h2>
        <div class="game-stats">
          <div class="stat-box">❓ Soalan: <span id="currentQuestion">0</span>/<span id="totalQuestions">8</span></div>
          <div class="stat-box">⭐ Skor: <span id="score">0</span></div>
          <div class="stat-box">🎯 Kad: <span id="currentCard">-</span></div>
        </div>
      </div>

      <!-- Card Box -->
      <div class="card-box-container" id="cardBox">
        <h3>🎴 Pilih Kad untuk Dapatkan Nombor Soalan</h3>
        <div class="card-game-container">
          <div class="card-row" id="cardRow">
            <!-- Cards will be generated by JavaScript -->
          </div>
          <button class="control-btn shuffle" id="shuffleBtn"><i class="fas fa-redo-alt"></i> Rawakkan Kad</button>
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
            Pilih formula atau jawapan yang betul
          </div>
        </div>

        <div class="question-text-box" id="questionText"></div>
        
        <div class="options-container" id="optionsContainer"></div>
        
        <!-- Feedback Box -->
        <div class="feedback-container" id="feedbackBox"></div>
        
        <div class="question-nav-bottom">
          <button class="next-btn" onclick="backToCards()">Seterusnya →</button>
        </div>
      </div>
    </section>

    <!-- RESULT SCREEN -->
    <section id="result-screen">
      <div class="result-card">
        <div class="trophy">🏆</div>
        <h2>Tahniah! Permainan Selesai!</h2>
        <p id="resultText">Anda telah berjaya menjawab semua soalan perakaunan!</p>
        <div class="final-score" id="finalScore">0/8</div>
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
  const flipSound = new Audio("../audio/flip_sound.mp3");
  const correctSound = new Audio("../audio/correct_answer_sound.mp3");
  const incorrectSound = new Audio("../audio/wrong_answer_sound.mp3");
  const excellentSound = new Audio("../audio/congrats_sound.mp3");
  const poorSound = new Audio("../audio/fail_sound.mp3");
  const notificationSound = new Audio("../audio/notification_sound.mp3");
  const shuffleSound = new Audio("../audio/flip_sound.mp3");

  // DOM Elements
  const startScreen = document.getElementById('start-screen');
  const gameScreen = document.getElementById('game-screen');
  const cardBox = document.getElementById('cardBox');
  const cardRow = document.getElementById('cardRow');
  const questionBox = document.getElementById('questionBox');
  const resultScreen = document.getElementById('result-screen');
  const instrScreen = document.getElementById('instruction-modal');
  const gameOverlay = document.getElementById('gameOverlay');
  const resultNotification = document.getElementById('resultNotification');
  const shuffleBtn = document.getElementById('shuffleBtn');
  
  // Game stats elements
  const currentQuestionEl = document.getElementById('currentQuestion');
  const totalQuestionsEl = document.getElementById('totalQuestions');
  const scoreEl = document.getElementById('score');
  const currentCardEl = document.getElementById('currentCard');
  const finalScoreEl = document.getElementById('finalScore');
  const resultTextEl = document.getElementById('resultText');
  
  // Question elements
  const questionNumEl = document.getElementById('questionNum');
  const questionTextEl = document.getElementById('questionText');
  const optionsContainer = document.getElementById('optionsContainer');
  const feedbackBox = document.getElementById('feedbackBox');
  
  // Notification elements
  const notificationNumberEl = document.getElementById('notificationNumber');
  const notificationMessageEl = document.getElementById('notificationMessage');

  // Card Numbers 1-8
  let cardNumbers = [1, 2, 3, 4, 5, 6, 7, 8];
  
  // Track answered cards
  let answeredCards = new Set();
  
  // Accounting Questions Data - 8 questions
  const accountingQuestions = {
    1: {
      question: "Apakah Peratus <br>Untung Kasar atas Kos Jualan<br> ",
      options: [
        "Untung Kasar / Jualan Bersih × 100",
        "Untung Bersih / Modal Awal × 100",
        "Untung Kasar / Kos Jualan × 100",
        "Untung Bersih / Jualan Bersih × 100"
      ],
      correct: 2,
      explanation: "Tokokan atau mark-up mengukur keuntungan berdasarkan kos barang yang dijual, oleh itu untung kasar dibahagikan dengan kos jualan."
    },
    2: {
      question: "Apakah Peratus Untung Kasar atas Jualan (Margin Untung Kasar)?",
      options: [
        "Untung Bersih / Jualan Bersih × 100",
        "Untung Kasar / Jualan Bersih × 100",
        "Untung Kasar / Kos Jualan × 100",
        "Untung Bersih / Modal Awal × 100"
      ],
      correct: 1,
      explanation: "Margin untung kasar menunjukkan jumlah untung kasar yang diperoleh daripada setiap ringgit jualan, maka jualan bersih digunakan sebagai pembahagi."
    },
    3: {
      question: "Apakah Peratus Untung Bersih atas Jualan (Margin Untung Bersih)?",
      options: [
        "Untung Kasar / Kos Jualan × 100",
        "Untung Bersih / Modal Awal × 100",
        "Untung Kasar / Jualan Bersih × 100",
        "Untung Bersih / Jualan Bersih × 100"
      ],
      correct: 3,
      explanation: "Margin untung bersih mengukur keuntungan sebenar selepas semua kos dan belanja ditolak, oleh itu untung bersih dibandingkan dengan jualan bersih."
    },
    4: {
      question: "Apakah formula Pulangan atas Modal?",
      options: [
        "Untung Bersih / Jualan Bersih × 100",
        "Untung Kasar / Kos Jualan × 100",
        "Untung Bersih / Modal Awal × 100",
        "Untung Kasar / Jualan Bersih × 100"
      ],
      correct: 2,
      explanation: "Pulangan atas modal menunjukkan pulangan keuntungan kepada pemilik, maka untung bersih dibahagikan dengan modal awal."
    },
    5: {
      question: "Antara berikut, yang manakah nisbah keberuntungan?",
      options: [
        "Nisbah semasa",
        "Nisbah cepat",
        "Margin untung bersih",
        "Nisbah pusing ganti inventori"
      ],
      correct: 2,
      explanation: "Margin untung bersih ialah nisbah keberuntungan kerana ia mengukur tahap keuntungan perniagaan, manakala pilihan lain mengukur kecairan atau kecekapan."
    },
    6: {
      question: "Apakah tujuan Peratus Untung Kasar atas Jualan digunakan?",
      options: [
        "Mengukur keupayaan membayar hutang semasa",
        "Menilai kecekapan kawalan kos jualan",
        "Menentukan nilai aset semasa",
        "Mengukur kecairan perniagaan"
      ],
      correct: 1,
      explanation: "Peratus untung kasar atas jualan digunakan untuk menilai sejauh mana perniagaan mengawal kos jualan dalam menjana keuntungan kasar."
    },
    7: {
      question: "Jika kos jualan meningkat manakala jualan bersih kekal, apakah kesan terhadap Peratus Untung Kasar?",
      options: [
        "Meningkat",
        "Menurun",
        "Tidak berubah",
        "Bertambah dua kali ganda"
      ],
      correct: 1,
      explanation: "Apabila kos jualan meningkat tanpa peningkatan jualan, untung kasar akan berkurang dan menyebabkan peratus untung kasar menurun."
    },
    8: {
      question: "Syarikat A mempunyai margin untung bersih lebih tinggi berbanding Syarikat B. Apakah kesimpulan PALING tepat?",
      options: [
        "Syarikat A lebih cekap mengawal perbelanjaan",
        "Syarikat B mempunyai jualan lebih tinggi",
        "Modal Syarikat A lebih rendah",
        "Kos jualan Syarikat B lebih kecil"
      ],
      correct: 0,
      explanation: "Margin untung bersih yang lebih tinggi menunjukkan Syarikat A lebih cekap mengurus kos dan perbelanjaan, lalu memperoleh keuntungan bersih yang lebih besar."
    }
  };

  // Game Variables
  let score = 0;
  let questionsAnswered = 0;
  const totalQuestions = 8;
  let currentCard = null;
  let selectedAnswer = null;
  let showFeedback = false;
  let currentQuestionData = null;
  let isCardFlipping = false;
  let isShuffling = false;
  let cardElements = [];

  // Shuffle array using Fisher-Yates algorithm
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }

  // Initialize cards with 8 cards
  function initializeCards() {
    cardRow.innerHTML = '';
    cardElements = [];
    
    // Create exactly 8 card numbers (1-8)
    cardNumbers = shuffleArray([1, 2, 3, 4, 5, 6, 7, 8]);
    
    // Hide shuffle button during initialization
    shuffleBtn.style.display = 'none';
    
    console.log(`Membuat ${cardNumbers.length} kartu:`, cardNumbers);
    
    cardNumbers.forEach((number, index) => {
      const card = document.createElement('div');
      card.className = 'card';
      card.dataset.number = number;
      
      if (answeredCards.has(number)) {
        card.classList.add('answered', 'flipped');
      }
      
      card.innerHTML = `
        <div class="card-inner">
          <div class="card-front">
            <div class="card-question">?</div>
          </div>
          <div class="card-back">
            <div class="card-label">Soalan</div>
            <div class="card-value">${number}</div>
          </div>
        </div>
      `;
      
      if (!answeredCards.has(number)) {
        card.addEventListener('click', () => selectCard(number, card));
      } else {
        card.style.cursor = 'not-allowed';
      }
      
      cardRow.appendChild(card);
      cardElements.push(card);
    });
  }

  // Shuffle cards function
  function shuffleCards() {
    if (isCardFlipping || isShuffling) return;
    
    isShuffling = true;
    // Hide shuffle button during shuffling
    shuffleBtn.style.display = 'none';
    
    // Play shuffle sound
    shuffleSound.play();
    
    // Add shuffle animation to all cards
    cardElements.forEach(card => {
      if (!answeredCards.has(parseInt(card.dataset.number))) {
        card.classList.add('shuffling');
      }
    });
    
    // Shuffle the card numbers array
    const unansweredNumbers = cardNumbers.filter(num => !answeredCards.has(num));
    const answeredNumbers = cardNumbers.filter(num => answeredCards.has(num));
    
    // Only shuffle unanswered cards
    const shuffledUnanswered = shuffleArray([...unansweredNumbers]);
    const newOrder = [...answeredNumbers, ...shuffledUnanswered];
    
    // Update the display order
    setTimeout(() => {
      // Remove all cards
      cardRow.innerHTML = '';
      
      // Add cards back in new order
      newOrder.forEach(number => {
        const card = cardElements.find(c => parseInt(c.dataset.number) === number);
        if (card) {
          cardRow.appendChild(card);
        }
      });
      
      // Remove shuffle animation
      cardElements.forEach(card => {
        card.classList.remove('shuffling');
      });
      
      // Update cardNumbers with new order
      cardNumbers = newOrder;
      
      // Show shuffle button again after shuffling
      setTimeout(() => {
        shuffleBtn.style.display = 'block';
        isShuffling = false;
      }, 300);
    }, 500);
  }

  // Select a card
  function selectCard(number, cardElement) {
    if (answeredCards.has(number) || currentCard === number || isCardFlipping) return;
    
    isCardFlipping = true;
    currentCard = number;
    currentCardEl.textContent = currentCard;
    
    flipSound.play();
    
    cardElement.classList.add('flipped');
    
    setTimeout(() => {
      showResultNotification(number);
      isCardFlipping = false;
    }, 800);
  }

  // Show result notification for 8 cards
  function showResultNotification(number) {
    notificationNumberEl.textContent = number;
    
    const messages = {
      1: "Anda pilih Kad Satu!",
      2: "Anda pilih Kad Dua!",
      3: "Anda pilih Kad Tiga!",
      4: "Anda pilih Kad Empat!",
      5: "Anda pilih Kad Lima!",
      6: "Anda pilih Kad Enam!",
      7: "Anda pilih Kad Tujuh!",
      8: "Anda pilih Kad Lapan!"
    };
    
    notificationMessageEl.textContent = messages[number] || `Anda pilih Kad ${number}!`;
    
    setTimeout(() => {
      notificationSound.play();
    }, 100);
    
    gameOverlay.classList.add('show');
    
    setTimeout(() => {
      resultNotification.classList.add('show');
    }, 200);
  }

  // Show question screen after notification
  function showQuestionScreen() {
    if (!currentCard || !accountingQuestions[currentCard]) {
      console.error('Invalid card number:', currentCard);
      resultNotification.classList.remove('show');
      gameOverlay.classList.remove('show');
      return;
    }
    
    resultNotification.classList.remove('show');
    
    setTimeout(() => {
      gameOverlay.classList.remove('show');
    }, 300);
    
    cardBox.style.display = 'none';
    questionBox.style.display = 'block';
    questionBox.classList.add('show');
    
    setTimeout(() => {
      questionBox.scrollIntoView({ behavior: 'smooth' });
    }, 100);
    
    loadQuestion(currentCard);
    
    currentQuestionEl.textContent = questionsAnswered + 1;
  }

  // Load question based on card number
  function loadQuestion(number) {
    const questionData = accountingQuestions[number];
    if (!questionData) {
      console.error('Question not found for number:', number);
      return;
    }
    
    currentQuestionData = questionData;
    
    questionNumEl.textContent = number;
    questionTextEl.innerHTML = questionData.question;
    
    optionsContainer.innerHTML = '';
    
    const optionColors = ['option-a', 'option-b', 'option-c', 'option-d'];
    
    questionData.options.forEach((option, index) => {
      const optionBtn = document.createElement('button');
      optionBtn.className = `option-btn ${optionColors[index]}`;
      optionBtn.textContent = `${String.fromCharCode(65 + index)}) ${option}`;
      
      optionBtn.onclick = () => handleAnswer(index);
      
      optionsContainer.appendChild(optionBtn);
    });
    
    selectedAnswer = null;
    showFeedback = false;
    feedbackBox.className = 'feedback-container';
    feedbackBox.innerHTML = '';
  }

  // Handle answer selection
  function handleAnswer(selectedIndex) {
    if (showFeedback) return;
    
    showFeedback = true;
    selectedAnswer = selectedIndex;
    
    const optionBtns = document.querySelectorAll('.option-btn');
    const correctIndex = currentQuestionData.correct;
    
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
    
    const isCorrect = selectedIndex === correctIndex;
    const correctAnswerText = currentQuestionData.options[correctIndex];
    const explanation = currentQuestionData.explanation || "Tiada penerangan tersedia.";
    
    if (isCorrect) {
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
    
    setTimeout(() => {
      feedbackBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }, 300);
  }

  // Back to cards from question
  function backToCards() {
    if (!showFeedback) {
      alert('Sila pilih jawapan terlebih dahulu sebelum kembali ke kad!');
      return;
    }
    
    feedbackBox.className = 'feedback-container';
    feedbackBox.innerHTML = '';
    
    answeredCards.add(currentCard);
    questionsAnswered++;
    
    updateCardDisplay();
    
    scoreEl.textContent = score;
    currentQuestionEl.textContent = questionsAnswered;
    
    questionBox.classList.remove('show');
    questionBox.style.display = 'none';
    cardBox.style.display = 'block';
    
    // Show shuffle button again
    shuffleBtn.style.display = 'block';
    
    showFeedback = false;
    selectedAnswer = null;
    currentQuestionData = null;
    
    if (questionsAnswered >= totalQuestions) {
      setTimeout(() => {
        showResult();
      }, 500);
    }
  }

  // Update card display to show answered ones
  function updateCardDisplay() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
      const number = parseInt(card.dataset.number);
      if (answeredCards.has(number)) {
        card.classList.add('answered');
        card.style.cursor = 'not-allowed';
        // Remove click event listener for answered cards
        card.removeEventListener('click', () => selectCard(number, card));
      }
    });
  }

  // Navigation Functions
  function startGame() {
    startScreen.style.display = 'none';
    gameScreen.style.display = 'block';
    cardBox.style.display = 'block';
    questionBox.style.display = 'none';
    resultScreen.classList.remove('show');
    
    score = 0;
    questionsAnswered = 0;
    currentCard = null;
    answeredCards.clear();
    selectedAnswer = null;
    showFeedback = false;
    currentQuestionData = null;
    isCardFlipping = false;
    isShuffling = false;
    
    scoreEl.textContent = '0';
    currentQuestionEl.textContent = '0';
    currentCardEl.textContent = '-';
    questionBox.classList.remove('show');
    
    // Update total questions display
    totalQuestionsEl.textContent = totalQuestions;
    
    // Hide shuffle button during initialization
    shuffleBtn.style.display = 'none';
    
    initializeCards();
    
    // Auto-shuffle cards when game starts
    setTimeout(() => {
      shuffleCards();
    }, 500);
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
    // Hide shuffle button during reset
    shuffleBtn.style.display = 'none';
    startGame();
  }

  function backToMenu() {
    resultScreen.classList.remove('show');
    gameScreen.style.display = 'none';
    cardBox.style.display = 'none';
    questionBox.style.display = 'none';
    startScreen.style.display = 'flex';
  }

  // Modified showResult for 8 questions
  function showResult() {
    gameScreen.style.display = 'none';
    cardBox.style.display = 'none';
    questionBox.style.display = 'none';
    resultScreen.classList.add('show');
    
    const maxScore = totalQuestions;
    finalScoreEl.textContent = `${score}/${maxScore}`;
    
    let message = '';
    if (score === maxScore) {
      message = 'Tahniah! Anda menguasai prinsip nisbah keuntungan dengan cemerlang! 🎓';
      excellentSound.play();
    } else if (score >= 6) { // 6 or more out of 8
      message = 'Hebat! Prestasi yang sangat baik dalam kuiz nisbah keuntungan! ⭐';
      excellentSound.play();
    } else if (score >= 4) { // 4-5 out of 8
      message = 'Bagus! Anda mempunyai pemahaman asas yang kukuh! 👍';
    } else if (score >= 2) { // 2-3 out of 8
      message = 'Memuaskan. Teruskan berusaha untuk memperbaiki pemahaman anda! 💪';
      poorSound.play();
    } else {
      message = 'Jangan putus asa! Cuba lagi dan tingkatkan pengetahuan nisbah keuntungan anda! 🔥';
      poorSound.play();
    }
    
    resultTextEl.textContent = message;
  }

  // Event listener for shuffle button
  shuffleBtn.addEventListener('click', shuffleCards);

  // Initialize the game when page loads
  window.onload = function() {
    totalQuestionsEl.textContent = totalQuestions;
    
    document.getElementById('floatingToggle').addEventListener('click', function() {
      document.body.classList.toggle('sidebar-collapsed');
    });
    
    // Initialize shuffle button visibility
    shuffleBtn.style.display = 'none';
  };
</script>

<!-- ADD THIS NEW SCRIPT FOR SIDEBAR HIGHLIGHTING -->
<script>
console.log("🟢 Modul1s1.php custom script running");

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