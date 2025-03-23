class Footer extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
               <footer class="footer">
        <div class="footer-container">

            <!-- Social Media Links -->
            <div class="footer-social">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
    
            <!-- Copyright and Creator -->
            <p class="footer-text">
                &copy; 2024 Quizzet. All Rights Reserved. <br>
                Made with ❤️ by <span class="creator">SoulGainer</span>
            </p>
        </div>
    </footer>
        `;
    }
}
customElements.define('app-footer', Footer);
