/* ========================================
   K-AMU ADMIN - INTERACTIVE COMPONENTS
   Sidebar Toggle, Dropdowns, Menu
   ======================================== */

(function () {
    "use strict";

    // ==========================================
    // DOM Elements
    // ==========================================

    const DOM = {
        // Sidebar
        sidebar: document.querySelector("[data-sidebar]"),
        sidebarToggle: document.querySelector("[data-toggle-mobile-sidebar]"),
        sidebarOverlay: document.querySelector("[data-sidebar-overlay]"),
        sidebarCollapseBtn: document.querySelector("[data-sidebar-collapse]"),
        menuToggles: document.querySelectorAll("[data-menu-toggle]"),

        // Navbar
        notificationBtn: document.querySelector(
            '[data-toggle="notifications"]'
        ),
        notificationDropdown: document.querySelector(
            '[data-dropdown="notifications"]'
        ),
        messageBtn: document.querySelector('[data-toggle="messages"]'),
        messageDropdown: document.querySelector('[data-dropdown="messages"]'),
        userBtn: document.querySelector('[data-toggle="user"]'),
        userDropdown: document.querySelector('[data-dropdown="user"]'),
    };

    // ==========================================
    // SIDEBAR MANAGER - Toggle & Collapse
    // ==========================================

    class SidebarManager {
        constructor() {
            this.isMobileOpen = false;
            this.isCollapsed = false;
            this.init();
        }

        init() {
            this.bindEvents();
            this.restoreState();
        }

        bindEvents() {
            // Mobile toggle button
            if (DOM.sidebarToggle) {
                DOM.sidebarToggle.addEventListener("click", () => {
                    this.toggleMobileView();
                });
            }

            // Sidebar overlay click
            if (DOM.sidebarOverlay) {
                DOM.sidebarOverlay.addEventListener("click", () => {
                    this.closeMobileView();
                });
            }

            // Collapse button
            if (DOM.sidebarCollapseBtn) {
                DOM.sidebarCollapseBtn.addEventListener("click", () => {
                    this.toggleCollapse();
                });
            }

            // Menu toggle buttons
            DOM.menuToggles.forEach((toggle) => {
                toggle.addEventListener("click", (e) => {
                    e.preventDefault();
                    this.toggleSubmenu(toggle);
                });
            });

            // Close mobile when clicking on a link
            document.querySelectorAll("[data-menu-link]").forEach((link) => {
                link.addEventListener("click", () => {
                    if (window.innerWidth <= 991) {
                        this.closeMobileView();
                    }
                });
            });

            // Handle window resize
            window.addEventListener("resize", () => {
                if (window.innerWidth > 991) {
                    this.closeMobileView();
                }
            });
        }

        toggleMobileView() {
            if (this.isMobileOpen) {
                this.closeMobileView();
            } else {
                this.openMobileView();
            }
        }

        openMobileView() {
            if (DOM.sidebar) {
                DOM.sidebar.classList.add("mobile-open");
                this.isMobileOpen = true;
            }
            if (DOM.sidebarOverlay) {
                DOM.sidebarOverlay.classList.add("show");
            }
        }

        closeMobileView() {
            if (DOM.sidebar) {
                DOM.sidebar.classList.remove("mobile-open");
                this.isMobileOpen = false;
            }
            if (DOM.sidebarOverlay) {
                DOM.sidebarOverlay.classList.remove("show");
            }
        }

        toggleCollapse() {
            if (DOM.sidebar) {
                DOM.sidebar.classList.toggle("collapsed");
                this.isCollapsed = DOM.sidebar.classList.contains("collapsed");

                // Save state to localStorage
                localStorage.setItem("sidebarCollapsed", this.isCollapsed);
            }
        }

        toggleSubmenu(toggle) {
            const submenu = toggle.nextElementSibling;
            if (submenu && submenu.classList.contains("submenu")) {
                // Close other submenus
                document.querySelectorAll(".submenu.open").forEach((menu) => {
                    if (menu !== submenu) {
                        menu.classList.remove("open");
                    }
                });

                // Toggle current submenu
                submenu.classList.toggle("open");
                toggle.classList.toggle("active");
            }
        }

        restoreState() {
            // Restore collapsed state
            const wasCollapsed =
                localStorage.getItem("sidebarCollapsed") === "true";
            if (wasCollapsed && DOM.sidebar) {
                DOM.sidebar.classList.add("collapsed");
                this.isCollapsed = true;
            }
        }
    }

    // ==========================================
    // NAVBAR MANAGER - Dropdowns
    // ==========================================

    class NavbarManager {
        constructor() {
            this.activeDropdown = null;
            this.init();
        }

        init() {
            this.bindEvents();
            this.setupClickOutside();
        }

        bindEvents() {
            if (DOM.notificationBtn) {
                DOM.notificationBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("notifications");
                });
            }

            if (DOM.messageBtn) {
                DOM.messageBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("messages");
                });
            }

            if (DOM.userBtn) {
                DOM.userBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("user");
                });
            }
        }

        toggleDropdown(type) {
            const dropdownMap = {
                notifications: DOM.notificationDropdown,
                messages: DOM.messageDropdown,
                user: DOM.userDropdown,
            };

            const dropdown = dropdownMap[type];
            if (!dropdown) return;

            // Close other dropdowns
            if (this.activeDropdown && this.activeDropdown !== type) {
                this.closeDropdown(this.activeDropdown);
            }

            // Toggle current
            if (this.activeDropdown === type) {
                this.closeDropdown(type);
            } else {
                dropdown.classList.add("show");
                this.activeDropdown = type;
            }
        }

        closeDropdown(type) {
            const dropdownMap = {
                notifications: DOM.notificationDropdown,
                messages: DOM.messageDropdown,
                user: DOM.userDropdown,
            };

            const dropdown = dropdownMap[type];
            if (dropdown) {
                dropdown.classList.remove("show");
            }

            if (this.activeDropdown === type) {
                this.activeDropdown = null;
            }
        }

        setupClickOutside() {
            document.addEventListener("click", (e) => {
                // Notifications
                if (
                    !DOM.notificationBtn?.contains(e.target) &&
                    !DOM.notificationDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("notifications");
                }

                // Messages
                if (
                    !DOM.messageBtn?.contains(e.target) &&
                    !DOM.messageDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("messages");
                }

                // User Menu
                if (
                    !DOM.userBtn?.contains(e.target) &&
                    !DOM.userDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("user");
                }
            });

            // Close on Escape key
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape") {
                    this.closeDropdown("notifications");
                    this.closeDropdown("messages");
                    this.closeDropdown("user");
                }
            });
        }
    }

    // ==========================================
    // INITIALIZE ON DOM READY
    // ==========================================

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", () => {
            new SidebarManager();
            new NavbarManager();
        });
    } else {
        new SidebarManager();
        new NavbarManager();
    }

    // ==========================================
    // UTILITY FUNCTIONS
    // ==========================================

    // Smooth scroll to element
    window.scrollToElement = function (selector) {
        const element = document.querySelector(selector);
        if (element) {
            element.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    };

    // Show notification
    window.showNotification = function (message, type = "info") {
        const alertClass =
            {
                success: "alert-success",
                error: "alert-danger",
                warning: "alert-warning",
                info: "alert-info",
            }[type] || "alert-info";

        const alert = document.createElement("div");
        alert.className = `alert ${alertClass} alert-dismissible fade show`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const container = document.querySelector(".content-wrapper");
        if (container) {
            container.insertBefore(alert, container.firstChild);
            setTimeout(() => alert.remove(), 5000);
        }
    };

    // Toggle class on element
    window.toggleClass = function (selector, className) {
        const element = document.querySelector(selector);
        if (element) {
            element.classList.toggle(className);
        }
    };

    // Remove class from all matching elements
    window.removeClassAll = function (selector, className) {
        document.querySelectorAll(selector).forEach((el) => {
            el.classList.remove(className);
        });
    };
})();
