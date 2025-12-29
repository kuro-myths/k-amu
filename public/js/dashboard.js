document.addEventListener("DOMContentLoaded", function () {
    const userCtx = document.getElementById("userChart");
    if (userCtx) {
        new Chart(userCtx, {
            type: "doughnut",
            data: {
                labels: [
                    "SuperAdmin",
                    "Mastercard",
                    "Leader",
                    "Tester",
                    "Pengguna",
                ],
                datasets: [
                    {
                        data: [1, 1, 3, 3, 10],
                        backgroundColor: [
                            "#4f46e5",
                            "#06b6d4",
                            "#10b981",
                            "#f59e0b",
                            "#ef4444",
                        ],
                        borderWidth: 0,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: { size: 12 },
                            padding: 15,
                            usePointStyle: true,
                        },
                    },
                },
            },
        });
    }

    const activityCtx = document.getElementById("activityChart");
    if (activityCtx) {
        new Chart(activityCtx, {
            type: "line",
            data: {
                labels: [
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jumat",
                    "Sabtu",
                    "Minggu",
                ],
                datasets: [
                    {
                        label: "Aktivitas",
                        data: [65, 72, 68, 85, 79, 88, 72],
                        borderColor: "#4f46e5",
                        backgroundColor: "rgba(79, 70, 229, 0.1)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: "#4f46e5",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: "#e5e7eb" },
                    },
                    x: { grid: { display: false } },
                },
            },
        });
    }
});
