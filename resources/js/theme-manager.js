// Theme Manager - Applies theme settings globally
class ThemeManager {
    constructor() {
        this.theme = null;
        this.init();
    }

    async init() {
        try {
            // Check if user is authenticated
            const userElement = document.querySelector("[data-user-id]");
            if (!userElement) return; // Not authenticated

            await this.loadTheme();
            this.applyTheme();
            this.observeThemeChanges();
        } catch (error) {
            console.error("Theme Manager initialization error:", error);
        }
    }

    async loadTheme() {
        try {
            const response = await fetch("/api/theme");
            if (response.ok) {
                this.theme = await response.json();
            }
        } catch (error) {
            console.error("Error loading theme:", error);
        }
    }

    applyTheme() {
        if (!this.theme) return;

        const root = document.documentElement;
        const body = document.body;

        // Apply CSS variables
        root.style.setProperty("--primary-color", this.theme.primary_color);
        root.style.setProperty("--secondary-color", this.theme.secondary_color);
        root.style.setProperty(
            "--background-color",
            this.theme.background_color
        );
        root.style.setProperty("--text-color", this.theme.text_color);
        root.style.setProperty("--accent-color", this.theme.accent_color);

        // Apply font styles
        this.applyFontFamily(this.theme.font_family);
        this.applyFontSize(this.theme.font_size);
        this.applyFontWeight(this.theme.font_weight);

        // Apply mode and toggles
        body.className = "";
        body.classList.add(`theme-${this.theme.mode}`);
        body.classList.add(`font-${this.theme.font_family}`);
        body.classList.add(`size-${this.theme.font_size}`);
        body.classList.add(`weight-${this.theme.font_weight}`);

        if (this.theme.dark_mode) {
            body.classList.add("dark-mode");
        }

        if (this.theme.compact_mode) {
            body.classList.add("compact-mode");
        }

        // Apply to document
        document.documentElement.style.backgroundColor =
            this.theme.background_color;
        document.documentElement.style.color = this.theme.text_color;

        // Store in localStorage for faster access
        localStorage.setItem("userTheme", JSON.stringify(this.theme));
    }

    applyFontFamily(family) {
        const root = document.documentElement;
        let fontFamily = "system-ui, -apple-system, sans-serif";

        if (family === "serif") {
            fontFamily = 'Georgia, "Times New Roman", serif';
        } else if (family === "mono") {
            fontFamily = '"Courier New", Courier, monospace';
        }

        root.style.setProperty("--font-family", fontFamily);
    }

    applyFontSize(size) {
        const root = document.documentElement;
        let fontSize = "1rem";

        if (size === "small") {
            fontSize = "0.875rem";
        } else if (size === "large") {
            fontSize = "1.25rem";
        }

        root.style.setProperty("--font-size", fontSize);
    }

    applyFontWeight(weight) {
        const root = document.documentElement;
        let fontWeight = "400";

        if (weight === "light") {
            fontWeight = "300";
        } else if (weight === "bold") {
            fontWeight = "700";
        }

        root.style.setProperty("--font-weight", fontWeight);
    }

    observeThemeChanges() {
        // Listen for theme changes via window events
        window.addEventListener("themeUpdated", (event) => {
            this.theme = event.detail;
            this.applyTheme();
        });
    }

    updateTheme(newTheme) {
        this.theme = { ...this.theme, ...newTheme };
        this.applyTheme();
    }
}

// Initialize theme manager when DOM is ready
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
        new ThemeManager();
    });
} else {
    new ThemeManager();
}
