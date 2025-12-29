document.addEventListener("DOMContentLoaded", function () {
    // Tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Active menu indicator based on current route
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll(".menu-link");
    menuLinks.forEach((link) => {
        const href = link.getAttribute("href");
        if (currentPath.includes(href)) {
            link.classList.add("active");
        }
    });
});
