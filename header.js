document.addEventListener("DOMContentLoaded", function () {
    // Load the header dynamically
    fetch("header.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("header-placeholder").innerHTML = data;

            // Highlight the active page in the navbar
            highlightActiveNav();
        })
        .catch(error => console.error("Error loading header:", error));
});

function highlightActiveNav() {
    const currentPage = window.location.pathname.split("/").pop(); // Get current page filename
    const navLinks = document.querySelectorAll("nav a"); // Select all nav links

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active-nav"); // Apply the active class
        } else {
            link.classList.remove("active-nav"); // Remove from others
        }
    });
}

// Scroll to top when the page loads
window.onload = function () {
    window.scrollTo(0, 0);
};

