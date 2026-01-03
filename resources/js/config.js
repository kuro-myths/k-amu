/**
 * K-AMU Theme & Search Configuration
 * Konfigurasi tema dan pencarian untuk aplikasi
 */

export const THEME_CONFIG = {
    // Default theme untuk user baru
    DEFAULT: {
        mode: "normal",
        primary_color: "#3b82f6",
        secondary_color: "#8b5cf6",
        background_color: "#ffffff",
        text_color: "#000000",
        accent_color: "#ec4899",
        font_family: "sans",
        font_size: "normal",
        font_weight: "normal",
        dark_mode: false,
        compact_mode: false,
    },

    // Mode theme yang tersedia
    MODES: {
        NORMAL: "normal",
        PRIVATE: "private",
        TOR: "tor",
    },

    // Font families
    FONTS: {
        SANS: "sans",
        SERIF: "serif",
        MONO: "mono",
    },

    // Font sizes
    SIZES: {
        SMALL: "small",
        NORMAL: "normal",
        LARGE: "large",
    },

    // Font weights
    WEIGHTS: {
        LIGHT: "light",
        NORMAL: "normal",
        BOLD: "bold",
    },

    // Preset themes
    PRESETS: {
        LIGHT: {
            name: "Light Mode",
            mode: "normal",
            primary_color: "#3b82f6",
            secondary_color: "#8b5cf6",
            background_color: "#ffffff",
            text_color: "#000000",
            accent_color: "#ec4899",
            dark_mode: false,
        },
        DARK: {
            name: "Dark Mode",
            mode: "normal",
            primary_color: "#60a5fa",
            secondary_color: "#a78bfa",
            background_color: "#1f2937",
            text_color: "#f3f4f6",
            accent_color: "#f472b6",
            dark_mode: true,
        },
        NORD: {
            name: "Nord Theme",
            mode: "normal",
            primary_color: "#88c0d0",
            secondary_color: "#81a1c1",
            background_color: "#2e3440",
            text_color: "#eceff4",
            accent_color: "#bf616a",
            dark_mode: true,
        },
        DRACULA: {
            name: "Dracula Theme",
            mode: "normal",
            primary_color: "#bd93f9",
            secondary_color: "#8be9fd",
            background_color: "#282a36",
            text_color: "#f8f8f2",
            accent_color: "#ff79c6",
            dark_mode: true,
        },
        PRIVATE: {
            name: "Private Mode",
            mode: "private",
            primary_color: "#6366f1",
            secondary_color: "#06b6d4",
            background_color: "#0f172a",
            text_color: "#e2e8f0",
            accent_color: "#f43f5e",
            dark_mode: true,
        },
        TOR: {
            name: "Tor Mode",
            mode: "tor",
            primary_color: "#7c3aed",
            secondary_color: "#6d28d9",
            background_color: "#1a1a1a",
            text_color: "#d1d5db",
            accent_color: "#a855f7",
            dark_mode: true,
        },
    },
};

export const SEARCH_CONFIG = {
    // Tipe data yang bisa dicari
    SEARCH_TYPES: {
        ALL: "all",
        NOTES: "notes",
        PROJECTS: "projects",
        MESSAGES: "messages",
    },

    // Label untuk tipe search
    TYPE_LABELS: {
        all: "Semua Tipe",
        notes: "📝 Catatan",
        projects: "📊 Proyek",
        messages: "💬 Pesan",
    },

    // Default pagination
    PAGINATION: {
        LIMIT: 20,
        OFFSET: 0,
    },

    // Max length untuk query
    MAX_QUERY_LENGTH: 255,

    // Min length untuk trigger search
    MIN_QUERY_LENGTH: 1,

    // Debounce delay untuk autocomplete (ms)
    DEBOUNCE_DELAY: 300,

    // Config untuk history & bookmarks
    HISTORY_LIMIT: 50,
    MAX_TAGS_PER_SEARCH: 10,

    // Common tags
    SUGGESTED_TAGS: [
        "project",
        "urgent",
        "client",
        "proposal",
        "report",
        "follow-up",
        "important",
        "reference",
        "budget",
        "deadline",
    ],
};

export const API_ENDPOINTS = {
    THEME: {
        GET: "/api/theme",
        UPDATE: "/api/theme",
        RESET: "/api/theme/reset",
        PRESETS: "/api/theme/presets",
    },
    SEARCH: {
        SEARCH: "/api/search",
        HISTORY: "/api/search/history",
        BOOKMARKS: "/api/search/bookmarks",
        BY_TAG: "/api/search/tag/:tag",
        ADD_TAG: "/api/search/:id/tag",
        REMOVE_TAG: "/api/search/:id/tag",
        TOGGLE_BOOKMARK: "/api/search/:id/bookmark",
        CLEAR_HISTORY: "/api/search/history",
    },
};

export const UI_CONFIG = {
    // Modal animation
    MODAL_ANIMATION: "fade",

    // Toast notification timeout (ms)
    TOAST_TIMEOUT: 3000,

    // Color picker
    COLOR_PRESETS: [
        "#3b82f6", // Blue
        "#8b5cf6", // Purple
        "#ec4899", // Pink
        "#f59e0b", // Amber
        "#10b981", // Emerald
        "#06b6d4", // Cyan
        "#6366f1", // Indigo
        "#ef4444", // Red
    ],
};

// Export default config
export default {
    THEME_CONFIG,
    SEARCH_CONFIG,
    API_ENDPOINTS,
    UI_CONFIG,
};
