<footer class="mellow-footer mt-5">

    <style>
        .mellow-footer {
            background: #2f2f2f;
            color: #e7e7e7;
            padding: 70px 5% 30px;
            font-family: 'Poppins', sans-serif;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-logo img {
            height: 55px;
        }

        .footer-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #fff;
        }

        .footer-links a {
            color: #d7d7d7;
            text-decoration: none;
            display: block;
            margin: 6px 0;
            transition: 0.2s;
        }

        .footer-links a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .footer-contact p {
            margin: 4px 0;
            font-size: 15px;
        }

        .footer-social a {
            margin-right: 15px;
            font-size: 18px;
            color: #d7d7d7;
            transition: 0.2s;
            text-decoration: none;
        }

        .footer-social a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            font-size: 14px;
            color: #bfbfbf;
        }
    </style>

    <div class="footer-grid">

        {{-- LOGO + SHORT DESCRIPTION --}}
        <div>
            <div class="footer-logo">
                <img src="{{ asset('images/main-logo.png') }}" alt="Mellow Resort">
                <h3 style="font-weight:600; margin:0;">MELLOW</h3>
            </div>
            <p class="mt-3">
                Experience unmatched luxury, relaxation, and island comfort at  
                Mellow Island Park — where every stay feels like paradise.
            </p>
        </div>

        {{-- QUICK LINKS --}}
        <div>
            <h4 class="footer-title">Explore</h4>
            <div class="footer-links">
                <a href="#hero">Home</a>
                <a href="#about-us">About</a>
                <a href="#rooms">Rooms</a>
                <a href="#activities">Activities</a>
                <a href="#spa">Spa & Wellness</a>
            </div>
        </div>

        {{-- CONTACT --}}
        <div>
            <h4 class="footer-title">Contact Us</h4>
            <div class="footer-contact">
                <p>Email: info@mellow.com</p>
                <p>Phone: +960 7703055</p>
                <p>Address: Mellow Island Park, Maldives</p>
            </div>
        </div>

        {{-- SOCIAL --}}
        <div>
            <h4 class="footer-title">Follow Us</h4>

            <div class="footer-social">
                <a href="#" target="_blank">Facebook</a>
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">YouTube</a>
                <a href="#" target="_blank">LinkedIn</a>
            </div>
        </div>
    </div>

    {{-- COPYRIGHT --}}
    <div class="footer-bottom">
        © {{ date('Y') }} Mellow Island Park. All Rights Reserved.
    </div>

</footer>
