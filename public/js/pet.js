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
                showNotification("Kai-Myu: " + data.message);
            }
        })
        .catch((err) => console.error(err));
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
                showNotification(data.message);
            }
        })
        .catch((err) => console.error(err));
}

// Send chat message
function sendChat() {
    const input = document.getElementById("chatInput");
    const message = input.value.trim();

    if (!message) return;

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
            if (data.success) {
                document
                    .getElementById("chatResponse")
                    .classList.remove("empty");
                document.getElementById("chatResponse").innerHTML = `
                <div style="animation: slideUp 0.3s ease;">
                    <strong style="color: var(--primary-yellow);">Pet:</strong>
                    <p style="margin-top: 10px; color: var(--primary-black);">${data.response}</p>
                </div>
            `;
                if (data.pet) {
                    updateStats(data.pet);
                }
                input.value = "";
            }
        })
        .catch((err) => console.error(err));
}

// Quick chat
function quickChat(text) {
    document.getElementById("chatInput").value = text;
    setTimeout(() => sendChat(), 100);
}

// Update stats display
function updateStats(data) {
    const statBars = document.querySelectorAll(".stat-fill");

    if (data.health && statBars[0]) {
        statBars[0].style.width = data.health + "%";
    }
    if (data.happiness && statBars[1]) {
        statBars[1].style.width = data.happiness + "%";
    }
    if (data.energy && statBars[2]) {
        statBars[2].style.width = data.energy + "%";
    }
}

// Show notification
function showNotification(message) {
    const div = document.createElement("div");
    div.textContent = message;
    div.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary-yellow);
        color: var(--primary-black);
        padding: 15px 20px;
        border-radius: 8px;
        font-weight: 600;
        z-index: 9999;
        animation: slideUp 0.3s ease;
    `;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
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
