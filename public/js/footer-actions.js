document.addEventListener("DOMContentLoaded", function () {
    const photoBtn = document.getElementById("footerPhotoBtn");
    const calendarBtn = document.getElementById("footerCalendarBtn");
    const clockBtn = document.getElementById("footerClockBtn");

    // Storage keys
    const COUNTDOWN_STORAGE_KEY = "countdown_history";
    const TIMETRACK_STORAGE_KEY = "timetrack_history";
    const TIMETRACK_STATE_KEY = "timetrack_state";

    // ===== SCREENSHOT / PHOTO BUTTON =====
    if (photoBtn) {
        photoBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Screenshot button clicked");
            takeScreenshot();
        });
    }

    function takeScreenshot() {
        if (typeof html2canvas === "undefined") {
            const script = document.createElement("script");
            script.src =
                "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js";
            script.onload = function () {
                captureScreen();
            };
            document.head.appendChild(script);
        } else {
            captureScreen();
        }
    }

    function captureScreen() {
        photoBtn.disabled = true;
        const originalContent = photoBtn.innerHTML;
        photoBtn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

        const mainContent = document.querySelector(".right-content-wrapper");

        if (mainContent) {
            html2canvas(mainContent, {
                backgroundColor: "#ffffff",
                scale: 2,
                logging: false,
                useCORS: true,
                allowTaint: true,
            })
                .then((canvas) => {
                    canvas.toBlob(function (blob) {
                        const url = URL.createObjectURL(blob);
                        const link = document.createElement("a");
                        const timestamp = new Date()
                            .toISOString()
                            .replace(/[:.]/g, "-")
                            .slice(0, -5);
                        link.href = url;
                        link.download = `screenshot-${timestamp}.png`;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        URL.revokeObjectURL(url);

                        photoBtn.disabled = false;
                        photoBtn.innerHTML = originalContent;
                        console.log("Screenshot downloaded successfully");
                    });
                })
                .catch((err) => {
                    console.error("Screenshot failed:", err);
                    photoBtn.disabled = false;
                    photoBtn.innerHTML = originalContent;
                    alert("Screenshot gagal. Silakan coba lagi.");
                });
        }
    }

    // ===== COUNTDOWN / CALENDAR BUTTON =====
    if (calendarBtn) {
        calendarBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Calendar button clicked");
            openCalendarModal();
        });
    }

    function openCalendarModal() {
        const modal = document.getElementById("countdownModal");
        if (modal) {
            const bootstrap = window.bootstrap;
            if (bootstrap) {
                const bsModal = new bootstrap.Modal(modal);
                bsModal.show();
                initializeCalendar();
            }
        } else {
            alert("Modal tidak ditemukan");
        }
    }

    // ===== CALENDAR FUNCTIONS =====
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    const markedDates = JSON.parse(localStorage.getItem("markedDates") || "{}");

    window.initializeCalendar = function () {
        renderCalendar();
    };

    window.renderCalendar = function () {
        const calendarContainer = document.getElementById("calendarContainer");
        if (!calendarContainer) return;

        const monthNames = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        const dayNames = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(
            currentYear,
            currentMonth + 1,
            0
        ).getDate();
        const daysInPrevMonth = new Date(
            currentYear,
            currentMonth,
            0
        ).getDate();

        let html = `
            <div class="calendar-header">
                <button class="btn btn-sm" onclick="window.prevMonth()" style="padding: 4px 8px;">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <h6 style="margin: 0; flex: 1; text-align: center;">${monthNames[currentMonth]} ${currentYear}</h6>
                <button class="btn btn-sm" onclick="window.nextMonth()" style="padding: 4px 8px;">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <table class="calendar-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
        `;

        // Day headers
        dayNames.forEach((day) => {
            html += `<th style="padding: 8px; text-align: center; font-weight: bold; border-bottom: 2px solid #e5e7eb;">${day}</th>`;
        });
        html += `</tr><tr>`;

        // Previous month days
        for (let i = firstDay - 1; i >= 0; i--) {
            const day = daysInPrevMonth - i;
            html += `<td style="padding: 8px; text-align: center; color: #ccc; border: 1px solid #e5e7eb;">${day}</td>`;
        }

        // Current month days
        const dateKey = `${currentYear}-${String(currentMonth + 1).padStart(
            2,
            "0"
        )}`;
        for (let day = 1; day <= daysInMonth; day++) {
            if ((firstDay + day - 1) % 7 === 0 && day !== 1) {
                html += `</tr><tr>`;
            }

            const fullDate = `${dateKey}-${String(day).padStart(2, "0")}`;
            const isMarked = markedDates[fullDate];
            const isToday =
                new Date().toDateString() ===
                new Date(currentYear, currentMonth, day).toDateString();

            let cellStyle = `padding: 8px; text-align: center; border: 1px solid #e5e7eb; cursor: pointer; `;
            if (isToday) {
                cellStyle += `background: rgba(79, 70, 229, 0.2); font-weight: bold;`;
            } else if (isMarked) {
                cellStyle += `background: rgba(16, 185, 129, 0.2); color: #10b981;`;
            } else {
                cellStyle += `background: white;`;
            }

            html += `<td style="${cellStyle}" onclick="window.toggleMark('${fullDate}')">${day}</td>`;
        }

        // Next month days
        const totalCells = firstDay + daysInMonth;
        const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
        for (let day = 1; day <= remainingCells; day++) {
            html += `<td style="padding: 8px; text-align: center; color: #ccc; border: 1px solid #e5e7eb;">${day}</td>`;
        }

        html += `</tr></table>`;
        calendarContainer.innerHTML = html;
    };

    window.prevMonth = function () {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    };

    window.nextMonth = function () {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    };

    window.toggleMark = function (date) {
        if (markedDates[date]) {
            delete markedDates[date];
        } else {
            markedDates[date] = true;
        }
        localStorage.setItem("markedDates", JSON.stringify(markedDates));
        renderCalendar();
    };

    window.clearAllMarks = function () {
        if (confirm("Hapus semua penanda tanggal?")) {
            localStorage.removeItem("markedDates");
            location.reload();
        }
    };

    // ===== TIME TRACKING / CLOCK BUTTON =====
    if (clockBtn) {
        clockBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Time tracking button clicked");
            openTimeTrackingModal();
        });
    }

    function openTimeTrackingModal() {
        const modal = document.getElementById("timetrackingModal");
        if (modal) {
            const bootstrap = window.bootstrap;
            if (bootstrap) {
                const bsModal = new bootstrap.Modal(modal);
                bsModal.show();
                updateTimeTrackingDisplay();
            }
        } else {
            alert("Modal tidak ditemukan");
        }
    }

    // ===== TIME TRACKING FUNCTIONS =====
    window.toggleTimeTracking = function () {
        let state = JSON.parse(
            localStorage.getItem(TIMETRACK_STATE_KEY) ||
                '{"active": false, "startTime": null}'
        );

        if (state.active) {
            // Stop tracking
            const endTime = new Date();
            const duration = Math.floor(
                (endTime.getTime() - state.startTime) / 1000
            );

            const history = JSON.parse(
                localStorage.getItem(TIMETRACK_STORAGE_KEY) || "[]"
            );
            history.push({
                date: new Date(state.startTime).toLocaleString("id-ID"),
                duration: duration,
                timestamp: state.startTime,
            });
            localStorage.setItem(
                TIMETRACK_STORAGE_KEY,
                JSON.stringify(history)
            );

            state.active = false;
            state.startTime = null;
        } else {
            // Start tracking
            state.active = true;
            state.startTime = new Date().getTime();
        }

        localStorage.setItem(TIMETRACK_STATE_KEY, JSON.stringify(state));
        updateTimeTrackingDisplay();
    };

    window.updateTimeTrackingDisplay = function () {
        const state = JSON.parse(
            localStorage.getItem(TIMETRACK_STATE_KEY) ||
                '{"active": false, "startTime": null}'
        );
        const statusBtn = document.getElementById("timetrackingToggleBtn");
        const statusDisplay = document.getElementById("timetrackingStatus");
        const timerDisplay = document.getElementById("timetrackingTimer");

        if (statusBtn) {
            statusBtn.textContent = state.active
                ? "Hentikan Tracking"
                : "Mulai Tracking";
            statusBtn.className = state.active
                ? "btn btn-danger btn-sm"
                : "btn btn-success btn-sm";
        }

        if (statusDisplay) {
            statusDisplay.innerHTML = state.active
                ? '<span class="badge bg-success">Aktif</span>'
                : '<span class="badge bg-secondary">Tidak Aktif</span>';
        }

        // Update timer
        if (state.active && timerDisplay) {
            const updateTimer = () => {
                const elapsed = Math.floor(
                    (new Date().getTime() - state.startTime) / 1000
                );
                const hours = Math.floor(elapsed / 3600);
                const minutes = Math.floor((elapsed % 3600) / 60);
                const seconds = elapsed % 60;

                timerDisplay.textContent = `${hours
                    .toString()
                    .padStart(2, "0")}:${minutes
                    .toString()
                    .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
            };

            updateTimer();
            window.timetrackingInterval = setInterval(updateTimer, 1000);
        } else if (timerDisplay) {
            timerDisplay.textContent = "00:00:00";
            if (window.timetrackingInterval) {
                clearInterval(window.timetrackingInterval);
            }
        }

        updateTimeTrackingHistory();
    };

    window.clearTimeTrackingHistory = function () {
        if (confirm("Hapus semua riwayat waktu aktif?")) {
            localStorage.removeItem(TIMETRACK_STORAGE_KEY);
            updateTimeTrackingHistory();
        }
    };

    window.updateTimeTrackingHistory = function () {
        const history = JSON.parse(
            localStorage.getItem(TIMETRACK_STORAGE_KEY) || "[]"
        );
        const historyContainer = document.getElementById(
            "timetrackingHistoryList"
        );

        if (historyContainer) {
            if (history.length === 0) {
                historyContainer.innerHTML =
                    "<p class='text-muted'>Belum ada riwayat</p>";
            } else {
                historyContainer.innerHTML = history
                    .reverse()
                    .map((item) => {
                        const hours = Math.floor(item.duration / 3600);
                        const minutes = Math.floor((item.duration % 3600) / 60);
                        const seconds = item.duration % 60;
                        return `<div class='p-2 border-bottom'>
                    <strong>${hours}h ${minutes}m ${seconds}s</strong> - ${item.date}
                </div>`;
                    })
                    .join("");
            }
        }
    };
});
