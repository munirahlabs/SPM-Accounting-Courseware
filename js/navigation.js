// WRAP ALL YOUR CODE IN THIS FUNCTION
(function() {
  // Wait for DOM to be fully loaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSidebar);
  } else {
    // DOM already loaded, run immediately
    initSidebar();
  }

  function initSidebar() {
    console.log("🎯 SIDEBAR INITIALIZATION STARTED");
    console.log("📁 navigation.js loaded for:", window.location.pathname);
    
    /////////// Sidebar Toggle Functionality
    const sidebar = document.getElementById("sidebar");
    const toggleSidebar = document.getElementById("toggleSidebar");
    const floatingToggle = document.getElementById("floatingToggle");

    if (!sidebar) {
      console.error("❌ CRITICAL ERROR: Sidebar element not found!");
      return;
    }

    console.log("✅ Sidebar element found");
    console.log("✅ Toggle button found:", toggleSidebar ? "Yes" : "No");
    console.log("✅ Floating toggle found:", floatingToggle ? "Yes" : "No");

    // Toggle sidebar when clicking the button INSIDE the sidebar
    if (toggleSidebar) {
      toggleSidebar.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        document.body.classList.toggle("sidebar-collapsed");

        // Show floating button when collapsed
        if (sidebar.classList.contains("collapsed")) {
          floatingToggle.classList.add("show");
        } else {
          floatingToggle.classList.remove("show");
        }
      });
    }

    // Toggle sidebar when clicking the floating button
    if (floatingToggle) {
      floatingToggle.addEventListener("click", () => {
        sidebar.classList.remove("collapsed");
        document.body.classList.remove("sidebar-collapsed");
        floatingToggle.classList.remove("show");
      });
    }

    // Function to find and mark the active sidebar item
    function markActiveSidebarItem() {
      console.log("🎯 MARKING ACTIVE SIDEBAR ITEM");
      
      // Get current page - BETTER METHOD
      const currentPath = window.location.pathname;
      const pathSegments = currentPath.split('/');
      const currentFile = pathSegments.pop(); // Get filename
      const currentFolder = pathSegments.pop(); // Get folder name
      
      console.log("📄 Current file:", currentFile);
      console.log("📁 Current folder:", currentFolder);
      
      // Get all sidebar links
      const allLinks = document.querySelectorAll('.subtopic-item a');
      console.log("🔗 Found sidebar links:", allLinks.length);
      
      let found = false;
      
      // METHOD 1: Exact filename match (most reliable)
      allLinks.forEach(link => {
        const href = link.getAttribute('href');
        const linkSegments = href.split('/');
        const linkFile = linkSegments.pop();
        
        if (linkFile === currentFile) {
          console.log("✅ EXACT FILENAME MATCH!");
          highlightLink(link);
          found = true;
        }
      });
      
      // METHOD 2: If no exact match, try matching by path
      if (!found) {
        console.log("⚠️ No exact filename match, trying path matching...");
        
        allLinks.forEach(link => {
          const href = link.getAttribute('href');
          
          // Check if current path contains the href or vice versa
          if (currentPath.includes(href) || href.includes(currentFile)) {
            console.log("✅ PATH MATCH FOUND!");
            highlightLink(link);
            found = true;
          }
        });
      }
      
      // METHOD 3: Last resort - check for Tingkatan4/Tingkatan5 in paths
      if (!found && (currentFolder === 'Tingkatan4' || currentFolder === 'Tingkatan5')) {
        console.log("🔄 Looking for links in", currentFolder, "...");
        
        allLinks.forEach(link => {
          const href = link.getAttribute('href');
          
          if (href.includes(currentFolder)) {
            console.log("✅ COURSE FOLDER MATCH!");
            highlightLink(link);
            found = true;
          }
        });
      }
      
      console.log(found ? "✅ Sidebar item highlighted!" : "❌ No sidebar item highlighted");
      
      // If nothing found, highlight first link in first module as fallback
      if (!found && allLinks.length > 0) {
        console.log("⚠️ No match found, highlighting first link as fallback");
        highlightLink(allLinks[0]);
      }
    }
    
    // Helper function to highlight a link
    function highlightLink(link) {
      // 1. Mark link as active
      link.classList.add('active');
      
      // 2. Highlight parent item
      const parentItem = link.closest('.subtopic-item');
      if (parentItem) {
        parentItem.classList.add('active-item');
      }
      
      // 3. Expand parent module
      const parentModule = link.closest('.module');
      if (parentModule) {
        const subtopicList = parentModule.querySelector('.subtopic-list');
        const arrow = parentModule.querySelector('.arrow');
        
        if (subtopicList && arrow) {
          subtopicList.classList.add('open');
          parentModule.classList.add('open');
        }
      }
    }

    // Accordion functionality for module headers
    function setupModuleToggle() {
      console.log("🔧 Setting up module toggle...");
      
      const moduleHeaders = document.querySelectorAll('.module-header');
      
      moduleHeaders.forEach(header => {
        header.addEventListener('click', () => {
          const list = header.nextElementSibling;
          const arrow = header.querySelector('.arrow');
          const module = header.parentElement;
          
          // Check if this module contains an active link
          const hasActive = module.querySelector('.subtopic-item a.active');
          
          // If module has active link and is open, don't collapse it
          if (hasActive && list.classList.contains('open')) {
            console.log("⚠️ Cannot collapse - module contains active page");
            return;
          }
          
          // Toggle the module open/close
          list.classList.toggle('open');
          module.classList.toggle('open');
          console.log("Toggled module:", module.classList.contains('open') ? 'open' : 'closed');
        });
      });
    }

    // Run all initialization
    markActiveSidebarItem();
    setupModuleToggle();
    
    // Double-check after a short delay
    setTimeout(() => {
      console.log("🔄 Running verification check...");
      markActiveSidebarItem();
    }, 500);
    
    console.log("✅ Sidebar initialization complete!");
  }
})();