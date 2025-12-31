document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarCollapseBtn = document.getElementById("sidebarCollapseBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");
    const mainContent = document.querySelector(".main-content");

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

    // Load collapsed state from localStorage
    const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
    if (isCollapsed && window.innerWidth >= 992) {
        sidebar.classList.add("collapsed");
        if (sidebarCollapseBtn) {
            sidebarCollapseBtn.classList.add("collapsed");
        }
    }

    // ===== Toggle Sidebar Function (Mobile) =====
    function toggleSidebar() {
        sidebar.classList.toggle("active");
        sidebarOverlay.classList.toggle("active");

        // Prevent body scroll when sidebar is open on mobile
        if (window.innerWidth < 992) {
            document.body.style.overflow = sidebar.classList.contains("active")
                ? "hidden"
                : "auto";
        }
    }

    // ===== Close Sidebar Function (Mobile) =====
    function closeSidebar() {
        sidebar.classList.remove("active");
        sidebarOverlay.classList.remove("active");
        document.body.style.overflow = "auto";
    }

    // ===== Open Sidebar Function (Mobile) =====
    function openSidebar() {
        sidebar.classList.add("active");
        sidebarOverlay.classList.add("active");

        // Prevent body scroll when sidebar is open on mobile
        if (window.innerWidth < 992) {
            document.body.style.overflow = "hidden";
        }
    }

    // ===== Collapse Sidebar Function (Desktop) =====
    function collapseSidebar() {
        sidebar.classList.toggle("collapsed");
        if (sidebarCollapseBtn) {
            sidebarCollapseBtn.classList.toggle("collapsed");
        }

        // Save collapsed state to localStorage
        const isNowCollapsed = sidebar.classList.contains("collapsed");
        localStorage.setItem("sidebarCollapsed", isNowCollapsed);
    }

    // ===== Event Listeners =====

    // 1. Toggle sidebar on button click (Mobile & Desktop)
    sidebarToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        if (window.innerWidth < 992) {
            // Mobile behavior - toggle open/close
            toggleSidebar();
        } else {
            // Desktop behavior - collapse/expand
            collapseSidebar();
        }
    });

    // 2. Collapse sidebar on button click (Desktop only)
    if (sidebarCollapseBtn) {
        sidebarCollapseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            collapseSidebar();
        });
    }

    // 3. Close sidebar on overlay click (Mobile)
    sidebarOverlay.addEventListener("click", function (e) {
        e.preventDefault();
        closeSidebar();
    });

    // 4. Close sidebar on close button click (Mobile)
    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            closeSidebar();
        });
    }

    // 5. Close sidebar when clicking menu items on mobile
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

    // 6. Handle submenu toggle
    const menuToggleButtons = document.querySelectorAll(".menu-link-toggle");
    menuToggleButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            const isShow = submenu && submenu.classList.contains("show");

            // Close all other submenus
            menuToggleButtons.forEach((btn) => {
                if (btn !== this) {
                    btn.classList.remove("show");
                    const sub = btn.nextElementSibling;
                    if (sub) {
                        sub.classList.remove("show");
                    }
                }
            });

            // Toggle current submenu
            if (submenu) {
                if (isShow) {
                    submenu.classList.remove("show");
                    this.classList.remove("show");
                } else {
                    submenu.classList.add("show");
                    this.classList.add("show");
                }
            }
        });
    });

    // 7. Handle window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            // Desktop view
            closeSidebar();
            // Keep collapsed state if it was set
            if (localStorage.getItem("sidebarCollapsed") === "true") {
                sidebar.classList.add("collapsed");
                if (sidebarCollapseBtn) {
                    sidebarCollapseBtn.classList.add("collapsed");
                }
            }
        } else {
            // Mobile view - reset collapsed state
            sidebar.classList.remove("collapsed");
            if (sidebarCollapseBtn) {
                sidebarCollapseBtn.classList.remove("collapsed");
            }
        }
    });

    // 8. Prevent sidebar close when clicking inside sidebar
    sidebar.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // 9. Close sidebar when pressing Escape key (Mobile)
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && window.innerWidth < 992) {
            closeSidebar();
        }
    });

    // 10. Bootstrap tooltip initialization
    if (typeof bootstrap !== "undefined") {
        const tooltipElements = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );
        tooltipElements.forEach((el) => {
            new bootstrap.Tooltip(el);
        });
    }
});
