document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("sidebarNavbarWrapper");
    const overlay = document.getElementById("sidebarOverlay");
    const toggleBtn = document.getElementById("sidebarToggleBtn");
    const collapseBtn = document.getElementById("collapseToggleBtn");
    const notificationBtn = document.getElementById("notificationBtn");
    const notificationDropdown = document.getElementById(
        "notificationDropdown"
    );
    const userMenuBtn = document.getElementById("userMenuBtn");
    const userDropdown = document.getElementById("userDropdown");

    if (!wrapper) return;

    // ===== Load Saved State from LocalStorage =====
    function loadSavedState() {
        const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
        if (isCollapsed && window.innerWidth >= 769) {
            wrapper.classList.add("collapsed");
            updateMainContentMargin();
        }
    }

    // ===== Update Main Content Margin =====
    function updateMainContentMargin() {
        const mainContent = document.querySelector(".main-content");
        if (mainContent) {
            if (wrapper.classList.contains("collapsed")) {
                mainContent.style.marginLeft = "80px";
            } else {
                mainContent.style.marginLeft = "280px";
            }
        }
    }

    // ===== Toggle Sidebar (Mobile) =====
    function toggleSidebar() {
        wrapper.classList.toggle("active");
        overlay.classList.toggle("show");
    }

    // ===== Close Sidebar =====
    function closeSidebar() {
        wrapper.classList.remove("active");
        overlay.classList.remove("show");
    }

    // ===== Toggle Collapse (Desktop) =====
    function toggleCollapse() {
        wrapper.classList.toggle("collapsed");
        const isCollapsed = wrapper.classList.contains("collapsed");
        localStorage.setItem(
            "sidebarCollapsed",
            isCollapsed ? "true" : "false"
        );
        updateMainContentMargin();
    }

    // ===== Toggle Submenu =====
    function toggleSubmenu(button) {
        const menuItem = button.closest(".menu-has-submenu");
        if (!menuItem) return;

        // Close other submenus
        document.querySelectorAll(".menu-has-submenu.open").forEach((item) => {
            if (item !== menuItem) {
                item.classList.remove("open");
            }
        });

        menuItem.classList.toggle("open");
    }

    // ===== Auto Expand Active Submenu =====
    function autoExpandActiveSubmenu() {
        const activeSubmenuItems = document.querySelectorAll(
            ".submenu-link.active"
        );
        activeSubmenuItems.forEach((item) => {
            const submenu = item.closest(".submenu");
            if (submenu) {
                const menuItem = submenu.closest(".menu-has-submenu");
                if (menuItem) {
                    menuItem.classList.add("open");
                }
            }
        });
    }

    // ===== Toggle Notification Dropdown =====
    function toggleNotificationDropdown(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle("show");
        if (userDropdown.classList.contains("show")) {
            userDropdown.classList.remove("show");
        }
    }

    // ===== Toggle User Dropdown =====
    function toggleUserDropdown(e) {
        e.stopPropagation();
        userDropdown.classList.toggle("show");
        if (notificationDropdown.classList.contains("show")) {
            notificationDropdown.classList.remove("show");
        }
    }

    // ===== Close Dropdowns =====
    function closeDropdowns() {
        notificationDropdown.classList.remove("show");
        userDropdown.classList.remove("show");
    }

    // ===== EVENT LISTENERS =====

    // Toggle sidebar on button click (mobile)
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });
    }

    // Close sidebar on overlay click
    overlay.addEventListener("click", function (e) {
        e.preventDefault();
        closeSidebar();
    });

    // Toggle collapse on collapse button click (desktop)
    if (collapseBtn) {
        collapseBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleCollapse();
        });
    }

    // Toggle submenu on menu toggle button click
    const menuToggles = document.querySelectorAll(".menu-toggle");
    menuToggles.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleSubmenu(this);
        });
    });

    // Close sidebar when clicking menu links on mobile
    const menuLinks = document.querySelectorAll(".menu-link:not(.menu-toggle)");
    menuLinks.forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 769) {
                setTimeout(closeSidebar, 100);
            }
        });
    });

    // Close sidebar when clicking submenu links on mobile
    const submenuLinks = document.querySelectorAll(".submenu-link");
    submenuLinks.forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 769) {
                setTimeout(closeSidebar, 100);
            }
        });
    });

    // Notification dropdown toggle
    if (notificationBtn) {
        notificationBtn.addEventListener("click", toggleNotificationDropdown);
    }

    // User dropdown toggle
    if (userMenuBtn) {
        userMenuBtn.addEventListener("click", toggleUserDropdown);
    }

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (e) {
        if (
            !notificationDropdown.contains(e.target) &&
            e.target !== notificationBtn
        ) {
            notificationDropdown.classList.remove("show");
        }
        if (!userDropdown.contains(e.target) && e.target !== userMenuBtn) {
            userDropdown.classList.remove("show");
        }
    });

    // Close sidebar on window resize
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 769) {
            closeSidebar();
        }
    });

    // Prevent sidebar close when clicking inside
    wrapper.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // Close sidebar on Escape key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeSidebar();
            closeDropdowns();
        }
    });

    // Initialize
    loadSavedState();
    autoExpandActiveSubmenu();
});
