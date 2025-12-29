document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");
    const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");

    // Exit if main elements don't exist
    if (!sidebarToggle || !sidebar) {
        console.warn("Sidebar elements not found");
        return;
    }

    // Get or create overlay
    let sidebarOverlay = document.getElementById("sidebarOverlay");
    if (!sidebarOverlay) {
        const overlay = document.createElement("div");
        overlay.id = "sidebarOverlay";
        overlay.className = "sidebar-overlay";
        document.body.appendChild(overlay);
        sidebarOverlay = overlay;
    }

    // ===== Toggle Sidebar Function =====
    function toggleSidebar() {
        sidebar.classList.toggle("active");
        sidebarOverlay.classList.toggle("active");
    }

    // ===== Close Sidebar Function =====
    function closeSidebar() {
        sidebar.classList.remove("active");
        sidebarOverlay.classList.remove("active");
    }

    // ===== Open Sidebar Function =====
    function openSidebar() {
        sidebar.classList.add("active");
        sidebarOverlay.classList.add("active");
    }

    // ===== Event Listeners =====

    // 1. Toggle sidebar on button click
    sidebarToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        toggleSidebar();
    });

    // 2. Close sidebar on overlay click
    sidebarOverlay.addEventListener("click", function (e) {
        e.preventDefault();
        closeSidebar();
    });

    // 3. Close sidebar on close button click (mobile)
    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            closeSidebar();
        });
    }

    // 4. Close sidebar when clicking menu items on mobile
    const menuLinks = document.querySelectorAll(".menu-link");
    menuLinks.forEach((link) => {
        link.addEventListener("click", function () {
            // Close sidebar only on mobile (width < 992px)
            if (window.innerWidth < 992) {
                // Add small delay for smooth transition
                setTimeout(closeSidebar, 100);
            }
        });
    });

    // 5. Close sidebar on window resize (if screen becomes large)
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });

    // 6. Prevent sidebar close when clicking inside sidebar
    sidebar.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // 7. Close sidebar when pressing Escape key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeSidebar();
        }
    });
});
