// Play with pet
function playWithPet() {
    fetch("/pet/interact", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                updateStats(data);
                showNotification("🎮 " + data.message);
                animatePetInteraction();
            } else {
                showNotification("❌ Gagal mengajak bermain", "error");
            }
        })
        .catch((err) => {
            console.error(err);
            showNotification("❌ Terjadi kesalahan", "error");
        });
}

// Rest pet
function restPet() {
    fetch("/pet/rest", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                updateStats(data);
                showNotification("😴 " + data.message);
                animatePetRest();
            } else {
                showNotification("❌ Gagal istirahat", "error");
            }
        })
        .catch((err) => {
            console.error(err);
            showNotification("❌ Terjadi kesalahan", "error");
        });
}

// Send chat message dengan loading state
function sendChat() {
    const input = document.getElementById("chatInput");
    const message = input.value.trim();

    if (!message) return;

    // Disable input saat loading
    input.disabled = true;
    const sendBtn = document.querySelector('.btn-send');
    sendBtn.disabled = true;

    // Show loading state
    const chatMessages = document.getElementById("chatMessages");
    const loadingMsg = document.createElement("div");
    loadingMsg.className = "message message-loading";
    loadingMsg.innerHTML = `
        <div class="message-avatar loading-avatar">
            <i class="bi bi-chat-left-quote"></i>
        </div>
        <div class="message-content">
            <p style="color: var(--primary-gray); font-style: italic;">Sedang berpikir... 💭</p>
        </div>
    `;
    chatMessages.appendChild(loadingMsg);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    fetch("/pet/chat", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({ message: message }),
    })
        .then((res) => res.json())
        .then((data) => {
            // Remove loading message
            loadingMsg.remove();

            if (data.success) {
                // Add AI response message
                const responseMsg = document.createElement("div");
                responseMsg.className = "message message-response";
                responseMsg.innerHTML = `
                    <div class="message-avatar">
                        <i class="bi bi-chat-left-quote"></i>
                    </div>
                    <div class="message-content">
                        <p>${data.response}</p>
                    </div>
                `;
                responseMsg.style.animation = "slideUp 0.3s ease";
                chatMessages.appendChild(responseMsg);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                if (data.pet) {
                    updateStats(data.pet);
                }
                showNotification("✨ Pet merespon pesan Anda!", "success");
            } else {
                showNotification("❌ Pet tidak merespons", "error");
            }
        })
        .catch((err) => {
            console.error(err);
            loadingMsg.remove();
            showNotification("❌ Gagal mengirim pesan", "error");
        })
        .finally(() => {
            input.value = "";
            input.disabled = false;
            sendBtn.disabled = false;
            input.focus();
        });
}

// Quick chat
function quickChat(text) {
    document.getElementById("chatInput").value = text;
    setTimeout(() => sendChat(), 100);
}

// Update stats display
function updateStats(data) {
    const statBars = document.querySelectorAll(".stat-fill");

    if (data.health !== undefined && statBars[0]) {
        statBars[0].style.width = data.health + "%";
    }
    if (data.happiness !== undefined && statBars[1]) {
        statBars[1].style.width = data.happiness + "%";
    }
    if (data.energy !== undefined && statBars[2]) {
        statBars[2].style.width = data.energy + "%";
    }

    // Update navbar level & experience
    updateNavbarInfo(data);
}

// Update navbar with latest info
function updateNavbarInfo(data) {
    if (data.level !== undefined || data.experience !== undefined) {
        const navbarLevel = document.querySelector(
            '.navbar-custom [class*="badge"]'
        );
        if (navbarLevel) {
            const level = data.level || 1;
            const exp = data.experience || 0;
            navbarLevel.parentElement.innerHTML = `
                <span class="badge bg-warning text-dark me-2"><i class="bi bi-star-fill"></i> Level ${level}</span>
                <span class="badge bg-info text-white"><i class="bi bi-lightning-charge"></i> EXP ${exp}/100</span>
            `;
        }
    }
}

// Show notification with enhanced styling
function showNotification(message, type = "success") {
    const div = document.createElement("div");
    div.textContent = message;

    const bgColor =
        type === "error" ? "var(--primary-black)" : "var(--primary-yellow)";
    const textColor =
        type === "error" ? "var(--primary-yellow)" : "var(--primary-black)";

    div.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: ${bgColor};
        color: ${textColor};
        padding: 15px 20px;
        border-radius: 8px;
        font-weight: 600;
        z-index: 9999;
        animation: slideUp 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        max-width: 300px;
        word-wrap: break-word;
    `;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
}

// Animate pet interaction
function animatePetInteraction() {
    const petImage = document.querySelector(".pet-image");
    if (petImage) {
        petImage.style.animation = "bounce 0.5s ease-in-out";
        setTimeout(() => {
            petImage.style.animation = "";
        }, 500);
    }
}

// Animate pet rest
function animatePetRest() {
    const petImage = document.querySelector(".pet-image");
    if (petImage) {
        petImage.style.opacity = "0.7";
        setTimeout(() => {
            petImage.style.opacity = "1";
        }, 1500);
    }
}

// Allow Enter to send chat
document.addEventListener("DOMContentLoaded", function () {
    const chatInput = document.getElementById("chatInput");
    if (chatInput) {
        chatInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") sendChat();
        });
    }
});

// Add bounce animation
const style = document.createElement("style");
style.textContent = `
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
`;
document.head.appendChild(style);
