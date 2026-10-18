<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    .pdf-toolbar {
      background: white;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      border-bottom: 1px solid #ddd;
      position: sticky;
      top: 0;
      z-index: 5;
      flex-wrap: nowrap;
    }

    .pdf-container {
      width: 100%;
      height: 100%;
      overflow: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      background: #f8faff;
      padding: 20px;
      position: relative;
      scroll-snap-type: y mandatory;
    }

    .toolbar-group {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      justify-content: center;
    }

    .toolbar-group:first-child {
      justify-content: flex-start;
    }

    .toolbar-group:last-child {
      justify-content: flex-end;
    }

    /* FIXED: Use data URLs for arrows since your image files don't exist */
    .icon-prev, .icon-next {
      display: inline-block;
      width: 20px;
      height: 20px;
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
    }

    .icon-prev {
      /* White arrow pointing left */
      background-image: url('../img/prev.png');
    }

    .icon-next {
      /* White arrow pointing right */
      background-image: url('../img/next.png');
    }

    #pdfViewer {
      margin: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 8px;
      transition: transform 0.3s ease;
      touch-action: pan-x pan-y;
      scroll-snap-align: start;
      flex-shrink: 0;
    }

    /* Updated toolbar button styling - ALL buttons same color */
    .toolbar-btn {
      background: #e5e7eb;
      color: #4b5563;
      border: none;
      border-radius: 6px;
      padding: 8px 16px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
      min-height: 40px;
    }
    
    /* Remove the secondary class since all buttons are same now */
    .toolbar-btn:hover { 
      background: #d1d5db;
      transform: translateY(-2px); 
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Icon container */
    .icon-container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 24px;
      height: 24px;
    }

    .toolbar-btn-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2em;
      width: 24px;
      height: 24px;
      color: #4b5563;
    }

    .toolbar-separator {
      height: 30px;
      width: 1px;
      background: #d1d5db;
      margin: 0 5px;
    }

    .page-indicator {
      background: #f3f4f6;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 500;
      min-width: 140px;
      text-align: center;
      white-space: nowrap;
    }

    .zoom-indicator {
      background: #f3f4f6;
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 500;
      min-width: 80px;
      text-align: center;
      white-space: nowrap;
    }

    .floating-toggle, .orientation-toggle {
      position: fixed;
      bottom: 20px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #4f46e5;
      color: white;
      border: none;
      font-size: 20px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .floating-toggle { right: 20px; }
    .orientation-toggle { left: 20px; }
    
    /* Custom icon styling */
    .icon-kanta {
      display: inline-block;
      width: 20px;
      height: 20px;
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      /* Magnifying glass icon */
      background-image: url('../img/kanta.png');
    }
    
    .icon-download {
      display: inline-block;
      width: 20px;
      height: 20px;
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
      /* Download icon */
      background-image: url('../img/muatTurun.png');
    }
  </style>
</head>

<body>

<?php include '../components/Top_nav.php'; ?>

<div class="layout">
  <?php include '../components/SidebarNav_T4.php'; ?>

  <main class="main" id="main">

  <div class="pdf-toolbar">
    <!-- Group 1: Navigation - Kiri -->
    <div class="toolbar-group">
      <button class="toolbar-btn" id="prevPage">
        <span class="icon-container">
          <span class="icon-prev"></span>
        </span>
        <span>Halaman Sebelum</span>
      </button>
      
      <div class="page-indicator">
        Halaman: <span id="pageNum">1</span> / <span id="pageCount">0</span>
      </div>
      
      <button class="toolbar-btn" id="nextPage">
        <span>Halaman Seterus</span>
        <span class="icon-container">
          <span class="icon-next"></span>
        </span>
      </button>
    </div>
    
    <div class="toolbar-separator"></div>
    
    <!-- Group 2: Zoom - Tengah -->
    <div class="toolbar-group">
      <button class="toolbar-btn" id="zoomOut" title="Zum Keluar">
        <span class="toolbar-btn-icon">−</span>
        <span class="icon-kanta"></span>
      </button>
      
      <div class="zoom-indicator">
        <span id="zoomLevel">180%</span>
      </div>
      
      <button class="toolbar-btn" id="zoomIn" title="Zum Masuk">
        <span class="toolbar-btn-icon">+</span>
        <span class="icon-kanta"></span>
      </button>
    </div>
    
    <div class="toolbar-separator"></div>
    
    <!-- Group 3: Download - Kanan -->
    <div class="toolbar-group">
      <button class="toolbar-btn" id="downloadPDF" title="Muat Turun">
        <span class="icon-download"></span>
        <span>Muat Turun</span>
      </button>
    </div>
  </div>

    <div class="pdf-container" id="pdfContainer">
      <canvas id="pdfViewer"></canvas>
    </div>

  </main>
</div>

<button class="floating-toggle" id="floatingToggle">☰</button>

<script src="../js/navigation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

<script>
let pdfDoc = null,
    pageNum = 1,
    pageCount = 0,
    scale = 1.8,
    canvas = document.getElementById('pdfViewer'),
    ctx = canvas.getContext('2d'),
    pdfContainer = document.getElementById('pdfContainer'),
    orientation = 'vertical';

function init() {
  loadPDF("../pdf/NOTA BAB 7.pdf");
  setupEventListeners();
}

function renderPage(num) {
  pdfDoc.getPage(num).then(page => {
    let viewport = page.getViewport({ scale });
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    page.render({ canvasContext: ctx, viewport: viewport }).promise.then(() => {
      document.getElementById('pageNum').textContent = num;
    });
  });
}

function loadPDF(url) {
  pdfjsLib.getDocument(url).promise.then(pdf => {
    pdfDoc = pdf;
    pageCount = pdf.numPages;
    document.getElementById('pageCount').textContent = pageCount;
    renderPage(pageNum);
  });
}

function setupEventListeners() {
  document.getElementById('nextPage').onclick = () => {
    if (pageNum < pageCount) { pageNum++; renderPage(pageNum); }
  };

  document.getElementById('prevPage').onclick = () => {
    if (pageNum > 1) { pageNum--; renderPage(pageNum); }
  };

  document.getElementById('zoomIn').onclick = () => {
    scale += 0.3;
    document.getElementById('zoomLevel').textContent = Math.round(scale*100) + '%';
    renderPage(pageNum);
  };

  document.getElementById('zoomOut').onclick = () => {
    if(scale > 0.6){
      scale -= 0.3;
      document.getElementById('zoomLevel').textContent = Math.round(scale*100) + '%';
      renderPage(pageNum);
    }
  };

  document.getElementById('downloadPDF').onclick = () => {
    window.open("../pdf/NOTA BAB 7.pdf", "_blank");
  };

}

init();
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