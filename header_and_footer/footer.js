document.addEventListener("DOMContentLoaded", function () {
    fetch("/header_and_footer/footer.html") // Load footer.html dynamically
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer-placeholder").innerHTML = data;
        })
        .catch(error => console.error("Error loading footer:", error));
});

