<!DOCTYPE html>
<html lang="ms">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ACCSMART:SPM | Learning</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<style> 
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: #f8faff;
    color: #1f2937;
    overflow-x: hidden;
    overflow-y: auto;
}

.layout {
    display: flex;
    height: calc(100vh - 64px);
    margin-top: 64px;
}

.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    margin-left: 400px;
    width: calc(100% - 400px);
    transition: margin-left 0.45s ease, width 0.45s ease;
}

body.sidebar-collapsed .main {
    margin-left: 0;
    width: 100%;
}

.main-content {
    flex: 1;
    overflow-y: auto;
    padding: 10px 40px;
    box-sizing: border-box;
}

.main-content h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: #1e3a8a;
    margin-bottom: 16px;
    line-height: 1.3;
}

.main-content h2 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2563eb;
    margin-bottom: 12px;
    line-height: 1.3;
}

.main-content p {
    font-size: 1rem;
    color: #1f2937;
    line-height: 1.6;
    margin-bottom: 12px;
}

.video-info {
    width: 100%;
    margin-top: 16px;
    font-family: "Poppins", sans-serif;
}

.video-title {
    font-weight: 600;
    font-size: 1rem;
    color: #111827;
    margin-bottom: 4px;
}

.video-separator {
    border: none;
    border-bottom: 2px solid #d1d5db;
    margin: 0 0 12px 0;
}

.video-about {
    height: 120px;
    overflow-y: auto;
    font-size: 0.95rem;
    line-height: 1.5;
    color: #374151;
    padding-right: 8px;
}

.video-wrapper {
    width: 100%;
    max-width: 100%;
    margin: 16px 0;
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.video-container {
    position: relative;
    width: 100%;
    background: #000;
}

.video-container video {
    width: 100%;
    display: block;
    outline: none;
}

/* Custom Controls */
.custom-controls {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    padding: 10px 15px;
    display: flex;
    flex-direction: column;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 10;
    pointer-events: none;
}

.video-container:hover .custom-controls,
.custom-controls.show {
    opacity: 1;
}

.custom-controls * {
    pointer-events: auto;
}

.progress-container {
    width: 100%;
    height: 6px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 3px;
    margin-bottom: 10px;
    cursor: pointer;
    position: relative;
}

.progress-bar {
    height: 100%;
    background: #ff0000;
    border-radius: 3px;
    width: 0%;
    position: relative;
}

.progress-handle {
    width: 12px;
    height: 12px;
    background: #ff0000;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    right: -6px;
    transform: translateY(-50%);
    opacity: 0;
    transition: opacity 0.2s ease;
}

.progress-container:hover .progress-handle {
    opacity: 1;
}

.controls-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.left-controls, .right-controls {
    display: flex;
    align-items: center;
    gap: 15px;
}

.control-btn {
    background: none;
    border: none;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: background 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
}

.control-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.play-pause {
    font-size: 1.4rem;
}

.time-display {
    color: white;
    font-size: 0.9rem;
    font-weight: 500;
}

.volume-container {
    display: flex;
    align-items: center;
    gap: 8px;
}

.volume-slider {
    width: 70px;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
    position: relative;
    cursor: pointer;
}

.volume-level {
    height: 100%;
    background: white;
    border-radius: 2px;
    width: 100%;
}

.volume-handle {
    width: 12px;
    height: 12px;
    background: white;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    right: -6px;
    transform: translateY(-50%);
    opacity: 0;
    transition: opacity 0.2s ease;
}

.volume-container:hover .volume-handle {
    opacity: 1;
}

.speed-control {
    position: relative;
}

.speed-btn {
    background: none;
    border: none;
    color: white;
    font-size: 0.9rem;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background 0.2s ease;
}

.speed-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.speed-options {
    position: absolute;
    bottom: 100%;
    right: 0;
    background: rgba(28, 28, 28, 0.9);
    border-radius: 4px;
    padding: 8px 0;
    min-width: 100px;
    display: none;
    z-index: 20;
}

.speed-options.show {
    display: block;
}

.speed-option {
    color: white;
    padding: 8px 16px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.2s ease;
}

.speed-option:hover {
    background: rgba(255, 255, 255, 0.1);
}

.speed-option.active {
    color: #ff0000;
    font-weight: 500;
}

.fullscreen-btn {
    font-size: 1.3rem;
}

/* Touch zones */
.touch-zone-left,
.touch-zone-center,
.touch-zone-right {
    position: absolute;
    top: 0;
    bottom: 60px;
    width: 33.33%;
    z-index: 5;
    cursor: pointer;
}

.touch-zone-left { left: 0; }
.touch-zone-center { left: 33.33%; }
.touch-zone-right { left: 66.66%; }

/* Skip feedback overlay */
.skip-feedback {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0.8);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 0;
    transition: opacity 0.2s ease;
    pointer-events: none;
    z-index: 15;
}

.skip-feedback.show {
    opacity: 1;
}

.skip-icon {
    font-size: 2rem;
    margin-bottom: 4px;
}

.skip-text {
    font-size: 0.85rem;
    font-weight: 600;
}

/* Floating Toggle Button */
.floating-toggle {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #1e3a8a;
    color: white;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.floating-toggle:hover {
    background: #2563eb;
    transform: scale(1.05);
}
</style>

<body>
<?php include '../components/Top_nav.php'; ?>

<div class="layout">

  <?php include '../components/SidebarNav_T4.php'; ?>

  <main class="main" id="main">

    <div class="main-content">
      <h1>Bab 1.2: Subbidang dan Badan Perakaunan</h1>

      <div class="video-wrapper">
        <div class="video-container">
          <video id="mainVideo" width="100%">
            <source src="../vid/intro.mp4" type="video/mp4">
            Browser anda tidak menyokong video tag.
          </video>
          
          <!-- Touch Zones -->
          <div class="touch-zone-left" id="touchLeft"></div>
          <div class="touch-zone-center" id="touchCenter"></div>
          <div class="touch-zone-right" id="touchRight"></div>

          <!-- Skip Feedback -->
          <div class="skip-feedback" id="skipFeedback">
            <div class="skip-icon" id="skipIcon"></div>
            <div class="skip-text" id="skipText"></div>
          </div>

          <!-- Custom Controls -->
          <div class="custom-controls" id="customControls">
            <div class="progress-container" id="progressContainer">
              <div class="progress-bar" id="progressBar">
                <div class="progress-handle" id="progressHandle"></div>
              </div>
            </div>
            
            <div class="controls-row">
              <div class="left-controls">
                <button class="control-btn play-pause" id="playPauseBtn">▶</button>
                <button class="control-btn rewind" id="rewindBtn">⏪</button>
                <button class="control-btn fast-forward" id="fastForwardBtn">⏩</button>
                <div class="volume-container">
                  <button class="control-btn volume-btn" id="volumeBtn">🔊</button>
                  <div class="volume-slider" id="volumeSlider">
                    <div class="volume-level" id="volumeLevel"></div>
                    <div class="volume-handle" id="volumeHandle"></div>
                  </div>
                </div>
                <div class="time-display" id="timeDisplay">0:00 / 0:00</div>
              </div>
              
              <div class="right-controls">
                <div class="speed-control">
                  <button class="speed-btn" id="speedBtn">1x</button>
                  <div class="speed-options" id="speedOptions">
                    <div class="speed-option" data-speed="0.25">0.25x</div>
                    <div class="speed-option" data-speed="0.5">0.5x</div>
                    <div class="speed-option active" data-speed="1">1x</div>
                    <div class="speed-option" data-speed="1.25">1.25x</div>
                    <div class="speed-option" data-speed="1.5">1.5x</div>
                    <div class="speed-option" data-speed="2">2x</div>
                  </div>
                </div>
                <button class="control-btn fullscreen-btn" id="fullscreenBtn">⛶</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="video-info">
        <div class="video-title">About</div>
        <hr class="video-separator">
        <div class="video-about">
          Dalam video ini, anda akan belajar apa itu simpanan perakaunan, bagaimana ia digunakan, dan bagaimana proses perakaunan berlaku dalam satu kitaran lengkap.
        </div>
      </div>

    </div>

  </main>

</div>

<button class="floating-toggle" id="floatingToggle">☰</button>

<script src="../js/navigation.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const video = document.getElementById('mainVideo');
  const playPauseBtn = document.getElementById('playPauseBtn');
  const rewindBtn = document.getElementById('rewindBtn');
  const fastForwardBtn = document.getElementById('fastForwardBtn');
  const progressContainer = document.getElementById('progressContainer');
  const progressBar = document.getElementById('progressBar');
  const progressHandle = document.getElementById('progressHandle');
  const volumeBtn = document.getElementById('volumeBtn');
  const volumeSlider = document.getElementById('volumeSlider');
  const volumeLevel = document.getElementById('volumeLevel');
  const volumeHandle = document.getElementById('volumeHandle');
  const timeDisplay = document.getElementById('timeDisplay');
  const speedBtn = document.getElementById('speedBtn');
  const speedOptions = document.getElementById('speedOptions');
  const fullscreenBtn = document.getElementById('fullscreenBtn');
  const videoContainer = document.querySelector('.video-container');
  const customControls = document.getElementById('customControls');
  
  // Touch zones
  const touchLeft = document.getElementById('touchLeft');
  const touchCenter = document.getElementById('touchCenter');
  const touchRight = document.getElementById('touchRight');
  const skipFeedback = document.getElementById('skipFeedback');
  const skipIcon = document.getElementById('skipIcon');
  const skipText = document.getElementById('skipText');

  let isDraggingProgress = false;
  let isDraggingVolume = false;
  let controlsTimeout;

  // Show feedback with icon and text
  function showFeedback(icon, text) {
    skipIcon.textContent = icon;
    skipText.textContent = text;
    skipFeedback.classList.add('show');
    
    setTimeout(() => {
      skipFeedback.classList.remove('show');
    }, 500);
  }

  // Show controls temporarily
  function showControls() {
    customControls.classList.add('show');
    clearTimeout(controlsTimeout);
    controlsTimeout = setTimeout(() => {
      if (!video.paused) {
        customControls.classList.remove('show');
      }
    }, 3000);
  }

  // Double tap detection
  let lastTapLeft = 0;
  let lastTapRight = 0;

  // LEFT → rewind 10s
  touchLeft.addEventListener('click', function(e) {
    e.stopPropagation();
    let now = Date.now();

    if (now - lastTapLeft < 350) {
      video.currentTime = Math.max(0, video.currentTime - 10);
      showFeedback('⏪', '10 saat');
      showControls();
    }
    
    lastTapLeft = now;
  });

  // RIGHT → forward 10s
  touchRight.addEventListener('click', function(e) {
    e.stopPropagation();
    let now = Date.now();

    if (now - lastTapRight < 350) {
      video.currentTime = Math.min(video.duration, video.currentTime + 10);
      showFeedback('⏩', '10 saat');
      showControls();
    }
    
    lastTapRight = now;
  });

  // CENTER → tap to play/pause
  touchCenter.addEventListener('click', function(e) {
    e.stopPropagation();
    togglePlayPause();
    showControls();
  });

  // Toggle play/pause
  function togglePlayPause() {
    if (video.paused) {
      video.play();
      playPauseBtn.textContent = '❚❚';
    } else {
      video.pause();
      playPauseBtn.textContent = '▶';
    }
  }
  
  // Play/Pause button
  playPauseBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    togglePlayPause();
  });
  
  // Rewind 10 seconds button
  rewindBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    video.currentTime = Math.max(0, video.currentTime - 10);
    showFeedback('⏪', '10 saat');
  });
  
  // Fast forward 10 seconds button
  fastForwardBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    video.currentTime = Math.min(video.duration, video.currentTime + 10);
    showFeedback('⏩', '10 saat');
  });
  
  // Update progress bar as video plays
  video.addEventListener('timeupdate', function() {
    if (!isDraggingProgress) {
      const progress = (video.currentTime / video.duration) * 100;
      progressBar.style.width = `${progress}%`;
    }
    
    const currentTime = formatTime(video.currentTime);
    const duration = formatTime(video.duration);
    timeDisplay.textContent = `${currentTime} / ${duration}`;
  });
  
  // Click on progress bar to seek
  progressContainer.addEventListener('click', function(e) {
    e.stopPropagation();
    const rect = progressContainer.getBoundingClientRect();
    const percent = (e.clientX - rect.left) / rect.width;
    video.currentTime = percent * video.duration;
  });
  
  // Drag progress handle
  progressHandle.addEventListener('mousedown', function(e) {
    isDraggingProgress = true;
    e.preventDefault();
    e.stopPropagation();
  });
  
  document.addEventListener('mousemove', function(e) {
    if (isDraggingProgress) {
      const rect = progressContainer.getBoundingClientRect();
      let percent = (e.clientX - rect.left) / rect.width;
      percent = Math.max(0, Math.min(1, percent));
      progressBar.style.width = `${percent * 100}%`;
      video.currentTime = percent * video.duration;
    }
  });
  
  document.addEventListener('mouseup', function() {
    isDraggingProgress = false;
  });
  
  // Volume control
  volumeBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    if (video.volume > 0) {
      video.volume = 0;
      volumeBtn.textContent = '🔇';
      volumeLevel.style.width = '0%';
    } else {
      video.volume = 1;
      volumeBtn.textContent = '🔊';
      volumeLevel.style.width = '100%';
    }
  });
  
  // Volume slider
  volumeSlider.addEventListener('click', function(e) {
    e.stopPropagation();
    const rect = volumeSlider.getBoundingClientRect();
    let percent = (e.clientX - rect.left) / rect.width;
    percent = Math.max(0, Math.min(1, percent));
    video.volume = percent;
    volumeLevel.style.width = `${percent * 100}%`;
    updateVolumeIcon(percent);
  });
  
  // Drag volume handle
  volumeHandle.addEventListener('mousedown', function(e) {
    isDraggingVolume = true;
    e.preventDefault();
    e.stopPropagation();
  });
  
  document.addEventListener('mousemove', function(e) {
    if (isDraggingVolume) {
      const rect = volumeSlider.getBoundingClientRect();
      let percent = (e.clientX - rect.left) / rect.width;
      percent = Math.max(0, Math.min(1, percent));
      video.volume = percent;
      volumeLevel.style.width = `${percent * 100}%`;
      updateVolumeIcon(percent);
    }
  });
  
  document.addEventListener('mouseup', function() {
    isDraggingVolume = false;
  });
  
  // Update volume icon
  function updateVolumeIcon(volume) {
    if (volume === 0) {
      volumeBtn.textContent = '🔇';
    } else if (volume < 0.5) {
      volumeBtn.textContent = '🔈';
    } else {
      volumeBtn.textContent = '🔊';
    }
  }
  
  // Speed control
  speedBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    speedOptions.classList.toggle('show');
  });
  
  // Close speed options
  document.addEventListener('click', function(e) {
    if (!speedBtn.contains(e.target) && !speedOptions.contains(e.target)) {
      speedOptions.classList.remove('show');
    }
  });
  
  // Set playback speed
  speedOptions.querySelectorAll('.speed-option').forEach(option => {
    option.addEventListener('click', function(e) {
      e.stopPropagation();
      const speed = parseFloat(this.getAttribute('data-speed'));
      video.playbackRate = speed;
      speedBtn.textContent = `${speed}x`;
      
      speedOptions.querySelectorAll('.speed-option').forEach(opt => {
        opt.classList.remove('active');
      });
      this.classList.add('active');
      
      speedOptions.classList.remove('show');
    });
  });
  
  // Fullscreen functionality
  fullscreenBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    if (!document.fullscreenElement) {
      if (videoContainer.requestFullscreen) {
        videoContainer.requestFullscreen();
      } else if (videoContainer.webkitRequestFullscreen) {
        videoContainer.webkitRequestFullscreen();
      } else if (videoContainer.msRequestFullscreen) {
        videoContainer.msRequestFullscreen();
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
    }
  });
  
  // Format time
  function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
  }
  
  // Initialize
  volumeLevel.style.width = `${video.volume * 100}%`;
  updateVolumeIcon(video.volume);
  
  // Auto-hide controls when playing
  video.addEventListener('play', function() {
    showControls();
  });

  video.addEventListener('pause', function() {
    customControls.classList.add('show');
    clearTimeout(controlsTimeout);
  });

  // Show controls on mouse move
  videoContainer.addEventListener('mousemove', function() {
    showControls();
  });

  // Floating toggle
  const floatingToggle = document.getElementById('floatingToggle');
  floatingToggle.addEventListener('click', function() {
    document.body.classList.toggle('sidebar-collapsed');
  });

  // Keyboard shortcuts
  document.addEventListener('keydown', function(e) {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    
    switch(e.key) {
      case ' ':
        e.preventDefault();
        togglePlayPause();
        break;
      case 'ArrowLeft':
        e.preventDefault();
        video.currentTime = Math.max(0, video.currentTime - 10);
        showFeedback('⏪', '10 saat');
        break;
      case 'ArrowRight':
        e.preventDefault();
        video.currentTime = Math.min(video.duration, video.currentTime + 10);
        showFeedback('⏩', '10 saat');
        break;
      case 'f':
        fullscreenBtn.click();
        break;
    }
  });
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