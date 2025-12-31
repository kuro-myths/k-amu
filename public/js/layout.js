/* ==========================================
   NAVBAR & SIDEBAR INTERACTIONS
   ========================================== */

(function () {
    "use strict";

    const DOM = {
        navbar: {
            notificationBtn: document.querySelector(
                '[data-toggle="notifications"]'
            ),
            notificationDropdown: document.querySelector(
                '[data-dropdown="notifications"]'
            ),
            messageBtn: document.querySelector('[data-toggle="messages"]'),
            messageDropdown: document.querySelector(
                '[data-dropdown="messages"]'
            ),
            userBtn: document.querySelector('[data-toggle="user"]'),
            userDropdown: document.querySelector('[data-dropdown="user"]'),
        },
        sidebar: {
            container: document.querySelector("[data-sidebar]"),
            overlay: document.querySelector("[data-sidebar-overlay]"),
            headerToggle: document.querySelector(
                "[data-toggle-mobile-sidebar]"
            ),
            collapseBtn: document.querySelector("[data-sidebar-collapse]"),
            menuToggles: document.querySelectorAll("[data-menu-toggle]"),
            menuLinks: document.querySelectorAll("[data-menu-link]"),
        },
    };

    // ==========================================
    // NAVBAR INTERACTIONS
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
            if (DOM.navbar.notificationBtn) {
                DOM.navbar.notificationBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("notifications");
                });
            }

            if (DOM.navbar.messageBtn) {
                DOM.navbar.messageBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("messages");
                });
            }

            if (DOM.navbar.userBtn) {
                DOM.navbar.userBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    this.toggleDropdown("user");
                });
            }
        }

        toggleDropdown(type) {
            const dropdownMap = {
                notifications: DOM.navbar.notificationDropdown,
                messages: DOM.navbar.messageDropdown,
                user: DOM.navbar.userDropdown,
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
                notifications: DOM.navbar.notificationDropdown,
                messages: DOM.navbar.messageDropdown,
                user: DOM.navbar.userDropdown,
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
                if (
                    !DOM.navbar.notificationBtn?.contains(e.target) &&
                    !DOM.navbar.notificationDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("notifications");
                }

                if (
                    !DOM.navbar.messageBtn?.contains(e.target) &&
                    !DOM.navbar.messageDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("messages");
                }

                if (
                    !DOM.navbar.userBtn?.contains(e.target) &&
                    !DOM.navbar.userDropdown?.contains(e.target)
                ) {
                    this.closeDropdown("user");
                }
            });

            // Close on Escape
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
    // SIDEBAR INTERACTIONS
    // ==========================================

    class SidebarManager {
        constructor() {
            this.isCollapsed = this.getCollapsedState();
            this.isOpenMobile = false;
            this.init();
        }

        init() {
            this.applyCollapsedState();
            this.bindEvents();
            this.initActiveMenuItems();
            this.setupWindowResize();
        }

        bindEvents() {
            // Mobile header toggle
            if (DOM.sidebar.headerToggle) {
                DOM.sidebar.headerToggle.addEventListener("click", () => {
                    this.toggleMobileSidebar();
                });
            }

            // Desktop collapse button
            if (DOM.sidebar.collapseBtn) {
                DOM.sidebar.collapseBtn.addEventListener("click", () => {
                    this.toggleCollapsed();
                });
            }

            // Submenu toggles
            DOM.sidebar.menuToggles.forEach((toggle) => {
                toggle.addEventListener("click", (e) => {
                    e.preventDefault();
                    this.toggleSubmenu(toggle);
                });
            });

            // Menu links
            DOM.sidebar.menuLinks.forEach((link) => {
                link.addEventListener("click", () => {
                    if (window.innerWidth < 992) {
                        this.closeMobileSidebar();
                    }
                });
            });

            // Sidebar overlay (mobile)
            if (DOM.sidebar.overlay) {
                DOM.sidebar.overlay.addEventListener("click", () => {
                    this.closeMobileSidebar();
                });
            }

            // Close on escape
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape" && this.isOpenMobile) {
                    this.closeMobileSidebar();
                }
            });
        }

        toggleMobileSidebar() {
            if (this.isOpenMobile) {
                this.closeMobileSidebar();
            } else {
                this.openMobileSidebar();
            }
        }

        openMobileSidebar() {
            if (DOM.sidebar.container) {
                DOM.sidebar.container.classList.add("mobile-open");
            }
            if (DOM.sidebar.overlay) {
                DOM.sidebar.overlay.classList.add("show");
            }
            this.isOpenMobile = true;
        }

        closeMobileSidebar() {
            if (DOM.sidebar.container) {
                DOM.sidebar.container.classList.remove("mobile-open");
            }
            if (DOM.sidebar.overlay) {
                DOM.sidebar.overlay.classList.remove("show");
            }
            this.isOpenMobile = false;
        }

        toggleCollapsed() {
            this.isCollapsed = !this.isCollapsed;
            this.applyCollapsedState();
            this.saveCollapsedState();
        }

        applyCollapsedState() {
            if (DOM.sidebar.container) {
                if (this.isCollapsed) {
                    DOM.sidebar.container.classList.add("collapsed");
                } else {
                    DOM.sidebar.container.classList.remove("collapsed");
                }
            }
        }

        toggleSubmenu(toggle) {
            const submenu = toggle.nextElementSibling;
            if (!submenu || !submenu.classList.contains("submenu")) return;

            const isOpen = submenu.classList.contains("open");

            // Close other submenus
            DOM.sidebar.menuToggles.forEach((t) => {
                if (t !== toggle) {
                    const sub = t.nextElementSibling;
                    if (sub && sub.classList.contains("submenu")) {
                        sub.classList.remove("open");
                        t.classList.remove("open");
                    }
                }
            });

            // Toggle current
            if (!isOpen) {
                submenu.classList.add("open");
                toggle.classList.add("open");
            } else {
                submenu.classList.remove("open");
                toggle.classList.remove("open");
            }
        }

        initActiveMenuItems() {
            // Auto-expand submenu if current route is inside
            DOM.sidebar.menuToggles.forEach((toggle) => {
                const submenu = toggle.nextElementSibling;
                if (!submenu || !submenu.classList.contains("submenu")) return;

                const hasActiveChild = submenu.querySelector(".active");
                if (hasActiveChild) {
                    submenu.classList.add("open");
                    toggle.classList.add("open");
                }
            });

            // Set menu toggle as active if it has active children
            DOM.sidebar.menuToggles.forEach((toggle) => {
                const submenu = toggle.nextElementSibling;
                if (submenu && submenu.classList.contains("submenu")) {
                    const hasActive = submenu.querySelector(".active");
                    if (hasActive) {
                        toggle.classList.add("active");
                    }
                }
            });
        }

        setupWindowResize() {
            let resizeTimer;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (window.innerWidth >= 992) {
                        this.closeMobileSidebar();
                    }
                }, 250);
            });
        }

        saveCollapsedState() {
            localStorage.setItem(
                "sidebar-collapsed",
                this.isCollapsed ? "true" : "false"
            );
        }

        getCollapsedState() {
            const saved = localStorage.getItem("sidebar-collapsed");
            if (saved === null) {
                // Default: not collapsed
                return false;
            }
            return saved === "true";
        }
    }

    // ==========================================
    // INITIALIZATION
    // ==========================================

    document.addEventListener("DOMContentLoaded", () => {
        new NavbarManager();
        new SidebarManager();
    });

    // Handle page transitions (if using AJAX)
    if (window.addEventListener) {
        window.addEventListener("popstate", () => {
            setTimeout(() => {
                const sidebar = new SidebarManager();
                sidebar.initActiveMenuItems();
            }, 100);
        });
    }
})();
