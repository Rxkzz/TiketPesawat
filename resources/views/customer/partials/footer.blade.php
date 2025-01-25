<footer class="footer">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-section">
                <h5>Tentang TiketPesawat</h5>
                <ul>
                    <li><a href="#">Cara Pesan</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Bantuan</a></li>
                    <li><a href="#">Karir</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Produk</h5>
                <ul>
                    <li><a href="#">Tiket Pesawat</a></li>
                    <li><a href="#">Hotel</a></li>
                    <li><a href="#">Kereta Api</a></li>
                    <li><a href="#">Sewa Mobil</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h5>Follow Kami</h5>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 TiketPesawat. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: white;
        padding: 48px 0 24px;
        margin-top: 48px;
        border-top: 1px solid var(--border-color);
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-top {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 48px;
    }

    .footer-section h5 {
        color: var(--text-dark);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        margin-bottom: 12px;
    }

    .footer-section ul li a {
        color: var(--text-gray);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: var(--primary-purple);
    }

    .social-links {
        display: flex;
        gap: 16px;
    }

    .social-links a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--light-purple);
        color: var(--primary-purple);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: var(--primary-purple);
        color: white;
    }

    .footer-bottom {
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
        text-align: center;
        color: var(--text-gray);
        font-size: 14px;
    }
</style>