/**
 * Real-time Notification Badge Update
 * Polls server every 30 seconds for new notifications count
 */

(function () {
    "use strict";

    // Configuration
    const config = {
        pollInterval: 30000, // 30 seconds
        apiEndpoint: "/superadmin/notifikasi/api/unread",
    };

    /**
     * Update notification badge and dropdown
     */
    function updateNotificationBadge() {
        fetch(config.apiEndpoint, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                const badge = document.getElementById("notificationBadge");
                const dropdown = document.querySelector(
                    '[id="notificationBtn"] ~ .dropdown-menu'
                );

                if (!badge || !dropdown) return;

                // Update badge
                if (data.count > 0) {
                    const displayCount = data.count > 99 ? "99+" : data.count;
                    badge.textContent = displayCount;
                    badge.style.display = "block";
                } else {
                    badge.style.display = "none";
                }

                // Update dropdown (optional - for real-time updates)
                if (data.notifications && data.notifications.length > 0) {
                    updateDropdownItems(dropdown, data.notifications);
                }
            })
            .catch((error) =>
                console.error("Error updating notifications:", error)
            );
    }

    /**
     * Update dropdown notification items
     */
    function updateDropdownItems(dropdown, notifications) {
        if (!dropdown) return;

        const dropdownItems = dropdown.querySelector(".dropdown-menu");
        if (!dropdownItems) return;

        // Find notification items container (before the "Lihat Semua" link)
        let itemsHtml = "";

        notifications.forEach((notif) => {
            itemsHtml += `
                <li>
                    <a class="dropdown-item" href="/superadmin/notifikasi">
                        <i class="bi ${notif.icon || "bi-info-circle"}"></i>
                        <div class="d-flex flex-column flex-grow-1">
                            <span class="fw-bold">${notif.title}</span>
                            <small class="text-muted">${notif.content.substring(
                                0,
                                50
                            )}...</small>
                            <small class="text-secondary">${
                                notif.created_at
                            }</small>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
            `;
        });

        if (itemsHtml) {
            itemsHtml +=
                '<li><a class="dropdown-item text-center text-primary fw-bold" href="/superadmin/notifikasi">Lihat Semua</a></li>';
            dropdown.innerHTML = itemsHtml;
        }
    }

    /**
     * Initialize polling
     */
    function initializePolling() {
        // Update immediately on page load
        updateNotificationBadge();

        // Set up periodic polling
        setInterval(updateNotificationBadge, config.pollInterval);

        // Also update on page focus
        document.addEventListener("visibilitychange", function () {
            if (!document.hidden) {
                updateNotificationBadge();
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initializePolling);
    } else {
        initializePolling();
    }

    // Expose global function for manual updates
    window.updateNotifications = updateNotificationBadge;
})();
